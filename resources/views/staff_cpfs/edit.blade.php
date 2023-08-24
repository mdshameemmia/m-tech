@extends('layouts.master')
@section('body')

    <div class="row p-2" style="background-color:rgb(247, 238, 238)">
            
            
                    <h1 class="col-md-11">Staff & CPF </h1>
                <p class="col-md-1"><a href="{{route('staff_cpfs.index')}}"><button class="btn btn-primary btn-sm"> Back </button></a></p>
            
                <form action="{{route('staff_cpfs.update',$staff_cpf->id)}}"  method="POST" class="row m-3 p-3">
                    @csrf
                    <div class="form-group col-md-5  ">
                      <label for="" class= "font-weight-bold">Date</label>
                      <input type="text" name="date" id="" value="{{$staff_cpf->date??''}}" class="form-control  date " placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="form-group col-md-5  ">
                      <label for="" class= "font-weight-bold">Project Name  </label>
                      <input type="text" name="project_name" value="{{$staff_cpf->project_name??''}}" id="" class="form-control  " placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="form-group col-md-5  ">
                      <label for="" class= "font-weight-bold">Staff Name   </label>
                      <input type="text" name="staff_name" id="" value="{{$staff_cpf->staff_name??''}}" class="form-control  " placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="form-group col-md-5  ">
                      <label for="" class= "font-weight-bold">Work Permit No    </label>
                      <input type="text" name="work_permit_no" id="" value="{{$staff_cpf->work_permit_no??''}}" class="form-control  " placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="form-group col-md-5  ">
                      <label for="" class= "font-weight-bold">Staff Reg   </label>
                      <input type="text" name="staff_reg" id="" value="{{$staff_cpf->staff_reg??''}}" class="form-control  " placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="form-group col-md-5  ">
                      <label for="" class= "font-weight-bold">Salary of Month </label>
                      <input type="date" name="salary_of_month" id="" value="{{$staff_cpf->salary_of_month??''}}" class="date form-control  " placeholder="" aria-describedby="helpId">
                    </div>

                    <div class="form-group col-md-5  ">
                      <label for="" class= "font-weight-bold">CPF Amount</label>
                      <input type="text" name="cpf_amount" id="" value="{{$staff_cpf->cpf_amount??''}}" class="form-control  " placeholder="" aria-describedby="helpId">
                    </div>

                    <div class="form-group col-md-5  ">
                      <label for="" class= "font-weight-bold">Amount </label>
                      <input type="text" name="amount" id=""  value="{{$staff_cpf->amount??''}}" class="form-control  " placeholder="" aria-describedby="helpId">
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

