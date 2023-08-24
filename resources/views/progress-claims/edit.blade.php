@extends('layouts.master')
@section('body')
    <div class="row card" style="background-color:rgb(247, 238, 238)">
        <div class="row m-2 px-3">
            <h1 class="col-md-11">Progress Claim </h1>
            <p class="col-md-1"><a href="{{ route('progress-claim.index') }}"><button class="btn btn-primary btn-sm"> Back
                    </button></a></p>
        </div>
        <form action="{{ route('progress-claim.update', $progress_claim->id) }}" method="POST" class="row">
            @csrf
            <div class="col-md-12 px-5">
                <div class="form-group  ">
                    <label for="" class="col-md-12 font-weight-bold">Company Name </label>
                    <select name="company_id" class="form-control mx-2" id="company_id">
                        <option value="">Select One</option>
                        @foreach ($companies as $company)
                            <option @if ($progress_claim->company_id == $company->id) selected @endif value="{{ $company->id ?? '' }}">
                                {{ $company->name ?? '' }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group  ">
                    <label for="" class="col-md-12 font-weight-bold">Title</label>
                    <select name="project_id" class="form-control mx-2" id="">
                        <option value="">Select One</option>
                        <option selected value="{{ $progress_claim->project->id }}">
                            {{ $progress_claim->project->title ?? '' }}</option>
                    </select>
                </div>

                <div class="form-group  ">
                    <label for="" class="col-md-12 font-weight-bold">Telephone </label>
                    <input type="text" name="tel" id="" value="{{ $progress_claim->tel ?? '' }}"
                        class="form-control mx-2 tel" readonly placeholder="" aria-describedby="helpId">
                </div>
                <div class="form-group  ">
                    <label for="" class="col-md-12 font-weight-bold">Fax </label>
                    <input type="text" name="fax" id="" value="{{ $progress_claim->fax ?? '' }}"
                        class="form-control mx-2 fax" readonly placeholder="" aria-describedby="helpId">
                </div>

                <div class="form-group  ">
                    <label for="" class="col-md-12 font-weight-bold">Attention </label>
                    <input type="text" name="attention" id="" value="{{ $progress_claim->attention ?? '' }}"
                        class="form-control mx-2 attention " readonly placeholder="" aria-describedby="helpId">
                </div>

                <div class="form-group  ">
                    <label for="" class="col-md-12 font-weight-bold"> Date </label>
                    <input type="text" name="date" id="" value="{{ $progress_claim->date ?? '' }}"
                        class="form-control mx-2 date" placeholder="" aria-describedby="helpId">
                </div>

                <div class="form-group  ">
                    <label for="" class="col-md-12 font-weight-bold"> Quotation </label>
                    <select name="quotation_id" class="form-control" id="quotation_id">
                        <option value="">Select One</option>
                        @foreach ($quotations as $quotation)
                            <option @if ($progress_claim->quotation->quotation == $quotation->quotation) selected @endif value="{{ $quotation->id ?? '' }}">
                                {{ $quotation->quotation ?? '' }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- @dd($progress_claim->progressDescription) --}}
                <div class="col-md-12 ">
                    <div class="row">
                        <h2 class="col-md-10">Working Percentages</h2>
                        {{-- <a role="button" class="col-md-2"><button type="button" class="btn  btn-primary btn-sm btn-icon"><i class="fa fa-plus"></i></button></a> --}}
                    </div>
                    <div id="progress_claim_container">
                        @php
                            $total_amount = 0;
                            $total_due = 0;
                            $product_description_title = null;
                            $layer_title = null;
                        @endphp
                        @foreach ($progress_claim->progressDescription as $item)
                            @php
                                if ($product_description_title !== $item->product_description_title) {
                                    $layer_title = $item->product_description_title;
                                    $product_description_title = $item->product_description_title;
                                } else {
                                    $layer_title = null;
                                }
                                $total_amount = $total_amount + $item->contact_sum;
                                $total_due = $total_due + $item->amount_due;
                            @endphp
                            @if ($layer_title)
                                <h5 class="mt-4 mx-2 text-success">{{ $layer_title ?? '' }}</h5>
                            @endif
                            <div class="row">
                                <input type="hidden" name="product_description_title[]"
                                    value="{{ $item->product_description_title ?? '' }}">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="" class="px-2">Description</label>
                                        <input type="text" readonly name="description[]" id=""
                                            class="form-control mx-2 " placeholder=""
                                            value="{{ $item->description ?? '' }}" aria-describedby="helpId">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="" class="px-2">Contact Sum</label>
                                        <input type="text" readonly name="contact_sum[]" id=""
                                            class="form-control mx-2 contact_sum" placeholder=""
                                            value="{{ $item->contact_sum ?? '' }}" aria-describedby="helpId">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="" class="px-2">Work Done (%{{ $item->work_done }})</label>
                                        <input type="text" value="{{ $item->work_done ?? '' }}" name="work_done[]"
                                            onkeyup="setAmountDue(this)" id="work_done"
                                            class="form-control mx-2 work_done " placeholder=""
                                            aria-describedby="helpId">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="" class="px-2">Amount Due</label>
                                        <input type="text" readonly name="amount_due[]" id="amount_due"
                                            class="form-control mx-2 amount_due " placeholder=""
                                            value="{{ $item->amount_due ?? '' }}" aria-describedby="helpId">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="row my-3 px-2">
                            <div style="width: 130px;padding:2px 5px">Total Amount </div>
                            <div style="width: 130px;padding:2px 5px">
                                <input type="text" class="form-control text-danger" id="total_amount" readonly
                                    name="total_amount" value="{{ $total_amount ?? '' }}">
                            </div>
                            <div style="width: 130px;padding:2px 5px">Total Payment </div>
                            <div style="width: 130px;padding:2px 5px">
                                <input type="text" class="form-control text-danger" id="total_payment" readonly
                                    name="total_payment" value="{{ $total_amount - $total_due }}">
                                <input type="hidden" id="old_total_payment"
                                    value="{{ $total_amount - $total_due }}">
                                <input type="hidden" id="old_current_payment"
                                    value="{{ $progress_claim->current_payment }}">
                            </div>
                            <div style="width: 130px;padding:2px 5px">Current Amount</div>
                            <div style="width: 130px;padding:2px 5px">
                                <input type="text" class="form-control text-danger"
                                    value="{{ $progress_claim->current_payment ?? '' }}" id="current_payment" readonly
                                    name="current_payment">
                            </div>
                            <div style="width: 130px;padding:2px 5px">Total Due</div>
                            <div style="width: 130px;padding:2px 5px">
                                <input type="text" class="form-control text-danger " id="total_due" readonly
                                    name="total_due" value="{{ $total_due ?? '' }}">
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <div class="form-group  mx-4 px-4 ">
                <button type="submit" class="btn btn-sm btn-primary mx-2 ">Update </button>
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
                                `<option value="${title.title}">${title.title}</option>`
                        })
                        titleContainer.html(titleContent)
                    }
                });
            })
        })

        // get working status description 
        $(document).ready(function() {
            $("#quotation_id").on('change', function() {
                let quotation_id = $("#quotation_id :selected").val();
                let company_id = $("#company_id :selected").val();
                $.ajax({
                    url: "/get-description-by-quotation",
                    method: "GET",
                    data: {
                        quotation_id: quotation_id,
                        company_id: company_id,
                    },
                    success: function(res) {
                        console.log(res)
                        let container = $("#progress_claim_container");
                        let textContainer = '';
                        let layer_title = null;
                        let product_description_title = null;
                        res.forEach(product => {
                            // console.log(product)
                            if (product_description_title !== product
                                .product_description_title) {
                                layer_title = product.product_description_title;
                                product_description_title = product
                                    .product_description_title;
                            } else {
                                layer_title = null;
                            }

                            textContainer += `
                            <h4 class='mt-3'>${layer_title?layer_title:''}</h4>
                              <div class="row">

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
                                          <label for="" class="px-2">Work Done (%${product.work_done??0})</label>
                                          <input type="text" required name="work_done[]" onkeyup="setAmountDue(this)" id="work_done" class="form-control mx-2 work_done "
                                              placeholder="" aria-describedby="helpId">
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                      <div class="form-group">
                                          <label for="" class="px-2">Amount Due</label>
                                          <input type="text" readonly name="amount_due[]" id="amount_due" class="form-control mx-2 amount_due "
                                              placeholder="" value="${product.amount_due??product.contact_sum}" aria-describedby="helpId">
                                      </div>
                                  </div>

                              </div>
                          `
                        })
                        container.html(textContainer);

                    }
                });
            })
        })


        function setAmountDue(data) {
            let work_done = $(data).closest('.row').find('.work_done').val();
            let contact_sum = $(data).closest('.row').find('.contact_sum').val();
            let amount = $(data).closest('.row').find('.contact_sum').val();
            let fractionVal = work_done / 100;
            let floatVal = fractionVal * contact_sum;

            let amount_due = amount - floatVal;
            if (amount_due) {
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
            $("#total_payment").val(total_payment);

            let old_total_payment = $("#old_total_payment").val();
            let old_current_payment = $("#old_current_payment").val();

            
            let update_current_payment = old_total_payment - total_payment;
            let subtract_val = old_current_payment- update_current_payment;
            $("#current_payment").val(subtract_val);

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
