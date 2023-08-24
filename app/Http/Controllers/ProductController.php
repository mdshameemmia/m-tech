<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products =  Product::orderBy('id','desc')->get();
        return view('products.index',compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        try{
            $data = $request->except("_token");
            $item_name = trim($data['item_name']);
           $isExistProduct = Product::where('item_name','LIKE',"%". $item_name ."%")->first();
            if(!empty($isExistProduct)){
             return redirect()->back()->withErrors(["This product has already exist"]);
            }
            Product::create($data);
            return redirect()->route('products.index')->withMessage('Successfully added !');
            
        }catch(Exception $e)
        {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function edit($id)
    {
        $product = Product::where('id',$id)->first();
        return view('products.edit',compact('product'));
    }

    public function update(Request $request,$id)
    {
        try{
            $data = $request->except('_token');
           $product =  Product::where('id',$id)->first();
           $product->update($data);
            return redirect()->route('products.index')->withMessage('Successfully Updated !');
        }catch(Exception $e)
        {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function delete($id)
    {
        try{
            $product = Product::where('id',$id)->first();
            $product->delete();
            return redirect()->route('products.index')->withMessage('Successfully Deleted !');
        }catch(Exception $e)
        {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
