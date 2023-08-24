@extends('layouts.master')
@section('body')
    <div class="row">
        <div class="col-md-12 d-flex justify-content-between">
            <h1>Project List</h1>
            <form action="{{route('project.download')}}" class="d-flex" method="POST">
                @csrf
                <input type="text"  class="date form-control mx-1" name="start_date" placeholder="Start date">
                <input type="text" class="date form-control mx-1" name="end_date" placeholder="End date">
                <input class="btn btn-primary btn-sm form-control" value="Report Download" type="submit">
            </form>
    
            <p><a href="{{ url('projects/create') }}"><button class="btn btn-primary btn-sm"> <i
                            class="fa fa-plus"></i></button></a></p>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <th>SL</th>
                <th>Title </th>
                <th>Amount  </th>
                <th>Company Name</th>
                <th>Start Date </th>
                <th>End  Date </th>
                <th>Status </th>
                <th>Action </th>
            </thead>
            <tbody id="tbody">
                @forelse ($projects as $key=>$project)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $project->title ?? '' }}</td>
                        <td>{{ $project->amount ?? '' }}</td>
                        <td>{{ $project->company->name ?? '' }}</td>
                        <td>{{ $project->start_date ?? '' }}</td>
                        <td>{{ $project->end_date ?? '' }}</td>
                        <td>{{ $project->status ?? '' }}</td>
                        <td>
                            <a href="{{ route('projects.edit', $project->id) }}"><i class="fa fa-edit text-info"></i></a>
                            <a href="{{ route('projects.delete', $project->id) }}"
                                onclick="return confirm('Are you sure to delete ?')"><i
                                    class="fa fa-trash text-danger"></i></a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No Record Available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

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
        /* .form-control{
            background-color: #fff !important ;
        } */
    </style>
@endpush