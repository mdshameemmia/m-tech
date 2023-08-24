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
      {{-- <p>
        <img src="{{asset('images/logo.jpg')}}" width="100%" height="60px" alt="">
      </p>
    <h3>Progress Claim</h3>
    
    <div style="width:100% ;display:flex">
        <div style="width: 50%;float:left">
            <p>{{$progress_claim->company->name??''}}</p>
            <p>{{$progress_claim->company->address??''}}</p>
            <p>Tel: {{$progress_claim->company->tel??''}}</p>
            <p>Fax: {{$progress_claim->company->fax??''}}</p>
            <p>Attention: {{$progress_claim->company->attention??''}}</p>
        </div>
        <div style="width: 50%;float:left">
            <p>Date: {{$progress_claim->date??''}}</p>
            <p>Ref QUOTATION NO: {{$progress_claim->quotation->quotation??''}}</p>
            <p>PROGRESS CLAIM MONTH: {{date('M Y',strtotime($progress_claim->date))}}</p>
            <p>PROGRESS CLAIM NO: {{$progress_claim->claim_no??''}}</p>
        </div>
     </div>

     <br>
     <div>
        <span style="font-weight: bold;color:#000">Project Title</span> : {{$progress_claim->title??''}}
     </div>

     <br>
     <div>
        <span style="font-weight: bold;color:#000">Fire Protection System</span>
     </div> --}}

     <table border="1" style="border-collapse:collapse">

        <thead>
            <tr>
                <th>S/N</th>
                <th>Description</th>
                <th>Contract Sum</th>
                <th>Work Done %</th>
                <th>Amount Due</th>
            </tr>
        </thead>


        <tbody>
            @php
                $total = 0;
                $due = 0;
            @endphp
            @foreach ($progress_claim->progressDescription as $item)
             @php
                 $total = $total + $item->contact_sum;
                 $due = $due + $item->amount_due;
             @endphp
                <tr>
                    <td>{{$loop->iteration??''}}</td>
                    <td>{{$item->description??''}}</td>
                    <td>{{$item->contact_sum??''}}</td>
                    <td>{{$item->work_done??''}}</td>
                    <td>{{$item->amount_due??''}}</td>
                </tr>
            @endforeach
            <tr>
                <th colspan="2">Total </th>
                <th>{{$total ??""}}</th>
                <th></th>
                <th>{{$due ??""}}</th>
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
      <div style="display: flex;width:100%;border-top: 1px dotted #000;padding-top:5px">
        <div style="float:left;width:60%">
                MR: MOTIN <br>
                Project Manager <br>
                Mob. +65 9007 9245
        </div>
        <div style="float:left;width:40%">
                Owner's Signature / Name <br>
                Nric No : <br>
                Date : 
        </div>
      </div>
    
</body>
</html>