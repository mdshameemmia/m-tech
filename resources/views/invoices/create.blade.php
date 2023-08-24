@extends('layouts.master')
@section('body')
    <div class="row card " style="background-color:rgb(247, 238, 238)">
        <div class="row m-2 px-3">
            <h1 class="col-md-11">Invoice Create </h1>
            <p class="col-md-1"><a href="{{ route('invoice.index') }}"><button class="btn btn-primary btn-sm"> Back
                    </button></a></p>
        </div>
        <form action="{{ route('invoice.store') }}" method="POST" class="row">
            @csrf
            <div class="col-md-12 px-5">
                <div class="form-group  ">
                    <label for="" class="col-md-12 font-weight-bold">Company Name </label>
                    <select name="company_id" class="form-control mx-2" id="company_id">
                        <option value="">Select One</option>
                        @foreach ($companies as $company)
                            <option value="{{ $company->id ?? '' }}">{{ $company->name ?? '' }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group  ">
                    <label for="" class="col-md-12 font-weight-bold">Title</label>
                    <select name="title" class="form-control mx-2" id="title">
                        <option value="">Select One</option>
                    </select>
                </div>


                <div class="form-group  ">
                    <label for="" class="col-md-12 font-weight-bold"> Date </label>
                    <input type="text" name="date" id="" class="form-control mx-2 date" placeholder=""
                        aria-describedby="helpId">
                </div>

                <div class="form-group  ">
                    <label for="" class="col-md-12 font-weight-bold"> Progress Claim </label>
                    <select name="claim_no" class="form-control" id="progress_claim_id">
                        <option value="">Select One</option>
                    </select>
                </div>


                <div class="col-md-12 ">
                    <div class="row">
                        <h2 class="col-md-10">Working Status</h2>
                        {{-- <a role="button" class="col-md-2"><button type="button" class="btn  btn-primary btn-sm btn-icon"><i class="fa fa-plus"></i></button></a> --}}
                    </div>
                    <div id="progress_claim_container">


                    </div>
                    <div class="row my-3 px-2">
                        <div class="col-md-3 d-flex justify-start">
                            <label for="" style="width: 250px">Total Amount</label>
                            <input type="text" class="form-control text-danger" id="total_amount" readonly
                                name="total_amount">
                        </div>
                        <div class="col-md-3 d-flex justify-start">
                            <label for="" style="width: 250px">Current Amount</label>
                            <input type="text" class="form-control text-danger" value="" id="current_payment"
                                readonly name="current_payment">
                        </div>

                        <div class="col-md-3 d-flex justify-start">
                            <label for="" style="width: 250px">Total Payment</label>
                            <input type="text" class="form-control text-danger" id="total_payment" readonly
                                name="total_payment">
                            <input type="hidden" class="form-control text-danger" id="tp">
                        </div>

                        <div class="col-md-3 d-flex justify-start">
                            <label for="" style="width: 250px">Total Due</label>
                            <input type="text" class="form-control text-danger" id="total_due" readonly name="total_due">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group  mx-4 px-3 ">
                <button type="submit" class="btn btn-sm btn-primary mx-2 ">Save </button>
            </div>
        </form>


    </div>
@endsection

@push('js')
    <script src="{{ asset('js/flatpickr.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.min.css') }}"></script>

    <script>
        $(".date").flatpickr();
    </script>

    <script>
        // set amount value 
        $(document).ready(function() {
            $(".qty").on('keyup', function() {
                let qty = $(".qty").val();
                let rate = $(this).closest('.row').find('.rate').val();
                if (rate && qty) {
                    let amount = $(this).closest('.row').find('.amount').val(parseInt(qty) * parseInt(
                        rate));
                }
            })
            $(".rate").on('keyup', function() {
                let qty = $(".qty").val();
                let rate = $(this).closest('.row').find('.rate').val();
                if (rate && qty) {
                    let amount = $(this).closest('.row').find('.amount').val(parseInt(qty) * parseInt(
                        rate));
                }
            })
        })

        function setAmount(data) {
            let rate = $(data).closest('.row').find('.rate').val();
            let qty = $(data).closest('.row').find('.qty').val();
            if (rate && qty) {
                let amount = $(data).closest('.row').find('.amount').val(parseInt(rate) * parseInt(qty));
            }

        }

        // get title 
        $(document).ready(function() {
            $("#company_id").on('change', function() {
                let id = $("#company_id :selected").val();
                $.ajax({
                    url: "/get-title-by-compnay",
                    method: "GET",
                    data: {
                        id: id
                    },
                    success: function(res) {
                        let company = res.company;
                        $("input[name=tel]").val(company.tel);
                        $("input[name=fax]").val(company.fax);
                        $("input[name=attention]").val(company.attention);
                        let titleContainer = $("select[name=title]");
                        let titleContent = `<option value=''>Select One</option>`;
                        let titles = res.titles;
                        titles.forEach(title => {
                            titleContent +=
                                `<option value="${title.id}">${title.title}</option>`
                        })
                        titleContainer.html(titleContent)
                    }
                });
            })
        })

        // get invoice 
        $(document).ready(function() {
            $("#title").on('change', function() {
                let title = $(this).val();
                $.ajax({
                    url: "/get-progress-claim",
                    method: "GET",
                    data: {
                        title: title
                    },
                    success: function(res) {
                        let progressClaimContainer = $("#progress_claim_id");
                        let progressClaimContent = `<option value=''>Select One</option>`;
                        res.forEach(progressClaim => {
                            progressClaimContent +=
                                `<option value="${progressClaim.claim_no}">${progressClaim.claim_no}</option>`
                        })
                        progressClaimContainer.html(progressClaimContent)
                    }
                });
            })
        })

        // get working status description 
        $(document).ready(function() {
            $("#progress_claim_id").on('change', function() {
                let claim_no = $("#progress_claim_id :selected").val();
                let company_id = $("#company_id :selected").val();
                $.ajax({
                    url: "/get-description-by-progress-claim",
                    method: "GET",
                    data: {
                        claim_no: claim_no,
                        company_id: company_id,
                    },
                    success: function(res) {
                        console.log(res)
                        let container = $("#progress_claim_container");
                        let textContainer = '';
                        let total_amount = 0;
                        let total_due = 0;
                        let product_description_title = null;
                        let layer_title = null;
                        res.progress_descriptions.forEach(product => {
                            if (product_description_title !== product
                                .product_description_title) {
                                layer_title = product.product_description_title;
                                product_description_title = product
                                    .product_description_title;
                            } else {
                                layer_title = null;
                            }
                            total_amount += parseFloat(product.contact_sum);
                            total_due += parseFloat(product.amount_due);
                            textContainer += `
                            <h4 class='mt-3'>${layer_title?layer_title:''}</h4>

                              <div class="row">
                                <input type="hidden" name="product_description_title[]" value="${product.product_description_title}">

                                  <div class="col-md-3">
                                      <div class="form-group">
                                          <label for="" class="px-2">Description</label>
                                          <input type="text" readonly name="description[]" id="" class="form-control mx-2 "
                                              placeholder="" value="${product.description}" aria-describedby="helpId">
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                      <div class="form-group">
                                          <label for="" class="px-2">Contact Sum</label>
                                          <input type="text" readonly name="contact_sum[]" id="" class="form-control mx-2 contact_sum"
                                              placeholder="" value="${product.contact_sum}" aria-describedby="helpId">
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                      <div class="form-group">
                                          <label for="" class="px-2">Work Done (%)</label>
                                          <input type="text" readonly name="work_done[]" value="${product.work_done}" onkeyup="setAmountDue(this)" id="work_done" class="form-control mx-2 work_done "
                                              placeholder="" aria-describedby="helpId">
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                      <div class="form-group">
                                          <label for="" class="px-2">Amount Due</label>
                                          <input type="text" readonly name="amount_due[]" id="amount_due" class="form-control mx-2 amount_due "
                                              placeholder="" value="${product.amount_due}" aria-describedby="helpId">
                                      </div>
                                  </div>

                              </div>
                          `
                        })
                        $("#total_amount").val(total_amount);
                        $("#total_due").val(total_due.toFixed(2));
                        $("#total_payment").val((total_amount - total_due).toFixed(2));
                        $("#current_payment").val(res.progress_claim.current_payment);

                        container.html(textContainer);

                        let tpVal = total_amount - total_due;
                        if (isNaN(tpVal)) {
                            $("#tp").val(0);
                        } else {
                            $("#tp").val(tpVal);
                        }

                    }
                });
            })
        })


        // function setAmountDue(data) {
        //     let work_done = $(data).closest('.row').find('.work_done').val();
        //     // alert(work_done)
        //     let contact_sum = $(data).closest('.row').find('.contact_sum').val();
        //     let amount = $(data).closest('.row').find('.contact_sum').val();
        //      let fractionVal =  work_done / 100;
        //      let floatVal = fractionVal * contact_sum;

        //     let amount_due = amount - floatVal;
        //     if (amount_due) {
        //          $(data).closest('.row').find('.amount_due').val(amount_due.toFixed(2));
        //     }
        // }
        function setAmountDue(data) {
            let work_done = $(data).closest('.row').find('.work_done').val();
            let contact_sum = $(data).closest('.row').find('.contact_sum').val();
            let amount = $(data).closest('.row').find('.contact_sum').val();
            let fractionVal = work_done / 100;
            let floatVal = fractionVal * contact_sum;
            
            let amount_due = amount - floatVal;
            
            if (amount_due ==0) {
                $(data).closest('.row').find('.amount_due').val('0');
            }else{
                $(data).closest('.row').find('.amount_due').val(amount_due.toFixed(2));
            }

            let all_dues = $('.amount_due');
            let total_due = 0;
            for (let item of all_dues) {
                total_due += parseFloat(item.value);
            }
            $("#total_due").val(total_due.toFixed(2));
            let total_amount = $("#total_amount").val();
            let current_total_due = $("#total_due").val();
            let total_payment = total_amount - current_total_due;
            $("#total_payment").val(total_payment.toFixed(2));

            let tp = $("#tp").val();

            let installation = total_payment - tp;
            $("#current_payment").val(installation.toFixed(2));


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

        .amount,
        .tel,
        .fax,
        .attention {
            background-color: #d5caca !important;
        }
    </style>
@endpush
