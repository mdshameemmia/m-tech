@extends('layouts.master')
@section('body')

    <div class="row p-2" style="background-color:rgb(247, 238, 238)">
            
                <h1 class="col-md-11">Loan </h1>
                <p class="col-md-1"><a href="{{route('loan.index')}}"><button class="btn btn-primary btn-sm"> Back </button></a></p>
            
                <form action="{{route('loan.store')}}"  method="POST" class="row m-3 p-3">
                    @csrf
                    <div class="form-group col-md-5  ">
                      <label for="" class= "font-weight-bold">Date</label>
                      <input type="text" name="date" id="" class="form-control  date " placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="form-group col-md-5  ">
                      <label for="" class= "font-weight-bold"> Name  </label>
                      <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group col-md-5  ">
                      <label for="" class= "font-weight-bold"> Mobile  </label>
                      <input type="text" name="mobile" class="form-control">
                    </div>
                    <div class="form-group col-md-5  ">
                      <label for="" class= "font-weight-bold">Amount </label>
                      <input type="text" name="amount" id="" class="form-control  " placeholder="" aria-describedby="helpId">
                    </div>

                 
                    <div class="form-group col-md-5  ">
                      <label for="" class= "font-weight-bold ">Cheque</label>
                      <input type="radio" name="check_or_cash" value="Check" onclick="isCheck('Check')"  placeholder="" aria-describedby="helpId">
                      <label for="" class= "font-weight-bold ">Cash</label>
                      <input type="radio" name="check_or_cash" value="Cash"  onclick="isCheck('Cash')" placeholder="" aria-describedby="helpId">
                      <div class="form-group bank-description d-none row col-md-12">
                        <div class="form-group">
                          <label for="">Bank Name</label>
                          <input type="text" name="bank_name" class="form-control" id="">
                        </div>
                        <div class="form-group ">
                          <label for="">Account Number</label>
                          <input type="text" name="account_no" class="form-control" id="">
                        </div>
                     </div>

                    </div>

                  
                    <div class="form-group col-md-12  ">
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

       $('#company_id').on('change',function(){
        let compnay_id =  $(this).val();
         $.ajax({
          url:"/get-project-name",
          data:{
            company_id : compnay_id
          },
          success:function(res){
            // projects 
            let projects = res.projects;
            let projectNameContainer = null;
            let project_name = $("#project_name");
            projectNameContainer += `<option>Select One</option>`;
            projects.map(project=>{
              projectNameContainer += `<option value="${project.title}">${project.title}</option>`;
            })
            project_name.html(projectNameContainer);

            // projects 
            let invoices = res.invoices;
            let invoiceNameContainer = null;
            let invoice_name = $("#invoice");
            invoiceNameContainer += `<option>Select One</option>`;
            invoices.map(invoice=>{
              invoiceNameContainer += `<option value="${invoice.invoice_no}">${invoice.invoice_no}</option>`;
            })
            invoice_name.html(invoiceNameContainer);
          }
         })
       })


       // bank details access 
       function isCheck(val)
       {

        if (val =='Check') {
          $('.bank-description').attr('class','bank-description');
        }else{
          $('.bank-description').attr('class','bank-description d-none');
        }
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

