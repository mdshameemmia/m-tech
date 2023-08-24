@extends('layouts.master')
@section('body')
    <div class="row">
            
        <div class="row col-md-12 d-flex justify-content-between my-2">
            <h1>Staff CPF & Salary </h1>
            <form action="{{ route('salary-report.download') }}" class="d-flex" method="POST">
                @csrf
                <input type="text" class="date form-control mx-1" name="start_date" placeholder="Start date">
                <input type="text" class="date form-control mx-1" name="end_date" placeholder="End date">
                <input class="btn btn-primary btn-sm form-control" value="Report Download" type="submit">
            </form>
            <p class="col-md-2"><a href="{{route('staff_cpfs.create')}}"><button class="btn btn-primary btn-sm"> <i class="fa fa-plus"></i></button></a></p>
        </div>
                <div style="width: 100%;overflow:scroll">
                    <table class="table table-striped table-hover table-responsive">
                    <thead>
                        <th class="custom_width">SL</th>
                        <th class="custom_width">Staff Name </th>
                        <th class="custom_width">Work Permit No </th>
                        <th class="custom_width">NID </th>
                        <th class="custom_width">Salay of Month </th>
                        <th class="custom_width">Personal Pay(CPF) </th>
                        <th class="custom_width">Company Pay(CPF) </th>
                        <th class="custom_width">Total CPF </th>
                        <th class="custom_width"> Amount </th>
                        <th class="custom_width"> Date </th>
                        <th class="custom_width">Action </th>
                    </thead>
                    <tbody id="tbody">
                        @forelse ($staff_cpfs as $key=>$staff_cpf)

                                <td class="custom_width">{{$key+1}}</td>
                                <td class="custom_width">{{$staff_cpf->employee->name??''}}</td>
                                <td class="custom_width">{{$staff_cpf->employee->ep??''}}</td>
                                <td class="custom_width">{{$staff_cpf->employee->nid??''}}</td>
                                <td class="custom_width">{{$staff_cpf->salary_of_month?date('M,Y',strtotime($staff_cpf->salary_of_month)):''}}</td>

                                <td class="custom_width">{{$staff_cpf->personal_cpf_amount??''}}</td>
                                <td class="custom_width">{{$staff_cpf->company_cpf_amount??''}}</td>
                                <td class="custom_width">{{$staff_cpf->total_cpf_amount??''}}</td>
                                <td class="custom_width">{{$staff_cpf->amount??''}}</td>
                                <td class="custom_width">{{$staff_cpf->date?date('d M, Y',strtotime($staff_cpf->date)):''}}</td>

                                <td>
                                    <a href="{{route('staff_cpfs.edit',$staff_cpf->id)}}"><i class="fa fa-edit text-info"></i></a>
                                    <a href="{{route('staff_cpfs.delete',$staff_cpf->id)}}" onclick="return confirm('Are you sure to delete ?')"><i class="fa fa-trash text-danger"></i></a>
                                   
                                </td>
                            </tr>
                        @empty
                            
                        @endforelse
                    </tbody>
                </table>
                </div>
          
    </div>
@endsection


@push('js')
    <script src="{{ asset('js/flatpickr.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.min.css') }}"></script>

    <script>
        $(".date").flatpickr();
    </script>
@endpush

@push('css')
    <link href="{{ asset('css/flatpickr.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <style>
         .custom_width {
           width: 300px !important;
       }
    </style>
@endpush