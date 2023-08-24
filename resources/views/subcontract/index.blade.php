@extends('layouts.master')
@section('body')
    <div class="row">

        <h1 class="col-md-10">Subcontractor Company </h1>
        <p class="col-md-2"><a href="{{ url('subcontract/create') }}"><button class="btn btn-primary btn-sm"> <i
                        class="fa fa-plus"></i></button></a></p>

        <table class="table table-striped table-hover">
            <thead>
                <th>SL</th>
                <th>Comany Name</th>
                <th> Name </th>
                <th>Mobile </th>
                <th>Passport </th>
                <th>Wokr Permit </th>
                <th>Action </th>
            </thead>
            <tbody id="tbody">
                @foreach ($subcontracts as $subcontract)
                    <tr>
                        <td>{{ $loop->iteration ?? '' }}</td>
                        <td>{{ $subcontract->company_name ?? '' }}</td>
                        <td>{{ $subcontract->name ?? '' }}</td>
                        <td>{{ $subcontract->mobile ?? '' }}</td>
                        <td>{{ $subcontract->passport ?? '' }}</td>
                        <td>{{ $subcontract->work_permit_no ?? '' }}</td>
                        <td>

                            <a href="{{ route('subcontract.edit', $subcontract->id) }}"><i
                                    class="fa fa-edit text-info"></i></a>
                            <a href="{{ route('subcontract.delete', $subcontract->id) }}"
                                onclick="return confirm('Are you sure to delete ?')"><i
                                    class="fa fa-trash text-danger"></i></a>


                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection

@push('js')
    <script></script>
@endpush
