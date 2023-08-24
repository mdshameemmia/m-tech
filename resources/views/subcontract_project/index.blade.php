@extends('layouts.master')
@section('body')
    <div class="row">

        <h1 class="col-md-10">Subcontractor Project </h1>
        <p class="col-md-2"><a href="{{ url('subcontract_project/create') }}"><button class="btn btn-primary btn-sm"> <i
                        class="fa fa-plus"></i></button></a></p>

        <table class="table table-striped table-hover">
            <thead>
                <th>SL</th>
                <th>Subcontractor Name</th>
                <th> Project Name </th>
                <th>Budget Amount </th>
                <th>Start Date </th>
                <th>End Date  </th>
                <th>Action </th>
            </thead>
            <tbody id="tbody">
                @foreach ($subcontract_projects as $subcontract_project)
                    <tr>
                        <td>{{ $loop->iteration ?? '' }}</td>
                        <td>{{ $subcontract_project->subcontract->name ?? '' }}</td>
                        <td>{{ $subcontract_project->project_name ?? '' }}</td>
                        <td>{{ $subcontract_project->budget ?? '' }}</td>
                        <td>{{$subcontract_project->start_date?date('d M, Y',strtotime($subcontract_project->start_date)):''}}</td>
                        <td>{{$subcontract_project->end_date?date('d M, Y',strtotime($subcontract_project->end_date)):''}}</td>
                        <td>

                            <a href="{{ route('subcontract_project.edit', $subcontract_project->id) }}"><i
                                    class="fa fa-edit text-info"></i></a>
                            <a href="{{ route('subcontract_project.delete', $subcontract_project->id) }}"
                                onclick="return confirm('Are you sure to delete ?')"><i
                                    class="fa fa-trash text-danger"></i></a>


                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection

@push('js')
    <script></script>
@endpush
