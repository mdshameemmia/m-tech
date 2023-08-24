<?php

namespace App\Http\Controllers;

use Exception;
use Mpdf\Mpdf;
use App\Models\Company;
use App\Models\Project;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\PaymentReceive;
use App\Models\StaffCPFAndSalary;
use Faker\Provider\ar_EG\Payment;

class StaffCPFAndSalaryController extends Controller
{
    public function index()
    {
        $staff_cpfs = StaffCPFAndSalary::all();
        return view('staff_cpfs.index', compact('staff_cpfs'));
    }

    public function create()
    {
        $projects = Project::all();
        $employees = Employee::all();
        return view('staff_cpfs.create', compact('projects', 'employees'));
    }

    public function store(Request $request)
    {
        try {
            $data = $request->except(["_token", 'type_of_account']);

            $salary_of_month = $data['salary_of_month'];
            $year = date('Y', strtotime($salary_of_month));
            $month = date('m', strtotime($salary_of_month));

            $totalPay = $data['amount'] + $data['company_cpf_amount'];

            $alreay_sent_salary = StaffCPFAndSalary::where('employee_id', $data['employee_id'])
                ->whereYear('salary_of_month', $year)
                ->whereMonth('salary_of_month', $month)
                ->first();
            if ($alreay_sent_salary) {
                return redirect()->route('staff_cpfs.index')->withMessage('Salary already sent of this month !');
            }

            $payment = PaymentReceive::where('check_or_cash', $request->type_of_account)->orderBy('id', 'DESC')->first();

            if ($request->type_of_account == 'Check') {
                if ($payment->total_check_amount < $totalPay) {
                    return redirect()->route('staff_cpfs.index')->withMessage('You have not enough balance for giving salary!');
                }
                $payment->total_check_amount = $payment->total_check_amount - $totalPay;
                $payment->spend_money = json_encode([date('d-m-Y') => 'Staff Cost']);
                $payment->update();
            } else {
                if ($payment->total_cash_amount < $totalPay) {
                    return redirect()->route('staff_cpfs.index')->withMessage('You have not enough balance for giving salary!');
                }
                $payment->total_cash_amount = $payment->total_cash_amount - $totalPay;
                $payment->spend_money = json_encode([date('d-m-Y') => 'Staff Cost']);
                $payment->update();
            }
            StaffCPFAndSalary::create($data);
            return redirect()->route('staff_cpfs.index')->withMessage('Successfully added !');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function edit($id)
    {
        $staff_cpf = StaffCPFAndSalary::where('id', $id)->first();
        return view('staff_cpfs.edit', compact('staff_cpf'));
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $request->except('_token');
            StaffCPFAndSalary::where('id', $id)->update($data);
            return redirect()->route('staff_cpfs.index')->withMessage('Successfully Updated !');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            StaffCPFAndSalary::where('id', $id)->delete();
            return redirect()->route('staff_cpfs.index')->withMessage('Successfully Deleted !');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function checkAmount(Request $request)
    {
        try {
            $amount = PaymentReceive::where('check_or_cash', $request->type_of_account)->orderBy('id', 'DESC')->first();
            return response()->json(["amount" => $amount]);
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
            
            $staff_cpfs = StaffCPFAndSalary::whereDate('date','>=',$start_date)->whereDate('date','<=',$end_date)->get();
            $view =  view('staff_cpfs.pdf', compact('staff_cpfs','company'));
            $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
            $mpdf->SetTopMargin(10);
            $mpdf->WriteHTML($view);
            $mpdf->Output();
            

        }catch(Exception $e)
        {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

}
