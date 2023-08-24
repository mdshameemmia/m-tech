@extends('layouts.master')
@section('body')

    <div class="row card " style="background-color:rgb(247, 238, 238)">
            
               <div class="row m-3">
                    <h1 class="col-md-11">Subcontractor Project </h1>
                <p class="col-md-1"><a href="{{route('subcontract_project.index')}}"><button class="btn btn-primary btn-sm"> Back </button></a></p>
            
               </div>
                <form action="{{route('subcontract_project.update',$subcontract_project->id)}}"  method="POST">
                    @csrf
                  
                    <div class="form-group row mx-4 ">
                      <label for="" class="col-md-12 font-weight-bold">Subcontractor Name </label>
                      <select name="subcontract_id" id="" class="form-control col-md-5">
                        <option value="">Select One</option>
                        @foreach ($subcontractors as $subcontractor)
                            <option @if ($subcontractor->id = $subcontract_project->subcontract_id)
                                selected
                            @endif value="{{$subcontractor->id??''}}">{{$subcontractor->name??''}}</option>
                        @endforeach
                      </select>
                    </div>
                  
                    <div class="form-group row mx-4 ">
                      <label for="" class="col-md-12 font-weight-bold">Project Name </label>
                      <input type="text" name="project_name" id="" value="{{$subcontract_project->project_name??''}}" class="form-control col-md-5 mx-2 " placeholder="" aria-describedby="helpId">
                    </div>
                  
                    <div class="form-group row mx-4 ">
                      <label for="" class="col-md-12 font-weight-bold">Budget Amount  </label>
                      <input type="text" name="budget" id="" value="{{$subcontract_project->budget??''}}" class="form-control col-md-5 mx-2 " placeholder="" aria-describedby="helpId">
                    </div>
                  
                    <div class="form-group row mx-4 ">
                      <label for="" class="col-md-12 font-weight-bold">Start Date   </label>
                      <input type="text" name="start_date" id="" value="{{$subcontract_project->start_date??''}}" class="form-control col-md-5 mx-2 date " placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="form-group row mx-4 ">
                      <label for="" class="col-md-12 font-weight-bold">End Date  </label>
                      <input type="text" name="end_date" id="" value="{{$subcontract_project->end_date??''}}" class="form-control col-md-5 mx-2 date" placeholder="" aria-describedby="helpId">
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

