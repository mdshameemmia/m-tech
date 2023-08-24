<?php

namespace App\Http\Controllers;

use Exception;
use Mpdf\Mpdf;
use App\Models\Levy;
use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\PaymentReceive;
use Spatie\Activitylog\Models\Activity;

class LevyController extends Controller
{
    public function index()
    {
        $levies = Levy::all();
        return view('levies.index',compact('levies'));
    }

    public function create()
    {
        return view('levies.create');
    }

    public function store(Request $request)
    {
     try{
        $data = $request->except("_token",'type_of_account');
        if($request->type_of_account == 'Cash'){
            $payment_receive = PaymentReceive::where('check_or_cash','Cash')->orderBy('id','DESC')->first();
            // dd($payment_receive);
            if($payment_receive){
                $payment_receive->total_cash_amount = $payment_receive->total_cash_amount - $data['amount'] ;
            }else{
                $payment_receive->total_cash_amount = $data['amount']; 
            }
            $payment_receive->update();
        }else{
            $payment_receive = PaymentReceive::where('check_or_cash','Check')->orderBy('id','DESC')->first();
            if($payment_receive){
                $payment_receive->total_check_amount =  $payment_receive->total_check_amount - $data['amount'];
            }else{
                $payment_receive->total_check_amount   = $data['amount']; 
            }  
            $payment_receive->update();
        }
        
         Levy::create($data);
         return redirect()->route('levies.index')->withMessage('Successfully added !');

     }catch(Exception $e)
     {
         return redirect()->back()->withErrors($e->getMessage());
     }
    }

    public function edit($id)
    {
        $levy = Levy::where('id',$id)->first();
        return view('levies.edit',compact('levy'));
    }

    public function update(Request $request,$id)
    {
        try{
            $data = $request->except('_token');
           $levy =  Levy::where('id',$id)->first();
           $levy->update($data);

            return redirect()->route('levies.index')->withMessage('Successfully Updated !');

        }catch(Exception $e)
        {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function delete($id)
    {
        try{
            $levy = Levy::where('id',$id)->first();
            $levy->delete();
            return redirect()->route('levies.index')->withMessage('Successfully Deleted !');
        }catch(Exception $e)
        {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function reportDownload(Request $request)
    {
        try{

            $company = Company::where("name","LIKE",'%'.'RICO'.'%')->first();
            $start_date = $request->start_date;
            $end_date = $request->end_date;
            
            $levies = Levy::whereDate('date','>=',$start_date)->whereDate('date','<=',$end_date)->get();
            $view =  view('levies.pdf', compact('levies','company'));
            $mpdf = new Mpdf();
            $mpdf->SetTopMargin(10);
            $mpdf->WriteHTML($view);
            $mpdf->Output();
            

        }catch(Exception $e)
        {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
