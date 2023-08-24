<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        p{
            margin: 0;
            padding: 0;
        }

        table tr td, th{
            padding: 10px 15px;
        }
    </style>
</head>
<body>
    <p>
        <img src="{{asset('images/logo.jpg')}}" width="100%" height="60px" alt="">
      </p>

    <h2>Quotation</h2>

     <div style="width:100% ;display:flex">
        <div style="width: 50%;float:left">
            <p>{{$quotation->company->name??''}}</p>
            <p>{{$quotation->company->address??''}}</p>
            <p>Tel: {{$quotation->company->tel??''}}</p>
            <p>Fax: {{$quotation->company->fax??''}}</p>
            <p>Attention: {{$quotation->company->attention??''}}</p>
        </div>
        <div style="width: 50%;float:left">
            <p>Date: {{$quotation->date??''}}</p>
            <p>Quotation: {{$quotation->quotation??''}}</p>
        </div>
     </div>

     <br>
     <div>
        <span style="font-weight: bold;color:#000">Project Title</span> : {{$quotation->title??''}}
     </div>

     <br>
     <div>
        <span style="font-weight: bold;color:#000">Project System</span>
     </div>

     <table border="1" style="border-collapse:collapse">

        <thead>
            <tr>
                <th>S/N</th>
                <th>Description</th>
                <th>Unit</th>
                <th>Rate</th>
                <th>Qty</th>
                <th>Amount($)</th>
            </tr>
        </thead>

        <tbody>
            @php
                $total = 0;
                $contentTitle = null;
                $i = 0;
                $subIndex = 0;
                $subtotal = 0;
            @endphp
            @foreach ($quotation->productQuotations  as $key=> $item)
        
                <tr>
                    @if ($contentTitle !== $item->product_description_title)
                    
                    <td colspan="4"  style="padding-top: <?= $key==0?'':'50px'?>" >{{$item->product_description_title??''}}</td>
                    @if ($key!==0)
                    <td colspan="2" style="padding-top: -20px">Subtotal {{$subtotal}}</td>
                    @endif
                       @php
                           $i=0;
                       @endphp  
                    @else 
                    <td>{{$i??''}}</td>
                    <td>{{$item->product->item_name??''}}</td>
                    <td>{{$item->product->unit??''}}</td>
                    <td>{{$item->rate??''}}</td>
                    <td>{{$item->qty??''}}</td>
                    <td>{{$item->amount??''}}</td>
                    
                    @endif
                   
                </tr>
             @php
                 $total = $total + $item->amount;
                 $subtotal = $subtotal + $item->amount;
                 $contentTitle = $item->product_description_title;
                 $i = $i+1;
             @endphp
            @endforeach
            <tr>
                <th colspan="5">Total </th>
                <th>{{$total ??""}}</th>
            </tr>
        </tbody>
     </table>


     <div>
        <h5>Terms & Conditions:</h5>
        <p>01. The quolationis based on the drawing given and any additional quantity will be considered is VO and will be computed accordingly.</p>
        <p>02. Any hacking of existing concrele slab to run u/g pipe/Conduit by others </p>
        <p>03.  Opening provision to run pipes through Slab/RC wall is excluded from the quolation</p>
        <p>04. The amount quoled is excluding of 7% GST</p>
        <p>05. The quolation is not inclusive of DLP</p>
     </div>
     <br>
     <div>
        <b>Note</b> : All Scaffolding above 3m, Scissor left & Boom leif Povide by  Rico Engineering pte Ltd
     </div>
     <br>
     <div>
        Yours Faithfully, <br>
        M- TECH (S) PTE LTD
     </div>
     <br>
     <br>
     <div style="border-top: 1px dotted #000;padding-top:5px">
        MR: MOTIN <br>
        Project Manager

     </div>
    
</body>
</html>