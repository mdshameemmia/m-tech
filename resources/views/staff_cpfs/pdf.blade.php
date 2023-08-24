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

    <h1>Staff CPF & Salary</h1>
    <table border="1" style="border-collapse:collapse">
        <thead>
            <tr>
                <th class="ser_no">S/No</th>
                <th>Date</th>
                <th>Staff Name</th>
                <th>Work Permit No</th>
                <th>Staff NID</th>
                <th>Salary of Month</th>
                <th>CPF Amount</th>
                <th>Amount($) </th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0;$cpf = 0; ?>
            @foreach ($staff_cpfs as $staff_cpf)
                <tr>
                    <td class="ser_no">{{ $loop->iteration ?? '' }}</td>
                    <td>{{ $staff_cpf->date ?date('Y-M-d',strtotime($staff_cpf->date)) :'' }}</td>
                    <td>{{$staff_cpf->employee->name??''}}</td>
                    <td>{{$staff_cpf->employee->ep??''}}</td>
                    <td>{{$staff_cpf->employee->nid??''}}</td>
                    <td>{{ $staff_cpf->salary_of_month ?date('M-y',strtotime($staff_cpf->salary_of_month)) :'' }}</td>
                    <td>{{$staff_cpf->total_cpf_amount??""}}</td>
                    <td>{{$staff_cpf->amount??""}}</td>
                </tr>
                <?php $i = $i+$staff_cpf->amount; $cpf = $cpf + $staff_cpf->total_cpf_amount; ?>
            @endforeach

        </tbody>
        <tfoot>
            <tr>
                <td colspan="6">Total</td>
                <td>{{$cpf ??''}}</td>
                <td>{{$i??""}}</td>
            </tr>
        </tfoot>
    </table>



</body>

</html>
