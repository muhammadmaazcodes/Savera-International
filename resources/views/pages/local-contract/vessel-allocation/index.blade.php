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
                  Vessel Allocation
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
                      Vessel Allocation </li>
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
<div class="card card-flush h-md-100 mb-3">
  <!--begin::Body-->
  <div class="card-body pb-4 pt-6">
          <div class="row">

              <div class="col-md-12">
                  <div class="row d-none" id="contract-details">
                     <div class="col">
                        <p class="mb-0 h5">Bussiness </p>
                        <p id="contract-bussiness"></p>
                      </div>
                      <div class="col">
                        <p class="mb-0 h5">Contract Date </p>
                        <p id="contract-date"></p>
                      </div>

                      <div class="col">
                        <p class="mb-0 h5">Lifting Date </p>
                        <p id="contract-lifting-date"></p>
                      </div>

                      <div class="col">
                        <p class="mb-0 h5">Product</p>
                        <p id="contract-product"></p>
                      </div>

                      <div class="col">
                        <p class="mb-0 h5">Buyer</p>
                        <p id="contract-buyer"></p>
                      </div>

                      <div class="col">
                        <p class="mb-0 h5">Cont. Qty</p>
                        <p id="contract-qty"></p>
                      </div>

                      <div class="col">
                        <p class="mb-0 h5">Selling Price</p>
                        <p id="contract-selling-price"></p>
                      </div>

                      <div class="col">
                        <p class="mb-0 h5">Payment Terms</p>
                        <p id="contract-payment-terms"></p>
                      </div>

                  </div>
              </div>

          
          </div>

        </div>
        <!--end: Card Body-->
    </div>
    <!--end::Table widget 14-->

    <div class="row">
          
      <div class="col-lg-5">
        <!--begin::Table widget 14-->
        <div class="card card-flush mt-5 h-md-100">
          <!--begin::Body-->
          <div class="card-body px-3 pt-3">

              <form class="pt-1 d-none" method="POST" action="" id="price-form" enctype="multipart/form-data">
                  @csrf
                  @method('POST')

                <div class="form-group">
                  <div class="form-group row gy-3 ">
                    <div class="col-md-12 mb-2">
                      <p><strong>Cont. Code : </strong><span id="con-code"></span></p>
                      </div>
                      <div class="col-md-4">
                          <label class="form-label">Vessel</label>
                      </div>
                      <div class="col-md-4">
                          <label class="form-label">Quantity</label>
                      </div>
                      <div class="col-md-4">
                        <label class="form-label">Remove</label>
                    </div>
                  </div>
              </div>
              <!--begin::Repeater-->
              <div id="kt_docs_repeater_basic">
                  <!--begin::Form group-->
                  <div class="form-group">
                      <div class="mb-5" data-repeater-list="vessel_allocations">
                          
                          <div class="rounded-3 p-3 border border-secondary mb-2" data-repeater-item>
                              <div class="form-group row gy-3 justify-content-center">
                                  <div class="col-md-4">
                                      <select name="inventory_id" class="form-control form-control-sm new-allocation-vessels vessel_show">
                                        <option disabled selected value="">--</option>
                                        @foreach ($vessels as $vessel)
                                            <option value="{{ $vessel->id }}" data-remaining="{{ $vessel->unsold_qty() }}" data-seller="{{ $vessel->seller->name }}">{{ $vessel->vessel->name }}</option>
                                        @endforeach
                                      </select>
                                  </div>
                                <div class="col-md-4">
                                  <input type="number" name="quantity" class="form-control form-control-sm" step="0.001">
                                </div>
                              <div class="col-md-4">
                                <a href="javascript:;" data-repeater-delete
                                    class="btn btn-sm btn-light-danger">
                                    <i class="fa fa-cancel"></i>
                                </a>
                            </div>
                            <div class="col-12"><span class="vessel_show_details"></span></span></div>
                              </div>
                          </div>

                      </div>

                      <div id="show-allocations"></div>
                      

                    <div class="mb-3">
                      <a href="javascript:;" data-repeater-create class="btn btn-light-primary btn-sm">
                          <i class="ki-duotone ki-plus fs-3"></i>
                          Add
                      </a>
                    </div>

                  </div>
                  <!--end::Form group-->

              </div>
              <!--end::Repeater-->


              <div class="text-center">
                  <button type="submit" id="submit-btn" class="btn btn-sm btn-light fw-bold btn-primary me-2">Allocate</button>
              </div>

            </form>

          </div>
          <!--end: Card Body-->
      </div>
   <!--end::Table widget 14-->
          </div>

  <div class="col-lg-7">
              {{-- All BLs --}}
      <div class="card card-flush mt-5 h-md-100">
          <div class="card-body px-4 pt-4">

            <div class="row">
              <div class="col-md-3">
                <select class="form-select" id="buyer">
                  <option disabled selected>-- Buyer --</option>
                  <option value="">All</option>
                  @foreach ($companies as $buyer)
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
                      <option value="{{ $product->code }}">{{ $product->code }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="table-responsive">
              <table class="table align-middle table-row-bordered table-hover mt-5" id="bl-table">
                  <thead class="bg-secondary fw-bold">
                      <tr>
                          <th>Contract#</th>
                          <th>PRD</th>
                          <th>Buyer</th>
                          <th><small>Contract</small> Qty</th>
                          <th>Allocated Qty.</th>
                          <th>Unallocated Qty.</th>
                          <th>Price</th>
                          <th hidden>Seller</th>
                      </tr>
                  </thead>
                  <tbody id="bls-tbody">
                      @foreach ($contracts as $contract)
                          <tr data-form-action="{{ route('allocate.vessel',$contract->id) }}" data-route="{{ route('get.contract',$contract->id) }}" data-id="{{ $contract->id }}">
                            <td>{{ $contract->code }}</td>
                            <td>{{ $contract->product->code ?? 'N/A' }}</td>
                            <td>{{ $contract->buyer->name ?? 'N/A' }}</td>
                            <td>{{ number_format($contract->quantity,3) }}</td>
                            <td>{{ number_format($contract->allocations->sum('quantity'),3) ?? '0' }}</td>
                            <td>{{ $contract->unallocated_qty() ?? '0' }}</td>
                            <td>{{ number_format($contract->selling_price) }}</td>
                            <td hidden>{{ $contract->business->name ?? 'N/A' }}</td>
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

        <input type="hidden" id="product_id">

{!! theme()->addVendor('formrepeater') !!}
@push('scripts')
<script src="https://malsup.github.io/jquery.form.js"></script>
@if (Session::has('success'))
<script>
  swal("{{ Session::get('success') }}","","success")
</script>
@elseif (Session::has('warning'))
<script>
  swal("{{ Session::get('warning') }}","","warning")
</script>
@endif
@if (Session::has('contract-id'))
<script>
  $(document).ready(function () {
      $('tr[data-id="{{ Session::get("contract-id") }}"]').trigger('click');
  });
</script>
@endif
@if (Request::has('contract_id'))
<script>
  $(document).ready(function () {
      $('tr[data-id="{{ Request::get("contract_id") }}"]').trigger('click');
  });
</script>
@endif
@if (Session::has('product-update'))
<script>
  $(document).ready(function () {
      $('tr[data-id="{{ Session::get("product-update") }}"]').trigger('click');
      swal("All existing Vessel/BL allocations has been removed","","success")
  });
</script>
@endif
<script>
  $('#kt_docs_repeater_basic').repeater({
      initEmpty: true,

      defaultValues: {
          'text-input': 'foo'
      },

      show: function() {
          $(this).slideDown();
      },

      hide: function(deleteElement) {
          $(this).slideUp(deleteElement);
      }
  });
</script>
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
            $('#con-code').text(data.code);
            $('#product_id').val(data.product_id);
            if (response.count_allocation > 0) {
              $('#allocations-heading').show();
              $('#show-allocations').html(response.allocations);
            }
            else {
              $('#allocations-heading').hide();
              $('#show-allocations').html('');
            }
            
            $('.new-allocation-vessels').html(response.contract_product_vessel);
            $('#contract-bussiness').text(data.bussiness);
            $('#contract-date').text(data.date);
            $('#contract-lifting-date').text(data.lifting_date);
            $('#contract-product').text(data.product);
            $('#contract-buyer').text(data.buyer);
            $('#contract-qty').text(data.quantity);
            $('#contract-selling-price').text(data.selling_price);
            $('#contract-payment-terms').text(data.payment_terms);
            $('#contract-remarks').text(data.remarks);

        }
      });

  });
</script>

  <script>
    $(document).ready(function () {
      var table = $('#bl-table').DataTable({
        info: false,
        paging : true,
        pageLength: 10
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
    
    $('body').on('change', '.vessel_show', function() {
        var $t = $(this); 
        var vessel_seller = $(this).find(':selected').data('seller');
        var product_id = $('#product_id').val();
        var vessel_id = $(this).val();
      
      var url = "{{ url('') }}"+"/get-unsold-qty-product/"+vessel_id+"/"+product_id;
      
      $.ajax({
        type: "GET",
        url: url,
        data: {},
        success: function (response) {
          $t.closest('.row').find('.vessel_show_details').text('Unsold Qty:' + response + ' Seller:' + vessel_seller);
          $t.parent().parent().find('input').attr('max',response);
        }
      });


    });
  </script>

  <script>
    $(document).on("click",".confirm-delete", function () {
      
      var url = $(this).attr('data-route');
      swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover this record!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            window.location.href =url;
          } else {
            swal("Your record is safe!");
          }
        });
    });
  </script>

@endpush
</x-default-layout>