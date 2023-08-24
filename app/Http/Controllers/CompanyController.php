<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Exception;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class CompanyController extends Controller
{
    public function index()
    {
        $companies =  Company::orderBy('id','desc')->get();
        return view('companies.index',compact('companies'));
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        try{
            $data = $request->except("_token");
             Company::create($data);
         return redirect()->route('companies.index')->withMessage('Successfully added !');
        }catch(Exception $e)
        {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function edit($id)
    {
        $company = Company::where('id',$id)->first();
        return view('companies.edit',compact('company'));
    }

    public function update(Request $request,$id)
    {
        try{
            $data = $request->except('_token');
           $company =  Company::where('id',$id)->first();
           $company->update($data);

            return redirect()->route('companies.index')->withMessage('Successfully Updated !');

        }catch(Exception $e)
        {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function delete($id)
    {
        try{
            $company = Company::where('id',$id)->first();
            $company->delete();
            return redirect()->route('companies.index')->withMessage('Successfully Deleted !');
        }catch(Exception $e)
        {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

}
