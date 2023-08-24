@extends('layouts.master')
@section('body')
    <div class="row">

        <div class="row col-md-12 d-flex justify-content-between my-2">
            <h1>Salary Vouchar </h1>
            <form action="{{ route('salary-vourchar.download') }}" class="d-flex" method="POST">
                @csrf
                <select name="employee_id" id="" class="form-control select2">
                    <option value="">Select One</option>
                    @foreach ($time_schedules as $time_schedule)
                    <option value="{{$time_schedule->employee->id??''}}">{{$time_schedule->employee->name??''}}</option>
                        
                    @endforeach
                </select>
                <input type="text" class="date form-control mx-1" name="date" placeholder="Select date">
                
                <input class="btn btn-primary btn-sm form-control" value="Report Download" type="submit">
            </form>
            <p class="col-md-2">
                <a href="{{ url('salary-vouchar/create') }}"><button class="btn btn-primary btn-sm"> <i
                    class="fa fa-plus"></i></button></a>
            </p>
                        </div>
        <div class="row" style="width: 100%;overflow:scroll">

            <table class="table table-striped table-hover">
                <thead>
                    <th style="width: 50px">SL</th>
                    <th class="custom_width">Employee Name</th>
                    <th class="custom_width">Date </th>
                    <th class="custom_width">Basic Pay</th>
                    <th class="custom_width">Pay Per Hr</th>
                    <th class="custom_width">Total   Basic Pay</th>
                    <th class="custom_width">Over Time</th>
                    <th class="custom_width">Pay per OT</th>
                    <th class="custom_width">Total Over Time</th>
                    <th class="custom_width">Transport Pay</th>
                    <th class="custom_width">Food Pay</th>
                    <th class="custom_width">Medical  Pay</th>
                    <th class="custom_width">Bonus </th>
                    <th class="custom_width">Gross Pay</th>
                    <th class="custom_width">CPF</th>
                    <th class="custom_width">Contribution</th>
                    <th class="custom_width">WDL/CDAC/BMF</th>
                    <th class="custom_width">CADC</th>
                    <th class="custom_width">Advance/Loan</th>
                    <th class="custom_width">Income Tax</th>
                    <th class="custom_width">Monthly Housing</th>
                    <th class="custom_width">Others</th>
                    <th class="custom_width">Total  Deduction </th>
                    <th class="custom_width">Net Pay</th>
                    <th class="custom_width">Action </th>
                </thead>
                <tbody id="tbody">
                    @forelse ($salary_vouchars as $key=>$salary_vouchar)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $salary_vouchar->employee->name ?? '' }}</td>
                            <td>{{ $salary_vouchar->date ?date('Y/m/d',strtotime($salary_vouchar->date)):null }}</td>
                            <td>{{ $salary_vouchar->basic_pay ?? '' }}</td>
                            <td>{{ $salary_vouchar->amount_per_day ?? '' }}</td>
                            <td>{{ $salary_vouchar->total_basic_pay ?? '' }}</td>
                            <td>{{ $salary_vouchar->over_time ?? '' }}</td>
                            <td>{{ $salary_vouchar->amount_per_time ?? '' }}</td>
                            <td>{{ $salary_vouchar->total_over_time ?? '' }}</td>
                            <td>{{ $salary_vouchar->transport_pay ?? '' }}</td>
                            <td>{{ $salary_vouchar->food_pay ?? '' }}</td>
                            <td>{{ $salary_vouchar->medical_pay ?? '' }}</td>
                            <td>{{ $salary_vouchar->bonus ?? '' }}</td>
                            <td>{{ $salary_vouchar->gross_pay ?? '' }}</td>
                            <td>{{ $salary_vouchar->cpf ?? '' }}</td>
                            <td>{{ $salary_vouchar->contribution ?? '' }}</td>
                            <td>{{ $salary_vouchar->wdl_cdac_mbmf ?? '' }}</td>
                            <td>{{ $salary_vouchar->cadc ?? '' }}</td>
                            <td>{{ $salary_vouchar->advance_or_loan ?? '' }}</td>
                            <td>{{ $salary_vouchar->income_tax ?? '' }}</td>
                            <td>{{ $salary_vouchar->monthly_housing ?? '' }}</td>
                            <td>{{ $salary_vouchar->others ?? '' }}</td>
                            <td>{{ $salary_vouchar->total_deduction ?? '' }}</td>
                            <td>{{ $salary_vouchar->net_pay ?? '' }}</td>
                     
                            <td>
                                <a href="{{ route('single-salary-vouchar.download', $salary_vouchar->id) }}"><i
                                        class="fa fa-file text-info"></i></a>
                                {{-- <a href="{{ route('time-schedule.edit', $salary_vouchar->id) }}"><i
                                        class="fa fa-edit text-info"></i></a> --}}
                            @if (\App\Models\StaffCPFAndSalary::where('employee_id',$salary_vouchar->employee_id)->whereYear('salary_of_month',date('Y',strtotime($salary_vouchar->date)))->whereMonth('salary_of_month',date('m',strtotime($salary_vouchar->date)))->count() == '0')
                                <a href="{{ route('salary-vouchar.delete', $salary_vouchar->id) }}"
                                    onclick="return confirm('Are you sure to delete ?')"><i
                                        class="fa fa-trash text-danger"></i></a>
                            @endif 
                            </td>
                        </tr>
                    @empty

                        <tr>
                            <td colspan="11" class="text-center">No Record Available</td>
                        </tr>
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

    <style>
        /* .form-control {
            background-color: #fff !important;
        } */

        .custom_width {
            width: 160px !important;
            height: 20px !important;
        }

        .table td,
        .table th {
            padding: 5px 10px !important;
        }

        table {
            table-layout: fixed;
            word-wrap: break-word;
        }
    </style>
@endpush
