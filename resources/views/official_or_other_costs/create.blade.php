@extends('layouts.master')
@section('body')

    <div class="row card " style="background-color:rgb(247, 238, 238)">
            
               <div class="row m-3">
                    <h1 class="col-md-11">Official/Other Cost</h1>
                <p class="col-md-1"><a href="{{route('official_or_other_costs.index')}}"><button class="btn btn-primary btn-sm"> Back </button></a></p>
            
               </div>
                <form action="{{route('official_or_other_costs.store')}}"  method="POST">
                    @csrf
                    <div class="form-group row mx-4 ">
                      <label for="" class="col-md-12 font-weight-bold">Date</label>
                      <input type="text" name="date" id="" class="form-control col-md-5 mx-2 date " placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="form-group row mx-4 ">
                      <label for="" class="col-md-12 font-weight-bold">Description   </label>
                      <input type="text" name="description" id="" class="form-control col-md-5 mx-2 " placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="form-group row mx-4 ">
                      <label for="" class="col-md-12 font-weight-bold">Amount </label>
                      <input type="text" name="amount" id="amount"  class="form-control col-md-5 mx-2 " placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="form-group row mx-4  ">
                      <label for="" class= "col-md-12 font-weight-bold">Type of Account </label>
                      <select id="type_of_account" name="type_of_account" class="form-control col-md-5 mx-2" >
                        <option value="">Select Account Type</option>
                        <option value="Cash">Cash</option>
                        <option value="Check">Check</option>
                      </select>
                    </div>
                    <div class="form-group row mx-4 py-3 text-center amount_checking_container">

                    </div>

                    <div class="form-group row mx-4 ">
                      <button type="submit" class="btn btn-sm btn-primary mx-2 ">Save </button>
                     
                    </div>


                </form>
               
          
    </div>
@endsection

@push('js')
<script src="{{asset('js/flatpickr.js')}}"></script>
  <script src="{{asset('js/sweetalert2.min.css')}}"></script>

    <script>
       $(".date").flatpickr();

        // total amount calculation 
        function getTotalAmount(){
         let qty = $("input[name=qty]").val();
         let rate = $("input[name=rate]").val();
         let total = qty * rate;
         $("#amount").val(total);
       }


       // type of account 
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

