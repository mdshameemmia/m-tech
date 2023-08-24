@extends('layouts.master')
@section('body')
    <div class="row">
            
                <h1 class="col-md-10">Employees List</h1>
                <p class="col-md-2"><a href="{{url('employees/create')}}"><button class="btn btn-primary btn-sm"> <i class="fa fa-plus"></i></button></a></p>
            
                <div class="row" style="width: 100%;overflow:scroll">

                    <table class="table table-striped table-hover" >
                        <thead>
                            <th>SL</th>
                            <th>Name </th>
                            <th>Father's Name  </th>
                            <th>Country</th>
                            <th>City</th>
                            <th>Zip Code</th>
                            <th>Mobile</th>
                            <th>Passport </th>
                            <th>Nid</th>
                            <th>Company Name</th>
                            <th>Action </th>
                        </thead>
                        <tbody id="tbody">
                            @forelse ($employees as $key=>$employee)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$employee->name??''}}</td>
                                    <td>{{$employee->father_name??''}}</td>
                                    <td>{{$employee->country??''}}</td>
                                    <td>{{$employee->city??""}}</td>
                                    <td>{{$employee->zip_code??''}}</td>
                                    <td>{{$employee->mobile??''}}</td>
                                    <td>{{$employee->passport??''}}</td>
                                    <td>{{$employee->nid??''}}</td>
                                    <td>{{$employee->company->name??''}}</td>
                                    <td>
                                        <a href="{{route('employees.edit',$employee->id)}}"><i class="fa fa-edit text-info"></i></a>
                                        <a href="{{route('employees.delete',$employee->id)}}" onclick="return confirm('Are you sure to delete ?')"><i class="fa fa-trash text-danger"></i></a>
                                       
                                    </td>
                                </tr>
                            @empty
    
                            <tr>
                                <td colspan="11" class="text-center">No Record Available</td>
                            </tr>
                                
                            @endforelse
                        </tbody>
                    </table>
                </div>
          
    </div>
@endsection

@push('js')
    <script>
       
    </script>
@endpush
@push('css')
    <style>
       .form-control {
            background-color: #fff !important;
        }

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