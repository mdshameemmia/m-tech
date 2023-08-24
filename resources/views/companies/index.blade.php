@extends('layouts.master')
@section('body')
    <div class="row">
        <h1 class="col-md-10">Company List</h1>
        <p class="col-md-2"><a href="{{ url('companies/create') }}"><button class="btn btn-primary btn-sm"> <i
                        class="fa fa-plus"></i></button></a></p>
        <table class="table table-striped table-hover">
            <thead>
                <th>SL</th>
                <th>Name </th>
                <th>Address </th>
                <th>Tel</th>
                <th>Fax</th>
                <th>Action </th>
            </thead>
            <tbody id="tbody">
                @forelse ($companies as $key=>$company)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $company->name ?? '' }}</td>
                        <td>{{ $company->address ?? '' }}</td>
                        <td>{{ $company->tel ?? '' }}</td>
                        <td>{{ $company->fax ?? '' }}</td>
                        <td>{{ $company->attention ?? '' }}</td>
                        <td>
                            <a href="{{ route('companies.edit', $company->id) }}"><i class="fa fa-edit text-info"></i></a>
                            <a href="{{ route('companies.delete', $company->id) }}"
                                onclick="return confirm('Are you sure to delete ?')"><i
                                    class="fa fa-trash text-danger"></i></a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No Record Available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
@endsection

@push('js')
    <script></script>
@endpush
