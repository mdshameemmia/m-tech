@extends('layouts.master')
@section('body')
    <div class="row">

        <h1 class="col-md-10">Time Schedules</h1>
        <p class="col-md-2"><a href="{{ url('time-schedule/create') }}"><button class="btn btn-primary btn-sm"> <i
                        class="fa fa-plus"></i></button></a></p>

        <div class="row" style="width: 100%;overflow:scroll">

            <table class="table table-striped table-hover">
                <thead>
                    <th class="first">SL</th>
                    <th class="custom_width"> Name</th>
                    <th class="custom_width">Date </th>
                    <th class="custom_width">Start Time</th>
                    <th class="custom_width">End Time</th>
                    <th class="custom_width">Break Time</th>
                    <th class="custom_width">Reg Days</th>
                    <th class="custom_width">OT Hours</th>
                    <th class="custom_width">PH Hours</th>
                    <th class="custom_width">Trans. Fee </th>
                    <th class="custom_width">Food Fee</th>
                    <th class="custom_width">Site</th>
                    <th class="custom_width">Remarks</th>
                    <th class="custom_width">Action </th>
                </thead>
                <tbody id="tbody">
                    @forelse ($time_schedules as $key=>$time_schedule)
                        <tr>
                            <td class="first">{{ $loop->iteration }}</td>
                            <td>{{ $time_schedule->employee->name ?? '' }}</td>
                            <td>{{ $time_schedule->date ? date('Y-m-d',strtotime($time_schedule->date)) :'' }}</td>
                            <td>{{ $time_schedule->start_time ?? '' }}</td>
                            <td>{{ $time_schedule->end_time ?? '' }}</td>
                            <td>{{ $time_schedule->break_time ?? '' }}</td>
                            <td>{{ $time_schedule->hour_in_regular_days ?? '' }}</td>
                            <td>{{ $time_schedule->ot_in_regular_day ?? '' }}</td>
                            <td>{{ $time_schedule->work_in_over_time ?? '' }}</td>
                            <td>{{ $time_schedule->transport_fee ?? '' }}</td>
                            <td>{{ $time_schedule->food_fee ?? '' }}</td>
                            <td>
                                <span data-toggle="tooltip" data-placement="top" title="{{$time_schedule->site??''}}">
                                    {{$time_schedule->site ? substr($time_schedule->site, 0, 10) : ''}}
                                </span>
                            </td>
                            <td>{{ $time_schedule->remarks ?? '' }}</td>
                            <td>
                                {{-- <a href="{{ route('time-schedule.edit', $time_schedule->id) }}"><i
                                        class="fa fa-edit text-info"></i></a> --}}
                                    @if(\App\Models\SalaryVouchar::where('employee_id',$time_schedule->employee_id)->whereYear('date',date('Y',strtotime($time_schedule->date)))->whereMonth('date',date('m',strtotime($time_schedule->date)))->count() == 0)
                                <a href="{{ route('time-schedule.delete', $time_schedule->id) }}"
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
    <script></script>
@endpush
@push('css')
    <style>
        .form-control {
            background-color: #fff !important;
        }

        .custom_width {
            width: 100px !important;
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

        .first{
            width: 40px;
        }
    </style>
@endpush
