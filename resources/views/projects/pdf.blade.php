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
            padding: 10px 15px;
            text-align: center;
        }

        table {
            width: 100%;
        }

        h1 {
            text-align: center;
            background-color: rgb(148, 212, 50);
        }

        p{
            text-align: center;
            font-weight: bold;
            font-size: 14px;
            margin:25px 0;
        }

        .ser_no{
            text-align: center;
            background-color: rgb(148, 212, 50);
        
        }
        th{
            background-color: rgb(148, 212, 50);
        }

        tfoot tr td{
            font-weight: bold;
            color: #000;
            background-color: rgb(148, 212, 50);
            text-align: center;
        }
    </style>
</head>

<body>
    
    <p>
        <img src="{{ asset('images/logo.jpg') }}" width="100%" height="70px" alt="">
    </p>

    <p>
        {{$company->address??""}}
    </p>

    <h1>TOTAL PROJECT BUDGET</h1>
    <table border="1" style="border-collapse:collapse">
        <thead>
            <tr>
                <th class="ser_no">S/No</th>
                <th>Company Name</th>
                <th>Project Name</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Total Budger Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0; ?>
            @foreach ($projects as $project)
                <tr>
                    <td class="ser_no">{{ $loop->iteration ?? '' }}</td>
                    <td>{{ $project->company->name ?? '' }}</td>
                    <td>{{ $project->title ?? '' }}</td>
                    <td>{{ $project->start_date ?date('Y-M-d',strtotime($project->start_date)) :'' }}</td>
                    <td>{{ $project->end_date ?date('Y-M-d',strtotime($project->end_date)) :'' }}</td>
                    <td>{{ $project->amount ?? '' }}</td>
                </tr>
                <?php $i = $i+$project->amount; ?>
            @endforeach

        </tbody>
        <tfoot>
            <tr>
                <td colspan="5">Total</td>
                <td>{{$i??""}}</td>
            </tr>
        </tfoot>
    </table>



</body>

</html>
