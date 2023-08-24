<?php

namespace App\Http\Controllers;

use Exception;
use Mpdf\Mpdf;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\PaymentReceive;
use App\Models\OfficialOrOtherCost;

class OfficialOrOtherCostController extends Controller
{
    public function index()
    {
        $official_or_other_costs = OfficialOrOtherCost::all();
        return view('official_or_other_costs.index', compact('official_or_other_costs'));
    }

    public function create()
    {
        return view('official_or_other_costs.create');
    }

    public function store(Request $request)
    {
        try {
            $data = $request->except(["_token",'type_of_account']);
            if($request->type_of_account == 'Check'){
                $payment = PaymentReceive::where('check_or_cash',$request->type_of_account)->orderBy('id','DESC')->first();
                $payment->total_check_amount = $payment->total_check_amount - $data['amount'];
                 $payment->spend_money = json_encode([date('d-m-Y')=>'Official Cost']);
                $payment->update();
            }else{
                $payment = PaymentReceive::where('check_or_cash',$request->type_of_account)->orderBy('id','DESC')->first();
                $payment->total_cash_amount = $payment->total_cash_amount - $data['amount'];
                 $payment->spend_money = json_encode([date('d-m-Y')=>'Official Cost']);
                $payment->update(); 
            }
            
            OfficialOrOtherCost::create($data);
            return redirect()->route('official_or_other_costs.index')->withMessage('Successfully added !');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function edit($id)
    {
        $official_or_other_cost = OfficialOrOtherCost::where('id', $id)->first();
        return view('official_or_other_costs.edit', compact('official_or_other_cost'));
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $request->except('_token');
            OfficialOrOtherCost::where('id', $id)->update($data);
            return redirect()->route('official_or_other_costs.index')->withMessage('Successfully Updated !');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            OfficialOrOtherCost::where('id', $id)->delete();
            return redirect()->route('official_or_other_costs.index')->withMessage('Successfully Deleted !');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function reportDownload(Request $request)
    {
        try{

            $company = Company::where("name","LIKE",'%'.'RICO'.'%')->first();
            $start_date = $request->start_date;
            $end_date = $request->end_date;
            
            $official_or_other_costs = OfficialOrOtherCost::whereDate('date','>=',$start_date)->whereDate('date','<=',$end_date)->get();
            $view =  view('official_or_other_costs.pdf', compact('official_or_other_costs','company'));
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
