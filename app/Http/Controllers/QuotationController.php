<?php

namespace App\Http\Controllers;

use Exception;
use Mpdf\Mpdf;
use Carbon\Carbon;
use App\Models\Company;
use App\Models\Product;
use App\Models\ProductQuotation;
use App\Models\Project;
use App\Models\Quotation;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Symfony\Contracts\Service\Attribute\Required;

class QuotationController extends Controller
{
    public function index()
    {
        $quotations = Quotation::orderBy('id', 'desc')->get();
        return view('vendors.index', compact('quotations'));
    }

    public function create()
    {
        $companies  = Company::orderBy('id', 'desc')->get();
        $products = Product::orderBy('id', 'desc')->get();
        return view('vendors.create', compact('companies', 'products'));
    }

    public function store(Request $request)
    {
        try {

            // dd($request->all());

            $company_details = $request->except(['_token', 'product_id', 'unit', 'rate', 'qty', 'amount', 'status']);
            $data = $request->all();
            $own_company_title = 'MT';
            $company_id = $request->company_id;
            $company =  Company::where('id', $company_id)->first();
            $company_name = $company->name;
            $company_name_arr = explode(" ", $company_name);
            $company_title = substr($company_name_arr[0], 0, 1) . substr($company_name_arr[1], 0, 1);
            // $quotation_count = Quotation::count() + 1;
            $quotation_count =  Quotation::where('quotation','LIKE','%'. $company_title .'%')->count() + 1;
            $quotation = $own_company_title . '/' . $company_title . '/' . 'Q/' . Carbon::now()->format('Y') . '-' . str_pad($quotation_count, 2, '0', STR_PAD_LEFT);

            $company_details['quotation'] = $quotation;

            // $product_ids = $data['product_id'];
            // $unit = $data['unit'];
            // $rate = $data['rate'];
            // $qty = $data['qty'];
            // $amount = $data['amount'];
            // $product_arr = [];
            // foreach ($product_ids as $key => $product_id) {
            //     $product_arr[$key]['product_id'] = $product_ids[$key];
            //     $product_arr[$key]['unit'] = $unit[$key];
            //     $product_arr[$key]['rate'] = $rate[$key];
            //     $product_arr[$key]['qty'] = $qty[$key];
            //     $product_arr[$key]['amount'] = $amount[$key];
            // }

            // Quotation::create($company_details)->productQuotations()->createMany($product_arr);
            Quotation::create($company_details);
            return redirect()->route('vendors.index')->withMessage('Successfully added !');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }


    public function edit($id)
    {
        try {

            $quotation = Quotation::findOrFail($id);
            $companies  = Company::orderBy('id', 'desc')->get();
            $products = Product::orderBy('id', 'desc')->get();
            return view('vendors.edit', compact('quotation', 'companies', 'products'));
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
    public function quotationDescriptionEdit($id)
    {
        try {
            $quotation_description = ProductQuotation::where('id',$id)->first();
            $companies  = Company::orderBy('id', 'desc')->get();
            $products = Product::orderBy('id', 'desc')->get();
            return view('vendors.edit_quotation_description', compact('quotation_description', 'companies', 'products'));
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
    public function update(Request $request, $id)
    {
        try {

            Quotation::findOrFail($id)->update($request->all());
            return redirect()->route('vendors.index')->withMessage("Successfully update");
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $quotation = Quotation::where('id', $id)->first();
            $quotation->productQuotations()->delete();
            $quotation->delete();

            return redirect()->route('vendors.index')->withMessage('Successfully Deleted !');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }


    public function getTitle(Request $request)
    {
        $company_id =  $request->id;
        $company = Company::where('id', $company_id)->first();
        $quotations = Quotation::where('company_id', $company_id)->get();
        $projects = Quotation::where('company_id',$company_id)->select('project_id')->distinct()->get();
        // return $projects;
        $titles = Project::where('company_id', $company_id)->whereNotIn('id',$projects)->get();
        $data = [
            'titles' => $titles,
            'company' => $company,
            'quotations' => $quotations,
        ];
        return $data;
    }


    public function getUnit(Request $request)
    {
        $product_id = $request->product_id;
        $unit = Product::where('id', $product_id)->first();
        return $unit;
    }


    public function quotationDownload($id)
    {
        try {

            $quotation = Quotation::where('id', $id)->first();
            $descriptions = $quotation->productQuotations;
            // dd($quotation);
            $data = [];
            foreach ($descriptions as $key => $item) {
                $data['data'][$item['product_description_title']]['quotation_description'][$key] = $item;
                $data['data'][$item['product_description_title']]['subtotal'][$key] = $item->amount;
            }

            $company_profile = Company::first();
            $own_company_address = $company_profile->address;


            $view =  view('vendors.pdf', compact('quotation', 'data','company_profile'));
            $mpdf =  new Mpdf(['mode' => 'utf-8']);
            $name = $quotation->company->name;
            $company = $quotation->company->address;
            $tel = $quotation->company->tel;
            $fax = $quotation->company->fax;
            $attention = $quotation->company->attention;
            $date = date('d/m/Y',strtotime($quotation->date));
            $quotation_name = $quotation->quotation;
            $title = $quotation->project->title;
           
            $header = "
                    <img src='images/logo.jpg' width='100%' height='100px' />
                    <h2>Quotation</h2>
                <div style='width:100% ;display:flex'>
                    <div style='width: 50%;float:left'>
                        <p>$name</p>
                        <p>$company</p>
                        <p>Tel: $tel</p>
                        <p>Fax: $fax</p>
                        <p>Attention: $attention</p>
                    </div>
                    <div style='width: 50%;float:left'>
                        <p>Date: $date</p>
                        <p>Quotation: $quotation_name</p>
                    </div>
                    </div>
                <br>
                <div>
                <span style='font-weight: bold;color:#000'>Project Title</span> :$title
            </div>
            <br>
           
             ";
            $mpdf->setHTMLHeader($header);
            $mpdf->SetTopMargin(100);
            $mpdf->setHTMLFooter("<p style='text-align:center;font-size:12px'>Page {PAGENO} of {nb}</p>");
            $mpdf->WriteHTML($view);
            $mpdf->Output("$quotation_name.pdf",'D');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }


    public function quotationDescription($id)
    {
        try {

            $product_quotations = ProductQuotation::where('quotation_id', $id)->get();
            $quotation = Quotation::findOrFail($id);
            return view('vendors.product_quotations', compact('product_quotations', 'id', 'quotation'));
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }


    public function quotationDescriptionCreate($quotation_id)
    {
        try {
            $quotation = Quotation::findOrFail($quotation_id);
            $products = Product::orderBy('id', 'desc')->get();
            return view('vendors.quotation_description_create', compact('quotation', 'products'));
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }


    public function quotationDescriptionStore(Request $request, $id)
    {
        try {

            $quotation_id = $id;

            $quotation =  Quotation::findOrFail($quotation_id);

            $data = $request->all();
            // dd($data);
            $product_ids = $data['product_id'];
            $unit = $data['unit'];
            $rate = $data['rate'];
            $qty = $data['qty'];
            $amount = $data['amount'];
            $product_arr = [];
            foreach ($product_ids as $key => $product_id) {
                $product_arr[$key]['product_id'] = $product_ids[$key];
                $product_arr[$key]['unit'] = $unit[$key];
                $product_arr[$key]['rate'] = $rate[$key];
                $product_arr[$key]['qty'] = $qty[$key];
                $product_arr[$key]['amount'] = $amount[$key];
                $product_arr[$key]['product_description_title'] = $data['product_description_title'];
            }
            $quotation->productQuotations()->createMany($product_arr);
            return redirect()->to("vendors/quotation-description/$id")->withMessage('Successfully added');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function quotationDescriptionDelete($id)
    {
        try {

            ProductQuotation::findOrFail($id)->delete();
            return redirect()->back()->withMessage('Successfully added');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
    public function quotationDescriptionUpdate(Request $request,$id)
    {
        try {
            $data = $request->except(["_token"]);
            ProductQuotation::where('id',$id)->update($data);
            return redirect()->to('/vendors/index')->withMessage('Successfully added');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
