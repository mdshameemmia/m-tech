<?php

namespace App\Http\Controllers;

use Exception;
use Mpdf\Mpdf;
use App\Models\Company;
use App\Models\Employee;
use App\Models\TimeSchedule;
use Illuminate\Http\Request;
use App\Models\SalaryVouchar;
use Facade\FlareClient\Time\Time;

class SalaryVoucharController extends Controller
{
    public function index()
    {
        $salary_vouchars = SalaryVouchar::orderBy('id','DESC')->get();
        $time_schedules =  TimeSchedule::with('Employee')->select('employee_id')->distinct()->get();

        return view('salary-vouchars.index',compact('salary_vouchars','time_schedules'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('salary-vouchars.create',compact('employees'));
    }


    public function search(Request $request)
    {
        try{
            $employees = Employee::all();
           $date = $request->date;
           $year = date('Y',strtotime($request->date));
           $month = date('m',strtotime($request->date));
           $employee_id = $request->employee_id;

           $salary_vouchar = SalaryVouchar::where('employee_id',$employee_id)
                                          ->whereYear('date',$year)
                                          ->whereMonth('date',$month)
                                          ->first();

           if($salary_vouchar){
            return redirect()->route('salary-vouchar.index')->withMessage('Salary vouchar has already created!');
           }
           $total_days = TimeSchedule::where('employee_id',$employee_id)->whereYear('date',$year)->whereMonth('date',$month)->where('hour_in_regular_days','!=','0')->pluck('hour_in_regular_days')->count();
           $total_over_time = TimeSchedule::where('employee_id',$employee_id)->whereYear('date',$year)->whereMonth('date',$month)->pluck('ot_in_regular_day')->sum();
           $total_transport_fee = TimeSchedule::where('employee_id',$employee_id)->whereYear('date',$year)->whereMonth('date',$month)->pluck('transport_fee')->sum();
           $total_food_fee = TimeSchedule::where('employee_id',$employee_id)->whereYear('date',$year)->whereMonth('date',$month)->pluck('food_fee')->sum();
           
           return view('salary-vouchars.create',compact('total_days','total_over_time','total_transport_fee','total_food_fee','employees','employee_id','date'));

        }catch(Exception $e)
        {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try{

            $data = $request->all();
            $date = date('Y-m-d h:i:m',strtotime($data['date']));
             $data['date'] = $date;
            SalaryVouchar::create($data);
            return redirect()->route('salary-vouchar.index')->withMessage('Successfully added');
            
        }catch(Exception $e)
        {
            return $e;
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
    
    public function reportDownload(Request $request)
    {
        try{
            $year = date('Y',strtotime($request->date));
            $month = date('m',strtotime($request->date));
            $employee_id = $request->employee_id;
            $empoyee = Employee::where('id',$employee_id)->first();
            $time_schedules = TimeSchedule::where('employee_id',$employee_id)->whereYear('date',$year)->whereMonth('date',$month)->orderBy('date','ASC')->get();
           
            $first_date = TimeSchedule::where('employee_id',$employee_id)->whereYear('date',$year)->whereMonth('date',$month)->orderBy('id','asc')->first();
            $last_date = TimeSchedule::where('employee_id',$employee_id)->whereYear('date',$year)->whereMonth('date',$month)->orderBy('id','desc')->first();
            $company = Company::where("name","LIKE",'%'.'RICO'.'%')->first();
            $view =  view('salary-vouchars.pdf', compact('time_schedules','company','empoyee','first_date','last_date'));
            $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
            $mpdf->SetTopMargin(1);
            $mpdf->WriteHTML($view);
            $mpdf->Output("$empoyee->name.pdf",'D');
            

        }catch(Exception $e)
        {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }


    public function singleSalaryVoucharDownload(Request $request,$id)
    {
        $company = Company::where("name","LIKE",'%'.'RICO'.'%')->first();
        $salary_vouchar =  SalaryVouchar::findOrFail($id);
        $employee = Employee::where('id',$salary_vouchar->employee_id)->first();
        $total_days = TimeSchedule::where('employee_id',$salary_vouchar->employee_id)->whereYear('date',date('Y',strtotime($salary_vouchar->date)))->whereMonth('date',date('m',strtotime($salary_vouchar->date)))->where('hour_in_regular_days','!=',0)->count();
        $view =  view('salary-vouchars.single-salary-pdf', compact('salary_vouchar','company','employee','total_days'));
        $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
        $mpdf->SetTopMargin(10);
        $mpdf->WriteHTML($view);
        $mpdf->Output("$employee->name.pdf",'D');
    }

    public function delete($id)
    {
        try{
            $salary_vouchar = SalaryVouchar::where('id',$id)->first();
            $salary_vouchar->delete();
            return redirect()->back()->withMessage('Successfully Deleted !');
        }catch(Exception $e)
        {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
    
    
}
