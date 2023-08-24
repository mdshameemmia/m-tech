<?php

namespace App\Http\Controllers;

use Exception;
use Mpdf\Mpdf;
use App\Models\Company;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects =  Project::orderBy('id','desc')->get();
        return view('projects.index',compact('projects'));
    }

    public function create()
    {
        $companies = Company::orderBy('id','DESC')->get();
        return view('projects.create',compact('companies'));
    }

    public function store(Request $request)
    {
        try{
            $data = $request->except("_token");
             Project::create($data);
         return redirect()->route('projects.index')->withMessage('Successfully added !');
        }catch(Exception $e)
        {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function edit($id)
    {
        $project = Project::where('id',$id)->first();
        $companies = Company::orderBy('id','DESC')->get();
        return view('projects.edit',compact('project','companies'));
    }

    public function update(Request $request,$id)
    {
        try{
            $data = $request->except('_token');
           $project =  Project::where('id',$id)->first();
           $project->update($data);

            return redirect()->route('projects.index')->withMessage('Successfully Updated !');

        }catch(Exception $e)
        {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function delete($id)
    {
        try{
            $project = Project::where('id',$id)->first();
            $project->delete();
            return redirect()->route('projects.index')->withMessage('Successfully Deleted !');
        }catch(Exception $e)
        {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function reportDownload(Request $request)
    {
        try{

            $company = Company::where("name","LIKE",'%'.'RICO'.'%')->first();
            $start_date = $request->start_date;
            $end_date = $request->end_date;
            
            $projects = Project::whereDate('start_date','>=',$start_date)->whereDate('end_date','<=',$end_date)->get();
            $view =  view('projects.pdf', compact('projects','company'));
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
