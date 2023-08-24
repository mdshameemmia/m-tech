<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        p {
            margin: 0;
            padding: 0;
        }

        table tr td,
        th {
            padding: 1px 3px;
            text-align: center;
            font-size: 13px;    
 
        }

        table {
            width: 100%;
        }

        h1 {
            text-align: center;
            color: #000;
            font-size: 24px;
            margin: 0;
        }
        img{
            margin: 10px 0;
        }

        p{
            font-weight: bold;
            font-size: 13px;
            margin: 0;
        }

        .ser_no{
            text-align: center;
            /* background-color: rgb(146, 35, 158); */
            color: #fff;
        
        }
        th{
            /* background-color: rgb(146, 35, 158); */
            color: #000;
        }

        tfoot tr td{
            font-weight: bold;
            color: #000;
            font-weight: bold;
            /* background-color: rgb(146, 35, 158); */
            text-align: center;
        }
    </style>
</head>

<body>
    
    
        {{-- <img src="{{ asset('images/logo.jpg') }}" width="100%" height="70px" alt=""> --}}
    

        <h1>Time Sheet</h1>
    <p >
        Name of Employee : {{$empoyee->name??""}}
    </p>
    <p style="margin-bottom:8px;margin-top:0">
        Work Permit Number : {{$empoyee->ep??""}}
    </p>

    <div style="width: 100%;position:float;margin:2px 0">
        <div style="width: 33%;float: left;">
            <p>{{date('d/m/Y',strtotime($first_date->date))}}</p>
            <p>Start DD/MM/YYYY</p>
        </div>
        <div style="width: 33%;float: left;">
            <p>{{date('d/m/Y',strtotime($last_date->date))}}</p>
            <p>End DD/MM/YYYY</p>
        </div>
        <div style="width: 33%;float: left;">
            <p>Every Sunday</p>
            <p>Rest Day</p>
        </div>
    </div>

    <table border="1" style="border-collapse:collapse">
        <thead>
            
            <tr>
                <th>Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Break Time</th>
                <th>Regular Days</th>
                <th>OT Hours </th>
                <th>Sun/PH Hours</th>
                <th>Transport Fee</th>
                <th>Food Fee</th>
                <th>Site </th>
                <th>Remarks </th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0;$ot = 0;$tf=0;$ff=0; ?>
            @foreach ($time_schedules as $time_schedule)
                <tr>
                   @if ($time_schedule->hour_in_regular_days)
                       <?php $i++; ?>
                   @endif
                    <td>{{ $time_schedule->date ?date('d',strtotime($time_schedule->date)) :'' }}</td>
                    <td>{{$time_schedule->start_time??''}}</td>
                    <td>{{$time_schedule->end_time??''}}</td>
                    <td>{{$time_schedule->break_time??''}}</td>
                    <td>{{$time_schedule->hour_in_regular_days??''}}</td>
                    <td>{{$time_schedule->ot_in_regular_day??''}}</td>
                    <td>{{$time_schedule->work_in_over_time??""}}</td>
                    <td>{{$time_schedule->transport_fee??""}}</td>
                    <td>{{$time_schedule->food_fee??""}}</td>
                    <td>
                    
                        @php
                        $sites = explode('(',$time_schedule->site);
                        if(isset($sites[1])){
                            $site = explode(')',$sites[1]);
                        }
                    @endphp
                    {{$site[0]??""}}
                    </td>
                    <td>{{$time_schedule->remarks??""}}</td>
                </tr>
                <?php 
                $ot = $ot+$time_schedule->ot_in_regular_day;
                $tf = $tf + $time_schedule->transport_fee;
                $ff = $ff + $time_schedule->food_fee;
                 ?>
            @endforeach

        </tbody>
        <tfoot>
            <tr>
                <td colspan="4">Total</td>
                <td>Days : {{$i}}</td>
                <td>OT Hours : {{$ot}}</td>
                <td></td>
                <td>{{$tf??''}}</td>
                <td>{{$ff??''}}</td>
                <td></td>
                <td></td>
             
            </tr>
        </tfoot>
    </table>



</body>

</html>
