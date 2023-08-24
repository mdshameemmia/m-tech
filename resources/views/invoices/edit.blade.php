@extends('layouts.master')
@section('body')

    <div class="row card " style="background-color:rgb(247, 238, 238)">
            
               <div class="row m-2">
                    <h1 class="col-md-11">Quotation</h1>
                <p class="col-md-1"><a href="{{route('projects.index')}}"><button class="btn btn-primary btn-sm"> Back </button></a></p>
            
               </div>
                <form action="{{route('projects.update',$project->id)}}"  method="POST">
                    @csrf
                    <div class="form-group row mx-4 ">
                      <label for="" class="col-md-12 font-weight-bold">Title</label>
                      <input type="text" name="title" value="{{$project->title??''}}" id="" class="form-control col-md-5 mx-2 " placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="form-group row mx-4 ">
                      <label for="" class="col-md-12 font-weight-bold">Amount  </label>
                      <input type="text" name="amount" id="" value="{{$project->amount??''}}" class="form-control col-md-5 mx-2 " placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="form-group row mx-4 ">
                      <label for="" class="col-md-12 font-weight-bold">Company Name    </label>
                      <select name="company_id" class="form-control col-md-5 mx-2" id="">
                        <option value="">Select One</option>
                        @foreach ($companies as $company)
                            <option value="{{$company->id??''}}">{{$company->name??''}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group row mx-4 ">
                      <label for="" class="col-md-12 font-weight-bold">Start Date    </label>
                      <input type="text" name="start_date" value="{{$project->start_date??''}}" id="" class="form-control col-md-5 mx-2 date" placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="form-group row mx-4 ">
                      <label for="" class="col-md-12 font-weight-bold">End Date    </label>
                      <input type="text" name="end_date" id=""  value="{{$project->end_date??''}}" class="form-control col-md-5 mx-2 date" placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="form-group row mx-4 ">
                      <label for="" class="col-md-12 font-weight-bold">Status    </label>
                       <label for="" class="mx-2">Active</label>
                       <input type="radio" name="status" class="mt-1" value="0">
                       <label for="" class="mx-2">Inactive</label>
                       <input type="radio" name="status" class="mt-1" value="1">
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

