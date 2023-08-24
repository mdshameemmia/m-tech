@extends('layouts.master')
@section('body')
    <div class="row">
        <h1 class="col-md-10">Invoice </h1>
        <p class="col-md-2"><a href="{{ url('invoice/create') }}"><button class="btn btn-primary btn-sm"> <i
                        class="fa fa-plus"></i></button></a></p>
        <div style="width: 100%;overflow:scroll;height:500px">

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th rowspan="2" class="first">SL</th>
                        <th class="custom_width" rowspan="2">Company Name </th>
                        <th class="custom_width" rowspan="2">tel </th>
                        <th class="custom_width" rowspan="2">fax </th>
                        <th class="custom_width" rowspan="2">Invoice No </th>
                        <th class="custom_width" rowspan="2">Amount  </th>
                        {{-- <th class="custom_width">Description</th>
                        <th class="custom_width">Contact Sum</th>
                        <th class="custom_width">Payment Done</th>
                        <th class="custom_width">Amount Due</th>
                        <th class="custom_width">Progress Claim Date</th> --}}
                        <th class="custom_width" rowspan="2">Action </th>
                    </tr>
                </thead>
                <tbody id="tbody">
                  
                    @foreach ($invoices as $key => $invoice)
                        <tr class="">
                            <td>{{ $loop->iteration }}</td>
                            <td class="custom_width">{{ $invoice->company->name ?? '' }}</td>
                            <td class="custom_width">{{ $invoice->company->tel ?? '' }}</td>
                            <td class="custom_width">{{ $invoice->company->fax ?? '' }}</td>
                            <td class="custom_width">{{ $invoice->invoice_no ?? '' }}</td>
                            <td class="custom_width">{{ $invoice->progressClaim->current_payment ?round($invoice->progressClaim->current_payment,2):null }}</td>
                            {{-- <td class="custom_width " colspan="5">
                                @foreach ($invoice->invoiceDetails as $ivc)
                                    <div style="width: 100%;display:flex;">
                                        <div style="width: 20%">
                                            {{ $ivc->description}}
                                        </div>
                                        <div style="width: 20%;padding-left:15px">
                                            {{ $ivc->contact_sum }}
                                        </div>
                                        <div style="width: 20%">
                                            {{$ivc->contact_sum - $ivc->amount_due }}
                                        </div>
                                        <div style="width: 20%">
                                            {{ number_format((float) $ivc->amount_due, 2, '.', '') }}
                                        </div>
                                        <div style="width: 20%">
                                            {{ $ivc->created_at ? date('d M, Y', strtotime($ivc->created_at)) : null }}
                                        </div>
                                    </div>
                                    @if (!$loop->last)
                                        <hr>
                                    @endif
                                @endforeach
                            </td> --}}
                            <td class="custom_width">
                                {{-- <a href="{{route('vendors.edit',$invoice->id)}}"><i class="fa fa-edit text-info"></i></a> --}}
                                
                                        @if (\App\Models\PaymentReceive::where('invoice',$invoice->invoice_no)->count() == '0')
                                        <a href="{{ route('invoice.delete', $invoice->id) }}"
                                            onclick="return confirm('Are you sure to delete ?')"><i
                                                class="fa fa-trash text-danger"></i></a>
                                        @endif 
                                <a href="{{ route('invoice.download', $invoice->id) }}" target="_blank"
                                    tooltip="Test" class="text-info"><i class="fa fa-file"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

                
            </table>
        </div>
    </div>
@endsection
@push('js')
    <script></script>
@endpush
@push('css')
<style>
    .form-control {
        background-color: #fff !important;
    }

    .custom_width {
        width: 160px !important;
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

     .first{
        width: 50px !important;
    }

</style>
@endpush
