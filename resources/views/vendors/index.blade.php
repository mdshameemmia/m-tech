@extends('layouts.master')
@section('body')
    <div class="row">
        <h1 class="col-md-10">Quotation List</h1>
        <p class="col-md-2"><a href="{{ url('vendors/create') }}"><button class="btn btn-primary btn-sm"> <i
                        class="fa fa-plus"></i></button></a></p>
        <table class="table table-striped table-hover">
            <thead>
                <th>SL</th>
                <th>Company Name  </th>
                <th>tel  </th>
                <th>fax </th>
                <th>Title </th>
                <th> Quotation </th>
                <th>Action </th>
            </thead>
            <tbody id="tbody">
                @foreach ($quotations as $key =>$quotation)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$quotation->company->name??""}}</td>
                        <td>{{$quotation->tel ??''}}</td>
                        <td>{{$quotation->fax ??''}}</td>
                        {{-- <td>{{$quotation->project->title ??''}}</td> --}}
                        <td>
                            <span data-toggle="tooltip" data-placement="top" title="{{$quotation->project->title??''}}">
                                {{$quotation->project->title ? substr($quotation->project->title, 0, 10) : ''}}
                            </span>
                        </td>

                        <td>{{$quotation->quotation ??''}}</td>
                        <td>
                            <a href="{{route('vendors.quotation_description',$quotation->id)}}" data-toggle="tooltip" data-placement="top" title="Quotation Description"><i class="fa fa-bars text-info"></i></a>
                            <a href="{{route('vendors.edit',$quotation->id)}}" data-toggle="tooltip" data-placement="top" title="Quotation Edit"><i class="fa fa-edit text-info"></i></a>
                            @if (\App\Models\ProgressClaim::where('quotation_id',$quotation->id)->count() == '0')
                            <a href="{{route('vendors.delete',$quotation->id)}}" onclick="return confirm('Are you sure to delete ?')"><i class="fa fa-trash text-danger"></i></a>
                            @endif
                           <a href="{{route('quotation.download',$quotation->id)}}"  tooltip="Test" class="text-info"><i class="fa fa-file"></i></a>
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
