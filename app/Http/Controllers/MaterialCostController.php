<?php

namespace App\Http\Controllers;

use Exception;
use Mpdf\Mpdf;
use App\Models\Company;
use App\Models\Project;
use App\Models\MaterialCost;
use Illuminate\Http\Request;
use App\Models\PaymentReceive;

class MaterialCostController extends Controller
{
    public function index()
    {
        $material_costs = MaterialCost::all();
        return view('material_costs.index', compact('material_costs'));
    }

    public function create()
    {
        $projects = Project::all();
        return view('material_costs.create',compact('projects'));
    }

    public function store(Request $request)
    {
        try {
            $data = $request->except(["_token",'type_of_account']);
            // $cash_memo = strtolower($data['cash_memo_no']);
            // $data['cash_memo_no'] = $cash_memo;
            // $already_exist = MaterialCost::where("cash_memo_no",$cash_memo)->first();

            // if($already_exist){
            //     return redirect()->route('material_costs.index')->withMessage('This cash memo alreay exist');
            // }
            
            $tmp_name = $_FILES["cash_memo_no"]["tmp_name"];
            $ext = strtolower(pathinfo($_FILES["cash_memo_no"]["name"], PATHINFO_EXTENSION));
            $name = strtotime(now()).'.'. $ext;
            move_uploaded_file($tmp_name, "memos/$name");

            $data['cash_memo_no'] = $name;

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
            
            MaterialCost::create($data);
            return redirect()->route('material_costs.index')->withMessage('Successfully added !');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function edit($id)
    {
        $material_cost = MaterialCost::where('id', $id)->first();
        return view('material_costs.edit', compact('material_cost'));
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $request->except('_token');
            MaterialCost::where('id', $id)->update($data);
            return redirect()->route('material_costs.index')->withMessage('Successfully Updated !');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            MaterialCost::where('id', $id)->delete();
            return redirect()->route('material_costs.index')->withMessage('Successfully Deleted !');
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
            
            $material_costs = MaterialCost::whereDate('date','>=',$start_date)->whereDate('date','<=',$end_date)->get();
            $view =  view('material_costs.pdf', compact('material_costs','company'));
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
