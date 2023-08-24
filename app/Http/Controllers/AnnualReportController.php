<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Levy;
use Carbon\CarbonPeriod;
use App\Models\MaterialCost;
use Illuminate\Http\Request;
use App\Models\PaymentReceive;
use App\Models\SubContactCost;
use App\Models\StaffCPFAndSalary;
use App\Models\OfficialOrOtherCost;

class AnnualReportController extends Controller
{
    public function index()
    {
        return view('annual_reports.index');
    }

    public function search(Request $request)
    {
        $date_from = $request->date_from;
        $date_to = $request->date_to;
        $year1 = date('Y',strtotime($date_from));
        $year2 = date('Y',strtotime($date_to));

        $period = CarbonPeriod::create($date_from,$date_to)->month();
        $months = collect($period)->map(function (Carbon $date) {
                return [
                    'month_name' => $date->monthName,
                ];
            });

        $month_name_arr = [];
       
     
        // levy cost
        $levy_cost = Levy::whereBetween('date',[$date_from,$date_to])->get();
        $levy_cost_arr = [];
        foreach($levy_cost as $key=> $cost)
        {
            $levy_cost_arr[date('M',strtotime($cost->date))][$key] = $cost->amount;
            $month_name_arr[date('M-Y',strtotime($cost->date))] = 'true';
        }


        // cpf and salary 
        $cpf_and_salary = StaffCPFAndSalary::whereBetween('date',[$date_from,$date_to])->get();
        $cpf_cost_arr = [];
        $staff_salary_arr = [];
        foreach($cpf_and_salary as $key=> $cost)
        {
            $cpf_cost_arr[date('M',strtotime($cost->date))][$key] = $cost->cpf_amount;
            $staff_salary_arr[date('M',strtotime($cost->date))][$key] = $cost->amount;
        }


        // sub_contact cost
        $sub_contact_cost = SubContactCost::whereBetween('date', [$date_from, $date_to])->get();
        $sub_contact_cost_arr = [];
        foreach ($sub_contact_cost as $key => $cost) {
            $sub_contact_cost_arr[date('M', strtotime($cost->date))][$key] = $cost->amount;
        }


        // other cost
        $other_costs = OfficialOrOtherCost::whereBetween('date', [$date_from, $date_to])->get();
        $other_cost_arr = [];
        foreach ($other_costs as $key => $cost) {
            $other_cost_arr[date('M', strtotime($cost->date))][$key] = $cost->amount;
        }

        // product cost
        $product_costs = MaterialCost::whereBetween('date', [$date_from, $date_to])->get();
        $product_cost_arr = [];
        foreach ($product_costs as $key => $cost) {
            $product_cost_arr[date('M', strtotime($cost->date))][$key] = $cost->amount;
        }

        // paid material cost
        $paid_materials = PaymentReceive::whereBetween('date', [$date_from, $date_to])->get();
        $paid_material_arr = [];
        $monthly_paid_arr = [];
        foreach ($paid_materials as $key => $cost) {
            $paid_material_arr[date('M', strtotime($cost->date))][$key] = $cost->paid_material_amount;
            $monthly_paid_arr[date('M', strtotime($cost->date))][$key] = $cost->amount;
        }


        $master_arr = [];
        $master_arr['product_cost'] = $product_cost_arr;
        $master_arr['salary_cost'] = $staff_salary_arr;
        $master_arr['other_cost'] = $other_cost_arr;
        $master_arr['cpf_cost'] = $cpf_cost_arr;
        $master_arr['levy_cost'] = $levy_cost_arr;
        $master_arr['sub_contact_cost'] = $sub_contact_cost_arr;
        $master_arr['monthly_paid_material_cost'] = $paid_material_arr;
        $master_arr['monthly_payment_cost'] = $monthly_paid_arr;

    
        return view('annual_reports.index',compact('master_arr','year1','year2','date_from','date_to'));
        
    }
}
