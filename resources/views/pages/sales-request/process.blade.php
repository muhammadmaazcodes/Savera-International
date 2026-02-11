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
  td {
    cursor: pointer;
  }
  .table-responsive {
        overflow-x: visible;
    }
</style>
  
    <div class="row">
        <div class="col-md-6">

            <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
        
              <!--begin::Toolbar container-->
              <div id="kt_app_toolbar_container" class="">
        
                  <!--begin::Page title-->
                  <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                      <!--begin::Title-->
                      <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        Processing Sales
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
                            Processing Sales </li>
                          <!--end::Item-->
        
                      </ul>
                      <!--end::Breadcrumb-->
                  </div>
                  <!--end::Page title-->
        
              </div>
              <!--end::Toolbar container-->
            </div>

        </div>
        <div class="col-md-6">
            <div class="text-end mt-5">
                <a href="{{ url('sales-request/export?status=1') }}" id="export-table" class="btn btn-secondary border border-dark btn-sm">Export <i class="fa fa-download"></i></a>
            </div>
        </div>
    </div>
  
        <div class="row">
          
          <div class="col-lg-5">
              <!--begin::Table widget 14-->
      <div class="card card-flush mt-5 h-md-100">
          <!--begin::Body-->
          <div class="card-body px-3 pt-3">

              <form class="pt-1 d-none" method="POST" action="{{ route('sales.request.store') }}" id="bls-form" enctype="multipart/form-data">
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
                                      <label class="form-label">Gatepass</label>
                                      <input type="text" class="form-control" name="gate_pass" id="gate_pass" placeholder="..." required>
                                  </div>
                                  
                                  <div class="col-md-12">
                                      <label for="" class="form-label">Attach GatePass</label>
                                      <input type="file" name="gatepass_file" class="form-control form-control-sm" required>
                                  </div>
                                  <input type="hidden" name="sale_id" id="sale_id">
                                  <div class="col-md-12">
                                      <div class="form-group">
                                          <div class="form-group row justify-content-center">
                                             <div class="col-md-4">
                                                <label class="form-label">Index#</label>
                                              </div>  
                                              <div class="col-md-4">
                                                  <label class="form-label">Bl#</label>
                                              </div>
                                              <div class="col-md-4">
                                                  <label class="form-label">Lifted Qty</label>
                                              </div>
                                          </div>
                                      </div>
                                      <div id="kt_docs_repeater_basic">
                                          <!--begin::Form group-->
                                          <div class="form-group">
                                              <div class="" data-repeater-list="bl_id">
                                                  <div class="mb-1" data-repeater-item>
                                                      <div class="form-group row gy-3 gx-1 align-items-center">
                                                          <div class="col-md-4">
                                                            <select class="form-control form-control-sm" id="index_number">
                                                                <option value="">---</option>
                                                            </select>
                                                          </div>
                                                          <div class="col-md-4">
                                                            <select class="form-control form-control-sm" id="bl_number">
                                                                <option value="">---</option>
                                                            </select>
                                                          </div>
                                                          <div class="col-md-4">
                                                              <input type="number" name="quantity" class="form-control form-control-sm mb-2 mb-md-0" placeholder="Qty" required />
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <!--end::Form group-->
                              
                                          <!--begin::Form group-->
                                          <div class="form-group mt-5">
                                              <a href="javascript:;" data-repeater-create class="btn btn-light-primary btn-sm fs-7">
                                                      <i class="ki-duotone ki-plus"></i>
                                                      Add BL
                                              </a>
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

            <div class="row">
                <div class="col-md-4">
                  <input type="text" id="vehicle" class="form-control" placeholder="Vehicle #">
                </div>
                <div class="col-md-4">
                  <select class="form-select" id="product">
                    <option disabled selected>-- Product --</option>  
                    <option value="">All</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->code }}">{{ $product->code }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <table class="table align-middle table-bordered table-hover mt-5" id="bl-table">
                  <thead class="bg-secondary fw-bold">
                      <tr>
                          <th>V#</th>
                          <th>P</th>
                          <th>R. Qty</th>
                          <th>BL#</th>
                          <th>BL B. Qty</th>
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
      function BlDataTable() {
              var table = $("#bl-table").DataTable({
                  processing: true,
                  serverSide: true,
                  info: false,
                  paging: false,
                  destroy: true,
                  sorting: false,
                  ajax: "{{ url('sales-request/process') }}",
                  columns: [
                      {data: 'vehicle_number', name: 'vehicle_number'},
                      {data: 'product_name', name: 'product_name'},
                      {data: 'quantity', name: 'quantity'},
                      {data: 'bl_number', name: 'bl_number'},
                      {data: 'bl_qty', name: 'bl_qty'},
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
              table.column(1).search(value).draw();
          });

          $('#vehicle').on('keyup', function() {
              var value = $(this).val();
              table.column(0).search(value).draw();
          });

          return table;
      }

      $(document).ready(function() {
          BlDataTable();
      });

  
      $(document).on('click','#check-submit-btn', function () {
          
              $("#bls-form").ajaxSubmit(
                  {
                      url: "{{ url('sales-request/store') }}",
                      type: 'post',
                      success: function(response) { 
                          swal("Sale Requested Successfully!", "", "success");
                          $('#bls-form')[0].reset();
                          $('#kt_docs_repeater_basic').find('[data-repeater-delete]').click();
                          BlDataTable();
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
      $(document).on("click",".edit-lifting", function () {
          
          var url = $(this).attr('data-info');
          var action = "{{ route('lifting.store') }}";
          var inv_url = $(this).attr('data-inv');

          $(this).closest("tr").addClass('bg-secondary');

          $.ajax({
              type: "GET",
              url: url,
              success: function (data) {
                  $('#bls-form').attr('action',action);
                  $('#bls-form').removeClass('d-none');
                  $('#sale_id').val(data.id);
                  // Assign Values
                  $('#bls-form').find('#gate_pass').val(data.gate_pass);
              }
          });

          $.ajax({
              type: "GET",
              url: inv_url,
              success: function (response) {
                var bls = response.bls;
                var indexNumbers = bls.map(function(item, index) {
                    return item.index_number;
                });
                var BLNumbers = bls.map(function(item, index) {
                    return item.bl_number;
                });

                var options_index = '<option value="">---</option>';
                indexNumbers.forEach(function(item, index) {
                    options_index += '<option value="'+ item +'">'+ item +'</option>';
                });

                var options_bl = '<option value="">---</option>';
                BLNumbers.forEach(function(item, index) {
                    options_bl += '<option value="'+ item +'">'+ item +'</option>';
                });
                $('#index_number').html(options_index);
                $('#bl_number').html(options_bl);
              }
          });
      });
  </script>

@endpush
</x-default-layout>