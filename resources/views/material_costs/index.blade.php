@extends('layouts.master')
@section('body')
    <div class="row">

        <div class="row col-md-12 d-flex justify-content-between my-2">
            <h1>Material Cost</h1>
            <form action="{{ route('material-report.download') }}" class="d-flex" method="POST">
                @csrf
                <input type="text" class="date form-control mx-1" name="start_date" placeholder="Start date">
                <input type="text" class="date form-control mx-1" name="end_date" placeholder="End date">
                <input class="btn btn-primary btn-sm form-control" value="Report Download" type="submit">
            </form>
            <p class="col-md-2"><a href="{{ route('material_costs.create') }}"><button class="btn btn-primary btn-sm"> <i
                            class="fa fa-plus"></i></button></a></p>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <th>SL</th>
                <th>Date</th>
                <th>Company Name </th>
                <th>Description </th>
                <th>Amount</th>
                <th>Cash Memo</th>
                {{-- <th>Action </th> --}}
            </thead>
            <tbody id="tbody">
                @forelse ($material_costs as $key=>$material_cost)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $material_cost->date ? date('d M, Y', strtotime($material_cost->date)) : '' }}</td>
                        <td>{{ $material_cost->company_name ?? '' }}</td>
                        <td>{{ $material_cost->material ?? '' }}</td>
                        <td>{{ $material_cost->amount ?? '' }}</td>
                        <td>
                            @if ($material_cost->cash_memo_no)
                            <a href="{{url("memos/$material_cost->cash_memo_no")}}"  target="_blank"><i class="fa fa-file"></i></a>
                                
                            @endif
                        </td>
                        {{-- <td>
                            
                            <a href="{{ route('material_costs.delete', $material_cost->id) }}"
                                onclick="return confirm('Are you sure to delete ?')"><i
                                    class="fa fa-trash text-danger"></i></a>

                        </td> --}}
                    </tr>
                @empty
                @endforelse
            </tbody>
        </table>

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
        /* .form-control{
                background-color: #fff !important ;
            } */
    </style>
@endpush
