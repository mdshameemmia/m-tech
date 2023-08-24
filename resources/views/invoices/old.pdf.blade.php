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
        }
    </style>
</head>

<body>


    <table border="1" style="border-collapse:collapse">

        <thead>
            <tr>
                <th>ITEM</th>
                <th>DESCRIPTION</th>
                <th>U.PRICE</th>
                <th colspan="2">AMOUNT($) </th>
            </tr>
        </thead>

        <tbody>
            @php
                $total_contact_sum = 0;
                $total_due = 0;
                $total_payment = 0;
                $i = 0;
            @endphp
            @foreach ($data['data'] as $key => $invoices)
                @foreach ($invoices['quotation_description'] as $k => $item)
                    @php
                        $total_contact_sum = $total_contact_sum + $item->contact_sum;
                        $total_due = $total_due + $item->amount_due;
                        $total_payment = $total_payment + ($item->contact_sum - $item->amount_due);
                    @endphp

                    @if ($loop->iteration - 1 == $i)
                        <tr>
                            <td colspan="6">{{ $key ?? '' }}</td>
                        </tr>
                    @endif
                    <tr>
                        <td>{{ $loop->iteration ?? '' }}</td>
                        <td>{{ $item->description ?? '' }}</td>
                        <td>{{ $item->contact_sum ?? '' }}</td>
                        <td colspan="2">{{ $item->contact_sum - $item->amount_due }}</td>
                        <td>{{ $item->amount_due ?? '' }}</td>

                    </tr>

                    @if (count($invoices['quotation_description']) == $loop->iteration)
                        <tr>
                            <td style="color:black;font-weight:bold;font-size:13px" colspan="2">Sub Total</td>
                            <td style="color:black;font-weight:bold">{{ array_sum($invoices['sub_total_amount']) }}</td>
                            <td style="color:black;font-weight:bold;font-size:13px" colspan="2">
                                {{ array_sum($invoices['sub_payment']) }}</td>
                            <td style="color:black;font-weight:bold">{{ array_sum($invoices['sub_total_due']) }}</td>
                        </tr>
                    @endif
                @endforeach
            @endforeach
            <tr>
                <th style="text-align: left" colspan="2">Total </th>
                <th style="text-align: left">{{ $total_contact_sum ?? '' }}</th>
                <th style="text-align: left" colspan="2">{{ $total_payment ?? '' }}</th>
                <th style="text-align: left">{{ $total_due ?? '' }}</th>
            </tr>
        </tbody>
    </table>


    <div style="width: 400px">
        <div>
            <h5>Terms & Conditions:</h5>
            <p>01. The quolationis based on the drawing given and any additional quantity will be considered is VO and
                will be computed accordingly.</p>
            <p>02. Any hacking of existing concrele slab to run u/g pipe/Conduit by others </p>
            <p>03. Opening provision to run pipes through Slab/RC wall is excluded from the quolation</p>
            <p>04. The amount quoled is excluding of 7% GST</p>
            <p>05. The quolation is not inclusive of DLP</p>
        </div>
        <br>
        <div>
            <b>Note</b> : All Scaffolding above 3m, Scissor left & Boom leif Povide by Rico Engineering pte Ltd
        </div>
    </div>
        <div style="width: 100%;display:float;height:200px;">
            <br>
            <div>
                Yours Faithfully, <br>
                {{ 'M- TECH (S) PTE LTD' }}
            </div>
            <br>
            <br>
    
            <div style="border-top: 1px dotted #000;padding-top:0;width:40%;float: left;">
                {{ $progress_claim->project->project_manager ?? '' }} <br>
                Project Manager
            </div>
    
            <div style="border-top: 1px dotted #000;padding-top:0;width:40%;float: right;">
                <h3 style="margin: 0;padding:0">Owner's Signature / Name </h3>
            </div>
        </div>


</body>

</html>
