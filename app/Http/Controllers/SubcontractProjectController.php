<?php

namespace App\Http\Controllers;

use App\Models\Subcontract;
use Exception;
use Illuminate\Http\Request;
use App\Models\SubcontractProject;

class SubcontractProjectController extends Controller
{
    public function index()
    {
        $subcontract_projects = SubcontractProject::all();
        return view('subcontract_project.index',compact('subcontract_projects'));
    }

    public function create()
    {
        $subcontractors = Subcontract::all();
        return view('subcontract_project.create',compact('subcontractors'));
    }

    public function store(Request $request)
    {
     try{
         $data = $request->except("_token");
         SubcontractProject::create($data);
         return redirect()->route('subcontract_project.index')->withMessage('Successfully added !');

     }catch(Exception $e)
     {
         return redirect()->back()->withErrors($e->getMessage());
     }
    }

    public function edit($id)
    {
        $subcontract_project = SubcontractProject::where('id',$id)->first();
        $subcontractors = Subcontract::all();
        return view('subcontract_project.edit',compact('subcontract_project','subcontractors'));
    }

    public function update(Request $request,$id)
    {
        try{
            $data = $request->except('_token');
           $subcontract =  SubcontractProject::where('id',$id)->first();
           $subcontract->update($data);

            return redirect()->route('subcontract_project.index')->withMessage('Successfully Updated !');

        }catch(Exception $e)
        {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function delete($id)
    {
        try{
            $subcontract = SubcontractProject::where('id',$id)->first();
            $subcontract->delete();
            return redirect()->route('subcontract_project.index')->withMessage('Successfully Deleted !');
        }catch(Exception $e)
        {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
