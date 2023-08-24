@extends('layouts.master')
@section('body')
    <div class="row">

        <h2 class="col-md-10">Total Profit/Loss Amount ($)</h2>
        <div class="row my-4">
            <form action="{{ route('annual_reports.search') }}" method="POST" class="d-flex justify-content-center">
                @csrf
                <div class="form-group mx-3">
                    <label for="">Date From</label>
                    <input type="text" name="date_from" value="{{$date_from??''}}" id="" class="date form-control" placeholder=""
                        aria-describedby="helpId">
                </div>
                <div class="form-group mx-3">
                    <label for="">Date To </label>
                    <input type="text" name="date_to" value="{{$date_to??''}}" id="" class="date form-control" placeholder=""
                        aria-describedby="helpId">
                </div>
                <div class="form-group  mt-1">

                    <button class="btn btn-primary mt-4  " type="submit">Search </button>
                </div>

            </form>
        </div>
        
        @isset($master_arr)
        <div class="row" style="width: 100%;overflow:scroll">
                <table class="table table-striped table-hover ">
                    <thead>
                        <tr>
                            <th class="custom_width">Month Name</th>
                            <th class="custom_width">Product Cost</th>
                            <th class="custom_width">Staff Salary</th>
                            <th class="custom_width">Official/Other Cost</th>
                            <th class="custom_width">Levy Cost</th>
                            <th class="custom_width">CPF Cost</th>
                            <th class="custom_width">Sub Contact Cost</th>
                            <th class="custom_width">Total Cost Amount </th>
                            <th class="custom_width">Monthly Paid Material </th>
                            <th class="custom_width">Monthly Payment </th>
                            <th class="custom_width">Total Monthly Balance </th>
                        </tr>
                    </thead>

                    <tbody>


                        <tr>

                            <td class="custom_width">Jun-{{ $year1 }} </td>
                            <td class="custom_width">
                                {{ isset($master_arr['product_cost']['Jun']) ? '$' . array_sum($master_arr['product_cost']['Jun']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['salary_cost']['Jun']) ? '$' . array_sum($master_arr['salary_cost']['Jun']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['other_cost']['Jun']) ? '$' . array_sum($master_arr['other_cost']['Jun']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['levy_cost']['Jun']) ? '$' . array_sum($master_arr['levy_cost']['Jun']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['cpf_cost']['Jun']) ? '$' . array_sum($master_arr['cpf_cost']['Jun']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['sub_contact_cost']['Jun'])? '$' . array_sum($master_arr['sub_contact_cost']['Jun']): '$0.00' }}
                            </td>
                            <td class="custom_width">

                                @php
                                    $product_cost_jun = 0;
                                    if (isset($master_arr['product_cost']['Jun'])) {
                                        $product_cost_jun = array_sum($master_arr['product_cost']['Jun']);
                                    }
                                    $salary_cost_jun = 0;
                                    if (isset($master_arr['salary_cost']['Jun'])) {
                                        $salary_cost_jun = array_sum($master_arr['salary_cost']['Jun']);
                                    }
                                    $other_cost_jun = 0;
                                    if (isset($master_arr['other_cost']['Jun'])) {
                                        $other_cost_jun = array_sum($master_arr['other_cost']['Jun']);
                                    }
                                    $levy_cost_jun = 0;
                                    if (isset($master_arr['levy_cost']['Jun'])) {
                                        $levy_cost_jun = array_sum($master_arr['levy_cost']['Jun']);
                                    }
                                    $cpf_cost_jun = 0;
                                    if (isset($master_arr['cpf_cost']['Jun'])) {
                                        $cpf_cost_jun = array_sum($master_arr['cpf_cost']['Jun']);
                                    }
                                    $sub_contact_cost_jun = 0;
                                    if (isset($master_arr['sub_contact_cost']['Jun'])) {
                                        $sub_contact_cost_jun = array_sum($master_arr['sub_contact_cost']['Jun']);
                                    }
                                    
                                    $total_jun  = $product_cost_jun + $salary_cost_jun + $other_cost_jun + $levy_cost_jun + $cpf_cost_jun + $sub_contact_cost_jun;
                                    echo $total_jun;
                                @endphp


                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['monthly_paid_material_cost']['Jun'])? '$' . array_sum($master_arr['monthly_paid_material_cost']['Jun']): '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['monthly_payment_cost']['Jun'])? '$' . array_sum($master_arr['monthly_payment_cost']['Jun']): '$0.00' }}
                            </td>
                            <td class="custom_width">
                            @php
                            $monthly_payment_jun = 0;
                               if(isset($master_arr['monthly_payment_cost']['Jun'])){
                                   $monthly_payment_jun = array_sum($master_arr['monthly_payment_cost']['Jun']);
                               }
                                echo $monthly_payment_jun - $total_jun . "$";
                            @endphp    
                            </td>


                        </tr>
                        <tr>

                            <td class="custom_width">Jul-{{ $year1 }} </td>
                            <td class="custom_width">
                                {{ isset($master_arr['product_cost']['Jul']) ? '$' . array_sum($master_arr['product_cost']['Jul']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['salary_cost']['Jul']) ? '$' . array_sum($master_arr['salary_cost']['Jul']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['other_cost']['Jul']) ? '$' . array_sum($master_arr['other_cost']['Jul']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['levy_cost']['Jul']) ? '$' . array_sum($master_arr['levy_cost']['Jul']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['cpf_cost']['Jul']) ? '$' . array_sum($master_arr['cpf_cost']['Jul']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['sub_contact_cost']['Jul'])? '$' . array_sum($master_arr['sub_contact_cost']['Jul']): '$0.00' }}
                            </td>
                            <td class="custom_width">
                            @php
                                    $product_cost_jul = 0;
                                    if (isset($master_arr['product_cost']['Jul'])) {
                                        $product_cost_jul = array_sum($master_arr['product_cost']['Jul']);
                                    }
                                    $salary_cost_jul = 0;
                                    if (isset($master_arr['salary_cost']['Jul'])) {
                                        $salary_cost_jul = array_sum($master_arr['salary_cost']['Jul']);
                                    }
                                    $other_cost_jul = 0;
                                    if (isset($master_arr['other_cost']['Jul'])) {
                                        $other_cost_jul = array_sum($master_arr['other_cost']['Jul']);
                                    }
                                    $levy_cost_jul = 0;
                                    if (isset($master_arr['levy_cost']['Jul'])) {
                                        $levy_cost_jul = array_sum($master_arr['levy_cost']['Jul']);
                                    }
                                    $cpf_cost_jul = 0;
                                    if (isset($master_arr['cpf_cost']['Jul'])) {
                                        $cpf_cost_jul = array_sum($master_arr['cpf_cost']['Jul']);
                                    }
                                    $sub_contact_cost_jul = 0;
                                    if (isset($master_arr['sub_contact_cost']['Jul'])) {
                                        $sub_contact_cost_jul = array_sum($master_arr['sub_contact_cost']['Jul']);
                                    }
                                    
                                    $total_Jul =  $product_cost_jul + $salary_cost_jul + $other_cost_jul + $levy_cost_jul + $cpf_cost_jul + $sub_contact_cost_jul;
                                    echo $total_Jul;
                                @endphp    
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['monthly_paid_material_cost']['Jul'])? '$' . array_sum($master_arr['monthly_paid_material_cost']['Jul']): '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['monthly_payment_cost']['Jul'])? '$' . array_sum($master_arr['monthly_payment_cost']['Jul']): '$0.00' }}
                            </td>
                            <td class="custom_width">
                            @php
                            $monthly_payment_Jul = 0;
                               if(isset($master_arr['monthly_payment_cost']['Jul'])){
                                   $monthly_payment_Jul = array_sum($master_arr['monthly_payment_cost']['Jul']);
                               }
                                echo $monthly_payment_Jul - $total_Jul . "$";
                            @endphp     
                            </td>


                        </tr>
                        <tr>

                            <td class="custom_width">Aug-{{ $year1 }} </td>
                            <td class="custom_width">
                                {{ isset($master_arr['product_cost']['Aug']) ? '$' . array_sum($master_arr['product_cost']['Aug']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['salary_cost']['Aug']) ? '$' . array_sum($master_arr['salary_cost']['Aug']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['other_cost']['Aug']) ? '$' . array_sum($master_arr['other_cost']['Aug']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['levy_cost']['Aug']) ? '$' . array_sum($master_arr['levy_cost']['Aug']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['cpf_cost']['Aug']) ? '$' . array_sum($master_arr['cpf_cost']['Aug']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['sub_contact_cost']['Aug'])? '$' . array_sum($master_arr['sub_contact_cost']['Aug']): '$0.00' }}
                            </td>
                            <td class="custom_width">
                            @php
                                    $product_cost_Aug = 0;
                                    if (isset($master_arr['product_cost']['Aug'])) {
                                        $product_cost_Aug = array_sum($master_arr['product_cost']['Aug']);
                                    }
                                    $salary_cost_Aug = 0;
                                    if (isset($master_arr['salary_cost']['Aug'])) {
                                        $salary_cost_Aug = array_sum($master_arr['salary_cost']['Aug']);
                                    }
                                    $other_cost_Aug = 0;
                                    if (isset($master_arr['other_cost']['Aug'])) {
                                        $other_cost_Aug = array_sum($master_arr['other_cost']['Aug']);
                                    }
                                    $levy_cost_Aug = 0;
                                    if (isset($master_arr['levy_cost']['Aug'])) {
                                        $levy_cost_Aug = array_sum($master_arr['levy_cost']['Aug']);
                                    }
                                    $cpf_cost_Aug = 0;
                                    if (isset($master_arr['cpf_cost']['Aug'])) {
                                        $cpf_cost_Aug = array_sum($master_arr['cpf_cost']['Aug']);
                                    }
                                    $sub_contact_cost_Aug = 0;
                                    if (isset($master_arr['sub_contact_cost']['Aug'])) {
                                        $sub_contact_cost_Aug = array_sum($master_arr['sub_contact_cost']['Aug']);
                                    }
                                    
                                    $total_Aug =  $product_cost_Aug + $salary_cost_Aug + $other_cost_Aug + $levy_cost_Aug + $cpf_cost_Aug + $sub_contact_cost_Aug;
                                    echo $total_Aug;
                                @endphp    
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['monthly_paid_material_cost']['Aug'])? '$' . array_sum($master_arr['monthly_paid_material_cost']['Aug']): '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['monthly_payment_cost']['Aug'])? '$' . array_sum($master_arr['monthly_payment_cost']['Aug']): '$0.00' }}
                            </td>
                            <td class="custom_width">
                            @php
                            $monthly_payment_Aug = 0;
                               if(isset($master_arr['monthly_payment_cost']['Aug'])){
                                   $monthly_payment_Aug = array_sum($master_arr['monthly_payment_cost']['Aug']);
                               }
                                echo $monthly_payment_Aug - $total_Aug . "$";
                            @endphp     
                            </td>


                        </tr>
                        <tr>

                            <td class="custom_width">Sep-{{ $year1 }} </td>
                            <td class="custom_width">
                                {{ isset($master_arr['product_cost']['Sep']) ? '$' . array_sum($master_arr['product_cost']['Sep']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['salary_cost']['Sep']) ? '$' . array_sum($master_arr['salary_cost']['Sep']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['other_cost']['Sep']) ? '$' . array_sum($master_arr['other_cost']['Sep']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['levy_cost']['Sep']) ? '$' . array_sum($master_arr['levy_cost']['Sep']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['cpf_cost']['Sep']) ? '$' . array_sum($master_arr['cpf_cost']['Sep']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['sub_contact_cost']['Sep'])? '$' . array_sum($master_arr['sub_contact_cost']['Sep']): '$0.00' }}
                            </td>
                            <td class="custom_width">
                                @php
                                    $product_cost_Sep = 0;
                                    if (isset($master_arr['product_cost']['Sep'])) {
                                        $product_cost_Sep = array_sum($master_arr['product_cost']['Sep']);
                                    }
                                    $salary_cost_Sep = 0;
                                    if (isset($master_arr['salary_cost']['Sep'])) {
                                        $salary_cost_Sep = array_sum($master_arr['salary_cost']['Sep']);
                                    }
                                    $other_cost_Sep = 0;
                                    if (isset($master_arr['other_cost']['Sep'])) {
                                        $other_cost_Sep = array_sum($master_arr['other_cost']['Sep']);
                                    }
                                    $levy_cost_Sep = 0;
                                    if (isset($master_arr['levy_cost']['Sep'])) {
                                        $levy_cost_Sep = array_sum($master_arr['levy_cost']['Sep']);
                                    }
                                    $cpf_cost_Sep = 0;
                                    if (isset($master_arr['cpf_cost']['Sep'])) {
                                        $cpf_cost_Sep = array_sum($master_arr['cpf_cost']['Sep']);
                                    }
                                    $sub_contact_cost_Sep = 0;
                                    if (isset($master_arr['sub_contact_cost']['Sep'])) {
                                        $sub_contact_cost_Sep = array_sum($master_arr['sub_contact_cost']['Sep']);
                                    }
                                    
                                    $total_Sep =  $product_cost_Sep + $salary_cost_Sep + $other_cost_Sep + $levy_cost_Sep + $cpf_cost_Sep + $sub_contact_cost_Sep;
                                    echo $total_Sep;
                                @endphp
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['monthly_paid_material_cost']['Sep'])? '$' . array_sum($master_arr['monthly_paid_material_cost']['Sep']): '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['monthly_payment_cost']['Sep'])? '$' . array_sum($master_arr['monthly_payment_cost']['Sep']): '$0.00' }}
                            </td>
                            <td class="custom_width">
                              @php
                            $monthly_payment_Sep = 0;
                               if(isset($master_arr['monthly_payment_cost']['Sep'])){
                                   $monthly_payment_Sep = array_sum($master_arr['monthly_payment_cost']['Sep']);
                               }
                                echo $monthly_payment_Sep - $total_Sep . "$";
                            @endphp     
                            </td>


                        </tr>
                        <tr>

                            <td class="custom_width">Oct-{{ $year1 }} </td>
                            <td class="custom_width">
                                {{ isset($master_arr['product_cost']['Oct']) ? '$' . array_sum($master_arr['product_cost']['Oct']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['salary_cost']['Oct']) ? '$' . array_sum($master_arr['salary_cost']['Oct']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['other_cost']['Oct']) ? '$' . array_sum($master_arr['other_cost']['Oct']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['levy_cost']['Oct']) ? '$' . array_sum($master_arr['levy_cost']['Oct']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['cpf_cost']['Oct']) ? '$' . array_sum($master_arr['cpf_cost']['Oct']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['sub_contact_cost']['Oct'])? '$' . array_sum($master_arr['sub_contact_cost']['Oct']): '$0.00' }}
                            </td>
                            <td class="custom_width">
                            @php
                                    $product_cost_Oct = 0;
                                    if (isset($master_arr['product_cost']['Oct'])) {
                                        $product_cost_Oct = array_sum($master_arr['product_cost']['Oct']);
                                    }
                                    $salary_cost_Oct = 0;
                                    if (isset($master_arr['salary_cost']['Oct'])) {
                                        $salary_cost_Oct = array_sum($master_arr['salary_cost']['Oct']);
                                    }
                                    $other_cost_Oct = 0;
                                    if (isset($master_arr['other_cost']['Oct'])) {
                                        $other_cost_Oct = array_sum($master_arr['other_cost']['Oct']);
                                    }
                                    $levy_cost_Oct = 0;
                                    if (isset($master_arr['levy_cost']['Oct'])) {
                                        $levy_cost_Oct = array_sum($master_arr['levy_cost']['Oct']);
                                    }
                                    $cpf_cost_Oct = 0;
                                    if (isset($master_arr['cpf_cost']['Oct'])) {
                                        $cpf_cost_Oct = array_sum($master_arr['cpf_cost']['Oct']);
                                    }
                                    $sub_contact_cost_Oct = 0;
                                    if (isset($master_arr['sub_contact_cost']['Oct'])) {
                                        $sub_contact_cost_Oct = array_sum($master_arr['sub_contact_cost']['Oct']);
                                    }
                                    
                                    $total_Oct =  $product_cost_Oct + $salary_cost_Oct + $other_cost_Oct + $levy_cost_Oct + $cpf_cost_Oct + $sub_contact_cost_Oct;
                                    echo $total_Oct;
                                @endphp    
                            
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['monthly_paid_material_cost']['Oct'])? '$' . array_sum($master_arr['monthly_paid_material_cost']['Oct']): '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['monthly_payment_cost']['Oct'])? '$' . array_sum($master_arr['monthly_payment_cost']['Oct']): '$0.00' }}
                            </td>
                            <td class="custom_width">
                             @php
                            $monthly_payment_Oct = 0;
                               if(isset($master_arr['monthly_payment_cost']['Oct'])){
                                   $monthly_payment_Oct = array_sum($master_arr['monthly_payment_cost']['Oct']);
                               }
                                echo $monthly_payment_Oct - $total_Oct . "$";
                            @endphp     
                            </td>


                        </tr>
                        <tr>

                            <td class="custom_width">Nov-{{ $year1 }} </td>
                            <td class="custom_width">
                                {{ isset($master_arr['product_cost']['Nov']) ? '$' . array_sum($master_arr['product_cost']['Nov']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['salary_cost']['Nov']) ? '$' . array_sum($master_arr['salary_cost']['Nov']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['other_cost']['Nov']) ? '$' . array_sum($master_arr['other_cost']['Nov']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['levy_cost']['Nov']) ? '$' . array_sum($master_arr['levy_cost']['Nov']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['cpf_cost']['Nov']) ? '$' . array_sum($master_arr['cpf_cost']['Nov']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['sub_contact_cost']['Nov'])? '$' . array_sum($master_arr['sub_contact_cost']['Nov']): '$0.00' }}
                            </td>
                            <td class="custom_width">
                            @php
                                    $product_cost_Nov = 0;
                                    if (isset($master_arr['product_cost']['Nov'])) {
                                        $product_cost_Nov = array_sum($master_arr['product_cost']['Nov']);
                                    }
                                    $salary_cost_Nov = 0;
                                    if (isset($master_arr['salary_cost']['Nov'])) {
                                        $salary_cost_Nov = array_sum($master_arr['salary_cost']['Nov']);
                                    }
                                    $other_cost_Nov = 0;
                                    if (isset($master_arr['other_cost']['Nov'])) {
                                        $other_cost_Nov = array_sum($master_arr['other_cost']['Nov']);
                                    }
                                    $levy_cost_Nov = 0;
                                    if (isset($master_arr['levy_cost']['Nov'])) {
                                        $levy_cost_Nov = array_sum($master_arr['levy_cost']['Nov']);
                                    }
                                    $cpf_cost_Nov = 0;
                                    if (isset($master_arr['cpf_cost']['Nov'])) {
                                        $cpf_cost_Nov = array_sum($master_arr['cpf_cost']['Nov']);
                                    }
                                    $sub_contact_cost_Nov = 0;
                                    if (isset($master_arr['sub_contact_cost']['Nov'])) {
                                        $sub_contact_cost_Nov = array_sum($master_arr['sub_contact_cost']['Nov']);
                                    }
                                    
                                    $total_Nov =  $product_cost_Nov + $salary_cost_Nov + $other_cost_Nov + $levy_cost_Nov + $cpf_cost_Nov + $sub_contact_cost_Nov;
                                    echo $total_Nov;
                                @endphp    
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['monthly_paid_material_cost']['Nov'])? '$' . array_sum($master_arr['monthly_paid_material_cost']['Nov']): '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['monthly_payment_cost']['Nov'])? '$' . array_sum($master_arr['monthly_payment_cost']['Nov']): '$0.00' }}
                            </td>
                            <td class="custom_width">
                            @php
                            $monthly_payment_Nov = 0;
                               if(isset($master_arr['monthly_payment_cost']['Nov'])){
                                   $monthly_payment_Nov = array_sum($master_arr['monthly_payment_cost']['Nov']);
                               }
                                echo $monthly_payment_Nov - $total_Nov . "$";
                            @endphp     
                            </td>


                        </tr>
                        <tr>

                            <td class="custom_width">Dec-{{ $year1 }} </td>
                            <td class="custom_width">
                                {{ isset($master_arr['product_cost']['Dec']) ? '$' . array_sum($master_arr['product_cost']['Dec']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['salary_cost']['Dec']) ? '$' . array_sum($master_arr['salary_cost']['Dec']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['other_cost']['Dec']) ? '$' . array_sum($master_arr['other_cost']['Dec']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['levy_cost']['Dec']) ? '$' . array_sum($master_arr['levy_cost']['Dec']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['cpf_cost']['Dec']) ? '$' . array_sum($master_arr['cpf_cost']['Dec']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['sub_contact_cost']['Dec'])? '$' . array_sum($master_arr['sub_contact_cost']['Dec']): '$0.00' }}
                            </td>
                            <td class="custom_width">
                            @php
                                    $product_cost_Dec = 0;
                                    if (isset($master_arr['product_cost']['Dec'])) {
                                        $product_cost_Dec = array_sum($master_arr['product_cost']['Dec']);
                                    }
                                    $salary_cost_Dec = 0;
                                    if (isset($master_arr['salary_cost']['Dec'])) {
                                        $salary_cost_Dec = array_sum($master_arr['salary_cost']['Dec']);
                                    }
                                    $other_cost_Dec = 0;
                                    if (isset($master_arr['other_cost']['Dec'])) {
                                        $other_cost_Dec = array_sum($master_arr['other_cost']['Dec']);
                                    }
                                    $levy_cost_Dec = 0;
                                    if (isset($master_arr['levy_cost']['Dec'])) {
                                        $levy_cost_Dec = array_sum($master_arr['levy_cost']['Dec']);
                                    }
                                    $cpf_cost_Dec = 0;
                                    if (isset($master_arr['cpf_cost']['Dec'])) {
                                        $cpf_cost_Dec = array_sum($master_arr['cpf_cost']['Dec']);
                                    }
                                    $sub_contact_cost_Dec = 0;
                                    if (isset($master_arr['sub_contact_cost']['Dec'])) {
                                        $sub_contact_cost_Dec = array_sum($master_arr['sub_contact_cost']['Dec']);
                                    }
                                    
                                    $total_Dec =  $product_cost_Dec + $salary_cost_Dec + $other_cost_Dec + $levy_cost_Dec + $cpf_cost_Dec + $sub_contact_cost_Dec;
                                    echo $total_Dec;
                                @endphp    
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['monthly_paid_material_cost']['Dec'])? '$' . array_sum($master_arr['monthly_paid_material_cost']['Dec']): '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['monthly_payment_cost']['Dec'])? '$' . array_sum($master_arr['monthly_payment_cost']['Dec']): '$0.00' }}
                            </td>
                            <td class="custom_width">
                            @php
                            $monthly_payment_Dec = 0;
                               if(isset($master_arr['monthly_payment_cost']['Dec'])){
                                   $monthly_payment_Dec = array_sum($master_arr['monthly_payment_cost']['Dec']);
                               }
                                echo $monthly_payment_Dec - $total_Dec . "$";
                            @endphp     
                            </td>


                        </tr>
                        <tr>

                            <td class="custom_width">Jan-{{ $year2 }} </td>
                            <td class="custom_width">
                                {{ isset($master_arr['product_cost']['Jan']) ? '$' . array_sum($master_arr['product_cost']['Jan']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['salary_cost']['Jan']) ? '$' . array_sum($master_arr['salary_cost']['Jan']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['other_cost']['Jan']) ? '$' . array_sum($master_arr['other_cost']['Jan']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['levy_cost']['Jan']) ? '$' . array_sum($master_arr['levy_cost']['Jan']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['cpf_cost']['Jan']) ? '$' . array_sum($master_arr['cpf_cost']['Jan']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['sub_contact_cost']['Jan'])? '$' . array_sum($master_arr['sub_contact_cost']['Jan']): '$0.00' }}
                            </td>
                            <td class="custom_width">
                            @php
                                    $product_cost_jan = 0;
                                    if (isset($master_arr['product_cost']['Jan'])) {
                                        $product_cost_jan = array_sum($master_arr['product_cost']['Jan']);
                                    }
                                    $salary_cost_jan = 0;
                                    if (isset($master_arr['salary_cost']['Jan'])) {
                                        $salary_cost_jan = array_sum($master_arr['salary_cost']['Jan']);
                                    }
                                    $other_cost_jan = 0;
                                    if (isset($master_arr['other_cost']['Jan'])) {
                                        $other_cost_jan = array_sum($master_arr['other_cost']['Jan']);
                                    }
                                    $levy_cost_jan = 0;
                                    if (isset($master_arr['levy_cost']['Jan'])) {
                                        $levy_cost_jan = array_sum($master_arr['levy_cost']['Jan']);
                                    }
                                    $cpf_cost_jan = 0;
                                    if (isset($master_arr['cpf_cost']['Jan'])) {
                                        $cpf_cost_jan = array_sum($master_arr['cpf_cost']['Jan']);
                                    }
                                    $sub_contact_cost_jan = 0;
                                    if (isset($master_arr['sub_contact_cost']['Jan'])) {
                                        $sub_contact_cost_jan = array_sum($master_arr['sub_contact_cost']['Jan']);
                                    }
                                    
                                     $total_Jan =  $product_cost_jan + $salary_cost_jan + $other_cost_jan + $levy_cost_jan + $cpf_cost_jan + $sub_contact_cost_jan;
                                    echo $total_Jan;
                                @endphp    
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['monthly_paid_material_cost']['Jan'])? '$' . array_sum($master_arr['monthly_paid_material_cost']['Jan']): '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['monthly_payment_cost']['Jan'])? '$' . array_sum($master_arr['monthly_payment_cost']['Jan']): '$0.00' }}
                            </td>
                            <td class="custom_width">
                            @php
                            $monthly_payment_Jan = 0;
                               if(isset($master_arr['monthly_payment_cost']['Jan'])){
                                   $monthly_payment_Jan = array_sum($master_arr['monthly_payment_cost']['Jan']);
                               }
                                echo $monthly_payment_Jan - $total_Jan . "$";
                            @endphp     
                            </td>


                        </tr>
                        <tr>

                            <td class="custom_width">Feb-{{ $year2 }} </td>
                            <td class="custom_width">
                                {{ isset($master_arr['product_cost']['Feb']) ? '$' . array_sum($master_arr['product_cost']['Feb']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['salary_cost']['Feb']) ? '$' . array_sum($master_arr['salary_cost']['Feb']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['other_cost']['Feb']) ? '$' . array_sum($master_arr['other_cost']['Feb']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['levy_cost']['Feb']) ? '$' . array_sum($master_arr['levy_cost']['Feb']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['cpf_cost']['Feb']) ? '$' . array_sum($master_arr['cpf_cost']['Feb']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['sub_contact_cost']['Feb'])? '$' . array_sum($master_arr['sub_contact_cost']['Feb']): '$0.00' }}
                            </td>
                            <td class="custom_width">
                            @php
                                    $product_cost_Feb = 0;
                                    if (isset($master_arr['product_cost']['Feb'])) {
                                        $product_cost_Feb = array_sum($master_arr['product_cost']['Feb']);
                                    }
                                    $salary_cost_Feb = 0;
                                    if (isset($master_arr['salary_cost']['Feb'])) {
                                        $salary_cost_Feb = array_sum($master_arr['salary_cost']['Feb']);
                                    }
                                    $other_cost_Feb = 0;
                                    if (isset($master_arr['other_cost']['Feb'])) {
                                        $other_cost_Feb = array_sum($master_arr['other_cost']['Feb']);
                                    }
                                    $levy_cost_Feb = 0;
                                    if (isset($master_arr['levy_cost']['Feb'])) {
                                        $levy_cost_Feb = array_sum($master_arr['levy_cost']['Feb']);
                                    }
                                    $cpf_cost_Feb = 0;
                                    if (isset($master_arr['cpf_cost']['Feb'])) {
                                        $cpf_cost_Feb = array_sum($master_arr['cpf_cost']['Feb']);
                                    }
                                    $sub_contact_cost_Feb = 0;
                                    if (isset($master_arr['sub_contact_cost']['Feb'])) {
                                        $sub_contact_cost_Feb = array_sum($master_arr['sub_contact_cost']['Feb']);
                                    }
                                    
                                    $total_Feb =  $product_cost_Feb + $salary_cost_Feb + $other_cost_Feb + $levy_cost_Feb + $cpf_cost_Feb + $sub_contact_cost_Feb;
                                    echo $total_Feb;
                                @endphp    
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['monthly_paid_material_cost']['Feb'])? '$' . array_sum($master_arr['monthly_paid_material_cost']['Feb']): '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['monthly_payment_cost']['Feb'])? '$' . array_sum($master_arr['monthly_payment_cost']['Feb']): '$0.00' }}
                            </td>
                            <td class="custom_width">
                            @php
                            $monthly_payment_Feb = 0;
                               if(isset($master_arr['monthly_payment_cost']['Feb'])){
                                   $monthly_payment_Feb = array_sum($master_arr['monthly_payment_cost']['Feb']);
                               }
                                echo $monthly_payment_Feb - $total_Feb . "$";
                            @endphp     
                            </td>


                        </tr>
                        <tr>

                            <td class="custom_width">Mar-{{ $year2 }} </td>
                            <td class="custom_width">
                                {{ isset($master_arr['product_cost']['Mar']) ? '$' . array_sum($master_arr['product_cost']['Mar']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['salary_cost']['Mar']) ? '$' . array_sum($master_arr['salary_cost']['Mar']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['other_cost']['Mar']) ? '$' . array_sum($master_arr['other_cost']['Mar']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['levy_cost']['Mar']) ? '$' . array_sum($master_arr['levy_cost']['Mar']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['cpf_cost']['Mar']) ? '$' . array_sum($master_arr['cpf_cost']['Mar']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['sub_contact_cost']['Mar'])? '$' . array_sum($master_arr['sub_contact_cost']['Mar']): '$0.00' }}
                            </td>
                            <td class="custom_width">
                            @php
                                    $product_cost_Mar = 0;
                                    if (isset($master_arr['product_cost']['Mar'])) {
                                        $product_cost_Mar = array_sum($master_arr['product_cost']['Mar']);
                                    }
                                    $salary_cost_Mar = 0;
                                    if (isset($master_arr['salary_cost']['Mar'])) {
                                        $salary_cost_Mar = array_sum($master_arr['salary_cost']['Mar']);
                                    }
                                    $other_cost_Mar = 0;
                                    if (isset($master_arr['other_cost']['Mar'])) {
                                        $other_cost_Mar = array_sum($master_arr['other_cost']['Mar']);
                                    }
                                    $levy_cost_Mar = 0;
                                    if (isset($master_arr['levy_cost']['Mar'])) {
                                        $levy_cost_Mar = array_sum($master_arr['levy_cost']['Mar']);
                                    }
                                    $cpf_cost_Mar = 0;
                                    if (isset($master_arr['cpf_cost']['Mar'])) {
                                        $cpf_cost_Mar = array_sum($master_arr['cpf_cost']['Mar']);
                                    }
                                    $sub_contact_cost_Mar = 0;
                                    if (isset($master_arr['sub_contact_cost']['Mar'])) {
                                        $sub_contact_cost_Mar = array_sum($master_arr['sub_contact_cost']['Mar']);
                                    }
                                    
                                    $total_Mar =  $product_cost_Mar + $salary_cost_Mar + $other_cost_Mar + $levy_cost_Mar + $cpf_cost_Mar + $sub_contact_cost_Mar;
                                    echo $total_Mar;
                                @endphp    
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['monthly_paid_material_cost']['Mar'])? '$' . array_sum($master_arr['monthly_paid_material_cost']['Mar']): '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['monthly_payment_cost']['Mar'])? '$' . array_sum($master_arr['monthly_payment_cost']['Mar']): '$0.00' }}
                            </td>
                            <td class="custom_width">
                                
                            @php
                            $monthly_payment_Mar = 0;
                               if(isset($master_arr['monthly_payment_cost']['Mar'])){
                                   $monthly_payment_Mar = array_sum($master_arr['monthly_payment_cost']['Mar']);
                               }
                                echo $monthly_payment_Mar - $total_Mar . "$";
                            @endphp 
                            </td>


                        </tr>
                        <tr>

                            <td class="custom_width">Apr-{{ $year2 }} </td>
                            <td class="custom_width">
                                {{ isset($master_arr['product_cost']['Apr']) ? '$' . array_sum($master_arr['product_cost']['Apr']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['salary_cost']['Apr']) ? '$' . array_sum($master_arr['salary_cost']['Apr']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['other_cost']['Apr']) ? '$' . array_sum($master_arr['other_cost']['Apr']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['levy_cost']['Apr']) ? '$' . array_sum($master_arr['levy_cost']['Apr']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['cpf_cost']['Apr']) ? '$' . array_sum($master_arr['cpf_cost']['Apr']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['sub_contact_cost']['Apr'])? '$' . array_sum($master_arr['sub_contact_cost']['Apr']): '$0.00' }}
                            </td>
                            <td class="custom_width">
                            @php
                                    $product_cost_Apr = 0;
                                    if (isset($master_arr['product_cost']['Apr'])) {
                                        $product_cost_Apr = array_sum($master_arr['product_cost']['Apr']);
                                    }
                                    $salary_cost_Apr = 0;
                                    if (isset($master_arr['salary_cost']['Apr'])) {
                                        $salary_cost_Apr = array_sum($master_arr['salary_cost']['Apr']);
                                    }
                                    $other_cost_Apr = 0;
                                    if (isset($master_arr['other_cost']['Apr'])) {
                                        $other_cost_Apr = array_sum($master_arr['other_cost']['Apr']);
                                    }
                                    $levy_cost_Apr = 0;
                                    if (isset($master_arr['levy_cost']['Apr'])) {
                                        $levy_cost_Apr = array_sum($master_arr['levy_cost']['Apr']);
                                    }
                                    $cpf_cost_Apr = 0;
                                    if (isset($master_arr['cpf_cost']['Apr'])) {
                                        $cpf_cost_Apr = array_sum($master_arr['cpf_cost']['Apr']);
                                    }
                                    $sub_contact_cost_Apr = 0;
                                    if (isset($master_arr['sub_contact_cost']['Apr'])) {
                                        $sub_contact_cost_Apr = array_sum($master_arr['sub_contact_cost']['Apr']);
                                    }
                                    
                                    $total_Apr =  $product_cost_Apr + $salary_cost_Apr + $other_cost_Apr + $levy_cost_Apr + $cpf_cost_Apr + $sub_contact_cost_Apr;
                                    echo $total_Apr;
                                @endphp    
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['monthly_paid_material_cost']['Apr'])? '$' . array_sum($master_arr['monthly_paid_material_cost']['Apr']): '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['monthly_payment_cost']['Apr'])? '$' . array_sum($master_arr['monthly_payment_cost']['Apr']): '$0.00' }}
                            </td>
                            <td class="custom_width">
                            @php
                            $monthly_payment_Apr = 0;
                               if(isset($master_arr['monthly_payment_cost']['Apr'])){
                                   $monthly_payment_Apr = array_sum($master_arr['monthly_payment_cost']['Apr']);
                               }
                                echo $monthly_payment_Apr - $total_Apr . "$";
                            @endphp     
                            </td>


                        </tr>
                        <tr>

                            <td class="custom_width">May-{{ $year2 }} </td>
                            <td class="custom_width">
                                {{ isset($master_arr['product_cost']['May']) ? '$' . array_sum($master_arr['product_cost']['May']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['salary_cost']['May']) ? '$' . array_sum($master_arr['salary_cost']['May']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['other_cost']['May']) ? '$' . array_sum($master_arr['other_cost']['May']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['levy_cost']['May']) ? '$' . array_sum($master_arr['levy_cost']['May']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['cpf_cost']['May']) ? '$' . array_sum($master_arr['cpf_cost']['May']) : '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['sub_contact_cost']['May'])? '$' . array_sum($master_arr['sub_contact_cost']['May']): '$0.00' }}
                            </td>
                            <td class="custom_width">
                            @php
                                    $product_cost_May = 0;
                                    if (isset($master_arr['product_cost']['May'])) {
                                        $product_cost_May = array_sum($master_arr['product_cost']['May']);
                                    }
                                    $salary_cost_May = 0;
                                    if (isset($master_arr['salary_cost']['May'])) {
                                        $salary_cost_May = array_sum($master_arr['salary_cost']['May']);
                                    }
                                    $other_cost_May = 0;
                                    if (isset($master_arr['other_cost']['May'])) {
                                        $other_cost_May = array_sum($master_arr['other_cost']['May']);
                                    }
                                    $levy_cost_May = 0;
                                    if (isset($master_arr['levy_cost']['May'])) {
                                        $levy_cost_May = array_sum($master_arr['levy_cost']['May']);
                                    }
                                    $cpf_cost_May = 0;
                                    if (isset($master_arr['cpf_cost']['May'])) {
                                        $cpf_cost_May = array_sum($master_arr['cpf_cost']['May']);
                                    }
                                    $sub_contact_cost_May = 0;
                                    if (isset($master_arr['sub_contact_cost']['May'])) {
                                        $sub_contact_cost_May = array_sum($master_arr['sub_contact_cost']['May']);
                                    }
                                    
                                    $total_May =  $product_cost_May + $salary_cost_May + $other_cost_May + $levy_cost_May + $cpf_cost_May + $sub_contact_cost_May;
                                    echo $total_May;
                                @endphp    
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['monthly_paid_material_cost']['May'])? '$' . array_sum($master_arr['monthly_paid_material_cost']['May']): '$0.00' }}
                            </td>
                            <td class="custom_width">
                                {{ isset($master_arr['monthly_payment_cost']['May'])? '$' . array_sum($master_arr['monthly_payment_cost']['May']): '$0.00' }}
                            </td>
                            <td class="custom_width">
                            @php
                            $monthly_payment_May = 0;
                               if(isset($master_arr['monthly_payment_cost']['May'])){
                                   $monthly_payment_May = array_sum($master_arr['monthly_payment_cost']['May']);
                               }
                                echo $monthly_payment_May - $total_May . "$";
                            @endphp     
                            </td>


                        </tr>
                    </tbody>
                </table>
            </div>
        @endisset



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
