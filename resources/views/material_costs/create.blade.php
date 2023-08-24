@extends('layouts.master')
@section('body')

    <div class=" card " style="background-color:rgb(247, 238, 238)">
            
               <div class="row m-3">
                    <h1 class="col-md-11">Description  </h1>
                <p class="col-md-1"><a href="{{route('material_costs.index')}}"><button class="btn btn-primary btn-sm"> Back </button></a></p>
            
               </div>
                <form action="{{route('material_costs.store')}}"  method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row mx-4 ">
                      <label for="" class="col-md-12 font-weight-bold">Date</label>
                      <input type="text" name="date" id="" class="form-control col-md-5 mx-2 date " placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="form-group row mx-4 ">
                      <label for="" class="col-md-12 font-weight-bold">Company Name   </label>
                      <input type="text" name="company_name" id="company_name" class="form-control col-md-5 mx-2 " placeholder="" aria-describedby="helpId">
                    </div>

                    <div class="form-group row mx-4 ">
                      <label for="" class="col-md-12 font-weight-bold">Project Name   </label>
                      <select name="project_id" id="project_id" class="form-control col-md-5 mx-2">
                        <option value="">Select One</option>
                        @foreach ($projects as $key=> $project)
                            <option value="{{$project->id??''}}">{{$project->title??""}}</option>
                        @endforeach
                      </select>
                      {{-- <input type="text" name="project_id" id="project_id" class="form-control col-md-5 mx-2 " placeholder="" aria-describedby="helpId"> --}}
                    </div>
                    <div class="form-group row mx-4 ">
                      <label for="" class="col-md-12 font-weight-bold">Purchases of Material   </label>
                      <input type="text" name="material" id="" class="form-control col-md-5 mx-2 " placeholder="" aria-describedby="helpId">
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
                        <option value="Check">Cheque</option>
                      </select>
                    </div>

                    <div class="form-group row cash_memo_container mx-4 d-none ">
                      <label for="" class="col-md-12 font-weight-bold">Cash Memo </label>
                      <input type="file" name="cash_memo_no" id="cash_memo_no" required  class="form-control col-md-5 mx-2 " placeholder="" aria-describedby="helpId">
                    </div>


                    <div class="form-group row mx-4 amount_checking_container">

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
              $('.cash_memo_container').attr('class','form-group row cash_memo_container mx-4')
              let msg = `<p style="font-weight:bold;color:green;font-size:16px">${res.amount.total_cash_amount}$ available this account</p>`
              messageContainer.html(msg);
            }else{
              $('.cash_memo_container').attr('class','form-group row cash_memo_container mx-4')
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

