<x-default-layout>
  <style>
    .nav-link.active {
      background-color: #4bcbf1 !important;
    }

    .nav-link {
      font-size: 13px;
    }
    th {
      font-weight: bold !important;
      color: #000 !important;
      border-bottom: 1px solid #000 !important;
    }
  td {
      padding-top: 0.3em !important;
      padding-bottom: 0.3em !important;
      border-bottom: 1px solid #000 !important;
      color: #000 !important;
  }
  </style>
  <div class="d-flex flex-column flex-column-fluid">
      <!--begin::Toolbar-->
      <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

          <!--begin::Toolbar container-->
          <div id="kt_app_toolbar_container" class="">

              <!--begin::Page title-->
              <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                  <!--begin::Title-->
                  <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                      Contracts
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
                        Contracts </li>
                      <!--end::Item-->

                  </ul>
                  <!--end::Breadcrumb-->
              </div>
              <!--end::Page title-->
          </div>
          <!--end::Toolbar container-->
      </div>
      <!--end::Toolbar-->

      <div class="mb-4"> 

      </div>

              <!--begin::Card-->
              <div class="card">
                  <!--begin::Card header-->
                  <div class="card-header border-0 pt-6">
                      <!--begin::Card title-->
                      <div class="card-title">
                          <!--begin::Search-->
                          <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                              <a href="{{ url('local-contracts/contracts') }}" class="nav-link tabs-link active">Contracts</a>
                            </li>
                            <li class="nav-item" role="presentation">
                              <a href="{{ url('local-contracts/buyer') }}" class="nav-link tabs-link">Buyer</a>
                            </li>
                            <li class="nav-item" role="presentation">
                              <a class="nav-link tabs-link" href="{{ url('local-contracts/vessel') }}">Vessel</a>
                            </li>
                            <li class="nav-item" role="presentation">
                              <a href="{{ url('local-contracts/seller') }}" class="nav-link tabs-link">Seller</a>
                            </li>
                          </ul>

                          <!--end::Search-->
                      </div>
                      <!--begin::Card title-->

                      <!--begin::Card toolbar-->
                      <div class="card-toolbar">

                          <!--begin::Toolbar-->
                          <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                            
                              
                          <!--begin::Add customer-->
                          {{-- Export Button Start --}}
                            <button type="button" class="btn btn-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                              <i class="ki-duotone ki-exit-down fs-2"><span class="path1"></span><span class="path2"></span></i>
                              Export
                            </button>
                          <div id="kt_datatable_example_export_menu" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4" data-kt-menu="true">
                              <div class="menu-item px-3">
                                  <a href="#" class="menu-link px-3" data-kt-export="excel">
                                  Export as Excel
                                  </a>
                              </div>
                              <div class="menu-item px-3">
                                  <a href="#" class="menu-link px-3" data-kt-export="csv">
                                  Export as CSV
                                  </a>
                              </div>
                              <div class="menu-item px-3">
                                  <a href="#" class="menu-link px-3" data-kt-export="pdf">
                                  Export as PDF
                                  </a>
                              </div>                    
                          </div>

                          <div id="kt_datatable_example_buttons" class="d-none"></div>
                           {{-- Export Button End --}}
                          <!--end::Add customer-->

                          <!--begin::Add customer-->
                              <a href="/local-contract/create" class="btn btn-primary ms-3">
                                New Contract
                              </a>
                              <!--end::Add customer-->

                          </div>
                          <!--end::Toolbar-->

                      </div>
                      <!--end::Card toolbar-->
                  </div>
                  <!--end::Card header-->

                  <!--begin::Card body-->
                  <div class="card-body pt-0">
                    <div class="">
                      
                      <div class="tab-content">
                        <div class="tab-pane fade show active" id="pills-vessel" role="tabpanel" aria-labelledby="pills-vessel">

                          <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button bg-secondary fw-bold text-dark fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="true" aria-controls="collapse5">
                                  Filter Contracts
                                </button> 
                              </h2>
                              <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row">
                                      <div class="col-md-3 mb-2">
                                        <select name="type" id="type4" class="form-select">
                                            <option disabled selected>Transaction Type</option>
                                            <option value="">All</option>
                                            <option value="normal">Normal</option>
                                            <option value="barter">Barter</option>
                                            <option value="temp">Temporary</option>
                                        </select>
                                    </div>
                                      <div class="col-md-3 mb-2">
                                        <select name="seller" id="seller4" class="form-select">
                                              <option disabled selected>Search Seller</option>
                                              <option value="">All</option>
                                              @foreach ($businesses as $business)
                                                <option value="{{ $business->name }}">{{ $business->name }}</option>
                                              @endforeach
                                          </select>
                                      </div>
                                        <div class="col-md-3 mb-2">
                                            <select name="vessel" id="vessel4" class="form-select">
                                                <option disabled selected>Search Vessel</option>
                                                <option value="">All</option>
                                                @foreach ($vessels as $vessel)
                                                  <option value="{{ $vessel->name }}">{{ $vessel->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                          <select name="buyer" id="buyer4" class="form-select">
                                              <option disabled selected>Search Buyer</option>
                                              <option value="">All</option>
                                              @foreach ($companies as $company)
                                                <option value="{{ $company->name }}">{{ $company->name }}</option>
                                              @endforeach
                                          </select>
                                      </div>
                                        <div class="col-md-3 mb-2">
                                            <select name="product" id="product4" class="form-select">
                                                <option disabled selected>Search Product</option>
                                                <option value="">All</option>
                                                @foreach ($products as $product)
                                                  <option value="{{ $product->code }}">{{ $product->code }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <input type="text" name="bl_qty" id="bl_qty4" placeholder="BL Qty" class="form-control">
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <input type="text" name="shortage" id="shortage4" placeholder="Shortage" class="form-control">
                                        </div>
                                        <div class="col-md-12 row">
                                          <div class="col-md-3 mb-2">
                                            <label for="contract_date_to_4" class="form-label">Cont. Date To</label>
                                              <input type="date" name="contract_date_to_4" id="contract_date_to_4" placeholder="Shortage" class="form-control">
                                          </div>
                                          <div class="col-md-3 mb-2">
                                            <label for="contract_date_from_4" class="form-label">Cont. Date From</label>
                                            <input type="date" name="contract_date_from_4" id="contract_date_from_4" class="form-control">
                                        </div>
                                        </div>
                                    </div>
                                </div>
                              </div>
                            </div>
                          </div>

                              <div class="table-responsive">

                                <!--begin::Table-->
                                  <table class="table align-middle table-row-bordered table-hover fs-6 gy-5" id="kt_datatable_example">
                                    <thead>
                                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                            <th class="w-10px pe-2" hidden>
                                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                    <input class="form-check-input" type="checkbox" data-kt-check="true"
                                                        data-kt-check-target="#kt_customers_table .form-check-input"
                                                        value="1" />
                                                </div>
                                            </th>
                                            <th>Trans.<br>Type</th>
                                            <th>Contract#</th>
                                            <th>Contract Date</th>
                                            <th>Product</th>
                                            <th>Buyer</th>
                                            <th>Selling Price</th>
                                            <th>Contract Qty.</th>
                                            <th>Unlifted Qty.</th>
                                            <th hidden>Seller</th>
                                            <th hidden>Vessel</th>
                                            <th hidden>BL Qty.</th>
                                            <th hidden>Shortage</th>
                                            <th class="text-end min-w-70px">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                      @foreach ($contracts as $contract)
                                        @php
                                            $unlifted_qty = $contract->quantity - $contract->liftings->sum('quantity');
                                        @endphp
                                          <tr>
                                            <td hidden>
                                              <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                  <input class="form-check-input" type="checkbox" value="1" />
                                              </div>
                                          </td>
                                            <td>{{ $contract->type ?? 'N/A' }}</td>
                                            <td>{{ $contract->code ?? 'N/A' }}</td>
                                            <td>{{ $contract->date ?? 'N/A' }}</td>
                                            <td>{{ $contract->product->code ?? 'N/A' }}</td>
                                            <td>{{ $contract->buyer->name ?? 'N/A' }}</td>
                                            <td>{{ $contract->selling_price ?? '0.00' }}</td>
                                            <td>{{ $contract->quantity ?? '0.00' }}</td>
                                            <td>{{ number_format($unlifted_qty,3) }}</td>
                                            <td hidden>{{ $contract->business->name ?? 'N/A' }}</td>
                                            <td hidden>{{ $contract->inventory->vessel->name ?? 'N/A' }}</td>
                                            <td hidden>{{ $contract->inventory->bl_quantity ?? 'N/A' }}</td>
                                            <td hidden>{{ $contract->inventory->vessel_shortage ?? 'N/A' }}</td>
                                            <td class="text-end">
                                              <a href="#"
                                                  class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                  data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                  Actions
                                                  <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                              <!--begin::Menu-->
                                              <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                  data-kt-menu="true">
                                                  <!--begin::Menu item-->
                                                  <div class="menu-item px-3">
                                                    <a href="{{ url('local-contracts/view-contract/'.$contract->id) }}" class="menu-link px-3 text-dark">
                                                        View
                                                    </a>
                                                </div>
                                                <!--end::Menu item-->
                                                      <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                      <a href="{{ url('local-contract/'.$contract->id.'/edit') }}" class="menu-link px-3 text-dark">
                                                        Edit Basics
                                                      </a>
                                                  </div>
                                                  <!--begin::Menu item-->
                                                   <div class="menu-item px-3">
                                                      <a href="#" class="menu-link px-3 text-dark" id="UpdateProduct" data-route="{{ route('contract.edit-product',$contract->id) }}">
                                                          Edit Product
                                                      </a>
                                                  </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                  <a href="#" class="menu-link px-3 text-dark" id="UpdateQty" data-route="{{ route('contract.edit-qty',$contract->id) }}" data-id="{{ $contract->id }}">
                                                    Edit Qty
                                                  </a>
                                                </div>
                                              <!--end::Menu item-->
                                               <!--begin::Menu item-->
                                               <div class="menu-item px-3">
                                                {{-- <a href="#" class="menu-link px-3 text-dark" id="UpdateRate" data-get="{{ route('get.contract',$contract->id) }}" data-route="{{ route('update.rate',$contract->id) }}" data-id="{{ $contract->id }}" data-rate="{{ $contract->selling_price }}" data-bs-toggle="modal" data-bs-target="#RateModal">
                                                    Edit Rate
                                                </a> --}}
                                                <a href="#" class="menu-link px-3 text-dark" id="UpdateRate" data-route="{{ route('contract.edit-rate',$contract->id) }}" data-id="{{ $contract->id }}">
                                                  Edit Rate
                                              </a>
                                            </div>
                                            <!--end::Menu item-->
                                             <!--begin::Menu item-->
                                             <div class="menu-item px-3">
                                              <a href="{{ url('local-contracts/vessel-allocation?contract_id='.$contract->id) }}" class="menu-link px-3 text-dark">
                                                  Edit Vessel
                                              </a>
                                          </div>
                                          <!--end::Menu item-->
                                                  <!--begin::Menu item-->
                                                  <div class="menu-item px-3">
                                                    <a href="{{ url('local-contracts/split/'.$contract->id) }}" class="menu-link px-3 text-dark">
                                                        Split
                                                    </a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                   <div class="menu-item px-3">
                                                    <a href="/local-contracts/washout/{{ $contract->id }}" class="menu-link px-3 text-dark">
                                                        Washout
                                                    </a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                   <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3 text-dark">
                                                        Resold
                                                    </a>
                                                </div>
                                                <!--end::Menu item-->
      
                                              </div>
                                              <!--end::Menu-->
                                          </td>
                                        </tr>
                                      @endforeach
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->

                              </div>
                            </div>
                            
                      </div>


                    </div>

                  </div>
                  <!--end::Card body-->
              </div>
              <!--end::Card-->
  </div>
  <!--end::Table widget 14-->

<!-- Modal -->
<div class="modal fade" id="WhatsappMessage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Whatsapp Message</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <p id="full-contract-msg">
         <span id="new-contract-date">00-XYZ-0000</span> <br>
         <span id="new-contract-number">----</span> <br> 
         <span id="new-contract-product">-------</span> <br> 
         <span id="new-contract-payment">------</span> <br>
         <span id="new-contract-buyer"> Buyer : ----</span>  <br>
         <span id="new-contract-lifting">Lifting ------ </span> <br>
         <span id="new-contract-business"> Seller option: ---- </span> 
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


  {{-- Start Qty Modal --}}
  <div class="modal fade" id="QuantityModal" tabindex="-1" aria-labelledby="QuantityModalLabel" aria-hidden="true">
      {{-- AJAX HERE --}}
  </div>
  {{-- End Qty Modal --}}

  {{-- Start Rate Modal --}}
  <div class="modal fade" id="RateModal" tabindex="-1" aria-labelledby="RateModalLabel" aria-hidden="true">
      {{-- AJAX HERE --}}
  </div>
  {{-- End Rate Modal --}}

  {{-- Start Product Modal --}}
  <div class="modal fade" id="ProductModal" tabindex="-1" aria-labelledby="ProductModalLabel" aria-hidden="true">
    {{-- AJAX HERE --}}
  </div>
  {{-- End Product Modal --}}
  
  @push('scripts')
  
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if (Session::has('error'))
        <script>
          swal("{{ Session::get('error') }}","","warning");
        </script>
    @endif
      <script>
          $(document).ready(function() {
              var table = $('#kt_datatable_example').DataTable();

              $('#type4').on('change', function() {
                  table.column(1).search(this.value).draw();
              });

              $('#product4').on('change', function() {
                  table.column(4).search(this.value).draw();
              });

              $('#seller4').on('change', function() {
                  table.column(9).search(this.value).draw();
              });

              $('#buyer4').on('change', function() {
                  table.column(5).search(this.value).draw();
              });

              $('#vessel4').on('change', function() {
                  table.column(10).search(this.value).draw();
              });

              $('#bl_qty4').on('keyup', function() {
                  table.column(11).search(this.value).draw();
              });

              $('#shortage4').on('keyup', function() {
                  table.column(12).search(this.value).draw();
              });

              $('#contract_date_to_4, #contract_date_from_4').on('change', function() {
                  table.draw();
              });

              $.fn.dataTable.ext.search.push(
                  function(settings, data, dataIndex) {
                      var minDate = $('#contract_date_to_4').val();
                      var maxDate = $('#contract_date_from_4').val();
                      var date = data[3];

                      if ((minDate === '' && maxDate === '') ||
                          (minDate <= date && maxDate === '') ||
                          (minDate === '' && maxDate >= date) ||
                          (minDate <= date && maxDate >= date)) {
                          return true;
                      }
                      return false;
                  }
              );

          });
      </script>

      <script>
        // Product
        $(document).on("click","#UpdateProduct", function () {
          
          var route = $(this).attr('data-route');
          $.ajax({
            type: "GET",
            url: route,
            data: {},
            success: function (response) {
              $('#ProductModal').html(response.ProductModal);
              $('#ProductModal').modal('toggle');
            }
          });

        });

        // Quantity
        $(document).on("click","#UpdateQty", function () {
          
          var route = $(this).attr('data-route');

          $.ajax({
            type: "GET",
            url: route,
            data: {},
            success: function (response) {
              $('#QuantityModal').html(response.QtyModal);
              $('#QuantityModal').modal('toggle');
            }
          });

        });

        $(document).on("keyup",'#QuickQty',function () { 
            var currentQty = parseFloat($('#CurrentQty').val());
            $('#NewQty').val(currentQty + parseFloat($(this).val()));
         });

        // Rate
        $(document).on("click","#UpdateRate", function () {

          var route = $(this).attr('data-route');

          $.ajax({
            type: "GET",
            url: route,
            data: {},
            success: function (response) {
              $('#RateModal').html(response.RateModal);
              $('#RateModal').modal('toggle');
            }
          });

        });
      </script>

      <script>
          $(document).on("click", ".has-contract", function() {
              swal("This Inventory contain contracts !");
          });

          $(document).on("click", ".delete-has-contract", function() {
              swal("This Inventory contain contracts !");
          });
      </script>

      @if (Session::has('contract-success'))
      <script>
        $(document).ready(function () {
          $.ajax({
            type: "GET",
            url: "{{ route('get.contract',Session::get('contract-success')) }}",
            success: function (response) {
              var data = response.data;
              $('#new-contract-date').text(data.date);
              $('#new-contract-number').text(data.code);
              $('#new-contract-product').text(data.product + ' ' + data.quantity + ' ' + data.selling_price);
              $('#new-contract-payment').text(data.payment_terms);
              $('#new-contract-buyer').text('Buyer : ' + data.buyer);
              $('#new-contract-lifting').text('Lifting : ' + data.lifting_date);
              $('#new-contract-business').text('Seller Option : ' +  data.bussiness);
            }
          });

          $('#WhatsappMessage').modal('toggle');

          var message = $('#full-contract-msg').html();
          var contract_id = "{{ Session::get('contract-success') }}";
          $.ajax({
            type: "POST",
            url: "{{ route('save.message') }}",
            data: {
              _token: "{{ csrf_token() }}",
              contract_id: contract_id,
              message: message
            },
            success: function (response) {
            }
          });

        });
      </script>
      @endif


      <script>
        "use strict";
      // Class definition
      var KTDatatablesExample = function () {
      // Shared variables
      var table;
      var datatable;

      // Private functions
      var initDatatable = function () {
      // Set date data order
      const tableRows = table.querySelectorAll('tbody tr');

      tableRows.forEach(row => {
          const dateRow = row.querySelectorAll('td');
          const realDate = moment(dateRow[3].innerHTML, "DD MMM YYYY, LT").format(); // select date from 4th column in table
          dateRow[3].setAttribute('data-order', realDate);
      });

      // Init datatable --- more info on datatables: https://datatables.net/manual/
      datatable = $(table).DataTable();
      }

      // Hook export buttons
      var exportButtons2 = () => {
      const documentTitle = 'Contract Vessel';
      var buttons = new $.fn.dataTable.Buttons(table, {
          buttons: [
              {
                  extend: 'copyHtml5',
                  exportOptions: {
                  columns: [1,2,3,4,5,6,7,8]
              },
                  title: documentTitle
              },
              {
                  extend: 'excelHtml5',
                  exportOptions: {
                  columns: [1,2,3,4,5,6,7,8]
              },
                  title: documentTitle
              },
              {
                  extend: 'csvHtml5',
                  exportOptions: {
                  columns: [1,2,3,4,5,6,7,8]
              },
                  title: documentTitle
              },
              {
                  extend: 'pdfHtml5',
                                      exportOptions: {
                  columns: [1,2,3,4,5,6,7,8]
              },
                  title: documentTitle
              }
          ]
      }).container().appendTo($('#kt_datatable_example_buttons'));

      // Hook dropdown menu click event to datatable export buttons
      const exportButtons = document.querySelectorAll('#kt_datatable_example_export_menu [data-kt-export]');
      exportButtons.forEach(exportButton => {
          exportButton.addEventListener('click', e => {
              e.preventDefault();

              // Get clicked export value
              const exportValue = e.target.getAttribute('data-kt-export');
              const target = document.querySelector('.dt-buttons .buttons-' + exportValue);

              // Trigger click event on hidden datatable export buttons
              target.click();
          });
      });
      }

      // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
      var handleSearchDatatable = () => {
      const filterSearch = document.querySelector('[data-kt-filter="search"]');
      filterSearch.addEventListener('keyup', function (e) {
          datatable.search(e.target.value).draw();
      });
      }

      // Public methods
      return {
      init: function () {
          table = document.querySelector('#kt_datatable_example');

          if ( !table ) {
              return;
          }

          initDatatable();
          exportButtons2();
          handleSearchDatatable();
      }
      };
      }();

      // On document ready
      KTUtil.onDOMContentLoaded(function () {
      KTDatatablesExample.init();
      });
      </script>

  @endpush
</x-default-layout>