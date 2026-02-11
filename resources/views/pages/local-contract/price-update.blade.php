<x-default-layout>
  <style>
    tr {
      cursor: pointer;
    }
  </style>
  <!--begin::Toolbar-->
  <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

      <!--begin::Toolbar container-->
      <div id="kt_app_toolbar_container" class="">

          <!--begin::Page title-->
          <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
              <!--begin::Title-->
              <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                  Price Update
              </h1>
              <!--end::Title-->


              <!--begin::Breadcrumb-->
              <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                  <!--begin::Item-->
                  <li class="breadcrumb-item text-muted">
                      <a href="/" class="text-muted text-hover-primary">
                          Dashboard </a>
                  </li>
                  <!--end::Item-->
                  <!--begin::Item-->
                  <li class="breadcrumb-item">
                      <span class="bullet bg-gray-400 w-5px h-2px"></span>
                  </li>
                  <!--end::Item-->

                  <!--begin::Item-->
                  <li class="breadcrumb-item text-muted">
                      Price Update </li>
                  <!--end::Item-->

              </ul>
              <!--end::Breadcrumb-->
          </div>
          <!--end::Page title-->

      </div>
      <!--end::Toolbar container-->
  </div>
  <!--end::Toolbar-->

<!--begin::Table widget 14-->
<div class="card card-flush h-md-100">
    <!--begin::Body-->
    <div class="card-body pb-4 pt-6">
            <div class="row">

                <div class="col-md-12 justify-content-center">
                    <div class="row d-none" id="contract-details">
                       <div class="col">
                          <label class="form-label">Bussiness </label>
                          <input type="text" disabled value="" class="form-control form-control-sm" id="contract-bussiness">
                        </div>
                        <div class="col">
                            <label class="form-label">Contract Date </label>
                            <input type="text" disabled value="" class="form-control form-control-sm" id="contract-date">
                        </div>

                        <div class="col">
                          <label class="form-label">Lifting Date</label>
                          <input type="text" disabled value="" class="form-control form-control-sm" id="contract-lifting-date">
                        </div>

                        <div class="col">
                          <label class="form-label">Product</label>
                          <input type="text" disabled value="" class="form-control form-control-sm" id="contract-product">
                        </div>

                        <div class="col">
                          <label class="form-label">Buyer</label>
                          <input type="text" disabled value="" class="form-control form-control-sm" id="contract-buyer">
                        </div>

                        <div class="col-md-12 mt-4">
                          <div class="row justify-content-center">
                            <div class="col-md-2">
                              <label class="form-label">Cont. Qty</label>
                              <input type="text" disabled value="" class="form-control form-control-sm" id="contract-qty">
                            </div>
    
                            <div class="col-md-2">
                              <label class="form-label">Selling Price</label>
                              <input type="text" disabled value="" class="form-control form-control-sm" id="contract-selling-price">
                            </div>
    
                            <div class="col-md-2">
                              <label class="form-label">Payment Terms</label>
                              <input type="text" disabled value="" class="form-control form-control-sm" id="contract-payment-terms">
                            </div>
    
                          </div>
                        </div>

                    </div>
                </div>

            
            </div>

          </div>
          <!--end: Card Body-->
      </div>
      <!--end::Table widget 14-->

        <div class="row">
          
          <div class="col-lg-3">
              <!--begin::Table widget 14-->
      <div class="card card-flush mt-5 h-md-100">
          <!--begin::Body-->
          <div class="card-body px-3 pt-3">

              <form class="pt-1 d-none" method="POST" action="" id="price-form" enctype="multipart/form-data">
                  @csrf
                  @method('POST')

              <!--begin::Repeater-->
              <div>
                  <!--begin::Form group-->
                  <div class="form-group">
                      <div class="mb-5">
                          <div class="rounded-3 p-3">
                              <div class="form-group row gy-3 justify-content-center">

                                  <div class="col-md-12">
                                      <label class="form-label">Rate <span class="text-danger">*</span></label>
                                      <div class="input-group" id="rate">
                                        <span class="input-group-text" id="basic-addon1">PKR</span>
                                        <input type="number" class="form-control form-control-lg border-dark" placeholder="Rate (Per Maund)" name="rate"  />
                                      </div>
                                  </div>
                                  <div class="col-md-12">
                                    <label for="voyage_number" class="form-label">FX Rate</label>
                                    <div class="input-group" id="fx_rate">
                                      <span class="input-group-text" id="basic-addon1">PKR</span>
                                      <input type="number" class="form-control form-control-lg border-dark" placeholder="FX Rate" name="fx_rate" />
                                    </div>
                                  </div>
                                  <div class="col-md-12">
                                    <label for="voyage_number" class="form-label">Final Price</label>
                                    <div class="input-group" id="final_price">
                                      <span class="input-group-text" id="basic-addon1">USD</span>
                                      <input type="number" class="form-control form-control-lg border-dark" placeholder="Final Price" name="final_price" />
                                    </div>
                                </div>

                              </div>
                          </div>
                      </div>
                  </div>
                  <!--end::Form group-->

              </div>
              <!--end::Repeater-->
              <div class="text-center">
                  <button type="button" id="submit-btn" class="btn btn-sm btn-light fw-bold btn-primary me-2">Update</button>
              </div>

            </form>

          </div>
          <!--end: Card Body-->
      </div>
   <!--end::Table widget 14-->
          </div>

  <div class="col-lg-9">
              {{-- All BLs --}}
      <div class="card card-flush mt-5 h-md-100">
          <div class="card-body px-4 pt-4">

            <div class="row">
              <div class="col-md-3">
                <select class="form-select" id="buyer">
                  <option disabled selected>-- Buyer --</option>
                  <option value="">All</option>
                  @foreach ($buyers as $buyer)
                      <option value="{{ $buyer->name }}">{{ $buyer->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-3">
                <input type="text" id="contract_num" class="form-control" placeholder="Cont. Ref#">
              </div>
              <div class="col-md-3">
                <select class="form-select" id="product">
                  <option disabled selected>-- Product --</option>  
                  <option value="">All</option>
                  @foreach ($products as $product)
                      <option value="{{ $product->name }}">{{ $product->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="table-responsive">
              <table class="table align-middle table-row-bordered table-hover mt-5" id="bl-table">
                  <thead class="bg-secondary fw-bold">
                      <tr>
                          <th>Contract #</th>
                          <th>PRD</th>
                          <th>Buyer</th>
                          <th>Cont. Qty</th>
                          <th>Price</th>
                      </tr>
                  </thead>
                  <tbody id="bls-tbody">
                      @foreach ($contracts as $contract)
                          <tr data-form-action="{{ url('update-contract-price',$contract->id) }}" data-route="{{ route('get.contract',$contract->id) }}">
                            <td>{{ $contract->code }}</td>
                            <td>{{ $contract->product->name ?? 'N/A' }}</td>
                            <td>{{ $contract->buyer->name ?? 'N/A' }}</td>
                            <td>{{ $contract->quantity }}</td>
                            <td>{{ $contract->selling_price }}</td>
                          </tr>
                      @endforeach
                  </tbody>
              </table>
            </div>
          </div>
      </div>
  {{-- End BLs --}}
          </div>

        </div>



{!! theme()->addVendor('formrepeater') !!}
@push('scripts')
<script src="https://malsup.github.io/jquery.form.js"></script> 

<script>
  $(document).on("click","tr", function () {
      $('#price-form').removeClass('d-none');
      $('#contract-details').removeClass('d-none');
      var url = $(this).attr('data-route');
      var form_action = $(this).attr('data-form-action');

      $('#price-form').attr('action',form_action);

      $.ajax({
        type:'GET',
        url: url,
        data: {},
        success:function(response) {
            var data = response.data;
            $('input[name="rate"]').val(data.rate);
            $('input[name="fx_rate"]').val(data.fx_rate);
            $('input[name="final_price"]').val(data.final_price);

            $('#contract-bussiness').val(data.bussiness);
            $('#contract-date').val(data.date);
            $('#contract-lifting-date').val(data.lifting_date);
            $('#contract-product').val(data.product);
            $('#contract-buyer').val(data.buyer);
            $('#contract-qty').val(data.quantity);
            $('#contract-selling-price').val(data.selling_price);
            $('#contract-payment-terms').val(data.payment_terms);
            $('#contract-remarks').val(data.remarks);
        }
      });


  });
</script>

  <script>
    $(document).on("click","#submit-btn", function (e) {
         e.preventDefault();

         $("#price-form").ajaxSubmit(
            {
              type: 'post',
              success:    function(response) {               
                  $('#price-form')[0].reset();
                  $('#price-form').addClass('d-none');
                  $('#contract-details').addClass('d-none');
                  swal("Price Updated Successfully!", "", "success");
              },
              error:    function() {
                  swal("Error Occured!", "", "warning");
              }
            }
          );

    });
  </script>

  <script>
    $(document).ready(function () {
      
      var table = $('#bl-table').DataTable({
        paging: false,
        info: false,
        sorting: false
      });

      $('#buyer').on('change', function() {
          table.column(2).search(this.value).draw();
      });

      $('#product').on('change', function() {
          table.column(1).search(this.value).draw();
      });

      $('#contract_num').on('keyup', function() {
          table.column(0).search(this.value).draw();
      });

    });
  </script>
@endpush
</x-default-layout>