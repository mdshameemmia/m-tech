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
            background-color: rgb(37, 210, 94);
        }

        p{
            text-align: center;
            font-weight: bold;
            font-size: 14px;
            margin:25px 0;
        }

        .ser_no{
            text-align: center;
            background-color: rgb(37, 210, 94);
        
        }
        th{
            background-color: rgb(37, 210, 94);
        }

        tfoot tr td{
            font-weight: bold;
            color: #000;
            background-color: rgb(37, 210, 94);
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

    <h1>Sub Contract Cost</h1>
    <table border="1" style="border-collapse:collapse">
        <thead>
            <tr>
                <th class="ser_no">S/No</th>
                <th>Date</th>
                <th>Company Name</th>
                <th>Project Name </th>
                <th>Check/Cash </th>
                <th>Amount($)</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0; ?>
            @foreach ($sub_contact_costs as $sub_contact_cost)
                <tr>
                    <td class="ser_no">{{ $loop->iteration ?? '' }}</td>
                    <td>{{ $sub_contact_cost->date ?date('Y-M-d',strtotime($sub_contact_cost->date)) :'' }}</td>
                    <td>{{ $sub_contact_cost->subcontract->company_name ?? '' }}</td>
                    <td>{{ $sub_contact_cost->subcontractProject->project_name ?? '' }}</td>
                    <td>{{ $sub_contact_cost->check_or_cash ?? '' }}</td>
                    <td>{{ $sub_contact_cost->amount ?? '' }}</td>
                </tr>
                <?php $i = $i+$sub_contact_cost->amount; ?>
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
