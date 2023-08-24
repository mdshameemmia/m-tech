@extends('layouts.master')
@section('body')

    <div class="row p-2" style="background-color:rgb(247, 238, 238)">
            
            
                    <h1 class="col-md-11">Payment Received </h1>
                <p class="col-md-1"><a href="{{route('payment_receives.index')}}"><button class="btn btn-primary btn-sm"> Back </button></a></p>
            
                <form action="{{route('payment_receives.update',$payment_receive->id)}}"  method="POST" class="row m-3 p-3">
                    @csrf
                    <div class="form-group col-md-5  ">
                      <label for="" class= "font-weight-bold">Date</label>
                      <input type="text" name="date" id="" value="{{$payment_receive->date??''}}" class="form-control  date " placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="form-group col-md-5  ">
                      <label for="" class= "font-weight-bold">Company Name  </label>
                      <input type="text" name="company_name" value="{{$payment_receive->company_name??''}}" id="" class="form-control  " placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="form-group col-md-5  ">
                      <label for="" class= "font-weight-bold">Project Name   </label>
                      <input type="text" name="project_name" id="" value="{{$payment_receive->project_name??''}}" class="form-control  " placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="form-group col-md-5  ">
                      <label for="" class= "font-weight-bold">Invoice   </label>
                      <input type="text" name="invoice" id="" value="{{$payment_receive->invoice??''}}" class="form-control  " placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="form-group col-md-5  ">
                      <label for="" class= "font-weight-bold">Invoice Amount</label>
                      <input type="text" name="invoice_amount" id="" value="{{$payment_receive->invoice_amount??''}}" class="form-control  " placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="form-group col-md-5  ">
                      <label for="" class= "font-weight-bold">Paid Material Amount </label>
                      <input type="text" name="paid_material_amount" id="" value="{{$payment_receive->paid_material_amount??''}}" class=" form-control  " placeholder="" aria-describedby="helpId">
                    </div>

                    <div class="form-group col-md-5  ">
                      <label for="" class= "font-weight-bold mx-3">Check</label>
                      <input type="radio" name="check_or_cash" value="Check" @if ($payment_receive->check_or_cash == 'Check' )
                          checked 
                      @endif  placeholder="" aria-describedby="helpId">
                      <label for="" class= "font-weight-bold mx-3">Cash</label>
                      <input type="radio" name="check_or_cash" @if ($payment_receive->check_or_cash == 'Cash' )
                          checked 
                      @endif value="Cash"  placeholder="" aria-describedby="helpId">
                    </div>

                    <div class="form-group col-md-5  ">
                      <label for="" class= "font-weight-bold">Amount </label>
                      <input type="text" name="amount" id=""  value="{{$payment_receive->amount??''}}" class="form-control  " placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="form-group col-md-5  ">
                      <button type="submit" class="btn btn-sm btn-primary  ">Save </button>
                    
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

