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
  <!--begin::Toolbar-->
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
  <!--end::Toolbar-->

  <div class="accordion" id="accordionExample">
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button class="accordion-button bg-secondary fw-bold text-dark fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            Filter Processing Sales
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

              <form class="pt-1" method="POST" action="{{ route('lifting.store') }}" id="bls-form" enctype="multipart/form-data">
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
                                      <input type="text" class="form-control" name="gate_pass" id="gate_pass" value="{{ $lifting->gate_pass }}" placeholder="..." required>
                                  </div>
                                  
                                  <div class="col-md-12">
                                      <label for="" class="form-label">Attach GatePass</label>
                                      <input type="file" name="gatepass_file" class="form-control form-control-sm" required>
                                  </div>
                                  <input type="hidden" name="sale_id" value="{{ $lifting->id }}" id="sale_id">
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
                                                      <div class="form-group row gy-3 gx-1 align-items-center border border-2 p-1 my-1 rounded">
                                                        <div class="availability_bls" style="display: none;"></div>
                                                        <div class="col-md-3">
                                                            <select class="form-control form-control-sm index_number">
                                                                <option value="">---</option>
                                                                @foreach ($bls as $bl)
                                                                    <option data-id="{{ $bl->id }}" data-commingle="{{ $bl->commingle_bls->pluck('quantity','id') }}" data-commingle-qty="{{ $bl->commingle_bls->sum('quantity') }}" data-unlifted-qty="{{ $bl->unlifted_qty() }}">{{ $bl->index_number }}</option>
                                                                @endforeach
                                                            </select>
                                                          </div>
                                                          <div class="col-md-4">
                                                            <select class="form-control form-control-sm bl_number" name="bl_id">
                                                                <option value="">---</option>
                                                                @foreach ($bls as $bl)
                                                                    <option value="{{ $bl->id }}" data-commingle-qty="{{ $bl->commingle_bls->sum('quantity') }}" data-id="{{ $bl->id }}" data-unlifted-qty="{{ $bl->unlifted_qty() }}">{{ $bl->bl_number }}</option>
                                                                @endforeach
                                                            </select>
                                                          </div>
                                                          <div class="col-md-4">
                                                              <input type="number" name="bl_quantity" class="form-control form-control-sm mb-2 mb-md-0 lifting-bl-qty" placeholder="Qty" required />
                                                            <a href="javascript:void(0);" class="text-danger" style="opacity: 0" data-repeater-delete></a>
                                                          </div>
                                                          <div class="col-md-1 text-center">
                                                                <a href="javascript:void(0);" class="text-danger" data-repeater-delete><i class="fa fa-trash fs-5 text-danger"></i></a>
                                                          </div>
                                                          <div class="col-md-8 commingle_input" style="display: none;">
                                                            <div class="d-flex">
                                                                <label class="form-label mt-1">Commingle</label>
                                                                <input type="number" name="commingle_qty" class="ms-2 form-control form-control-sm mb-2 mb-md-0 commingle_qty" placeholder="Qty" autocomplete="off">
                                                            </div>
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
                                                    Add BL
                                            </a>
                                        </div>
                                        <!--end::Form group-->

                                          @foreach ($lifting->lifting_bls as $lift_bl)
                                            <div class="mb-1">
                                                <div class="form-group row gy-3 gx-1 align-items-center">
                                                    <div class="col-md-4">
                                                      <select class="form-control form-control-sm index_number" disabled>
                                                          <option selected>{{ $lift_bl->bl->index_number ?? '---' }}</option>
                                                      </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                      <select class="form-control form-control-sm bl_number" disabled>
                                                          <option selected>{{ $lift_bl->bl->bl_number ?? '---' }}</option>
                                                      </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="number" class="form-control form-control-sm mb-2 mb-md-0" disabled placeholder="Qty" value="{{ $lift_bl->quantity }}" />
                                                    </div>
                                                </div>
                                            </div>
                                          @endforeach

                                      </div>
                                  </div>

                              </div>
                          </div>
                      </div>
                  </div>
                  <!--end::Form group-->
                    <input type="hidden" name="completed" value="">
              </div>
              <!--end::Repeater-->
                @if ($lifting->status == 0)
                    <div class="text-center">
                        <button type="button" id="check-submit-btn" class="btn btn-sm btn-light fw-bold btn-primary me-2">Submit</button>
                        <button type="button" id="completed-submit-btn" data-val="completed" class="btn btn-sm btn-light fw-bold btn-success me-2">Submit & Marked as Completed</button>
                    </div>
                @endif

              </form>

          </div>
          <!--end: Card Body-->
      </div>
   <!--end::Table widget 14-->
          </div>

      @php
          $balance_qty = $lifting->quantity - $lifting->lifting_bls->sum('quantity');
      @endphp

  <div class="col-lg-7">
              {{-- All BLs --}}
      <div class="card card-flush mt-5 h-md-100">
          <div class="card-body px-4 pt-4">

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
    $(document).ready(function () {
        BlDataTable();
        setTimeout(() => {
            $('.sale-{{ $lifting->id }}').closest("tr").addClass('bg-secondary');
        }, 2000);

        $.ajax({
            type: "GET",
            url: "{{ url('get-inv/'.$inventory->id) }}",
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
                  options_index += '<option data-id="'+ bls[index].id +'" value="'+ item +'">'+ item +'</option>';
              });

              var options_bl = '<option value="">---</option>';
              BLNumbers.forEach(function(item, index) {
                  options_bl += '<option value="'+ bls[index].id +'" data-id="'+ bls[index].id +'" value="'+ item +'">'+ item +'</option>';
              });

              localStorage.setItem("options_index", options_index);
              localStorage.setItem("options_bl", options_bl);
            }
          });
    });
  </script>
<script>
  $('#kt_docs_repeater_basic').repeater({
      initEmpty: false,

      defaultValues: {
          'text-input': 'foo'
      },

      show: function() {
          $(this).slideDown(function () {
                var options_index = localStorage.getItem("options_index");
                $(this).find('.index_number').html(options_index);

                var options_bl = localStorage.getItem("options_bl");
                $(this).find('.bl_number').html(options_bl);
          });
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

      function SubmitForm() { 
        $("#bls-form").ajaxSubmit(
                  {
                      url: "{{ route('lifting.store') }}",
                      type: 'POST',
                      success: function(response) {
                          swal("Sale Requested Successfully!", "", "success");
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
                              swal("Error Occured!","", "warning");
                          }
                       }
                  }
              );
       }

      $(document).on('click','#completed-submit-btn', function () {
            if ($(this).attr('data-val') == 'completed') {
                $('input[name="completed"]').val('yes');    
            }
            SubmitForm();
      });

      $(document).on('click','#check-submit-btn', function () {
            SubmitForm();
      });
  </script>

      <script>
        $(document).on("change",".index_number", function () {
            var this_bl_id = $(this).find('option:selected').attr('data-id');
            var this_bl_unlifted_qty = $(this).find('option:selected').attr('data-unlifted-qty');
            var bl_qty = $(this).closest(".row").find('.lifting-bl-qty');
            $(bl_qty).attr('max',this_bl_unlifted_qty);
            var bl_number = $(this).closest(".row").find('.bl_number');
            var bl_id = $(bl_number).find('option[data-id="'+this_bl_id+'"]').prop('selected',true);

            var this_commingle_qty = $(this).find('option:selected').attr('data-commingle-qty');
            if (this_commingle_qty > 0) {
                $(this).closest(".row").find('.commingle_input').show();
                $(this).closest(".row").find('.commingle_qty').attr('max',this_commingle_qty);
            }
            else {
                $(this).closest(".row").find('.commingle_input').hide();
            }

            if ($(this).val() != "") {
                var available = '<p class="mb-0">Unlifted Qty: '+this_bl_unlifted_qty+'</p>';
                $(this).closest(".row").find('.availability_bls').show();
                $(this).closest(".row").find('.availability_bls').html(available);
            }
            else {
                $(this).closest(".row").find('.availability_bls').hide();
            }

            // var commingleData = $(this).find('option:selected').attr('data-commingle');
            // var commingleArray = JSON.parse(commingleData);
            // $.each(commingleArray, function(key, value) {
            // var commingle_inp = '<div class="d-flex">';
            //     commingle_inp += '<label class="form-label mt-1">Commingle</label>';
            //     commingle_inp += '<input type="number" name="commingle_qty" class="ms-2 form-control form-control-sm mb-2 mb-md-0 commingle_qty" placeholder="Qty">';
            //     commingle_inp += '</div>';
            // });
            // $(this).closest(".row").find('.commingle_input').html(commingle_inp);

        });

        $(document).on("change",".bl_number", function () {
            var this_bl_id = $(this).find('option:selected').attr('data-id');
            var this_bl_unlifted_qty = $(this).find('option:selected').attr('data-unlifted-qty');
            var bl_qty = $(this).closest(".row").find('.lifting-bl-qty');
            $(bl_qty).attr('max',this_bl_unlifted_qty);
            var index_number = $(this).closest(".row").find('.index_number');
            var bl_id = $(index_number).find('option[data-id="'+this_bl_id+'"]').prop('selected',true);
        });
      </script>
      <script>
        // $(document).on("keyup",".lifting-bl-qty", function () {
        //     var contract_qty = "{{ $balance_qty }}";
        //     var value = 0;
        //     $('.lifting-bl-qty').each(function (i, element) {
        //             value += parseInt($(element).val());
        //     });
            
        //     if (value > contract_qty) {
        //         $(this).addClass('border border-danger');
        //         setTimeout(() => {
        //             $(this).val('')
        //         }, 1000);
        //     }
        //     else {
        //         $(this).removeClass('border border-danger');
        //     }
        // });
    </script>
@endpush
</x-default-layout>