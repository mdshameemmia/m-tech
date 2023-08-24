@extends('layouts.master')
@section('body')
    <div class="card m-0 p-3" style="background-color:rgb(247, 238, 238)">
        <div class="row m-0 p-0">
            <h3 class="col-md-10 m-0 p-0">Vouchar  </h3>
            <p class="col-md-1"><a href="{{ route('salary-vouchar.index') }}"><button class="btn btn-primary btn-sm"> Back
                    </button></a></p>
            <p class="col-md-1">
                <button class="btn btn-primary btn-sm" id="addBtn"> Add</button>
            </p>
        </div>

        <div style="height:500px;width:100%;overflow: scroll ">
            <form action="{{ route('salary-vouchar.search') }}" method="POST" class="row">
                <div class="text-center">
                    <select name="employee_id" class="form-control" id="">
                        <option value="">Select Employee</option>
                        @foreach ($employees as $employee)
                        @isset($employee_id)
                        <option @if ($employee->id == $employee_id)
                            selected
                        @endif value="{{ $employee->id }}">{{ $employee->name ?? '' }}</option>
                        @else     
                        <option value="{{ $employee->id }}">{{ $employee->name ?? '' }}</option>  
                        @endisset
                          
                        @endforeach
                    </select>
                </div>
                <div class="text-center">
                    <input type="text" value="{{$date??''}}" name="date" placeholder="Select Month" class="form-control date2">
                </div>

                @csrf
                <button type="submit" class="btn btn-outline-primary">Search</button>

            </form>

            @isset($total_days)
                <h4 class="my-2">Salary Vouchar </h4>
                <form action="{{route('salary-vouchar.store')}}" method="POST" class="vouchar-container">
                    @csrf
                    <input type="hidden" name="employee_id" value="{{$employee_id??''}}">
                    <input type="hidden" name="date" value="{{$date??''}}">


                    <fieldset class="p-2" style="border: 1px solid rgb(102, 73, 208)">
                        <div class="row my-0 py-0">
                            <div class="form-group col-md-3 my-0 py-1">
                                <label for="">Basic Pay</label>
                                <input type="text" value="{{$total_days??""}}" class="form-control" name="basic_pay" readonly>
                            </div>
                            <div class="form-group col-md-3 my-0 py-1">
                                <label for="">Amount Per Day</label>
                                <input type="text" class="form-control" onkeyup="countTotalPay(this)" name="amount_per_day">
                            </div>
                            <div class="form-group col-md-3 my-0 py-1">
                                <label for="">Total Basic Pay</label>
                                <input type="text" class="form-control" name="total_basic_pay" readonly>
                            </div>
                            <div class="form-group col-md-3 my-0 py-1">
                                <label for="">Transport Pay </label>
                                <input type="text" value="{{$total_transport_fee??''}}" class="form-control" name="transport_pay" readonly>
                            </div>
                        </div>
                        <div class="row my-0 py-0">
                            <div class="form-group col-md-3 my-0 py-1">
                                <label for="">Over Time </label>
                                <input type="text" value="{{$total_over_time??""}}" class="form-control" name="over_time" readonly>
                            </div>
                            <div class="form-group col-md-3 my-0 py-1">
                                <label for="">Amount Per Hour</label>
                                <input type="text" class="form-control" onkeyup="countTotalOverTime(this)" name="amount_per_time">
                            </div>
                            <div class="form-group col-md-3 my-0 py-1">
                                <label for="">Total Over Pay</label>
                                <input type="text" class="form-control" name="total_over_time" readonly>
                            </div>
                            <div class="form-group col-md-3 my-0 py-1">
                                <label for="">Food Pay</label>
                                <input type="text" value="{{$total_food_fee??''}}" class="form-control" name="food_pay" readonly>
                            </div>
                        </div>

                        <div class="row my-0 py-0">
                            <div class="form-group col-md-4 my-0 py-1">
                                <label for="">Medical Pay</label>
                                <input type="text" class="form-control" name="medical_pay">
                            </div>
                            <div class="form-group col-md-4 my-0 py-1">
                                <label for="">Bonus</label>
                                <input type="text" onkeyup="getTotalGrossPay(this)" class="form-control" name="bonus">
                            </div>
                            <div class="form-group col-md-4 my-0 py-1">
                                <label for="">Gross Pay</label>
                                <input type="text" class="form-control" name="gross_pay" readonly>
                            </div>

                        </div>
                    </fieldset>
                    <fieldset class="p-2" style="border: 1px solid rgb(102, 73, 208)">
                        <div class="row my-0 py-0">
                            <div class="form-group col-md-3 my-0 py-1">
                                <label for="">CPF Employee</label>
                                <input type="text" value="" class="form-control" onkeyup="getTotalDeduction()" name="cpf" >
                            </div>
                            <div class="form-group col-md-3 my-0 py-1">
                                <label for="">Contributions</label>
                                <input type="text" class="form-control" onkeyup="getTotalDeduction()" name="contribution">
                            </div>
                            <div class="form-group col-md-3 my-0 py-1">
                                <label for="">WDL/CDAC/MBMF</label>
                                <input type="text" class="form-control" onkeyup="getTotalDeduction()" name="wdl_cdac_mbmf" >
                            </div>
                            <div class="form-group col-md-3 my-0 py-1">
                                <label for="">CDAC</label>
                                <input type="text" value="" class="form-control" onkeyup="getTotalDeduction()" name="cadc" >
                            </div>
                        </div>
                        <div class="row my-0 py-0">
                            <div class="form-group col-md-3 my-0 py-1">
                                <label for="">Advance / Loan</label>
                                <input type="text" value="" class="form-control" onkeyup="getTotalDeduction()" name="advance_or_loan" >
                            </div>
                            <div class="form-group col-md-3 my-0 py-1">
                                <label for="">Income Tax</label>
                                <input type="text" class="form-control" onkeyup="getTotalDeduction()" name="income_tax">
                            </div>
                            <div class="form-group col-md-3 my-0 py-1">
                                <label for="">Monthly Housing, Amenities & Services</label>
                                <input type="text" class="form-control" onkeyup="getTotalDeduction()" name="monthly_housing" >
                            </div>
                            <div class="form-group col-md-3 my-0 py-1">
                                <label for="">Others </label>
                                <input type="text" value="" onkeyup="getTotalDeduction()" class="form-control" name="others" >
                            </div>
                        </div>

                        <div class="row my-0 py-0">
                            <div class="form-group col-md-4 my-0 py-1">
                                <label for="">TOTAL DEDUCTIONS</label>
                                <input type="text" class="form-control" name="total_deduction">
                            </div>
                            <div class="form-group col-md-2 my-0 py-1">
                                <button type="button" class="btn btn-primary mt-3" onclick="subtractVal()">Net Pay</button>
                            </div>
                            <div class="form-group col-md-4 my-0 py-1">
                                <label for="">Net Pay</label>
                                <input type="text" class="form-control" name="net_pay" readonly>
                                
                            </div>

                        </div>
                    </fieldset>
                    <button type="submit" class="btn btn-primary btn-sm my-2">Submit</button>

                </form>
            @endisset
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('js/flatpickr.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.min.css') }}"></script>

    <script>
        let datePickr = document.getElementsByClassName("date");
        datePickr.flatpickr()

        let datePickr2 = document.getElementsByClassName("date2");
        datePickr2.flatpickr({dateFormat: "Y-m"})


        // count total pay 
        function countTotalPay(data)
        {
            let basic_pay = $('input[name=basic_pay]').val();
            let amount_per_day = data.value;
           let total_basic_pay = basic_pay * amount_per_day;
           console.log(total_basic_pay)
            $("input[name=total_basic_pay]").val(total_basic_pay.toFixed(2));
        }
        // count overtime  pay 
        function countTotalOverTime(data)
        {
            let over_time = $('input[name=over_time]').val();
            let amount_per_time = data.value;
           let total_over_time = over_time * amount_per_time;
            $("input[name=total_over_time]").val(total_over_time.toFixed(2));
        }


        // gross pay 
        function getTotalGrossPay(data)
        {
            let bonus = data.value;
            let total_basic_pay = $("input[name=total_basic_pay]").val();
            let total_over_time = $("input[name=total_over_time]").val();
            let transport_pay = $("input[name=transport_pay]").val();
            let food_pay = $("input[name=food_pay]").val();
            let medical_pay = $("input[name=medical_pay]").val();
            let total_gross_pay  = parseFloat(bonus) + parseFloat(total_basic_pay) + parseFloat(total_over_time) + parseFloat(transport_pay) + parseFloat(food_pay) + parseFloat(medical_pay);
            $("input[name=gross_pay]").val(total_gross_pay);
        }

        // total deduction 
        function getTotalDeduction()
        {
            let cpf = $("input[name=cpf]").val();
            let contribution = $("input[name=contribution]").val();
            let wdl_cdac_mbmf = $("input[name=wdl_cdac_mbmf]").val();
            let cadc = $("input[name=cadc]").val();
            let advance_or_loan = $("input[name=advance_or_loan]").val();
            let income_tax = $("input[name=income_tax]").val();
            let monthly_housing = $("input[name=monthly_housing]").val();
            let others = $("input[name=others]").val();
            let total_deduction = parseFloat(cpf) + parseFloat(contribution) + parseFloat(wdl_cdac_mbmf) + parseFloat(cadc) + parseFloat(advance_or_loan) + parseFloat(income_tax) + parseFloat(monthly_housing) + parseFloat(others);
             $("input[name=total_deduction]").val(total_deduction);
        }

        // subtrack 
        function subtractVal()
        {
            let total_gross_pay = $("input[name=gross_pay]").val();
            let total_deduction = $("input[name=total_deduction]").val();
            let net_pay  = total_gross_pay -  total_deduction;
            $("input[name=net_pay]").val(net_pay.toFixed(2));
        }
    </script>
@endpush

@push('css')
    <link href="{{ asset('css/flatpickr.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <style>
        .form-control {
            background-color: #fff !important;
        }
        .vouchar-container .form-control {
            background-color: #fff !important;
            height: 25px;
        }

        .custom_width {
            width: 200px !important;
            height: 20px !important;
        }

        .table td,
        .table th {
            padding: 0 10px !important;
        }

        table {
            table-layout: fixed;
            word-wrap: break-word;
        }
        label{
            margin: 0;
            padding: 0;
        }
    </style>
@endpush
