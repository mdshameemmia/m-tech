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
            background-color: rgb(146, 35, 158);
            color: #fff;
        }

        p{
            text-align: center;
            font-weight: bold;
            font-size: 14px;
            margin:25px 0;
        }

        .ser_no{
            text-align: center;
            background-color: rgb(146, 35, 158);
            color: #fff;
        
        }
        th{
            background-color: rgb(146, 35, 158);
            color: #fff;
        }

        tfoot tr td{
            font-weight: bold;
            color: #fff;
            font-weight: bold;
            background-color: rgb(146, 35, 158);
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

    <h1>PURCHASES OF MATERIAL COST</h1>
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
            @foreach ($material_costs as $material_cost)
                <tr>
                    <td class="ser_no">{{ $loop->iteration ?? '' }}</td>
                    <td>{{ $material_cost->date ?date('Y-M-d',strtotime($material_cost->date)) :'' }}</td>
                    <td>{{ $material_cost->material ?? '' }}</td>
                    <td></td>
                    <td></td>
                    <td>{{ $material_cost->amount ?? '' }}</td>
                </tr>
                <?php $i = $i+$material_cost->amount; ?>
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
