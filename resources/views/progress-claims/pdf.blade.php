<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table {
            width: 100%;
        }

        p {
            margin: 0;
            padding: 0;
        }

        table tr td,
        th {
            padding: 3px 2px;
        }

        .first {
            width: 30px;
            text-align: center;
        }
    </style>
</head>

<body>


    <table border="1" style="border-collapse:collapse">

        <thead>
            <tr>
                <th class="first">S/N</th>
                <th style="text-align: center"> Description</th>
                <th style="text-align: center">Contract Sum</th>
                <th colspan="2" style="text-align: center">Work Done (%) </th>
                <th style="text-align: center">Amount Due</th>
            </tr>
        </thead>



        <tbody>
            @php
                $first_title = \App\Models\ProductQuotation::whereNull('product_id')
                    ->where('quotation_id', $progress_claim->quotation_id)
                    ->first();
                $total = 0;
                $total_amount_due = 0;
                $i = 0;
            @endphp
            <tr>
                <td colspan="6">{{ $first_title->product_description_title ?? '' }}</td>

            </tr>

            @foreach ($data['data'] as $key => $quotations)
                @foreach ($quotations['quotation_description'] as $k => $item)
                    @if ($loop->iteration - 1 == $i)
                        <tr>
                            <td colspan="6">{{ $key ?? '' }}</td>
                        </tr>
                    @endif
                    <tr>
                        <td>{{ $loop->iteration ?? '' }}</td>
                        <td>{{ $item->description ?? '' }}</td>
                        <td style="text-align: center">{{ $item->contact_sum ?? '' }}</td>
                        <td style="text-align: center" colspan="2">{{ $item->work_done ?? '' }}</td>
                        <td style="text-align: center">{{ $item->amount_due ?? '' }}</td>

                    </tr>

                    @if (count($quotations['quotation_description']) == $loop->iteration)
                        <tr>
                            <td style="color:black;font-weight:bold;font-size:13px" colspan="2">Sub Total Amount</td>
                            <td style="color:black;font-weight:bold;text-align:center">
                                {{ array_sum($quotations['sub_total_amount']) }}
                            </td>
                            <td style="color:black;font-weight:bold;font-size:13px" colspan="2">Sub Total Due</td>
                            <td style="color:black;font-weight:bold;text-align:center">
                                {{ array_sum($quotations['sub_total_due']) }}</td>
                        </tr>
                    @endif

                    @php
                        $total = $total + $item->contact_sum;
                        $total_amount_due = $total_amount_due + $item->amount_due;
                    @endphp
                @endforeach
            @endforeach
            <tr>
                <th colspan="4"></th>
                <th style="text-align: center">Total </th>
                <th style="text-align: center">{{ $total ?? '' }}</th>
            </tr>
        </tbody>
    </table>


    <div style="display: float;float: right;width:50%;margin-top:20px">
        @php
        $remain_total  =  $total - $total_amount_due;
        $current_month = 0;
        @endphp
        <div style="width: 70%;float: left;">
            Progress Claim To Till Date :
        </div>
        <div style="width: 30%;float: right;">
           
            {{ $remain_total?round($remain_total,2):null}}
        </div>

        @foreach ($pre_progress_claim as $pre_progress)
        @php
            $current_month +=  $pre_progress->current_payment;
        @endphp
            <div style="width: 70%;float: left;">
                Less Total Claim :{{ $pre_progress->date ? date('d/m/Y', strtotime($pre_progress->date)) : '' }}
            </div>
            <div style="width: 30%;float: right;">
                {{ $pre_progress->current_payment?round($pre_progress->current_payment,2):null }}
                 <br>
            </div>
        @endforeach
        <div style="width: 100%;display:float">
            @php
                $tillDateVal =$remain_total- $current_month; 
            @endphp
            <div style="width: 70%;float: left;">
                Total Claim For {{$progress_claim->date?date('d/m/Y',strtotime($progress_claim->date)):''}}:
             </div>
             <div style="width: 30%;float: right;">
                 {{round(($tillDateVal),2)}}
             </div>
             <p style="text-align: center">({{convertNumberToWord(round(($tillDateVal),2))}})</p>
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
