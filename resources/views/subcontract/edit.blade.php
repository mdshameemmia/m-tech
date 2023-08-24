@extends('layouts.master')
@section('body')

    <div class="row card " style="background-color:rgb(247, 238, 238)">
            
               <div class="row m-3">
                    <h1 class="col-md-11">Subcontractor Company </h1>
                <p class="col-md-1"><a href="{{route('subcontract.index')}}"><button class="btn btn-primary btn-sm"> Back </button></a></p>
            
               </div>
                <form action="{{route('subcontract.update',$subcontract->id)}}"  method="POST">
                    @csrf
                  
                    <div class="form-group row mx-4 ">
                      <label for="" class="col-md-12 font-weight-bold">Company Name </label>
                      <input type="text" name="company_name" value="{{$subcontract->company_name??''}}" id="" class="form-control col-md-5 mx-2 " placeholder="" aria-describedby="helpId">
                    </div>
                  
                    <div class="form-group row mx-4 ">
                      <label for="" class="col-md-12 font-weight-bold">Subcontractor Name </label>
                      <input type="text" name="name" id="" value="{{$subcontract->name??''}}" class="form-control col-md-5 mx-2 " placeholder="" aria-describedby="helpId">
                    </div>
                  
                    <div class="form-group row mx-4 ">
                      <label for="" class="col-md-12 font-weight-bold">Subcontractor Mobile  </label>
                      <input type="text" name="mobile" id="" value="{{$subcontract->mobile??''}}" class="form-control col-md-5 mx-2 " placeholder="" aria-describedby="helpId">
                    </div>
                  
                    <div class="form-group row mx-4 ">
                      <label for="" class="col-md-12 font-weight-bold">Subcontractor Passport  </label>
                      <input type="text" name="passport" id="" value="{{$subcontract->passport??''}}" class="form-control col-md-5 mx-2 " placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="form-group row mx-4 ">
                      <label for="" class="col-md-12 font-weight-bold">Work Permit  No/IC/EP  </label>
                      <input type="text" name="work_permit_no" id="" value="{{$subcontract->work_permit_no??''}}" class="form-control col-md-5 mx-2 " placeholder="" aria-describedby="helpId">
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

