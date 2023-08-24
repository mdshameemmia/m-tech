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
            background-color: rgb(202, 151, 70);
            color: rgb(52, 118, 165);
        }

        p{
            text-align: center;
            font-weight: bold;
            font-size: 14px;
            margin:25px 0;
        }

        .ser_no{
            text-align: center;
            background-color: rgb(202, 151, 70);
            color: #000;
        
        }
        th{
            background-color: rgb(202, 151, 70);
            color: #000;
        }

        tfoot tr td{
            font-weight: bold;
            color: #000;
            background-color: rgb(202, 151, 70);
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

    <h1>Offical/House Rent/Other Cost </h1>
    <table border="1" style="border-collapse:collapse">
        <thead>
            <tr>
                <th class="ser_no">S/No</th>
                <th>Date</th>
                <th>Description</th>
                <th>QTY</th>
                <th>Rate($)</th>
                <th>Amount($) </th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0; ?>
            @foreach ($official_or_other_costs as $official_or_other_cost)
                <tr>
                    <td class="ser_no">{{ $loop->iteration ?? '' }}</td>
                    <td>{{ $official_or_other_cost->date ?date('Y-M-d',strtotime($official_or_other_cost->date)) :'' }}</td>
                    <td>{{ $official_or_other_cost->description ?? '' }}</td>
                    <td></td>
                    <td></td>
                    <td>{{ $official_or_other_cost->amount ?? '' }}</td>
                </tr>
                <?php $i = $i+$official_or_other_cost->amount; ?>
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
