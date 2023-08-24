<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Subcontract;
use Illuminate\Http\Request;

class SubcontractController extends Controller
{
    public function index()
    {
        $subcontracts = Subcontract::all();
        return view('subcontract.index',compact('subcontracts'));
    }

    public function create()
    {
        return view('subcontract.create');
    }

    public function store(Request $request)
    {
     try{
         $data = $request->except("_token");
         Subcontract::create($data);
         return redirect()->route('subcontract.index')->withMessage('Successfully added !');

     }catch(Exception $e)
     {
         return redirect()->back()->withErrors($e->getMessage());
     }
    }

    public function edit($id)
    {
        $subcontract = Subcontract::where('id',$id)->first();
        return view('subcontract.edit',compact('subcontract'));
    }

    public function update(Request $request,$id)
    {
        try{
            $data = $request->except('_token');
           $subcontract =  Subcontract::where('id',$id)->first();
           $subcontract->update($data);

            return redirect()->route('subcontract.index')->withMessage('Successfully Updated !');

        }catch(Exception $e)
        {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function delete($id)
    {
        try{
            $subcontract = Subcontract::where('id',$id)->first();
            $subcontract->delete();
            return redirect()->route('subcontract.index')->withMessage('Successfully Deleted !');
        }catch(Exception $e)
        {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
