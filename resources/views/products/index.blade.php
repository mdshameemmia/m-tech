@extends('layouts.master')
@section('body')
    <div class="row">
        <h1 class="col-md-10">Product List</h1>
        <p class="col-md-2"><a href="{{ url('products/create') }}"><button class="btn btn-primary btn-sm"> <i
                        class="fa fa-plus"></i></button></a></p>
        <table class="table table-striped table-hover">
            <thead>
                <th>SL</th>
                <th>Name </th>
                {{-- <th>Price </th> --}}
                <th>Unit</th>
                <th>Description</th>
                <th>Action </th>
            </thead>
            <tbody id="tbody">
                @forelse ($products as $key=>$product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product->item_name ?? '' }}</td>
                        {{-- <td>{{ $product->item_price ?? '' }}</td> --}}
                        <td>{{ $product->unit ?? '' }}</td>
                        <td>{{ $product->description ?? '' }}</td>
                        <td>
                            <a href="{{ route('products.edit', $product->id) }}"><i class="fa fa-edit text-info"></i></a>
                            <a href="{{ route('products.delete', $product->id) }}"
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
