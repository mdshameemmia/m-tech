<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table{
            width: 100%;
        }
        p{
            margin: 0;
            padding: 0;
            font-size: 12px;
        }

        table tr td, th{
            padding: 2px 2px;
            font-size: 14px;
            text-align: center;
        }
        .first{
            width: 30px;
        }

        div{
            font-size: 12px;
        }
    </style>
</head>
<body>


     <table border="1" style="border-collapse:collapse">

        <thead>
            <tr>
                <th class="first">S/N</th>
                <th style="text-align: left">Description</th>
                <th>Unit</th>
                <th>Rate</th>
                <th>Qty</th>
                <th>Amount($)</th>
            </tr>
        </thead>

        <tbody>
            @php
                $total = 0;
                $i = 0;
            @endphp
            @foreach ($data['data']  as $key=> $quotations)   
           
            @foreach ($quotations['quotation_description'] as $k=> $item)
            
               @if ($loop->iteration-1 == $i)
                   <tr>
                    <td style="text-align: left" colspan="6">{{$key??''}}</td>
                   </tr>
               @endif
                @if ($item->amount)
                <tr>
                    <td>{{$loop->iteration??''}}</td>
                    <td style="text-align: left">{{$item->product->item_name??''}}</td>
                    <td >{{$item->product->unit??''}}</td>
                    <td>{{$item->rate??''}}</td>
                    <td>{{$item->qty??''}}</td>
                    <td>{{$item->amount??''}}</td>
                </tr>
                @endif

                @if ($item->amount && count($quotations['quotation_description']) == $loop->iteration)
                <tr >
                    <td colspan="4"></td>
                    <td style="text-align: center;font-size:12px;color:black;font-weight:bold" colspan="1" >Sub Total</td>
                    <td style="text-align: center;color:black;font-weight:bold" colspan="1">{{array_sum($quotations['subtotal'])}}</td>
                </tr>
                @endif

                @php
                    $total =  $total+$item->amount;
                @endphp
                
            @endforeach
            @endforeach
            <tr>
                <th colspan="4">{{convertNumberToWord($total)}} (SINGAPORE DOLLAR)</th>
                <th>Total </th>
                <th>{{$total ??""}}</th>
            </tr>
        </tbody>
     </table>


     <div>
        <h5>Terms & Conditions:</h5>
        
         @php
             $conditions = explode(';',$quotation->project->conditions);
         @endphp
         @foreach ($conditions as $key => $condition)
             <p>{{$loop->iteration}}. {{$condition??''}}</p>
         @endforeach
     </div>
     <br>
     <div>
        <b>Note</b> : {{$quotation->project->notice_board??''}}
     </div>
     <br>
     <div>
        Yours Faithfully, <br>
       {{$company_profile->name??''}}
     </div>
     <br>
     <br>
     <div style="border-top: 1px dotted #000;padding-top:5px">
       {{$quotation->project->project_manager??''}} <br>
        Project Manager

     </div>
    
</body>
</html>

