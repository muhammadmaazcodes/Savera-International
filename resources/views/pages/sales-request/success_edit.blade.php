<x-default-layout>
  <style>
  input[type='text'],
  input[type='date'],
  input[type='number'],
  textarea,
  select {
      background:#f5f8fa !important
  }
  .form-check-input {
      border-color: #000;
      width: 1.3em;
      height: 1.3em;
  }
  .table-responsive {
        overflow-x: visible;
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
                  Allocation Sales
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
                    Allocation Sales </li>
                  <!--end::Item-->

              </ul>
              <!--end::Breadcrumb-->
          </div>
          <!--end::Page title-->

      </div>
      <!--end::Toolbar container-->
  </div>
  <!--end::Toolbar-->

  <div class="accordion" id="accordionExample">
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button class="accordion-button bg-secondary fw-bold text-dark fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            Filter Allocation Sales
          </button> 
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
          <div class="accordion-body">
              <div class="row">
                  <div class="col-md-3">
                      <select name="buyer" id="buyer" class="form-control">
                          <option disabled selected>Search Buyer</option>
                          <option value="">All</option>
                          @foreach ($buyers as $buyer)
                              <option value="{{ $buyer->name }}">{{ $buyer->name }}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="col-md-3">
                      <select name="vessel" id="vessel" class="form-control">
                          <option disabled selected>Search Vessel</option>
                          <option value="">All</option>
                          @foreach ($vessels as $vessel)
                              <option value="{{ $vessel->vessel->name }}">{{ $vessel->vessel->name }}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="col-md-3">
                      <select name="product" id="product" class="form-control">
                          <option disabled selected>Search Product</option>
                          <option value="">All</option>
                          @foreach ($products as $product)
                              <option value="{{ $product->code }}">{{ $product->code }}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="col-md-3">
                      <input type="text" name="vehicle" id="vehicle" placeholder="Vehicle Number" class="form-control">
                  </div>


              </div>
          </div>
        </div>
      </div>
    </div>

        <div class="row">
          
          <div class="col-lg-5">
              <!--begin::Table widget 14-->
      <div class="card card-flush mt-5 h-md-100">
          <!--begin::Body-->
          <div class="card-body px-3 pt-3">

              <form class="pt-1" method="POST" action="javascript:void(0);" id="bls-form" enctype="multipart/form-data">
                  @csrf
                  @method('POST')

              <!--begin::Repeater-->
              <div>
                  <!--begin::Form group-->
                  <div class="form-group">
                      <div class="mb-5">
                          <div class="rounded-3 p-3">
                              <div class="form-group row gy-3">

                                  <div class="col-md-12">
                                      <div class="form-group">
                                          <div class="form-group row justify-content-center">
                                              <div class="col-md-5">
                                                  <label class="form-label">Contract#</label>
                                              </div>
                                              <div class="col-md-5">
                                                  <label class="form-label">Allocated Qty</label>
                                              </div>
                                              <div class="col-md-2">
                                                <label class="form-label">Remove</label>
                                            </div>
                                          </div>
                                      </div>
                                      <input type="hidden" name="sale_id" value="{{ $sale->id }}">
                                      <div id="kt_docs_repeater_basic">
                                          <!--begin::Form group-->
                                          <div class="form-group">
                                              <div class="" data-repeater-list="contract_ids">
                                                  <div class="mb-1" data-repeater-item>
                                                      <div class="form-group row gy-3 gx-1 align-items-center">
                                                        <div class="availability" style="display: none;"></div>
                                                          <div class="col-md-5">
                                                            <select name="vessel_allocation_id" id="vessel_allocation_id" class="form-select form-select-sm" required>
                                                              <option value="">---</option>
                                                              @foreach ($contracts as $contract)
                                                                @foreach ($contract->allocations as $allocation)
                                                                <option data-unlifted-qty="{{ $allocation->unlifted_qty() }}" data-vessel="{{ $allocation->inventory->vessel->name ?? '--' }}" data-contract-id="{{ $contract->id }}" value="{{ $allocation->id }}">{{ $allocation->contract_number }}</option>
                                                                @endforeach
                                                              @endforeach
                                                            </select>
                                                          </div>
                                                          <input type="hidden" class="repeater_contract_id" name="contract_id">
                                                          <div class="col-md-5">
                                                              <input type="number" name="quantity" class="form-control form-control-sm mb-2 mb-md-0 allocation-qty" placeholder="Allocated Qty" required />
                                                          </div>
                                                          <div class="col-md-2">
                                                            <a href="javascript:void(0);" class="btn btn-sm btn-light-danger" data-repeater-delete><i class="fa fa-cancel"></i></a>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <!--end::Form group-->

                                          <!--begin::Form group-->
                                          <div class="form-group my-3">
                                            <a href="javascript:;" data-repeater-create class="btn btn-light-primary btn-sm fs-7">
                                                    <i class="ki-duotone ki-plus"></i>
                                                    Add Contract
                                            </a>
                                        </div>
                                        <!--end::Form group-->

                                          <!--begin::Form group-->
                                            <div class="form-group">
                                              @foreach ($sale->sales_contracts as $contract)
                                              <div class="">
                                                  <div class="mb-1">
                                                      <div class="form-group row gy-3 gx-1 align-items-center">
                                                          <div class="col-md-5">
                                                            <select class="form-select form-select-sm" disabled>
                                                              <option value="">{{ $contract->contract->code ?? '---' }}</option>
                                                            </select>
                                                          </div>
                                                          <div class="col-md-5">
                                                              <input type="number" class="form-control form-control-sm mb-2 mb-md-0 allocation-qty" placeholder="Allocated Qty" value="{{ $contract->quantity }}" disabled />
                                                          </div>
                                                          <div class="col-md-2">
                                                            <a href="javascript:void(0);" data-route="{{ route('sale_contract.delete',$contract->id) }}" class="btn btn-sm btn-light-danger confirm-delete" data-repeater-delete><i class="fa fa-cancel"></i></a>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                              @endforeach
                                        </div>
                                        <!--end::Form group-->

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
                <button type="button" id="check-submit-btn" class="btn btn-lg btn-light fw-bold btn-primary me-2">Submit</button>
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

              <table class="table align-middle table-bordered table-hover mt-5" id="bl-table">
                  <thead class="bg-secondary fw-bold">
                      <tr>
                          <th>Buyer</th>
                          <th>V</th>
                          <th>Veh#</th>
                          <th>P</th>
                          <th>R. Qty</th>
                          <th>Actions</th>
                      </tr>
                  </thead>
                  <tbody id="bls-tbody">
                    
                  </tbody>
              </table>
          </div>
      </div>
      {{-- End BLs --}}
          </div>

        </div>

{!! theme()->addVendor('formrepeater') !!}
@push('scripts')
<script src="https://malsup.github.io/jquery.form.js"></script> 
<script>
  $('#kt_docs_repeater_basic').repeater({
      initEmpty: false,

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
    $(document).on("change","#vessel_allocation_id", function () {
        $(this).closest(".row").find('.repeater_contract_id').val($(this).find("option:selected").attr('data-contract-id'));
    });
  </script>

  <script>
      function BlDataTable() {
              var table = $("#bl-table").DataTable({
                  processing: true,
                  serverSide: true,
                  info: false,
                  paging: false,
                  destroy: true,
                  sorting: false,
                  ajax: "{{ url('sales-request/allocation') }}",
                  columns: [
                      {data: 'buyer_name', name: 'buyer_name'},
                      {data: 'vessel_name', name: 'vessel_name'},
                      {data: 'vehicle_number', name: 'vehicle_number'},
                      {data: 'product_name', name: 'product_name'},
                      {data: 'quantity', name: 'quantity'},
                      {data: 'action', name: 'action', orderable: false, searchable: false},
                  ],
                          
              columnDefs: [{
                  targets: 1,
                  searchable: true,
                  visible: true
              }]
      
                  });

          $('#product').on('change', function() {
              var value = $(this).find(':selected').val();
              table.column(2).search(value).draw();
          });

          $('#buyer').on('change', function() {
              var value = $(this).find(':selected').val();
              table.column(1).search(value).draw();
          });

          $('#vessel').on('change', function() {
              var value = $(this).find(':selected').val();
              table.column(3).search(value).draw();
          });

          $('#vehicle').on('keyup', function() {
              var value = $(this).val();
              table.column(5).search(value).draw();
          });

          return table;
      }

      $(document).ready(function() {
          BlDataTable();
          setTimeout(() => {
              $('.sale-{{ $sale->id }}').closest("tr").addClass('bg-secondary');
          }, 2000);
      });

  
      $(document).on('click','#check-submit-btn', function () {
          
              $("#bls-form").ajaxSubmit(
                  {
                      url: "{{ route('sales.contract.store') }}",
                      type: 'POST',
                      success: function(response) {
                          swal("Completed Successfully!", "", "success");
                          $('#bls-form')[0].reset();
                          $('#kt_docs_repeater_basic').find('[data-repeater-delete]').click();
                          BlDataTable();
                          location.reload();
                      },
                      error: function(xhr, textStatus, error) {
                          var error_msg = JSON.parse(xhr.responseText);
                          if (error_msg.error) {
                              swal(""+ error_msg.error +"", "", "warning");
                          }
                          else {
                              swal("Error Occured!", "", "warning");
                          }
                       }
                  }
              );
      });
  </script>
  <script>
    $(document).on("keyup",".allocation-qty", function () {
        var contract_qty = "{{ $sale->loaded_qty() }}";
        var value = 0;
        $('.allocation-qty').each(function (i, element) {
                value += parseInt($(element).val());
        });
        
        if (value > contract_qty) {
            $(this).addClass('border border-danger');
            setTimeout(() => {
                $(this).val('')
            }, 1000);
        }
        else {
            $(this).removeClass('border border-danger');
        }
    });
</script>

<script>
    $(document).on("change","#vessel_allocation_id", function () {
        var unlifted_qty = $(this).find("option:selected").attr('data-unlifted-qty');
        var vessel = $(this).find("option:selected").attr('data-vessel');
        if ($(this).val() != "") {
            $(this).closest(".row").find(".availability").show();
            var availability = '<p class="mb-0">Unlifted Qty: '+unlifted_qty+'</p>';
            availability += '<p class="mb-0">Vessel: '+vessel+'</p>';
            $(this).closest(".row").find(".availability").html(availability);
        }
        else {
            $(this).closest(".row").find(".availability").hide();
        }
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