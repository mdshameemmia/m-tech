@extends('layouts.master')
@section('body')
    <div class="row card m-auto" style="background-color:rgb(247, 238, 238)">

        <div class="row m-3">
            <h1 class="col-md-11">Levy Cost</h1>
            <p class="col-md-1"><a href="{{ route('sub_contact_costs.index') }}"><button class="btn btn-primary btn-sm"> Back
                    </button></a></p>

        </div>
        <form action="{{ route('sub_contact_costs.update', $sub_contact_cost->id) }}" method="POST">
            @csrf
            <div class="form-group row mx-4 ">
                <label for="" class="col-md-12 font-weight-bold">Date</label>
                <input type="text" name="date" id="" class="form-control col-md-5 mx-2 date "
                    value="{{ $sub_contact_cost->date ?? '' }}" placeholder="" aria-describedby="helpId">
            </div>
            <div class="form-group row mx-4 ">
                <label for="" class="col-md-12 font-weight-bold">Compnay Name </label>
                <input type="text" name="company_name" id="" class="form-control col-md-5 mx-2 "
                    value="{{ $sub_contact_cost->company_name ?? '' }}" placeholder="" aria-describedby="helpId">
            </div>
            <div class="form-group row mx-4 ">
                <label for="" class="col-md-12 font-weight-bold">Site Name </label>
                <input type="text" name="site_name" id="" class="form-control col-md-5 mx-2 "
                    value="{{ $sub_contact_cost->site_name ?? '' }}" placeholder="" aria-describedby="helpId">
            </div>
            <div class="form-group row mx-4 ">
                <div class="col-md-12">
                    <label for="" class="mr-2">Amount Type</label>
                    <label for="" class="mx-1">Check</label>
                    <span>
                        <input type="radio" @if ($sub_contact_cost->check_or_cash == 'Check') checked @endif value="Check"
                            name="check_or_cash">
                    </span>
                    <label for="" class="mx-1">Cash</label>
                    <input type="radio" @if ($sub_contact_cost->check_or_cash == 'Cash') checked @endif name="check_or_cash"
                        value="Cash">
                </div>
            </div>
            <div class="form-group row mx-4 ">
                <label for="" class="col-md-12 font-weight-bold">Amount </label>
                <input type="text" name="amount" value="{{ $sub_contact_cost->amount ?? '' }}" id=""
                    class="form-control col-md-5 mx-2 " placeholder="" aria-describedby="helpId">
            </div>
            <div class="form-group row mx-4 ">
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
