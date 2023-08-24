@extends('layouts.master')
@section('body')
    <div class="row">
            
                <div class="row col-md-12 d-flex justify-content-between">
                    <h1>Levy Cost</h1>
                    <form action="{{route('levi-report.download')}}" class="d-flex" method="POST">
                        @csrf
                        <input type="text"  class="date form-control mx-1" name="start_date" placeholder="Start date">
                        <input type="text" class="date form-control mx-1" name="end_date" placeholder="End date">
                        <input class="btn btn-primary btn-sm form-control" value="Report Download" type="submit">
                    </form>
                    <p><a href="{{url('levies/create')}}"><button class="btn btn-primary btn-sm"> <i class="fa fa-plus"></i></button></a></p>

                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <th>SL</th>
                        <th>Date</th>
                        <th>Description </th>
                        <th>Amount</th>
                        <th>Action </th>
                    </thead>
                    <tbody id="tbody">
                        @forelse ($levies as $key=>$levy)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$levy->date?date('d M, Y',strtotime($levy->date)):''}}</td>
                                <td>{{$levy->description??''}}</td>
                                <td>{{$levy->amount??''}}</td>
                                <td>
                                    <a href="{{route('levies.edit',$levy->id)}}"><i class="fa fa-edit text-info"></i></a>
                                    {{-- <a href="{{route('levies.delete',$levy->id)}}" onclick="return confirm('Are you sure to delete ?')"><i class="fa fa-trash text-danger"></i></a> --}}
                                   
                                </td>
                            </tr>
                        @empty
                            
                        @endforelse
                    </tbody>
                </table>
          
    </div>
@endsection

@push('js')
<script src="{{asset('js/flatpickr.js')}}"></script>
  <script src="{{asset('js/sweetalert2.min.css')}}"></script>

    <script>
       $(".date").flatpickr();

    </script>
@endpush

@push('css')
    <link href="{{asset('css/flatpickr.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset("css/sweetalert2.min.css")}}">
    <style>
        /* .form-control{
            background-color: #fff !important ;
        } */
    </style>
@endpush