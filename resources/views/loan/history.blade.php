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
                <a href="{{ route('loan.index') }}"><button class="btn btn-primary btn-sm"> <i
                            class="fa fa-forward"></i></button></a>
            </p>
        </div>

        <div style="width: 100%;overflow:scroll">
            <table class="table table-striped table-hover table-responsive">
                <thead>
                    <th class="custom_width">SL</th>
                    <th class="custom_width"> Paid By  </th>
                    <th class="custom_width"> Paid To   </th>
                    <th class="custom_width"> Paid Amount </th>
                    <th class="custom_width"> Cheque/Cash </th>

                    <th class="custom_width">Paid Date </th>

                </thead>
                <tbody id="tbody">
                  @foreach ($histories as $history)
                      <tr>
                        <td>{{$loop->iteration??''}}</td>
                        <td>{{$history->name??''}}</td>
                        <td>{{$history->loan->name??''}}</td>
                        <td>{{$history->amount??''}}</td>
                        <td>
                         @if ($history->check_or_cash =='Check')
                             Cheque
                        @else     
                          Cash
                         @endif    
                        </td>
                        <td>{{$history->created_at?date('d/m/Y',strtotime($history->created_at)):''}}</td>
                      </tr>
                  @endforeach
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
