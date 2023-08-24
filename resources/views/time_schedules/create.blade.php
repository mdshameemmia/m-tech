@extends('layouts.master')
@section('body')
    <div class="card m-0 p-3" style="background-color:rgb(247, 238, 238)">
        <div class="row m-0 p-0">
            <h2 class="col-md-10 m-0 p-0">Time Schedule </h2>
            <p class="col-md-1"><a href="{{ route('time-schedule.index') }}"><button class="btn btn-primary btn-sm"> Back
                    </button></a></p>
            <p class="col-md-1">
                <button class="btn btn-primary btn-sm" id="addBtn"> Add</button>
                </p>
        </div>
      
        <div style="height:500px;width:100%;overflow: scroll ">
            <form action="{{route('time-schedule.search')}}" method="POST">
                @csrf
                <div class="row ">
                    <div class="col-md-3">
                     <select name="employee_id"  class="form-control" id="">
                         <option value="">Select Employee</option>
                         @foreach ($employees as $employee)
                             <option value="{{$employee->id}}">{{$employee->name??""}}</option>
                         @endforeach
                     </select>
                    </div>
                    <div class="col-md-3">
                     <input type="text" value="{{$date??''}}" name="date" placeholder="Select Month" class="form-control date2">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary btn-sm">Search</button>
                    </div>
                 </div>
            </form>
            <form action="{{ route('time-schedule.store') }}" method="POST" class="row">
                   <input type="hidden" value="{{$employee_id??''}}" name="employee_id">
                
                @csrf
                 <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="custom_width">Date</th>
                            <th class="custom_width">Start Time</th>
                            <th class="custom_width">End Time</th>
                            <th class="custom_width">Br. Time</th>
                            <th class="custom_width">Reg Days </th>
                            <th class="custom_width">OT Hours </th>
                            <th class="custom_width"> PH Hours </th>
                            <th class="custom_width">Trans. Fee</th>
                            <th class="custom_width">Food Fee</th>
                            <th class="custom_width">Site </th>
                            <th style="width: 70px">holiday </th>
                            <th class="custom_width">Remarks </th>
                        </tr>
                    </thead>
    
                    <tbody id="tbody">
                        @isset($time_schedules)
                        <?php $total_days = 0; ?>
                        @foreach ($time_schedules as $time_schedule)

                        <tr>
                            
                            <td class="parent_date"><input type="text" disabled  class="date bg-gray my-0 py-0 custom_width"  value="{{$time_schedule->date}}" name="date[]"></td>
                            <td class="parent_start_time"><input type="text" disabled class="my-0 py-0 custom_width start_time" value="{{$time_schedule->start_time}}" name="start_time[]" ></td>
                            <td class="parent_end_time"><input type="text" disabled class="my-0 py-0 custom_width end_time" value="{{$time_schedule->end_time}}" name="end_time[]" ></td>
                            <td class="parent_break_time"><input type="text" disabled class="my-0 py-0 custom_width break_time" value="{{$time_schedule->break_time}}" onkeyup="automaticCalculation(this)" name="break_time[]"></td>
                            <td class="parent_hour_in_regular_days"><input type="text" disabled class="my-0 py-0 custom_width hour_in_regular_days" value="{{$time_schedule->hour_in_regular_days}}" name="hour_in_regular_days[]"></td>
                            <td class="parent_ot_in_regular_day"><input type="text" disabled class="my-0 py-0 custom_width ot_in_regular_day" value="{{$time_schedule->ot_in_regular_day}}" name="ot_in_regular_day[]"></td>
                            <td class="parent_work_in_over_time"><input type="text" disabled class="my-0 py-0 custom_width work_in_over_time" value="{{$time_schedule->work_in_over_time}}" name="work_in_over_time[]"></td>
                            <td class="parent_transport_fee"><input type="text" disabled class="my-0 py-0 custom_width transport_fee" value="{{$time_schedule->transport_fee}}" name="transport_fee[]"></td>
                            <td class="parent_food_fee"><input type="text" disabled class="my-0 py-0 custom_width food_fee" value="{{$time_schedule->food_fee}}" name="food_fee[]"></td>
                            <td class="parent_site">
                            <select name="site[]" id="" disabled class=" my-0 py-0  site select2">
                                <option value="">Select One</option>
                                @foreach ($projects as $project)
                                <option @if ($time_schedule->site ==$project->title )
                                  selected  
                                @endif value="{{$project->title}}">{{$project->title?substr($project->title, 0, 10) : ''}}</option>
                                    
                                @endforeach
                            </select>
                               
                            </td>
                            <td class="parent_holiday">
                                <input type="checkbox" @if ($time_schedule->work_in_over_time)
                                    checked
                                @endif disabled name="is_holiday[]" onchange="automaticCalculation(this)" value="Yes">
                            </td>
                            <td class="parent_remarks"><input disabled type="text" value="{{$time_schedule->remarks}}" class="my-0 py-0 custom_width remarks" name="remarks[]"></td>

                            <td>
                                <i type="button" disabled class="btn btn-sm btn-danger fa fa-danger" onclick="btnRemove(this)"> </i>
                            </td>
                        </tr>
                        <?php $total_days = $total_days+1; ?>
                        @endforeach
                        @endisset
                    </tbody>
                 </table>

                 <div class="row col-md-12">
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary btn-sm mx-2">Submit</button>
                        </div>
                        <div class="col-md-2 font-weight-bold">
                            Total Days : {{$total_days??''}}
                        </div>
                 </div>

                 
               
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('js/flatpickr.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.min.css') }}"></script>

    <script>
        // date
        let datePickr = document.getElementsByClassName("date");
        datePickr.flatpickr({
            allowInput: true,
        })
        
        let datePickr2 = document.getElementsByClassName("date2");
        datePickr2.flatpickr({dateFormat: "Y-m"})

        // $(".date2").flatpickr({dateFormat: "Y-m"})
   


        // add row 
        $("#addBtn").on('click',function(){
            let tbody = $("#tbody");
            let content = `
                        <tr>
                            <td class="parent_date"><input type="date" required class="date my-0 py-0 custom_width"  name="date[]"></td>
                            <td class="parent_start_time"><input type="text" required class="my-0 py-0 custom_width start_time" name="start_time[]" ></td>
                            <td class="parent_end_time"><input type="text" required class="my-0 py-0 custom_width end_time" name="end_time[]" ></td>
                            <td class="parent_break_time"><input type="text" required class="my-0 py-0 custom_width break_time" onkeyup="automaticCalculation(this)" name="break_time[]"></td>
                            <td class="parent_hour_in_regular_days"><input type="text" class="my-0 py-0 custom_width hour_in_regular_days" name="hour_in_regular_days[]"></td>
                            <td class="parent_ot_in_regular_day"><input type="text" class="my-0 py-0 custom_width ot_in_regular_day" name="ot_in_regular_day[]"></td>
                            <td class="parent_work_in_over_time"><input type="text" class="my-0 py-0 custom_width work_in_over_time" name="work_in_over_time[]"></td>
                            <td class="parent_transport_fee"><input type="text" class="my-0 py-0 custom_width transport_fee" name="transport_fee[]"></td>
                            <td class="parent_food_fee"><input type="text" class="my-0 py-0 custom_width food_fee" name="food_fee[]"></td>
                            <td class="parent_site">
                                <select name="site[]" id="" class="my-0 py-0 custom_width site select2" required>
                                <option value="">Select One</option>
                                @foreach ($projects as $project)
                                <option value="{{$project->title}}">{{$project->title??''}}</option>
                                    
                                @endforeach
                            </select>
                                </td>
                            <td class="parent_holiday">
                                <input type="checkbox" name="is_holiday[]" onchange="automaticCalculation(this)" value="Yes">
                            </td>
                            <td class="parent_remarks"><input type="text" class="my-0 py-0 custom_width remarks" name="remarks[]"></td>

                            <td>
                                <i type="button" class="btn btn-sm btn-danger fa fa-trash" onclick="btnRemove(this)"> </i>
                            </td>
                        </tr>
            `;

            tbody.append(content);
             datePickr = document.getElementsByClassName("date");
            datePickr.flatpickr()
        })


        // delete Row

        function btnRemove(data){
            data.closest('tr').remove();
        }

        function automaticCalculation(data){
            
            let date = $(data).closest('tr').find('.parent_date').find('.date');
            let start_time = $(data).closest('tr').find('.parent_start_time').find('.start_time');
            let end_time = $(data).closest('tr').find('.parent_end_time').find('.end_time');
            let break_time = $(data).closest('tr').find('.parent_break_time').find('.break_time');
            
            let hour_in_regular_days = $(data).closest('tr').find('.parent_hour_in_regular_days').find('.hour_in_regular_days');
            let ot_in_regular_day = $(data).closest('tr').find('.parent_ot_in_regular_day').find('.ot_in_regular_day');
            let work_in_over_time = $(data).closest('tr').find('.parent_work_in_over_time').find('.work_in_over_time');
            
              // value setup 
           let  diff_time_without_break_time = end_time.val() - start_time.val();
           let  diff_time = diff_time_without_break_time - break_time.val();

            if($(data).is(":checked")){
                work_in_over_time.val(diff_time);
                hour_in_regular_days.val(0);
                ot_in_regular_day.val(diff_time);
            }else{
                work_in_over_time.val(0);
                hour_in_regular_days.val(8);
                ot_in_regular_day.val(diff_time-8);

            }
            
            
            
           

            if(data.value.length==0){
                // disbabled field 
                start_time.removeAttr('readonly');
                start_time.css({'background-color':'#fff'})

                date.removeAttr('readonly');
                date.css({'background-color':'#fff'})

                end_time.removeAttr('readonly');
                end_time.css({'background-color':'#fff'})

                hour_in_regular_days.removeAttr('readonly');
                hour_in_regular_days.css({'background-color':'#fff'})

                ot_in_regular_day.removeAttr('readonly');
                ot_in_regular_day.css({'background-color':'#fff'})

                work_in_over_time.removeAttr('readonly');
                work_in_over_time.css({'background-color':'#fff'})
            }else{
                // enabled field 
                start_time.attr('readonly','readonly');
                start_time.css({'background-color':'#E9E0E7'})

                date.attr('readonly','readonly');
                date.css({'background-color':'#E9E0E7'})

                end_time.attr('readonly','readonly');
                end_time.css({'background-color':'#E9E0E7'})

                hour_in_regular_days.attr('readonly','readonly');
                hour_in_regular_days.css({'background-color':'#E9E0E7'})

                ot_in_regular_day.attr('readonly','readonly');
                ot_in_regular_day.css({'background-color':'#E9E0E7'})

                work_in_over_time.attr('readonly','readonly');
                work_in_over_time.css({'background-color':'#E9E0E7'})
            }
       
           
        }
    </script>
@endpush

@push('css')
    <link href="{{ asset('css/flatpickr.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <style>
        .form-control {
            background-color: #fff !important;
        }

        .custom_width {
            width: 91px !important;
            height: 25px !important;
        }

        .table td,
        .table th {
            padding: 0 10px !important;
            width: 80px;
        }

        table {
            table-layout: fixed;
            word-wrap: break-word;
        }

        .btn-danger{
            width: 40px;
        }
    </style>
@endpush
