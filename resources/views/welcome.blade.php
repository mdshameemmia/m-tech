@extends('layouts.master')
@section('body')
    <div class="row my-3">
        <div class="col-md-3">
            <div class="card text-left m-0 p-0">
                <div class="card-body d-flex justify-content-between" style="background-color: rgb(200, 150, 150)">
                    <div>
                        <h4 class="card-title">Employee</h4>
                        <p class="card-text">
                            {{ \App\Models\Employee::count() }}
                        </p>
                    </div>
                    <div>
                        <i class="fa fa-users fa-2x text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-left m-0 p-0">
                <div class="card-body  d-flex justify-content-between" style="background-color: rgb(198, 225, 225)">
                    <div>
                        <h4 class="card-title">Company</h4>
                        <p class="card-text">
                            {{ \App\Models\Company::count() }}
                        </p>
                    </div>
                    <div>
                        <i class="fa fa-building fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-left m-0 p-0">
                <div class="card-body  d-flex justify-content-between" style="background-color: pink">
                    <div>
                        <h4 class="card-title">Projects</h4>
                        <p class="card-text">
                            {{ \App\Models\Project::count() }}
                        </p>
                    </div>
                    <div>
                        <i class="fa-solid fa-diagram-project fa-2x"></i>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-left m-0 p-0">
                <div class="card-body  d-flex justify-content-between" style="background-color:rgb(191, 230, 188)">
                    <div>
                        <h4 class="card-title">Remain Amount</h4>
                        <p class="card-text" style="font-size: 12px;color:#000">
                            Cheque :
                            {{ \App\Models\PaymentReceive::orderBy('id', 'DESC')->where('check_or_cash','Check')->pluck('total_check_amount')->first() ?round(\App\Models\PaymentReceive::orderBy('id', 'DESC')->where('check_or_cash','Check')->pluck('total_check_amount')->first(),2): '0' }};

                            Cash :
                            {{ \App\Models\PaymentReceive::orderBy('id', 'DESC')->where('check_or_cash','Cash')->pluck('total_cash_amount')->first() ?round(\App\Models\PaymentReceive::orderBy('id', 'DESC')->where('check_or_cash','Cash')->pluck('total_cash_amount')->first() ,2):'0' }}
                        </p>
                    </div>
                    <div>
                        <i class="fa fa-dollar fa-2x font-weight-bold"></i>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <div class="row my-3">
        <div class="col-md-3" >
            <a href="{{ route('vendors.index') }}" style="color: #fff">
                <div class="card text-left m-0 p-0" style="background-color: rgb(177, 91, 177)">
                    <div class="card-body  d-flex justify-content-between">
                        <div>
                            <h4 class="card-title">Quotations</h4>
                            <p></p>
                        </div>
                        <div>
                            <i class="fa-solid fa-diagram-project fa-2x"></i>

                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('progress-claim.index') }}">
                <div class="card text-left m-0 p-0">
                    <div class="card-body  d-flex justify-content-between" style="background-color: darkcyan;color:#fff">
                        <div>
                            <h4 class="card-title">Progress Claims</h4>
                            <p></p>
                        </div>
                        <div>
                            <i class="fa-solid fa-diagram-project fa-2x"></i>

                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('invoice.index') }}">
                <div class="card text-left m-0 p-0">
                    <div class="card-body  d-flex justify-content-between" style="background-color:darkkhaki;color:#fff">
                        <div>
                            <h4 class="card-title">Invoices</h4>
                            <p></p>
                        </div>
                        <div>
                            <i class="fa-solid fa-diagram-project fa-2x"></i>

                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('sub_contact_costs.index') }}">
                <div class="card text-left m-0 p-0">
                    <div class="card-body  d-flex justify-content-between" style="background-color: darkorchid;color:#fff">
                        <div>
                            <h4 class="card-title">Sub Contract Cost</h4>
                            <p></p>
                        </div>
                        <div>
                            <i class="fa-solid  fa-dollar fa-2x"></i>

                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row my-3">
        <div class="col-md-3">
            <a href="{{ route('official_or_other_costs.index') }}">
                <div class="card text-left m-0 p-0">
                    <div class="card-body  d-flex justify-content-between" style="background-color:darkseagreen;color:#fff">
                        <div>
                            <h4 class="card-title">Other Cost</h4>
                            <p></p>
                        </div>
                        <div>
                            <i class="fa-solid fa-dollar fa-2x"></i>

                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('material_costs.index') }}">
                <div class="card text-left m-0 p-0">
                    <div class="card-body  d-flex justify-content-between" style="background-color: darksalmon;color:#fff">
                        <div>
                            <h4 class="card-title">Material Cost</h4>
                            <p></p>
                        </div>
                        <div>
                            <i class="fa-solid fa-dollar fa-2x"></i>

                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('staff_cpfs.index') }}">
                <div class="card text-left m-0 p-0">
                    <div class="card-body  d-flex justify-content-between" style="background-color: darkmagenta;color:#fff">
                        <div>
                            <h4 class="card-title">Staff Salary </h4>
                            <p></p>
                        </div>
                        <div>
                            <i class="fa-solid fa-dollar fa-2x"></i>

                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('salary-vouchar.index') }}">
                <div class="card text-left m-0 p-0">
                    <div class="card-body  d-flex justify-content-between" style="background-color: darkolivegreen;color:#fff">
                        <div>
                            <h4 class="card-title">Salary Vouchar </h4>
                            <p></p>
                        </div>
                        <div>
                            <i class="fa-solid  fa-dollar fa-2x"></i>

                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .card {
            box-shadow: 1px 1px 8px;
            height: 120px;
            /* background-color: white */
            /* color: white; */
        }
    </style>
@endpush
