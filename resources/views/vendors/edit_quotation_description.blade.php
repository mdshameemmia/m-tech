@extends('layouts.master')
@section('body')

    <div class="row card  p-3" style="background-color:rgb(247, 238, 238)">
               <div class="row m-2">
                    <h1 class="col-md-11">Quotation Description </h1>
                    <p class="col-md-1"><a href="{{route('vendors.index')}}"><button class="btn btn-primary btn-sm"> Back </button></a></p>
               </div>
                <form action="{{route('vendors.quotation-description.update',$quotation_description->id)}}"  method="POST" class="row">
                    @csrf
                   


                      <div class="col-md-12 p-2">
                        


                        <div id="product_description">
                          <div class="row">
                            <label for="" class="col-md-3">Content Title</label>
                            <div class="form-group col-md-9">
                              <textarea name="product_description_title" class="form-control unit text-left" id="" cols="30" rows="3">
                                {{$quotation_description->product_description_title??''}}
                              </textarea>

                              {{-- <input type="text" name="product_description_title"  value="{{$quotation_description->product_description_title??''}}"  class="form-control unit"> --}}
                            </div>
                          </div>
                         <div class="row">
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="">Description</label>
                                <select name="product_id" class="form-control" id="product_id" onchange="getUnit(this)">
                                  <option value="">Select One</option>
                                  @foreach ($products as $product)
                                      <option @if ($quotation_description->product->id == $product->id)
                                          selected
                                      @endif value="{{$product->id??''}}">{{$product->item_name??''}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="">Unit</label>
                                <input type="text" name="unit" value="{{$quotation_description->unit??''}}" readonly class="form-control unit">
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="">Rate</label>
                                <input type="text" name="rate"  value="{{$quotation_description->rate??''}}" class="form-control rate">
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="">Qty</label>
                                <input type="text" name="qty" value="{{$quotation_description->qty??''}}" class="form-control qty">
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="">Amount </label>
                                <input type="text" name="amount" value="{{$quotation_description->amount??''}}" readonly class="form-control amount">
                              </div>
                            </div>
                          </div>
                        </div>
                      
                      </div>
                 </div>
                   
                    <div class="form-group  mx-0 px-0 ">
                      <button type="submit" class="btn btn-sm btn-primary mx-2 ">Save </button>
                     
                    </div>


                </form>
               
          
    </div>
@endsection

@push('js')
<script src="{{asset('js/flatpickr.js')}}"></script>
  <script src="{{asset('js/sweetalert2.min.css')}}"></script>

    <script>
       $(".date").flatpickr();

    </script>

    <script>

   
      
      
      // set amount value 
      $(document).ready(function(){
      $(".qty").on('keyup',function(){
        let qty = $(".qty").val();
        let rate = $(this).closest('.row').find('.rate').val();
        if(rate && qty){
          let amount = $(this).closest('.row').find('.amount').val(parseInt(qty)*parseInt(rate));
        }
      })
      $(".rate").on('keyup',function(){
        let qty = $(".qty").val();
        let rate = $(this).closest('.row').find('.rate').val();
        if(rate && qty){
          let amount = $(this).closest('.row').find('.amount').val(parseInt(qty)*parseInt(rate));
        }
      })
     })

     function setAmount(data)
     {
      let rate = $(data).closest('.row').find('.rate').val();
      let qty = $(data).closest('.row').find('.qty').val();
      if(rate && qty){
        let amount = $(data).closest('.row').find('.amount').val(parseInt(rate) * parseInt(qty));
      }

     }


     // get title 
     $(document).ready(function(){
       $("#company_id").on('change',function(){
        let id = $("#company_id :selected").val();
            $.ajax({
          url:"/get-title-by-compnay",
          method:"GET",
          data:{
            id:id
          },
            success: function(res) {
              
              let company = res.company;
              $("input[name=tel]").val(company.tel);
              $("input[name=fax]").val(company.fax);
              $("input[name=attention]").val(company.attention);

              let titleContainer = $("select[name=title]");
              let titleContent = `<option value=''>Select One</option>`;
              let titles = res.titles;
              
              titles.forEach(title=>{
                titleContent += `<option value="${title.title}">${title.title}</option>`
              })
              titleContainer.html(titleContent)

          }
        });
      })
     })


     // get unit 

     function getUnit(data){
      let product_id = data.value;
              $.ajax({
            url:"/get-unit-by-compnay",
            method:"GET",
            data:{
              product_id:product_id
            },
              success: function(res) {
               $(data).closest('.row').find('.unit').val(res.unit);

            }
          });
     }
    </script>

@endpush

@push('css')
    <link href="{{asset('css/flatpickr.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset("css/sweetalert2.min.css")}}">
    <style>
        .form-control{
            background-color: #fff !important ;
        }

        .amount,.tel,.fax,.attention{
          background-color: #d5caca  !important;
        }

       
    </style>
@endpush

