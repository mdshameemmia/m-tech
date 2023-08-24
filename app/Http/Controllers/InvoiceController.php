<?php

namespace App\Http\Controllers;

use Exception;
use Mpdf\Mpdf;
use Carbon\Carbon;
use App\Models\Company;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Quotation;
use Illuminate\Http\Request;
use App\Models\ProgressClaim;
use App\Models\ProductQuotation;
use App\Models\ProgressDescription;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::orderBy('id', 'desc')->get();
        return view('invoices.index', compact('invoices'));
    }

    public function create()
    {

        $companies  = Company::orderBy('id', 'desc')->get();
        $progress_claims  = ProgressClaim::orderBy('id', 'desc')->get();
        $products = Product::orderBy('id', 'desc')->get();
        return view('invoices.create', compact('companies', 'products','progress_claims'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

             $data = $request->all();
            $invoice = $request->except(['_token','description','contact_sum','work_done','amount_due','date','claim_no','title','total_amount','total_due','total_payment','product_description_title','current_payment']);
            $progress_claim_id = ProgressClaim::where('claim_no',$request->claim_no)->pluck('id')->first();
          
            $company = Company::where('id',$request->company_id)->first();
            // $invoice_count = ProgressClaim::where('company_id',$request->company_id)->where('project_id',$data['title'])->count();
            $invoice_count = Invoice::count() + 300;

            $company_name_arr = explode(" ", $company->name);
            $company_title = substr($company_name_arr[0], 0, 1) . substr($company_name_arr[1], 0, 1);
            $invoice_no = 'MT' . '/' . $company_title . '/' . 'INV/' . Carbon::now()->format('Y') . '-' . str_pad($invoice_count, 2, '0', STR_PAD_LEFT);


            $invoice['progress_claim_id'] = $progress_claim_id;
            $invoice['invoice_no'] = $invoice_no;
            $description = $data['description'];
            $contact_sum = $data['contact_sum'];
            $work_done = $data['work_done'];
            $amount_due = $data['amount_due'];
            $product_description_title = $data['product_description_title'];
            $invoice_details = [];
            foreach ($description as $key => $product_id) {
                $invoice_details[$key]['description'] = $description[$key];
                $invoice_details[$key]['contact_sum'] = $contact_sum[$key];
                $invoice_details[$key]['work_done'] = $work_done[$key];
                $invoice_details[$key]['amount_due'] = $amount_due[$key];
                $invoice_details[$key]['product_description_title'] = $product_description_title[$key];

            }

            Invoice::create($invoice)->invoiceDetails()->createMany($invoice_details);
            ProgressDescription::where('progress_claim_id',$progress_claim_id)->orderBy('id','desc')->delete();
             $old_progress_claim = ProgressClaim::where('id',$progress_claim_id)->orderBy('id','desc')->first();
             $old_progress_claim->is_invoice_create = 'Yes';
             $old_progress_claim->save();
             $old_progress_claim->progressDescription()->createMany($invoice_details);
             ProgressClaim::where('claim_no',$request->claim_no)->update([
                "total_amount"=>$request->total_amount,
                "total_payment"=>$request->total_payment,
                "total_due"=>$request->total_due
             ]);
            DB::commit();
            return redirect()->route('invoice.index')->withMessage('Successfully added !');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $invoice = Invoice::where('id', $id)->first();
            $invoice->invoiceDetails()->delete();
            $invoice->delete();

            return redirect()->route('invoice.index')->withMessage('Successfully Deleted !');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }


    public function getProductDescription(Request $request)
    {
        try{

            $quotation_id = $request->quotation_id;
            $product_quotations =  ProductQuotation::where('quotation_id',$quotation_id)->get();
             $old_progress_claim = ProgressClaim::where('quotation_id',$quotation_id)->where('company_id',$request->company_id)->orderBy('id','desc')->first();
            return $old_progress_claim->progressDescription;
            
            
            // $data = [];
            // foreach($product_quotations as $key=>$product_quotation)
            // {
            //     $data[$key]['description'] = $product_quotation->product->item_name;
            //     $data[$key]['contact_sum'] = $product_quotation->amount;
            // }

            
            // return $data;

        }catch(Exception $e)
        {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }



    public function invoiceDownload($id)
    {
        try {
  
            $invoice = Invoice::where('id',$id)->first();

            $descriptions = $invoice->invoiceDetails;
            $data = [];
            foreach ($descriptions as $key => $item) {
                $data['data'][$item['product_description_title']]['quotation_description'][$key] = $item;
                $data['data'][$item['product_description_title']]['sub_total_due'][$key] = $item->amount_due;
                $data['data'][$item['product_description_title']]['sub_total_amount'][$key] = $item->contact_sum;
                $data['data'][$item['product_description_title']]['sub_payment'][$key] = ($item->contact_sum - $item->amount_due);
            }

            // dd($invoice);


            $view =  view('invoices.pdf',compact('invoice','data'));

            $name = $invoice->company->name;
            $address = $invoice->company->address;
            $tel = $invoice->company->tel;
            $fax = $invoice->company->fax;
            $attention = $invoice->company->attention;
            $date = date('d/m/Y',strtotime( $invoice->created_at));
            $quotation = $invoice->progressClaim->quotation->quotation;
            $claim_no =  $invoice->progressClaim->claim_no;
            $month  = date('M Y',strtotime($invoice->progressClaim->date));
            $title = $invoice->progressClaim->project->title;
            $company_profile = Company::first();
            $own_company_address = $company_profile->address;
            $invoice_no = $invoice->invoice_no;
            $ref_claim = $invoice->progressClaim->claim_no;
        // dd($invoice);
            $header = "
                    <img src='images/logo.jpg' width='100%' height='100px' />
                    <h1 style='text-align:center;padding-left:200px'>Invoice</h1>
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
                        <p>INVOICE NO: $invoice_no</p>
                        <p>PROGRESS CLAIM REF: $ref_claim</p>
                        <p>Ref QUOTATION NO: $quotation</p>
                        <p>PROGRESS CLAIM MONTH: $month </p>
                        <p>PROGRESS CLAIM NO: $claim_no</p>
                    </div>
                 </div>
                <br>
            <div>
            <span style='font-weight: bold;color:#000'>Project Title</span> : $title
            </div>
            <br>
             ";
             $mpdf = new Mpdf();
            $mpdf->setHTMLHeader($header);
            $mpdf->SetTopMargin(120);
            $mpdf->setHTMLFooter("<p style='text-align:center;font-size:12px'>Page {PAGENO} of {nb}</p>");
            $mpdf->WriteHTML($view);
            $mpdf->Output("$invoice_no.pdf",'D');

        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }


    public function getProgressDescription(Request $request)
    {
        try{
            $progress_claim = ProgressClaim::where('company_id',$request->company_id)->where('claim_no',$request->claim_no)->first();
            $progress_descriptions  = ProgressDescription::where('progress_claim_id',$progress_claim->id)->get();
             $data = [
                'progress_claim'=>$progress_claim,
                'progress_descriptions'=>$progress_descriptions,
             ];
             return $data;

        }catch(Exception $e)
        {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function getProgressClaim(Request $request)
    {
        $progress_claims =  ProgressClaim::where('project_id',$request->title)->whereNull('is_invoice_create')->get();
        return $progress_claims;
    }
}
