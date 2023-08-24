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

        table {
            width: 100%;
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
                <th>AMOUNT($) </th>
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
                @endforeach
            @endforeach
            <tr>
                <th style="text-align: left"> </th>
                <th style="text-align: left" style="padding-bottom: 300px;width:50%"></th>
                <th style="text-align: left"></th>
                <th style="text-align: left">${{ $invoice->progressClaim->current_payment ? round($invoice->progressClaim->current_payment,2):null }}</th>
            </tr>
            <tr>
                <th style="text-align: left"> </th>
                <th style="text-align: left">{{convertNumberToWord(round($invoice->progressClaim->current_payment,2))}} (SINGAPORE DOLLAR)</th>
                <th style="text-align: left">Total</th>
                <th style="text-align: left">${{ $invoice->progressClaim->current_payment ?round($invoice->progressClaim->current_payment,2):null }}</th>
            </tr>
        </tbody>
    </table>

    <div style="width: 100%;display:float;height:200px;">
        <br>
        <div>
            Yours Faithfully, <br>
            {{ 'M- TECH (S) PTE LTD' }}
        </div>
        <br>
        <br>

        <div style="border-top: 1px dotted #000;padding-top:0;width:40%;float: left;">
            {{ $invoice->progressClaim->project->project_manager ?? '' }} <br>
            Project Manager
            <br>
        </div>

        <div style="border-top: 1px dotted #000;padding-top:0;width:40%;float: right;">
            <h3 style="margin: 0;padding:0">Owner's Signature / Name </h3>
        </div>
    </div>


</body>

</html>
