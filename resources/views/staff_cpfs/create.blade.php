@extends('layouts.master')
@section('body')

    <div class="row p-2" style="background-color:rgb(247, 238, 238)">
            
            
                    <h1 class="col-md-11">Staff & CPF </h1>
                <p class="col-md-1"><a href="{{route('staff_cpfs.index')}}"><button class="btn btn-primary btn-sm"> Back </button></a></p>
            
                <form action="{{route('staff_cpfs.store')}}"  method="POST" class="row m-3 p-3">
                    @csrf
                    <div class="form-group col-md-5  ">
                      <label for="" class= "font-weight-bold">Date</label>
                      <input type="text" name="date" id="" class="form-control  date " placeholder="" aria-describedby="helpId">
                    </div>

                    <div class="form-group col-md-5  ">
                      <label for="" class= "font-weight-bold">Staff Name   </label>
                      <select name="employee_id" id="employee_id" class="form-control">
                        <option value="">Select One</option>
                        @foreach ($employees as $employee)
                            <option value="{{$employee->id??''}}">{{$employee->name??''}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group col-md-5  ">
                      <label for="" class= "font-weight-bold">Work Permit No    </label>
                      <input type="text" name="work_permit_no" id="" readonly class="form-control  " placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="form-group col-md-5  ">
                      <label for="" class= "font-weight-bold">NID   </label>
                      <input type="text" name="nid" id="" class="form-control  " readonly placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="form-group col-md-5  ">
                      <label for="" class= "font-weight-bold">Salary of Month </label>
                      <input type="date" name="salary_of_month" id="salary_of_month" class="date form-control  " placeholder="" aria-describedby="helpId">
                    </div>

                    <div class="form-group col-md-5  ">
                      <label for="" class= "font-weight-bold">Personal CPF Amount</label>
                      <input type="text" name="personal_cpf_amount" readonly id="personal_cpf_amount" class="form-control  " placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="form-group col-md-5  ">
                      <label for="" class= "font-weight-bold">Company CPF Amount</label>
                      <input type="text" name="company_cpf_amount" onkeyup="getTotalCPF(this)" id="company_cpf_amount" class="form-control  " placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="form-group col-md-5  ">
                      <label for="" class= "font-weight-bold">Total CPF Amount</label>
                      <input type="text" name="total_cpf_amount" readonly id="" class="form-control  " placeholder="" aria-describedby="helpId">
                    </div>

                    <div class="form-group col-md-5  ">
                      <label for="" class= "font-weight-bold">Amount </label>
                      <input type="text" name="amount" id="" class="form-control  " readonly placeholder="" aria-describedby="helpId">
                    </div>

                    <div class="form-group col-md-5  ">
                      <label for="" class= "font-weight-bold">Type of Account </label>
                      <select id="type_of_account" name="type_of_account" class="form-control" >
                        <option value="">Select Account Type</option>
                        <option value="Cash">Cash</option>
                        <option value="Check">Check</option>
                      </select>
                    </div>
                    <div class="form-group col-md-5 py-3 text-center amount_checking_container">

                    </div>
                    <div class="form-group col-md-3">
                      <button type="submit" class="btn btn-sm btn-primary  ">Save </button>
                    
                    </div>


                </form>
               
          
    </div>
@endsection

@push('js')
<script src="{{asset('js/flatpickr.js')}}"></script>
  <script src="{{asset('js/sweetalert2.min.css')}}"></script>

    <script>
       $(".date").flatpickr();


       $('#type_of_account').on('change',function(){
        let type_of_account =  $(this).val();
         $.ajax({
          url:"/check-amount",
          data:{
            type_of_account : type_of_account
          },
          success:function(res){
           let messageContainer = $(".amount_checking_container");
            if(res.amount.total_cash_amount){
              let msg = `<p style="font-weight:bold;color:green;font-size:16px">${res.amount.total_cash_amount}$ available this account</p>`
              messageContainer.html(msg);
            }else{
              let msg = `<p style="font-weight:bold;color:green;font-size:16px">${res.amount.total_check_amount}$ available this account</p>`
              messageContainer.html(msg);
            }
          }
         })
       })

       $('#employee_id').on('change',function(){
        let employee_id =  $(this).val();

         $.ajax({
          url:"/get-employee-details",
          method:"POST",
          data:{
            employee_id : employee_id,
            "_token":"{{csrf_token()}}"
          },
          success:function(res){
           $("input[name=work_permit_no]").val(res.ep);
           $("input[name=nid]").val(res.nid);
          }
         })
       })


       // salary vouchar details
       $('#salary_of_month').on('change',function(){
        let salary_of_month =  $(this).val();
        let employee_id =  $("#employee_id").val();

         $.ajax({
          url:"/get-salary-details",
          method:"POST",
          data:{
            salary_of_month : salary_of_month,
            employee_id : employee_id,
            "_token":"{{csrf_token()}}"
          },
          success:function(res){
            
           if(res){
            $('input[name=personal_cpf_amount]').val(res.cpf);
            $('input[name=amount]').val(res.net_pay);
           }else{
            alert('Please create salary vouchar')
           }
          }
         })
       })

       //  total pay 
       function getTotalCPF(data)
       {
        let company_pay = data.value;
        let personal_pay = $("#personal_cpf_amount").val();
        let totalCPF = parseFloat(company_pay) + parseFloat(personal_pay);

          $('input[name=total_cpf_amount]').val(totalCPF.toFixed(2));
       }

    </script>
@endpush

@push('css')
    <link href="{{asset('css/flatpickr.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset("css/sweetalert2.min.css")}}">
    <style>
        .form-control{
            background-color: #fff !important ;
        }
    </style>
@endpush

