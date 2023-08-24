<?php

namespace App\Http\Controllers;

use Exception;
use Mpdf\Mpdf;
use App\Models\Company;
use App\Models\Subcontract;
use Illuminate\Http\Request;
use App\Models\PaymentReceive;
use App\Models\SubContactCost;
use App\Models\SubcontractProject;

class SubContactCostController extends Controller
{
    public function index()
    {
        $sub_contact_costs = SubContactCost::all();
        return view('sub_contact_costs.index',compact('sub_contact_costs'));
    }

    public function create()
    {
        $subcontracts = Subcontract::all();
        return view('sub_contact_costs.create',compact('subcontracts'));
    }

    public function store(Request $request)
    {
        try {
            $data = $request->except(["_token",'type_of_account']);
            $old_payment = SubContactCost::where('subcontract_project_id',$request->subcontract_project_id)->pluck('amount')->sum();
            $sub_contact_cost = SubcontractProject::where('id',$request->subcontract_project_id)->first();
            $remain_amount =  $sub_contact_cost->budget - $old_payment;
        
            if($remain_amount < $data['amount']){
                return redirect()->back()->withMessage(' Payment amount is greater than actual amount');
            }

            $data['check_or_cash'] = $request->type_of_account;
            if($request->type_of_account == 'Check'){
                $payment = PaymentReceive::where('check_or_cash',$request->type_of_account)->orderBy('id','DESC')->first();
                $payment->total_check_amount = $payment->total_check_amount - $data['amount'];
                $payment->spend_money = json_encode([date('d-m-Y')=>'Material Cost']);
                $payment->update();
            }else{
                $payment = PaymentReceive::where('check_or_cash',$request->type_of_account)->orderBy('id','DESC')->first();
                $payment->total_cash_amount = $payment->total_cash_amount - $data['amount'];
                $payment->spend_money = json_encode([date('d-m-Y')=>'Material Cost']);
                $payment->update(); 
            }
            
            
            SubContactCost::create($data);
            return redirect()->route('sub_contact_costs.index')->withMessage('Successfully added !');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function edit($id)
    {
        $sub_contact_cost = SubContactCost::where('id', $id)->first();
        return view('sub_contact_costs.edit', compact('sub_contact_cost'));
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $request->except('_token');
            SubContactCost::where('id', $id)->update($data);
            return redirect()->route('sub_contact_costs.index')->withMessage('Successfully Updated !');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            SubContactCost::where('id', $id)->delete();
            return redirect()->route('sub_contact_costs.index')->withMessage('Successfully Deleted !');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function getSubcontractProject(Request $request)
    {
        $subcontract_projects = SubcontractProject::where('subcontract_id',$request->subcontract_id)->get();
        return $subcontract_projects;
    }

    public function reportDownload(Request $request)
    {
        try{

            $company = Company::where("name","LIKE",'%'.'RICO'.'%')->first();
            $start_date = $request->start_date;
            $end_date = $request->end_date;
            
            $sub_contact_costs = SubContactCost::whereDate('date','>=',$start_date)->whereDate('date','<=',$end_date)->get();
            $view =  view('sub_contact_costs.pdf', compact('sub_contact_costs','company'));
            $mpdf = new Mpdf();
            $mpdf->SetTopMargin(10);
            $mpdf->WriteHTML($view);
            $mpdf->Output();

        }catch(Exception $e)
        {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
    

    public function getProjectAmount(Request $request)
    {
        $project = SubcontractProject::where('id',$request->subcontract_project_id)->first();
        $payment = SubContactCost::where('subcontract_project_id',$request->subcontract_project_id)->pluck('amount')->sum();
        $data = [
            'project'=>$project,
            'payment'=>$payment,
        ];

        return $data;
    }

}
