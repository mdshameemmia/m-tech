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
            padding: 2px 5px;
            text-align: center;
 
        }

        table {
            width: 100%;
        }

        h1 {
            text-align: center;
            /* background-color: rgb(146, 35, 158); */
            color: #000;
        }
        img{
            margin: 20px 0;
        }

        p{
            font-weight: bold;
            font-size: 14px;
            margin: 0;
        }

        .ser_no{
            text-align: center;
            /* background-color: rgb(146, 35, 158); */
            color: #fff;
        
        }
        th{
            /* background-color: rgb(146, 35, 158); */
            color: #000;
        }

        tfoot tr td{
            font-weight: bold;
            color: #000;
            font-weight: bold;
            /* background-color: rgb(146, 35, 158); */
            text-align: center;
        }

        .right_table table tr td{
            text-align: left;
            border: 2px solid black;

        }
    </style>
</head>

<body>
    
        {{-- @dd($employee) --}}
        <img src="{{ asset('images/logo.jpg') }}" width="100%" height="70px" alt="">
    

        <h1>Salary Vouchar</h1>
 
    <div style="width: 100%;position:float;margin:20px 0">
        <div style="width: 33%;float: left;">
            Pay to : {{$employee->name??""}}
        </div>
        <div style="width: 33%;float: left;">
           
            <p>FIN NO: {{$employee->ep??''}}</p>
        </div>
        <div style="width: 33%;float: left;">
         
            <p> Date: {{date('M Y')}}</p>
        </div>
    </div>

    {{-- @dd($salary_vouchar) --}}
    <div style="width: 100%;position:float;">
        <div style="width: 60%;float: left;">
            <table border="1" style="border-collapse:collapse">
                <tr>
                    <td rowspan="7" style="width: 30%" >EARNINGS</td>
                    <td>Basic pay : {{$total_days??''}} DAYS @  ${{$salary_vouchar->amount_per_day}} </td>
                    <td> ${{$salary_vouchar->total_basic_pay??''}}</td>
                </tr>
                <tr>
                    
                    <td>Overtime : {{$salary_vouchar->over_time??''}} HRS @ ${{$salary_vouchar->amount_per_time}}</td>
                    <td>${{$salary_vouchar->total_over_time??''}} </td>
                </tr>
                <tr>
                    
                    <td>TRANSPORT  </td>
                    <td>${{$salary_vouchar->transport_pay??''}} </td>
                </tr>
                <tr>
                    
                    <td>FOODS  </td>
                    <td>${{$salary_vouchar->food_pay??''}}  </td>
                </tr>
                <tr>
                    
                    <td>MEDICAL  </td>
                    <td>${{$salary_vouchar->medical_pay??''}}  </td>
                </tr>
                <tr>
                    
                    <td>Bonus  </td>
                    <td>${{$salary_vouchar->bonus??''}}  </td>
                </tr>
                <tr style="background-color: yellow">
                    
                    <td>(A)GROSS PAY  </td>
                    <td>${{$salary_vouchar->gross_pay??''}} </td>
                </tr>
        
                <tr>
                    <td rowspan="9">DEDUCATIONS</td>
                    <td>CPF-Employee</td>
                    <td>${{$salary_vouchar->cpf??''}}</td>
                </tr>
                <tr>
                    
                    <td>Contributions</td>
                    <td>${{$salary_vouchar->contribution??''}}</td>
                </tr>
                <tr>
                    
                    <td>WDL/CDAC/MBMF</td>
                    <td>${{$salary_vouchar->wdl_cdac_mbmf??''}}</td>
                </tr>
                <tr>
                    
                    <td>CDAC</td>
                    <td>${{$salary_vouchar->cadc??''}}</td>
                </tr>
                <tr>
                    
                    <td>Advanced/Loan</td>
                    <td>${{$salary_vouchar->advance_or_loan??''}}</td>
                </tr>
                <tr>
                    
                    <td>Income Tax</td>
                    <td>${{$salary_vouchar->income_tax??''}}</td>
                </tr>
                <tr>
                    
                    <td>Monthly Housing </td>
                    <td>${{$salary_vouchar->monthly_housing??''}}</td>
                </tr>
                <tr>
                    
                    <td>Others </td>
                    <td>${{$salary_vouchar->others??''}}</td>
                </tr>
                <tr>
             
                    <td  style="background-color: yellow">(B)TOTAL DEDUCTIONS </td>
                    <td  style="background-color: yellow">${{$salary_vouchar->total_deduction??''}}</td>
                </tr>
                <tr>
                    <td rowspan="2">ADDITION</td>
                    <td> Reimbursement</td>
                    <td></td>
                </tr>
                <tr style="background-color: yellow">
                    <td>(C)TOTAL ADDITIONS</td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>NETT PAY(A) </td>
                    <td>${{$salary_vouchar->net_pay??''}}</td>
                </tr>
            </table>
        
        </div>
        <div style="width: 35%;float: right;" class="right_table">
                <div>
                    <table border="1" style="border-collapse:collapse;text-align:left">
                        <tr>
                            <td>Pay for the month</td>
                            <td>{{$salary_vouchar->date?date('M-y',strtotime($salary_vouchar->date)):''}}</td>
                        </tr>
                        <tr>
                            <td>Over time hrs</td>
                            <td>{{$salary_vouchar->over_time??''}}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>${{$salary_vouchar->amount_per_time??''}}</td>
                        </tr>
                    </table>
                </div>
               <div style="margin-top: 20px">
                <table border="1" style="border-collapse:collapse;text-align:left">
                    <tr>
                        <td>Employee's CPF </td>
                        <td>${{$salary_vouchar->cpf??''}}</td>
                    </tr>
                    <tr>
                        <td>Total Contribution  </td>
                        <td>${{$salary_vouchar->contribution??''}}</td>
                    </tr>
                </table>
               </div>
               <div style="margin-top: 20px">
                <table border="1" style="border-collapse:collapse;">
                    <tr >
                        <td colspan="2">Prepared By: MOTIN 
                            <br>
                            <br>
                            <br>
                            <br>
                            
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            Approved By: Maimoona
                            <br>
                            <br>
                            <br>
                            
                            Maimoona, Director
                        </td>
                    </tr>
                   
                    <tr >
                        <td colspan="2" style="padding-bottom: 50px;text-align:left" >Received by :  </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding-top: 50px;text-align:left">Employee's Signature/Date</td>
                    </tr>
                </table>
               </div>
        </div>
    </div>


</body>

</html>
