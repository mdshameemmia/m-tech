@extends('layouts.master')
@section('body')
    <div class="row">



        <div class="row col-md-12 d-flex justify-content-between my-2">
            <h1>Loan </h1>
            {{-- <form action="{{ route('payment-report.download') }}" class="d-flex" method="POST">
                @csrf
                <input type="text" class="date form-control mx-1" name="start_date" placeholder="Start date">
                <input type="text" class="date form-control mx-1" name="end_date" placeholder="End date">
                <input class="btn btn-primary btn-sm form-control" value="Report Download" type="submit">
            </form> --}}
            <p></p>
            <p class="col-md-2">
                <a href="{{ route('loan.create') }}"><button class="btn btn-primary btn-sm"> <i
                            class="fa fa-plus"></i></button></a>
            </p>
        </div>

        <div style="width: 100%;overflow:scroll">
            <table class="table table-striped table-hover table-responsive">
                <thead>
                    <th class="custom_width">SL</th>
                    <th class="custom_width"> Name </th>
                    <th class="custom_width"> Mobile  </th>
                    <th class="custom_width"> Amount </th>
                    <th class="custom_width"> Cheque/Cash </th>
                    <th class="custom_width"> Date </th>
                    <th class="custom_width">Action </th>
                </thead>
                <tbody id="tbody">
                    @forelse ($loans as $key=>$loan)
                        <tr>
                            <td class="custom_width">{{ $key + 1 }}</td>
                            <td class="custom_width">{{ $loan->name ?? '' }}</td>
                            <td class="custom_width">{{ $loan->mobile ?? '' }}</td>
                            <td class="custom_width">
                               @if ($loan->amount == 0 || $loan->amount== null)
                                   Paid
                                @else 
                                {{ $loan->amount ?? '' }}
                               @endif
                            </td>
                            <td class="custom_width">
                             @if ($loan->check_or_cash =='Check')
                                 Cheque
                            @elseif($loan->check_or_cash =='Cash')
                            {{$loan->check_or_cash??""}}
                             @endif    
                            </td>
                            <td class="custom_width">{{ $loan->date ? date('d M, Y', strtotime($loan->date)) : '' }}</td>
                            <td>
                                
                                @if ($loan->amount != 0)
                                <a href="{{ route('loan.edit', $loan->id) }}">
                                    <button class="btn btn-info btn-sm m-1"><i
                                        class="fa fa-edit"></i></button>
                                </a>
                                @endif
                               
                                {{-- <a href="{{ route('loan.delete', $loan->id) }}"
                                    onclick="return confirm('Are you sure to delete ?')"><i
                                        class="fa fa-trash text-danger"></i></a> --}}

                                <a href="{{url('loan/history',$loan->id)}}">
                                    <button class="btn btn-info btn-sm m-1"><i class="fa fa-eye"></i> </button>
                                </a>
                                @if ($loan->amount != 0)
                                <a href="{{url('loan/paid',$loan->id)}}">
                                   <button class="btn btn-primary m-1"><i class="fa fa-dollar"></i></button>
                                </a>
                                @endif
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
