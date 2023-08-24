<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Company;
use App\Models\Employee;
use App\Models\Project;
use App\Models\SalaryVouchar;
use App\Models\TimeSchedule;
use Illuminate\Http\Request;
use Symfony\Component\Process\ExecutableFinder;

class TimeScheduleController extends Controller
{
    public function index()
    {
        $time_schedules = TimeSchedule::all();
        return view('time_schedules.index', compact('time_schedules'));
    }
    public function create()
    {
        $companies = Company::orderBy('id', 'desc')->get();
        $projects = Project::orderBy('id', 'DESC')->get();
        $employees = Employee::all();
        return view('time_schedules.create', compact('companies', 'projects', 'employees'));
    }

    public function store(Request $request)
    {
        try {

            $data = $request->except("_token");

            $time_schedules = [];
            foreach ($data['date'] as $key => $time_schedule) {


                $time_schedules[$key]['date'] = $data['date'][$key];
                $time_schedules[$key]['start_time'] = $data['start_time'][$key];
                $time_schedules[$key]['end_time'] = $data['end_time'][$key];
                $time_schedules[$key]['break_time'] = $data['break_time'][$key];
                $time_schedules[$key]['hour_in_regular_days'] = $data['hour_in_regular_days'][$key];
                $time_schedules[$key]['ot_in_regular_day'] = $data['ot_in_regular_day'][$key];
                $time_schedules[$key]['work_in_over_time'] = $data['work_in_over_time'][$key];
                $time_schedules[$key]['transport_fee'] = $data['transport_fee'][$key];
                $time_schedules[$key]['food_fee'] = $data['food_fee'][$key];
                $time_schedules[$key]['site'] = $data['site'][$key];
                $time_schedules[$key]['remarks'] = $data['remarks'][$key];
                $time_schedules[$key]['employee_id'] = $request->employee_id;
            }

            $existing_record = TimeSchedule::whereDate('date',$request->date)->where('employee_id',$request->employee_id)->first();
            if($existing_record){
                return redirect()->route('time-schedule.index')->withMessage('This date value already included');
            }
            TimeSchedule::insert($time_schedules);
            return redirect()->route('time-schedule.index')->withMessage('Successfully added !');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function edit($id)
    {
        $employee =  TimeSchedule::where('id', $id)->first();
        return view('time_schedules.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $request->except('_token');
            $employee =   TimeSchedule::where('id', $id)->first();
            $employee->update($data);

            return redirect()->route('time-schedules.index')->withMessage('Successfully Updated !');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $employee =  TimeSchedule::where('id', $id)->first();
            $employee->delete();
            return redirect()->route('time-schedule.index')->withMessage('Successfully Deleted !');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function search(Request $request)
    {
        try {

            $date =  $request->date;
            $year = date('Y', strtotime($request->date));
            $month = date('m', strtotime($request->date));
            $employee_id = $request->employee_id;

            $salary_vouchar = SalaryVouchar::where('employee_id',$employee_id)
                                          ->whereYear('date',$year)
                                          ->whereMonth('date',$month)
                                          ->first();

           if($salary_vouchar){
            return redirect()->route('time-schedule.index')->withMessage('Salary vouchar has already created!');
           }

            $companies = Company::orderBy('id', 'desc')->get();
            $projects = Project::orderBy('id', 'DESC')->get();
            $employees = Employee::all();

            $time_schedules   = TimeSchedule::where('employee_id', $employee_id)->whereYear('date', $year)->whereMonth('date', $month)->get();
            return view('time_schedules.create', compact('time_schedules', 'employee_id', 'date','companies','projects','employees'));
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
