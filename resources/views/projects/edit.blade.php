@extends('layouts.master')
@section('body')

    <div class="card " style="background-color:rgb(247, 238, 238)">
            
      <div class="row m-2 px-2  d-flex justify-content-between">
        <p></p>
        <h1>Project</h1>
        <p><a href="{{route('projects.index')}}"><button class="btn btn-primary btn-sm mx-1"> Back </button></a></p>
   </div>
                <form action="{{route('projects.update',$project->id)}}"  method="POST" class="row mx-5">
                    @csrf
                    <div class="form-group col-md-5 ">
                      <label for="" class=" font-weight-bold">Title</label>
                      <input type="text" name="title" value="{{$project->title??''}}" id="" class="form-control " placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="form-group col-md-5 ">
                      <label for="" class=" font-weight-bold">Amount  </label>
                      <input type="text" name="amount" id="" value="{{$project->amount??''}}" class="form-control " placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="form-group col-md-5 ">
                      <label for="" class=" font-weight-bold">Company Name    </label>
                      <select name="company_id" class="form-control " id="">
                        <option value="">Select One</option>
                        @foreach ($companies as $company)
                            <option @if ($company->id==$project->company_id)
                                selected
                            @endif value="{{$company->id??''}}">{{$company->name??''}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group col-md-5 ">
                      <label for="" class=" font-weight-bold">Start Date    </label>
                      <input type="text" name="start_date" value="{{$project->start_date??''}}" id="" class="form-control date" placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="form-group col-md-5 ">
                      <label for="" class=" font-weight-bold">End Date    </label>
                      <input type="text" name="end_date" id=""  value="{{$project->end_date??''}}" class="form-control date" placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="form-group col-md-5">
                      <label for="">Project Manager</label>
                      <input type="text" class="form-control" value="{{$project->project_manager??''}}" name="project_manager">
                  </div>
                  <div class="form-group col-md-5">
                        <label for="" >Condition</label>
                        <textarea name="conditions" id=""  class="form-control" cols="40" rows="3">
                          {{$project->conditions??""}}
                        </textarea>
                  </div>
                  <div class="form-group col-md-5">
                        <label for="" >N.B</label>
                        <input type="text" name="notice_board" id="" value="{{$project->notice_board??''}}"  class="form-control"  />
                  </div>

                    <div class="form-group col-md-5 ">
                      <label for="" class=" font-weight-bold">Status    </label>
                       <label for="" class="mx-2">Active</label>
                       <input type="radio" @if ($project->status=='active')
                           checked 
                       @endif name="status" class="mt-1" value="active">
                       <label for="" class="mx-2">Inactive</label>
                       <input type="radio" @if ($project->status=='inactive')
                       checked 
                   @endif name="status" class="mt-1" value="inactive">
                    </div>
                   
                    <div class="form-group col-md-12 ">
                      <button type="submit" class="btn btn-sm btn-primary">Save </button>
                     
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

