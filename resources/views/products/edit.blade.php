@extends('layouts.master')
@section('body')

    <div class="row card " style="background-color:rgb(247, 238, 238)">
            
               <div class="row m-3">
                    <h1 class="col-md-11">Product</h1>
                <p class="col-md-1"><a href="{{route('products.index')}}"><button class="btn btn-primary btn-sm"> Back </button></a></p>
            
               </div>
                <form action="{{route('products.update',$product->id)}}"  method="POST">
                    @csrf
                    <div class="form-group row mx-4 ">
                      <label for="" class="col-md-12 font-weight-bold">Item Name</label>
                      <input type="text" name="item_name" value="{{$product->item_name??''}}" id="" class="form-control col-md-5 mx-2 " placeholder="" aria-describedby="helpId">
                    </div>
                    {{-- <div class="form-group row mx-4 ">
                      <label for="" class="col-md-12 font-weight-bold">Item Price  </label>
                      <input type="text" name="item_price" value="{{$product->item_price??''}}" id="" class="form-control col-md-5 mx-2 " placeholder="" aria-describedby="helpId">
                    </div> --}}
                    <div class="form-group row mx-4 ">
                      <label for="" class="col-md-12 font-weight-bold">Unit   </label>
                      <input type="text" name="unit" id=""  value="{{$product->unit??''}}" class="form-control col-md-5 mx-2 " placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="form-group row mx-4 ">
                      <label for="" class="col-md-12 font-weight-bold">Description    </label>
                      <input type="text" name="description" value="{{$product->description??''}}" id="" class="form-control col-md-5 mx-2 " placeholder="" aria-describedby="helpId">
                    </div>
                   
                    <div class="form-group row mx-4 ">
                      <button type="submit" class="btn btn-sm btn-primary mx-2 ">Update </button>
                     
                    </div>


                </form>
               
          
    </div>
@endsection

@push('js')
<script src="{{asset('js/flatpickr.js')}}"></script>
  <script src="{{asset('js/sweetalert2.min.css')}}"></script>

    <script>
       $(".date").flatpickr();

    </script>
@endpush

@push('css')
    <link href="{{asset('css/flatpickr.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset("css/sweetalert2.min.css")}}">
    <style>
        .form-control{
            background-color: #fff !important ;
        }
    </style>
@endpush

