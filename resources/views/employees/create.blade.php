@extends('layouts.master')
@section('body')
    <div class="card m-0 p-3" style="background-color:rgb(247, 238, 238)">
        <div class="row m-0 p-0">
            <h2 class="col-md-11">Employee Profile</h2>
            <p class="col-md-1"><a href="{{ route('employees.index') }}"><button class="btn btn-primary btn-sm"> Back
                    </button></a></p>
        </div>
        <form action="{{ route('employees.store') }}" method="POST" class="row">
            @csrf
            <div class="col-md-4">
                <div class="form-group">
                    <label for="" class="font-weight-bold">Name</label>
                    <input type="text" name="name" id="" class="form-control " placeholder=""
                        aria-describedby="helpId">
                </div>
                <div class="form-group ">
                    <label for="" class=" font-weight-bold">Father Name</label>
                    <input type="text" name="father_name" id="" class="form-control " placeholder=""
                        aria-describedby="helpId">
                </div>
                <div class="form-group ">
                    <label for="" class=" font-weight-bold">Mother Name </label>
                    <input type="text" name="mother_name" id="" class="form-control " placeholder=""
                        aria-describedby="helpId">
                </div>
                <div class="form-group ">
                    <label for="" class=" font-weight-bold">Relative Name </label>
                    <input type="text" name="relative_name" id="" class="form-control " placeholder=""
                        aria-describedby="helpId">
                </div>
                <div class="form-group ">
                    <label for="" class=" font-weight-bold">Relative Mobile </label>
                    <input type="text" name="relative_mobile" id="" class="form-control " placeholder=""
                        aria-describedby="helpId">
                </div>
            
                <div class="form-group ">
                    <label for="" class=" font-weight-bold">Country </label>
                    <input type="text" name="country" id="" class="form-control " placeholder=""
                        aria-describedby="helpId">
                </div>
                <div class="form-group ">
                  <label for="" class=" font-weight-bold">State </label>
                  <input type="text" name="state" id="" class="form-control " placeholder=""
                      aria-describedby="helpId">
              </div>
              <div class="form-group ">
                  <label for="" class=" font-weight-bold">City </label>
                  <input type="text" name="city" id="" class="form-control " placeholder=""
                      aria-describedby="helpId">
              </div>
              <div class="form-group ">
                <label for="" class=" font-weight-bold">Zip Code </label>
                <input type="text" name="zip_code" id="" class="form-control " placeholder=""
                    aria-describedby="helpId">
            </div>
            </div>
            <div class="col-md-4">
                <div class="form-group ">
                    <label for="" class=" font-weight-bold">Mobile </label>
                    <input type="text" name="mobile" id="" class="form-control " placeholder=""
                        aria-describedby="helpId">
                </div>
                <div class="form-group ">
                    <label for="" class=" font-weight-bold">Passport </label>
                    <input type="text" name="passport" id="" class="form-control " placeholder=""
                        aria-describedby="helpId">
                </div>
                <div class="form-group ">
                    <label for="" class=" font-weight-bold">Passport Issue Date </label>
                    <input type="text" name="passport_issue_date" id="" class="form-control date"
                        placeholder="" aria-describedby="helpId">
                </div>
                <div class="form-group ">
                    <label for="" class=" font-weight-bold">Passport Expire Date </label>
                    <input type="text" name="passport_expire_date" id="" class="form-control date"
                        placeholder="" aria-describedby="helpId">
                </div>
                <div class="form-group ">
                  <label for="" class=" font-weight-bold"> EP/Work Permit No</label>
                  <input type="text" name="ep" id="" class="form-control " placeholder=""
                      aria-describedby="helpId">
              </div>
              <div class="form-group ">
                  <label for="" class=" font-weight-bold"> NID </label>
                  <input type="text" name="nid" id="" class="form-control " placeholder=""
                      aria-describedby="helpId">
              </div>
              <div class="form-group ">
                  <label for="" class=" font-weight-bold">Salary </label>
                  <input type="text" name="salary" id="" class="form-control " placeholder=""
                      aria-describedby="helpId">
              </div>
              <div class="form-group ">
                <label for="" class=" font-weight-bold">CPF Amount </label>
                <input type="text" name="cpf_amount" id="" class="form-control " placeholder=""
                    aria-describedby="helpId">
            </div>
            </div>

            <div class="col-md-4">
                <div class="form-group ">
                    <label for="" class=" font-weight-bold">Personal Pay </label>
                    <input type="text" name="personal_pay" id="" class="form-control " placeholder=""
                        aria-describedby="helpId">
                </div>
                <div class="form-group ">
                    <label for="" class=" font-weight-bold">Company Pay </label>
                    <input type="text" name="company_pay" id="" class="form-control " placeholder=""
                        aria-describedby="helpId">
                </div>
                <div class="form-group ">
                    <label for="" class=" font-weight-bold">Medical Pay </label>
                    <input type="text" name="medical_pay" id="" class="form-control " placeholder=""
                        aria-describedby="helpId">
                </div>
                <div class="form-group ">
                    <label for="" class=" font-weight-bold">Bonus Pay </label>
                    <input type="text" name="bonus_pay" id="" class="form-control " placeholder=""
                        aria-describedby="helpId">
                </div>
                <div class="form-group ">
                    <label for="" class=" font-weight-bold">Over Time Pay </label>
                    <input type="text" name="over_time_pay" id="" class="form-control " placeholder=""
                        aria-describedby="helpId">
                </div>
                <div class="form-group ">
                    <label for="" class=" font-weight-bold">Total Day Work </label>
                    <input type="text" name="total_day_work" id="" class="form-control " placeholder=""
                        aria-describedby="helpId">
                </div>
                <div class="form-group ">
                    <label for="" class=" font-weight-bold">Employee Type </label>
                    <input type="text" name="employee_type" id="" class="form-control " placeholder=""
                        aria-describedby="helpId">
                </div>
                <div class="form-group ">
                    <label for="" class=" font-weight-bold"> Company Name </label>
                    <select name="company_id"  class="form-control" id="">
                        <option value="">Select One</option>
                        @foreach ($companies as $company)
                            <option value="{{$company->id}}">{{$company->name??''}}</option>
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
