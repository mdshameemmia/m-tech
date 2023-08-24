@extends('layouts.master')
@section('body')

    <div class="row card " style="background-color:rgb(247, 238, 238)">
               <div class="row m-2 px-3">
                    <h1 class="col-md-11">Quotation </h1>
                    <p class="col-md-1"><a href="{{route('vendors.index')}}"><button class="btn btn-primary btn-sm"> Back </button></a></p>
               </div>
                <form action="{{route('vendors.store')}}"  method="POST" class="row">
                    @csrf
                    <div class="col-md-12 px-5">
                      <div class="form-group  ">
                        <label for="" class="col-md-12 font-weight-bold">Company Name    </label>
                        <select name="company_id" class="form-control mx-2" id="company_id">
                          <option value="">Select One</option>
                          @foreach ($companies as $company)
                              <option value="{{$company->id??''}}">{{$company->name??''}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group  ">
                        <label for="" class="col-md-12 font-weight-bold">Title</label>
                        <select name="project_id" class="form-control mx-2" id="">
                          <option value="">Select One</option>
                          
                        </select>

                      </div>
                      
                      <div class="form-group  ">
                        <label for="" class="col-md-12 font-weight-bold">Telephone  </label>
                        <input type="text" name="tel" id="" class="form-control mx-2 tel" readonly placeholder="" aria-describedby="helpId">
                      </div>
                      <div class="form-group  ">
                        <label for="" class="col-md-12 font-weight-bold">Fax  </label>
                        <input type="text" name="fax" id="" class="form-control mx-2 fax" readonly placeholder="" aria-describedby="helpId">
                      </div>
                      <div class="form-group  ">
                        <label for="" class="col-md-12 font-weight-bold">Attention  </label>
                        <input type="text" name="attention" id="" class="form-control mx-2 attention " readonly placeholder="" aria-describedby="helpId">
                      </div>
  
                      <div class="form-group  ">
                        <label for="" class="col-md-12 font-weight-bold"> Date    </label>
                        <input type="text" name="date" id="" class="form-control mx-2 date" placeholder="" aria-describedby="helpId">
                      </div>

                     </div>
                   
                    <div class="form-group  mx-4 px-3 ">
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

      $(".btn-icon").on('click',function(){
        $("#product_description").append(`
                        <div class="row">
                        <div class="col-md-3">
                           <div class="form-group">
                             <select name="product_id[]" class="form-control" onchange="getUnit(this)" id="product_id">
                               <option value="">Select One</option>
                               @foreach ($products as $product)
                                   <option value="{{$product->id??''}}">{{$product->item_name??''}}</option>
                               @endforeach
                             </select>
                           </div>
                         </div>
                         <div class="col-md-2">
                           <div class="form-group">
                             <input type="text" name="unit[]" readonly  class="form-control unit">
                           </div>
                         </div>
                         <div class="col-md-2">
                           <div class="form-group">
                             <input type="text" name="rate[]" onkeyup="setAmount(this)" class="form-control rate">
                           </div>
                         </div>
                         <div class="col-md-2">
                           <div class="form-group">
                             <input type="text" name="qty[]" onkeyup="setAmount(this)" class="form-control qty">
                           </div>
                         </div>
                         <div class="col-md-3">
                           <div class="form-group">
                             <input type="text" name="amount[]"  readonly class="form-control amount">
                           </div>
                         </div>
                         </div>
                        `)
      })
      $(".content-description").on('click',function(){
        $("#product_description").append(`
          <div class="row">
            <label for="" class="col-md-3">Content Title</label>
            <div class="form-group col-md-9">
            <input type="text" name="content_description[]"   class="form-control unit">
            </div>
          </div>
        `)
      })

      
      
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
             console.log(res)
              let company = res.company;
              $("input[name=tel]").val(company.tel);
              $("input[name=fax]").val(company.fax);
              $("input[name=attention]").val(company.attention);
              let titleContainer = $("select[name=project_id]");
              let titleContent = `<option value=''>Select One</option>`;
              let titles = res.titles;
              console.log(titles)
              titles.forEach(title=>{
                titleContent += `<option value="${title.id}">${title.title}</option>`
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

