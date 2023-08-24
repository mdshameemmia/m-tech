<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use App\Models\SalaryVouchar;
use Exception;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees =Employee::all();
        return view('employees.index',compact('employees'));
    }
    public function create()
    {
        $companies = Company::orderBy('id','desc')->get();
        return view('employees.create',compact('companies'));
    }

    public function store(Request $request)
    {
     try{
         $data = $request->except("_token");
         Employee::create($data);
         return redirect()->route('employees.index')->withMessage('Successfully added !');
     }catch(Exception $e)
     {
         return redirect()->back()->withErrors($e->getMessage());
     }
    }

    public function edit($id)
    {
        $companies = Company::orderBy('id','desc')->get();
        $employee = Employee::where('id',$id)->first();
        return view('employees.edit',compact('employee','companies'));
    }

    public function update(Request $request,$id)
    {
        try{
            $data = $request->except('_token');
           $employee =  Employee::where('id',$id)->first();
           $employee->update($data);

            return redirect()->route('employees.index')->withMessage('Successfully Updated !');

        }catch(Exception $e)
        {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function delete($id)
    {
        try{
            $employee = Employee::where('id',$id)->first();
            $employee->delete();
            return redirect()->route('employees.index')->withMessage('Successfully Deleted !');
        }catch(Exception $e)
        {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
    public function getEmployeeDetails(Request $request)
    {
        try{
            $employee =  Employee::where('id',$request->employee_id)->first();
            return $employee;
        }catch(Exception $e)
        {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
    public function getEmployeeSalary(Request $request)
    {
        try{
            $year = date('Y',strtotime($request->salary_of_month));
            $month = date('m',strtotime($request->salary_of_month));
            $salary  = SalaryVouchar::where('employee_id',$request->employee_id)->whereYear('date',$year)->whereMonth('date',$month)->first();
            return $salary;

        }catch(Exception $e)
        {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

}
