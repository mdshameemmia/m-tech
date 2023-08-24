@extends('layouts.master')
@section('body')

    <div class="row card m-auto" style="background-color:rgb(247, 238, 238)">
            
               <div class="row m-3">
                    <h1 class="col-md-11">Levy Cost</h1>
                <p class="col-md-1"><a href="{{route('official_or_other_costs.index')}}"><button class="btn btn-primary btn-sm"> Back </button></a></p>
            
               </div>
                <form action="{{route('official_or_other_costs.update',$official_or_other_cost->id)}}"  method="POST">
                    @csrf
                    <div class="form-group row mx-4 ">
                      <label for="" class="col-md-12 font-weight-bold">Date</label>
                      <input type="text" name="date" id="" class="form-control col-md-5 mx-2 date " value="{{$official_or_other_cost->date??''}}" placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="form-group row mx-4 ">
                      <label for="" class="col-md-12 font-weight-bold">Description    </label>
                      <input type="text" name="description" id="" class="form-control col-md-5 mx-2 " value="{{$official_or_other_cost->description??''}}" placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="form-group row mx-4 ">
                      <label for="" class="col-md-12 font-weight-bold">Qty   </label>
                      <input type="text" name="qty" id="" class="form-control col-md-5 mx-2 " value="{{$official_or_other_cost->qty??''}}" placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="form-group row mx-4 ">
                      <label for="" class="col-md-12 font-weight-bold">Rate    </label>
                      <input type="text" name="rate" id="" class="form-control col-md-5 mx-2 " value="{{$official_or_other_cost->rate??''}}" placeholder="" aria-describedby="helpId">
                    </div>
                 
                    <div class="form-group row mx-4 ">
                      <label for="" class="col-md-12 font-weight-bold">Amount </label>
                      <input type="text" name="amount" value="{{$official_or_other_cost->amount??''}}" id="" class="form-control col-md-5 mx-2 " placeholder="" aria-describedby="helpId">
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

