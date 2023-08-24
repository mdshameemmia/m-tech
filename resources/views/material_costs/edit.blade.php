@extends('layouts.master')
@section('body')

    <div class="row card m-auto" style="background-color:rgb(247, 238, 238)">
            
               <div class="row m-3">
                    <h1 class="col-md-11">Purchases of Material</h1>
                <p class="col-md-1"><a href="{{route('material_costs.index')}}"><button class="btn btn-primary btn-sm"> Back </button></a></p>
            
               </div>
                <form action="{{route('material_costs.update',$material_cost->id)}}"  method="POST">
                    @csrf
                    <div class="form-group row mx-4 ">
                      <label for="" class="col-md-12 font-weight-bold">Date</label>
                      <input type="text" name="date" id="" class="form-control col-md-5 mx-2 date " value="{{$material_cost->date??''}}" placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="form-group row mx-4 ">
                      <label for="" class="col-md-12 font-weight-bold">Company Name    </label>
                      <input type="text" name="company_name" id="" class="form-control col-md-5 mx-2 " value="{{$material_cost->material??''}}" placeholder="" aria-describedby="helpId">
                    </div>
                    
                    <div class="form-group row mx-4 ">
                      <label for="" class="col-md-12 font-weight-bold">Purchases of Material    </label>
                      <input type="text" name="material" id="" class="form-control col-md-5 mx-2 " value="{{$material_cost->material??''}}" placeholder="" aria-describedby="helpId">
                    </div>
                    
                 
                    <div class="form-group row mx-4 ">
                      <label for="" class="col-md-12 font-weight-bold">Amount </label>
                      <input type="text" name="amount" value="{{$material_cost->amount??''}}" id="" class="form-control col-md-5 mx-2 " placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="form-group row mx-4 ">
                      <button type="submit" class="btn btn-sm btn-primary mx-2 ">Save </button>
                     
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

