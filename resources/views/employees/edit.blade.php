@extends('layouts.master')
@section('body')
    <div class="card m-0 p-3" style="background-color:rgb(247, 238, 238)">
        <div class="row m-0 p-0">
            <h2 class="col-md-11">Employee Profile</h2>
            <p class="col-md-1"><a href="{{ route('employees.index') }}"><button class="btn btn-primary btn-sm"> Back
                    </button></a></p>
        </div>
        <form action="{{ route('employees.update',$employee->id) }}" method="POST" class="row">
            @csrf
            <div class="col-md-4">
                <div class="form-group">
                    <label for="" class="font-weight-bold">Name</label>
                    <input type="text" name="name" value="{{$employee->name??''}}" id="" class="form-control " placeholder=""
                        aria-describedby="helpId">
                </div>
                <div class="form-group ">
                    <label for="" class=" font-weight-bold">Father Name</label>
                    <input type="text" name="father_name" value="{{$employee->father_name??''}}" id="" class="form-control " placeholder=""
                        aria-describedby="helpId">
                </div>
                <div class="form-group ">
                    <label for="" class=" font-weight-bold">Mother Name </label>
                    <input type="text" name="mother_name"  value="{{$employee->mother_name??''}}" id="" class="form-control " placeholder=""
                        aria-describedby="helpId">
                </div>
                <div class="form-group ">
                    <label for="" class=" font-weight-bold">Relative Name </label>
                    <input type="text" name="relative_name"  value="{{$employee->relative_name??''}}" id="" class="form-control " placeholder=""
                        aria-describedby="helpId">
                </div>
                <div class="form-group ">
                    <label for="" class=" font-weight-bold">Relative Mobile </label>
                    <input type="text" name="relative_mobile"  value="{{$employee->relative_mobile??''}}" id="" class="form-control " placeholder=""
                        aria-describedby="helpId">
                </div>
            
                <div class="form-group ">
                    <label for="" class=" font-weight-bold">Country </label>
                    <input type="text" name="country" id=""  value="{{$employee->country??''}}" class="form-control " placeholder=""
                        aria-describedby="helpId">
                </div>
                <div class="form-group ">
                  <label for="" class=" font-weight-bold">State </label>
                  <input type="text" name="state" id=""  value="{{$employee->state??''}}" class="form-control " placeholder=""
                      aria-describedby="helpId">
              </div>
              <div class="form-group ">
                  <label for="" class=" font-weight-bold">City </label>
                  <input type="text" name="city" id=""  value="{{$employee->city??''}}" class="form-control " placeholder=""
                      aria-describedby="helpId">
              </div>
              <div class="form-group ">
                <label for="" class=" font-weight-bold">Zip Code </label>
                <input type="text" name="zip_code" id=""   value="{{$employee->zip_code??''}}" class="form-control " placeholder=""
                    aria-describedby="helpId">
            </div>
            </div>
            <div class="col-md-4">
                <div class="form-group ">
                    <label for="" class=" font-weight-bold">Mobile </label>
                    <input type="text" name="mobile" id=""  value="{{$employee->mobile??''}}" class="form-control " placeholder=""
                        aria-describedby="helpId">
                </div>
                <div class="form-group ">
                    <label for="" class=" font-weight-bold">Passport </label>
                    <input type="text" name="passport"   value="{{$employee->passport??''}}" id="" class="form-control " placeholder=""
                        aria-describedby="helpId">
                </div>
                <div class="form-group ">
                    <label for="" class=" font-weight-bold">Passport Issue Date </label>
                    <input type="text" name="passport_issue_date"  value="{{$employee->passport_issue_date??''}}" id="" class="form-control date"
                        placeholder="" aria-describedby="helpId">
                </div>
                <div class="form-group ">
                    <label for="" class=" font-weight-bold">Passport Expire Date </label>
                    <input type="text" name="passport_expire_date"   value="{{$employee->passport_expire_date??''}}" id="" class="form-control date"
                        placeholder="" aria-describedby="helpId">
                </div>
                <div class="form-group ">
                  <label for="" class=" font-weight-bold"> EP </label>
                  <input type="text" name="ep" id=""  value="{{$employee->ep??''}}" class="form-control " placeholder=""
                      aria-describedby="helpId">
              </div>
              <div class="form-group ">
                  <label for="" class=" font-weight-bold"> NID </label>
                  <input type="text" name="nid" id=""  value="{{$employee->nid??''}}"  class="form-control " placeholder=""
                      aria-describedby="helpId">
              </div>
              <div class="form-group ">
                  <label for="" class=" font-weight-bold">Salary </label>
                  <input type="text" name="salary" id=""  value="{{$employee->salary??''}}" class="form-control " placeholder=""
                      aria-describedby="helpId">
              </div>
              <div class="form-group ">
                <label for="" class=" font-weight-bold">CPF Amount </label>
                <input type="text" name="cpf_amount" id=""  value="{{$employee->cpf_amount??''}}" class="form-control " placeholder=""
                    aria-describedby="helpId">
            </div>
            </div>

            <div class="col-md-4">
                <div class="form-group ">
                    <label for="" class=" font-weight-bold">Personal Pay </label>
                    <input type="text" name="personal_pay"  value="{{$employee->personal_pay??''}}" id="" class="form-control " placeholder=""
                        aria-describedby="helpId">
                </div>
                <div class="form-group ">
                    <label for="" class=" font-weight-bold">Company Pay </label>
                    <input type="text" name="company_pay" id=""  value="{{$employee->company_pay??''}}" class="form-control " placeholder=""
                        aria-describedby="helpId">
                </div>
                <div class="form-group ">
                    <label for="" class=" font-weight-bold">Medical Pay </label>
                    <input type="text" name="medical_pay" id=""  value="{{$employee->medical_pay??''}}" class="form-control " placeholder=""
                        aria-describedby="helpId">
                </div>
                <div class="form-group ">
                    <label for="" class=" font-weight-bold">Bonus Pay </label>
                    <input type="text" name="bonus_pay" id=""   value="{{$employee->bonus_pay??''}}" class="form-control " placeholder=""
                        aria-describedby="helpId">
                </div>
                <div class="form-group ">
                    <label for="" class=" font-weight-bold">Over Time Pay </label>
                    <input type="text" name="over_time_pay"  value="{{$employee->over_time_pay??''}}" id="" class="form-control " placeholder=""
                        aria-describedby="helpId">
                </div>
                <div class="form-group ">
                    <label for="" class=" font-weight-bold">Total Day Work </label>
                    <input type="text" name="total_day_work" id=""  value="{{$employee->total_day_work??''}}" class="form-control " placeholder=""
                        aria-describedby="helpId">
                </div>
                <div class="form-group ">
                    <label for="" class=" font-weight-bold">Employee Type </label>
                    <input type="text" name="employee_type"  value="{{$employee->employee_type??''}}" id="" class="form-control " placeholder=""
                        aria-describedby="helpId">
                </div>
                <div class="form-group ">
                    <label for="" class=" font-weight-bold"> Company Name </label>
                    <select name="company_id"  class="form-control" id="" required>
                        <option value="">Select One</option>
                        @foreach ($companies as $company)
                            <option @if ($company->id == $employee->company_id)
                                selected
                            @endif value="{{$company->id}}">{{$company->name??''}}</option>
                        @endforeach
                    </select>
              
                </div>
            </div>
            <div class="form-group ">
                <button type="submit" class="btn btn-sm btn-primary mx-2 ">Save </button>
            </div>
        </form>
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
        .form-control {
            background-color: #fff !important;
        }
    </style>
@endpush
