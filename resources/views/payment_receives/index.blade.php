@extends('layouts.master')
@section('body')
    <div class="row">



        <div class="row col-md-12 d-flex justify-content-between my-2">
            <h1>Payment Received </h1>
            <form action="{{ route('payment-report.download') }}" class="d-flex" method="POST">
                @csrf
                <input type="text" class="date form-control mx-1" name="start_date" placeholder="Start date">
                <input type="text" class="date form-control mx-1" name="end_date" placeholder="End date">
                <input class="btn btn-primary btn-sm form-control" value="Report Download" type="submit">
            </form>
            <p class="col-md-2">
                <a href="{{ route('payment_receives.create') }}"><button class="btn btn-primary btn-sm"> <i
                            class="fa fa-plus"></i></button></a>
            </p>
        </div>

        <div style="width: 100%;overflow:scroll">
            <table class="table table-striped table-hover table-responsive">
                <thead>
                    <th class="custom_width">SL</th>
                    <th class="custom_width"> Date </th>
                    <th class="custom_width">Company Name </th>
                    <th class="custom_width">Project Name</th>
                    <th class="custom_width">Invoice </th>
                    <th class="custom_width"> Cheque/Cash </th>
                    <th class="custom_width"> Total Cash Amount </th>
                    <th class="custom_width"> Total Cheque Amount </th>
                    <th class="custom_width"> Amount</th>
                    <th class="custom_width">Action </th>
                </thead>
                <tbody id="tbody">
                    @forelse ($payment_receives as $key=>$payment_receive)
                        <tr>
                            <td class="custom_width">{{ $key + 1 }}</td>
                            <td class="custom_width">
                                {{ $payment_receive->date ? date('d M, Y', strtotime($payment_receive->date)) : '' }}</td>
                            <td class="custom_width">{{ $payment_receive->company->name ?? '' }}</td>
                            {{-- <td class="custom_width">{{ $payment_receive->project->title ?? '' }}</td> --}}
                            <td class="custom_width">
                                <span data-toggle="tooltip" data-placement="top" title="{{$payment_receive->project->title??''}}">
                                    {{$payment_receive->project->title ? substr($payment_receive->project->title, 0, 10) : ''}}
                                </span>
                            </td>
                            <td class="custom_width">{{ $payment_receive->invoice ?? '' }}</td>
                            <td class="custom_width">
                                @if ($payment_receive->check_or_cash == 'Check')
                                    Cheque
                                @else   
                                 Cash
                                @endif
                            </td>
                            <td class="custom_width">{{ $payment_receive->total_cash_amount ?round($payment_receive->total_cash_amount,2):null }}</td>
                            <td class="custom_width">{{ $payment_receive->total_check_amount ?round($payment_receive->total_check_amount,2):null }}</td>
                            <td class="custom_width">{{ $payment_receive->amount ?round($payment_receive->amount,2):null }}</td>
                            <td>
                                <a href="{{ route('payment_receives.edit', $payment_receive->id) }}"><i
                                        class="fa fa-edit text-info"></i></a>
                                <a href="{{ route('payment_receives.delete', $payment_receive->id) }}"
                                    onclick="return confirm('Are you sure to delete ?')"><i
                                        class="fa fa-trash text-danger"></i></a>

                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>

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
        /* .form-control {
            background-color: #fff !important;
        } */

        .custom_width {
            width: 200px !important;
            height: 20px !important;
        }

        .table td,
        .table th {
            padding: 5px 10px !important;
        }

        table {
            table-layout: fixed;
            word-wrap: break-word;
        }
    </style>
@endpush
