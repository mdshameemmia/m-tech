<?php

namespace App\Http\Controllers;

use Exception;
use Mpdf\Mpdf;
use Carbon\Carbon;
use App\Models\Company;
use App\Models\Product;
use App\Models\Project;
use App\Models\Quotation;
use Illuminate\Http\Request;
use App\Models\ProgressClaim;
use App\Models\ProductQuotation;
use Illuminate\Support\Facades\DB;

class ProgressClaimController extends Controller
{
    public function index()
    {
        $progress_claims = ProgressClaim::orderBy('id', 'desc')->get();
        // dd($progress_claims);
        return view('progress-claims.index', compact('progress_claims'));
    }

    public function create()
    {

        $companies  = Company::orderBy('id', 'desc')->get();
        $quotations  = Quotation::orderBy('id', 'desc')->get();
        $products = Product::orderBy('id', 'desc')->get();
        // dd($quotations);
        return view('progress-claims.create', compact('companies', 'products','quotations'));
    }


    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
             
            $progress_claim = $request->except(['_token','description','contact_sum','work_done','amount_due','product_description_title']);
            $data = $request->all();
            // dd($data);
            $company = Company::where('id',$request->company_id)->first();
            $total_progress_claim = ProgressClaim::where('company_id',$request->company_id)->where('quotation_id',$request->quotation_id)->count() + 1;
            $company_name_arr = explode(" ", $company->name);
            $company_title = substr($company_name_arr[0], 0, 1) . substr($company_name_arr[1], 0, 1);
            $claim_no = 'MT' . '/' . $company_title . '/' . 'PC/' . Carbon::now()->format('Y') . '-' . str_pad($total_progress_claim, 2, '0', STR_PAD_LEFT);

            $progress_claim['claim_no'] = $claim_no;
            $description = $data['description'];
            $contact_sum = $data['contact_sum'];
            $work_done = $data['work_done'];
            $amount_due = $data['amount_due'];
            $product_description_title = $data['product_description_title'];
            $progress_description = [];
            foreach ($description as $key => $product_id) {
                $progress_description[$key]['description'] = $description[$key];
                $progress_description[$key]['contact_sum'] = $contact_sum[$key];
                $progress_description[$key]['work_done'] = $work_done[$key];
                $progress_description[$key]['amount_due'] = $amount_due[$key];
                $progress_description[$key]['product_description_title'] = $product_description_title[$key];
            }


            ProgressClaim::create($progress_claim)->progressDescription()->createMany($progress_description);
            DB::commit();
            return redirect()->route('progress-claim.index')->withMessage('Successfully added !');
        } catch (Exception $e) {
            
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function edit($id)
    {

        try{
            $progress_claim = ProgressClaim::where("id",$id)->first();
            if($progress_claim->is_invoice_create =='Yes'){
                return redirect()->back();
            }
            $companies  = Company::orderBy('id', 'desc')->get();
            $quotations  = Quotation::orderBy('id', 'desc')->get();
            $products = Product::orderBy('id', 'desc')->get();
            return view('progress-claims.edit', compact('companies', 'products','quotations','progress_claim'));
        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function update(Request $request,$id)
    {
        DB::beginTransaction();
        try {
             
            // $progress_claim = $request->except(['_token','description','contact_sum','work_done','amount_due']);
            $progress_claim = $request->except(['_token','description','contact_sum','work_done','amount_due','product_description_title']);

            $data = $request->all();
            // dd($data);
            $company = Company::where('id',$request->company_id)->first();
            $total_progress_claim = ProgressClaim::where('company_id',$request->company_id)->where('quotation_id',$request->quotation_id)->count();
            $company_name_arr = explode(" ", $company->name);
            $company_title = substr($company_name_arr[0], 0, 1) . substr($company_name_arr[1], 0, 1);
            $claim_no = 'MT' . '/' . $company_title . '/' . 'PC/' . Carbon::now()->format('Y') . '-' . str_pad($total_progress_claim, 2, '0', STR_PAD_LEFT);

            $progress_claim['claim_no'] = $claim_no;
            $description = $data['description'];
            $contact_sum = $data['contact_sum'];
            $work_done = $data['work_done'];
            $amount_due = $data['amount_due'];
            $progress_description = [];
            foreach ($description as $key => $product_id) {
                $progress_description[$key]['description'] = $description[$key];
                $progress_description[$key]['contact_sum'] = $contact_sum[$key];
                $progress_description[$key]['work_done'] = $work_done[$key];
                $progress_description[$key]['amount_due'] = $amount_due[$key];
            }

            $old_progress_claim = ProgressClaim::where('id',$id)->first();
            $old_progress_claim->progressDescription()->delete();
            $old_progress_claim->update($progress_claim);
            $old_progress_claim->progressDescription()->createMany($progress_description);
            DB::commit();
            return redirect()->route('progress-claim.index')->withMessage('Successfully updated !');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }


    public function delete($id)
    {
        try {
            $quotation = ProgressClaim::where('id', $id)->first();
            $quotation->progressDescription()->delete();
            $quotation->delete();

            return redirect()->route('progress-claim.index')->withMessage('Successfully Deleted !');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }


    public function getProductDescription(Request $request)
    {
        try{
            
            $quotation_id = $request->quotation_id;
            $product_quotations =  ProductQuotation::where('quotation_id',$quotation_id)->get();
             $old_progress_claim = ProgressClaim::where('quotation_id',$quotation_id)->orderBy('id','desc')->first();
            if($old_progress_claim){
               return $old_progress_claim->progressDescription;
            }
            
            $data = [];
            $formatted_data = [];
            foreach($product_quotations as $key=>$product_quotation)
            {
                if(!empty($product_quotation->product_id)){
                    $data['description'] = $product_quotation->product->item_name;
                    $data['contact_sum'] = $product_quotation->amount;
                    $data['amount_due'] = $product_quotation->amount_due;
                    $data['product_description_title'] = $product_quotation->product_description_title;
                    array_push($formatted_data,$data);
                }
            }
            return $formatted_data;

        }catch(Exception $e)
        {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }


    public function getUnit(Request $request)
    {
        $product_id = $request->product_id;
        $unit = Product::where('id', $product_id)->first();
        return $unit;
    }


    public function progressClaimDownload($id)
    {
        try {

            $progress_claim =  ProgressClaim::where('id',$id)->first();

            $pre_progress_claim = ProgressClaim::where('project_id',$progress_claim->project_id)->where('claim_no','!=',$progress_claim->claim_no)->get();
            $company_profile = Company::first();
            $own_company_address = $company_profile->address;

            $descriptions = $progress_claim->progressDescription;
            $data = [];
            foreach ($descriptions as $key => $item) {
                $data['data'][$item['product_description_title']]['quotation_description'][$key] = $item;
                $data['data'][$item['product_description_title']]['sub_total_due'][$key] = $item->amount_due;
                $data['data'][$item['product_description_title']]['sub_total_amount'][$key] = $item->contact_sum;
            }

            // dd($data);


            $view =  view('progress-claims.pdf',compact('progress_claim','data','company_profile','pre_progress_claim'));

            $name = $progress_claim->company->name;
            $address = $progress_claim->company->address;
            $tel = $progress_claim->company->tel;
            $fax = $progress_claim->company->fax;
            $attention = $progress_claim->company->attention;
            $date = date('d/m/Y',strtotime( $progress_claim->created_at));
            $quotation = $progress_claim->quotation->quotation;
            $claim_no =  $progress_claim->claim_no;
            $month  = date('M Y',strtotime($progress_claim->date));
            $title = $progress_claim->project->title;
          
            
            $header = "<div>
                    <img src='images/logo.jpg' width='100%' height='100px' />
                    <h2>Progress Claim</h2>
                    <div style='width:100% ;display:flex'>
                    <div style='width: 50%;float:left'>
                        <p>$name</p>
                        <p>$address</p>
                        <p>Tel: $tel</p>
                        <p>Fax: $fax</p>
                        <p>Attention: $attention</p>
                    </div>
                    <div style='width: 50%;float:left'>
                        <p>Date: $date</p>
                        <p>Ref QUOTATION NO: $quotation</p>
                        <p>PROGRESS CLAIM MONTH: $month </p>
                        <p>PROGRESS CLAIM NO: $claim_no</p>
                    </div>
                 </div>
                <br>
            <div>
            <span style='font-weight: bold;color:#000;padding:20px 0'>Project Title</span> : $title
            </div>
            <br>
            </div>
             ";
             $mpdf = new Mpdf();
             $mpdf->setHTMLHeader($header);
             $mpdf->setHTMLFooter("<p style='text-align:center;font-size:12px'>Page {PAGENO} of {nb}</p>");
            $mpdf->SetTopMargin(110);

            $mpdf->WriteHTML($view);
            $mpdf->Output("$claim_no.pdf",'D');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }



}
