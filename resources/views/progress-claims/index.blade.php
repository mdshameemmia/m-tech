@extends('layouts.master')
@section('body')
    <div class="row">
        <h2 class="col-md-10">Progress Claim List</h2>
        <p class="col-md-2"><a href="{{ url('progress-claim/create') }}"><button class="btn btn-primary btn-sm"> <i
                        class="fa fa-plus"></i></button></a></p>
        <div style="width: 100%;overflow:scroll;height:600px">


            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th style="width:50px" rowspan="2">SL</th>
                        <th class="custom_width" rowspan="2">Company Name </th>
                        {{-- <th class="custom_width" rowspan="2">tel </th>
                        <th class="custom_width" rowspan="2">fax </th> --}}
                        <th class="custom_width" rowspan="2">Title </th>
                        <th class="custom_width" rowspan="2">Progress Claim </th>
                        <th class="custom_width" rowspan="2">Total Amount </th>
                        <th class="custom_width" rowspan="2">Total  Pay </th>
                        <th class="custom_width" rowspan="2">Current  Pay </th>
                        <th class="custom_width" rowspan="2">Total  Due </th>
                        {{-- <th class="custom_width">Description</th>
                        <th class="custom_width">Contact Sum</th>
                        <th class="custom_width">Work Done(%)</th>
                        <th class="custom_width">Amount Due</th> --}}
                        {{-- <th class="custom_width">Progress Claim Date</th> --}}
                        <th style="width: 70px"  rowspan="2">Action </th>
                    </tr>
                </thead>

                <tbody id="tbody">
                  
                    @foreach ($progress_claims as $key => $progress_claim)
                   
                        <tr class="">
                            <td class="custom_width">{{ $loop->iteration }}</td>
                            <td class="custom_width">{{ $progress_claim->company->name ?? '' }}</td>
                            {{-- <td class="custom_width">{{ $progress_claim->tel ?? '' }}</td>
                            <td class="custom_width">{{ $progress_claim->fax ?? '' }}</td> --}}
                            <td>
                                <span data-toggle="tooltip" data-placement="top" title="{{$progress_claim->project->title??''}}">
                                    {{$progress_claim->project->title ? substr($progress_claim->project->title, 0, 10) : ''}}
                                </span>
                            </td>
                            <td class="custom_width">{{ $progress_claim->claim_no ?? '' }}</td>
                            <td class="custom_width">{{ $progress_claim->total_amount ?? '' }}</td>
                            <td class="custom_width">{{ $progress_claim->total_payment ?round($progress_claim->total_payment, 2):null }}</td>
                            <td class="custom_width">{{ $progress_claim->current_payment ?round($progress_claim->current_payment, 2):null }}</td>
                            <td class="custom_width">{{ $progress_claim->total_due ?round($progress_claim->total_due, 2):null }}</td>
                            {{-- <td class="custom_width" colspan="5">
                                @foreach ($progress_claim->progressDescription as $claim)
                                    <div style="width: 100%;display:flex;">
                                        <div style="width: 25%">
                                            {{ substr($claim->description,0,10) }}
                                        </div>
                                        <div style="width: 20%;">
                                            {{ $claim->contact_sum }}
                                        </div>
                                        <div style="width: 20%">
                                            {{ $claim->work_done }}
                                        </div>
                                        <div style="width: 20%">
                                            {{ number_format((float) $claim->amount_due, 2, '.', '') }}
                                        </div>
                                        <div style="width: 20%">
                                            {{ $progress_claim->date ? date('d M, Y', strtotime($progress_claim->date)) : null }}
                                        </div>
                                    </div>
                                    @if (!$loop->last)
                                        <hr>
                                    @endif
                                @endforeach
                            </td> --}}
                            <td>
                                <a href="{{route('progress_claim.edit',$progress_claim->id)}}" 
                                    @if ($progress_claim->is_invoice_create=='Yes')
                                        onclick="return alert('Already Invoice Created')"
                                    @endif
                                    ><i class="fa fa-edit text-info"></i></a>
                                 
                                    @if (\App\Models\Invoice::where('progress_claim_id',$progress_claim->id)->count() == '0')
                                    <a href="{{ route('progress_claim.delete', $progress_claim->id) }}"
                                        @if ($progress_claim->is_invoice_create=='Yes')
                                            onclick="return alert('Already Invoice Created')"
                                        @else 
                                        onclick="return confirm('Are you sure to delete ?')">
                                        @endif
                                        <i class="fa fa-trash text-danger" ></i></a>
                                    @endif 

                                <a href="{{ route('progress_claim.download', $progress_claim->id) }}" target="_blank"
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
        width: 150px !important;
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

    table td,th{
        font-size: 13px;
    }

</style>
@endpush
