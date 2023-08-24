@extends('layouts.master')
@section('body')

    <div class="row card " style="background-color:rgb(247, 238, 238)">
            
               <div class="row m-3">
                    <h1 class="col-md-11">Sub Contract Payment  </h1>
                <p class="col-md-1"><a href="{{route('sub_contact_costs.index')}}"><button class="btn btn-primary btn-sm"> Back </button></a></p>
            
               </div>
                <form action="{{route('sub_contact_costs.store')}}"  method="POST">
                    @csrf
                  
                    <div class="form-group row mx-4 ">
                      <label for="" class="col-md-12 font-weight-bold">Subcontractor Name  </label>
                      <select name="subcontract_id"  class="form-control col-md-5 mx-2 " id="subcontract_id">
                        <option value="">Select One</option>
                        @foreach ($subcontracts as $subcontract)
                            <option value="{{$subcontract->id}}">{{$subcontract->name??''}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group row mx-4 ">
                      <label for="" class="col-md-12 font-weight-bold">Project Name  </label>
                      <select name="subcontract_project_id" id="subcontract_project_id" class="form-control col-md-5 mx-2 ">
                        <option value="">Select One</option>

                      </select>
                      <div class="col-md-5">
                            <p>Due Amount : <span id="due_amount" style="color: #000;font-weight:bold"></span>  <br>  Total Amount : <span style="color: #000;font-weight:bold" id="total_amount"></span> </p>
                      </div>
                    </div>
                    <div class="form-group col-md-5 row mx-4  ">
                      <label for="" class= "font-weight-bold">Type of Account </label>
                      <select id="type_of_account" name="type_of_account" class="form-control" >
                        <option value="">Select Account Type</option>
                        <option value="Cash">Cash</option>
                        <option value="Check">Cheque</option>
                      </select>
                    </div>
                    <div class="form-group col-md-5 text-center amount_checking_container">

                    </div>
                    <div class="form-group row mx-4 ">
                      <label for="" class="col-md-12 font-weight-bold">Amount </label>
                      <input type="text" name="amount" id="" class="form-control col-md-5 mx-2 " placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="form-group row mx-4 ">
                      <label for="" class="col-md-12 font-weight-bold">Date</label>
                      <input type="text" name="date" id="" class="form-control col-md-5 mx-2 date " placeholder="" aria-describedby="helpId">
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

       // payment
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

       // subcontract cost 
       $('#subcontract_id').on('change',function(){
        let subcontract_id =  $(this).val();
         $.ajax({
          url:"/get-subcontract-project",
          data:{
            subcontract_id : subcontract_id
          },
          success:function(res){
            console.log(res)
           let subcontract_project = $("#subcontract_project_id");
           let content = `<option>Select One</option>`
           res.forEach(sub_contract=>{
              content += `<option value=${sub_contract.id}>${sub_contract.project_name}</option>`
           })
           subcontract_project.html(content)
          }
         })
       })

       // subcontractor project amount 
       $('#subcontract_project_id').on('change',function(){
        let subcontract_project_id =  $(this).val();
         $.ajax({
          url:"/get-subcontract-project-amount",
          data:{
            subcontract_project_id : subcontract_project_id
          },
          success:function(res){
            console.log(res)
            let due = parseFloat(res.project.budget) - parseFloat(res.payment);
            $("#due_amount").html(due)
            $("#total_amount").html(res.project.budget)
          
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

