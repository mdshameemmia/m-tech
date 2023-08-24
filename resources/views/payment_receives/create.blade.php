@extends('layouts.master')
@section('body')
    <div class="row p-2" style="background-color:rgb(247, 238, 238)">


        <h1 class="col-md-11">Payment Received </h1>
        <p class="col-md-1"><a href="{{ route('payment_receives.index') }}"><button class="btn btn-primary btn-sm"> Back
                </button></a></p>

        <form action="{{ route('payment_receives.store') }}" method="POST" class="row m-3 p-3">
            @csrf
            <div class="form-group col-md-5  ">
                <label for="" class="font-weight-bold">Date</label>
                <input type="text" name="date" id="" class="form-control  date " placeholder=""
                    aria-describedby="helpId">
            </div>
            <div class="form-group col-md-5  ">
                <label for="" class="font-weight-bold">Company Name </label>
                <select name="company_id" id="company_id" class="form-control">
                    <option value="">Select One</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id ?? '' }}">{{ $company->name ?? '' }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-5  ">
                <label for="" class="font-weight-bold">Project Name </label>
                <select name="project_id" id="project_id" class="form-control">
                    <option value="">Select One</option>
                </select>
                {{-- <input type="text" name="project_name" id="" class="form-control  " placeholder="" aria-describedby="helpId"> --}}
            </div>
            <div class="form-group col-md-5  ">
                <label for="" class="font-weight-bold">Invoice </label>
                <select name="invoice" id="invoice" class="form-control">
                    <option value="">Select One</option>
                </select>
                {{-- <input type="text" name="invoice" id="" class="form-control  " placeholder="" aria-describedby="helpId"> --}}
            </div>
            <div class="form-group col-md-5  ">
                <label for="" class="font-weight-bold">Invoice Amount</label>
                <input type="text" name="invoice_amount" id="invoice_amount" readonly class="form-control  "
                    placeholder="" aria-describedby="helpId">
            </div>
            <div class="form-group col-md-5  ">
                <label for="" class="font-weight-bold">Paid Material Amount </label>
                <input type="text" name="paid_material_amount" id="paid_material_amount" readonly  class=" form-control  " placeholder=""
                    aria-describedby="helpId">
            </div>

            <div class="form-group col-md-5  ">
                <label for="" class="font-weight-bold ">Cheque</label>
                <input type="radio" name="check_or_cash" value="Check" onclick="isCheck('Check')" placeholder=""
                    aria-describedby="helpId">
                <label for="" class="font-weight-bold ">Cash</label>
                <input type="radio" name="check_or_cash" value="Cash" onclick="isCheck('Cash')" placeholder=""
                    aria-describedby="helpId">

                <div class="bank-description d-none">
                    <div class="form-group">
                        <label for="">Bank Name</label>
                        <input type="text" name="bank_name" class="form-control" id="">
                    </div>
                    <div class="form-group">
                        <label for="">Account Number</label>
                        <input type="text" name="account_no" class="form-control" id="">
                    </div>
                </div>

            </div>

            <div class="form-group col-md-5  ">
                <label for="" class="font-weight-bold">Amount </label>
                <input type="text" name="amount" id="amount" class="form-control  " readonly placeholder=""
                    aria-describedby="helpId">

                <div class="my-2">
                    <p class="my-0">Total Budget: <span style="color: #000;font-weight:bold" id="total_amount"></span></p>
                    <p class="my-0">Total Due: <span style="color: #000;font-weight:bold" id="total_due"></span></p>
                    <p class="my-0">Total Payment: <span style="color: #000;font-weight:bold" id="total_payment"></span></p>
                </div>
            </div>
            <div class="form-group col-md-5  ">
                <button type="submit" class="btn btn-sm btn-primary  ">Save </button>

            </div>


        </form>


    </div>
@endsection

@push('js')
    <script src="{{ asset('js/flatpickr.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.min.css') }}"></script>

    <script>
        $(".date").flatpickr();

        $('#company_id').on('change', function() {
            let compnay_id = $(this).val();
            $.ajax({
                url: "/get-project-name",
                data: {
                    company_id: compnay_id
                },
                success: function(res) {
                    // projects 
                    let projects = res.projects;
                    let projectNameContainer = null;
                    let projectContainer = $("#project_id");
                    projectNameContainer += `<option>Select One</option>`;
                    projects.map(project => {
                        projectNameContainer +=
                            `<option value="${project.id}">${project.title}</option>`;
                    })
                    projectContainer.html(projectNameContainer);


                }
            })
        })


        // get invoices 
        $("#project_id").on('change', function() {
            let project_id = $(this).val();
            $.ajax({
                url: "/get-invoice",
                data: {
                    project_id: project_id
                },
                success: function(res) {
                    console.log(res)
                    let invoices = res.invoices;
                    let progress_claims = res.progress_claims;
                    let invoiceNameContainer = null;
                    let invoice_name = $("#invoice");
                    invoiceNameContainer += `<option>Select One</option>`;
                    invoices.forEach(invoice => {
                        if(invoice){
                            invoiceNameContainer +=
                                `<option value="${invoice.invoice_no}">${invoice.invoice_no}</option>`;

                        }
                    })
                    invoice_name.html(invoiceNameContainer);
                    $("#invoice_amount").val()

                }
            })
        })
        // get invoice amount
        $("#invoice").on('change', function() {
            let invoice_no = $(this).val();
            $.ajax({
                url: "/get-invoice-amount",
                data: {
                    invoice_no: invoice_no
                },
                success: function(res) {
                  console.log(res)
                    let current_payment = res.progressClaim.current_payment;
                    let total_amount = res.progressClaim.total_amount;
                    let total_due = res.progressClaim.total_due;
                    let total_payment = res.progressClaim.total_payment;
                    $("#invoice_amount").val(current_payment);
                    $("#paid_material_amount").val(current_payment);
                    $("#amount").val(current_payment);
                    $("#total_amount").html(total_amount);
                    $("#total_due").html(total_due);
                    $("#total_payment").html(total_payment);

                }
            })
        })


        // bank details access 
        function isCheck(val) {

            if (val == 'Check') {
                $('.bank-description').attr('class', 'bank-description');
            } else {
                $('.bank-description').attr('class', 'bank-description d-none');
            }
        }
    </script>
@endpush

@push('css')
    <link href="{{ asset('css/flatpickr.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <style>
        .form-control {
            background-color: #fff !important;
        }
    </style>
@endpush
