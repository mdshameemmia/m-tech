@extends('layouts.master')
@section('body')
    <div class="row">
            
        <div class="row col-md-12 d-flex justify-content-between my-2">
            <h1>Sub Contract Payment</h1>
            <form action="{{ route('subcontract-report.download') }}" class="d-flex" method="POST">
                @csrf
                <input type="text" class="date form-control mx-1" name="start_date" placeholder="Start date">
                <input type="text" class="date form-control mx-1" name="end_date" placeholder="End date">
                <input class="btn btn-primary btn-sm form-control" value="Report Download" type="submit">
            </form>
                <p class="col-md-2"><a href="{{route('sub_contact_costs.create')}}"><button class="btn btn-primary btn-sm"> <i class="fa fa-plus"></i></button></a></p>
        </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <th>SL</th>
                        <th>Subcontractor Name </th>
                        <th>Project Name </th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Action </th>
                    </thead>
                    <tbody id="tbody">
                        @forelse ($sub_contact_costs as $key=>$sub_contact_cost)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$sub_contact_cost->subcontract->name??''}}</td>
                                <td>{{$sub_contact_cost->subcontractProject->project_name??''}}</td>
                                <td>{{$sub_contact_cost->date?date('d M, Y',strtotime($sub_contact_cost->date)):''}}</td>
                                <td>{{$sub_contact_cost->amount??''}}</td>
                                <td>
                                    {{-- <a href="{{route('sub_contact_costs.edit',$sub_contact_cost->id)}}"><i class="fa fa-edit text-info"></i></a> --}}
                                    <a href="{{route('sub_contact_costs.delete',$sub_contact_cost->id)}}" onclick="return confirm('Are you sure to delete ?')"><i class="fa fa-trash text-danger"></i></a>
                                   
                                </td>
                            </tr>
                        @empty
                            
                        @endforelse
                    </tbody>
                </table>
          
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
        /* .form-control{
                background-color: #fff !important ;
            } */
    </style>
@endpush