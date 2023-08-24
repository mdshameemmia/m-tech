@extends('layouts.master')
@section('body')
    <div class="row p-3">
        <h1 class="col-md-10">Quotation Description</h1>
        <p class="col-md-2"><a href="{{ url('vendors/quotation-description/create',$id) }}"><button class="btn btn-primary btn-sm"> <i
                        class="fa fa-plus"></i></button></a></p>
        <table class="table table-striped table-hover">
            <thead>
                <th>SL</th>
                <th>Quotation Title  </th>
                <th>Quotation Layer  </th>
                <th>Product Title  </th>
                <th>Unit </th>
                <th>Rate </th>
                <th> Qty </th>
                <th> Amount </th>
                <th>Action </th>
            </thead>
            <tbody id="tbody">
                @foreach ($product_quotations as $key=> $product_quotation)
                
                    <tr>
                        <td>{{$loop->iteration??''}}</td>
                        <td> {{$quotation->title}}</td>
                        <td>{{$product_quotation->product_description_title??''}}</td>
                        <td>{{$product_quotation->product->item_name??''}}</td>
                        <td>{{$product_quotation->unit??''}}</td>
                        <td>{{$product_quotation->rate??''}}</td>
                        <td>{{$product_quotation->qty??''}}</td>
                        <td>{{$product_quotation->amount??''}}</td>
                        <td>
                            <a href="{{route('vendors.quotation-description.edit',$product_quotation->id)}}" data-toggle="tooltip" data-placement="top" title=" Edit"><i class="fa fa-edit text-info"></i></a>
                            <a href="{{route('vendors.quotation-description.delete',$product_quotation->id)}}" onclick="return confirm('Are you sure to delete ?')"><i class="fa fa-trash text-danger"></i></a>
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
