<?php

namespace App\Http\Controllers;

use Exception;
use Mpdf\Mpdf;
use App\Models\Company;
use App\Models\Invoice;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\PaymentReceive;
use App\Models\ProgressClaim;

class PaymentReceivedController extends Controller
{
    public function index()
    {
        $payment_receives = PaymentReceive::orderBy('id','DESC')->get();
        return view('payment_receives.index', compact('payment_receives'));
    }

    public function create()
    {
        $companies = Company::all();
        return view('payment_receives.create',compact('companies'));
    }

    public function store(Request $request)
    {
        try {
            $data = $request->except("_token");
            if($data['check_or_cash'] == 'Cash'){
                $cash = PaymentReceive::where('check_or_cash','Cash')->orderBy('id','DESC')->first();
                if($cash){
                    $data['total_cash_amount'] = $data['amount'] + $cash->total_cash_amount;
                }else{
                    $data['total_cash_amount'] = $data['amount']; 
                }
            }else{
                $check = PaymentReceive::where('check_or_cash','Check')->orderBy('id','DESC')->first();
                if($check){
                    $data['total_check_amount'] = $data['amount'] + $check->total_check_amount;
                }else{
                    $data['total_check_amount'] = $data['amount']; 
                }  
            }

            
            PaymentReceive::create($data);
            return redirect()->route('payment_receives.index')->withMessage('Successfully added !');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function edit($id)
    {
        $payment_receive = PaymentReceive::where('id', $id)->first();
        return view('payment_receives.edit', compact('payment_receive'));
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $request->except('_token');
            PaymentReceive::where('id', $id)->update($data);
            return redirect()->route('payment_receives.index')->withMessage('Successfully Updated !');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            PaymentReceive::where('id', $id)->delete();
            return redirect()->route('payment_receives.index')->withMessage('Successfully Deleted !');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }


    public function getProjectName(Request $request)
    {
        try{
            $company_id = $request->company_id;
            $projects = Project::where('company_id',$company_id)->get();
            $invoices = Invoice::where('company_id',$company_id)->get();
            return response()->json([
                'projects'=>$projects,
                'invoices'=>$invoices,
            ]);

        }catch(Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function reportDownload(Request $request)
    {
        try{

            $company = Company::where("name","LIKE",'%'.'RICO'.'%')->first();
            $start_date = $request->start_date;
            $end_date = $request->end_date;
            
            $payment_receives = PaymentReceive::whereDate('date','>=',$start_date)->whereDate('date','<=',$end_date)->get();
            $view =  view('payment_receives.pdf', compact('payment_receives','company'));
            $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
            $mpdf->SetTopMargin(10);
            $mpdf->WriteHTML($view);
            $mpdf->Output();
            

        }catch(Exception $e)
        {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }


    public function getInvoice(Request $request)
    {
        $progress_claims = ProgressClaim::where('project_id',$request->project_id)->get();
        $invoices = [];
        if(!empty($progress_claims)){
            foreach($progress_claims as $key=>$progress_claim){
                $exist_invoice = PaymentReceive::where('invoice',$progress_claim->invoice->invoice_no)->count();
                if($exist_invoice == 1){
                    $invoices[$key] = null;
                }else{
                    $invoices[$key] = $progress_claim->invoice;
                }
            }
        }

        $data = [
            'progress_claims'=>$progress_claims,
            'invoices'=>$invoices, 
        ];

        return $data;
    }


    public function getInvoiceAmount(Request $request)
    {
        $invoice = Invoice::where('invoice_no',$request->invoice_no)->first();
        $data = [
            'invoice'=>$invoice,
            'progressClaim'=>$invoice->progressClaim,
        ];
        return $data;
    }

}
