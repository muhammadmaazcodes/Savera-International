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
                              <a href="{{ url('local-contracts/contracts') }}" class="nav-link tabs-link">Contracts</a>
                            </li>
                            <li class="nav-item" role="presentation">
                              <a href="{{ url('local-contracts/buyer') }}" class="nav-link tabs-link">Buyer</a>
                            </li>
                            <li class="nav-item" role="presentation">
                              <button class="nav-link active tabs-link" id="pills-vessel" data-bs-toggle="pill" data-bs-target="#pills-vessel" type="button" role="tab" aria-controls="pills-vessel" aria-selected="true">Vessel</button>
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

                              <div class="table-responsive">
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
                                          <th>Vessel</th>
                                          <th>Voyage</th>
                                          <th>Seller</th>
                                          <th>Product</th>
                                          <th>Landed Quantity</th>
                                          <th>Sold Qty.</th>
                                          <th>Unsold Qty.</th>
                                          <th>Lifted Qty.</th>
                                          {{-- <th class="text-end min-w-70px">Actions</th> --}}
                                      </tr>
                                  </thead>
                                  <tbody class="fw-semibold text-gray-600">
                                    @foreach ($inventories as $inv_id => $terminal_stocks)
                                          @foreach ($terminal_stocks as $stock)
                                              @php
                                                  $landed_qty = $stock->sum('terminal_quantity') - $stock->sum('terminal_shortage');
                                                  $sold_qty = $stock[0]->sold_qty();
                                                  $unsold_qty = $landed_qty - $stock[0]->sold_qty();
                                                  $lifted_qty = $stock[0]->lifted_qty();
                                                  // foreach ($stock as $value) {
                                                  //   $sold_qty += $value->sold_qty();
                                                  //   $unsold_qty += $value->unsold_qty();
                                                  //   $lifted_qty += $value->lifted_qty();
                                                  // }
                                              @endphp
                                              <tr>
                                                
                                                <td hidden>
                                                  <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                      <input class="form-check-input" type="checkbox" value="1" />
                                                  </div>
                                                </td>
                                                <td>
                                                  @isset($stock[0]->inventory)
                                                    {{ $stock[0]->inventory->vessel->name ?? '---' }}
                                                  @endisset
                                                </td>
                                                <td>
                                                  @isset($stock[0]->inventory)
                                                    {{ $stock[0]->inventory->voyage_number ?? '---' }}
                                                  @endisset
                                                </td>
                                                <td>
                                                  @isset($stock[0]->inventory)
                                                    {{ $stock[0]->inventory->seller->name ?? '---' }}
                                                  @endisset
                                                </td>
                                                <td>
                                                    {{ $stock[0]->product->code ?? '---' }}
                                                </td>
                                                <td>
                                                  {{ number_format($landed_qty,3) }}
                                                </td>
                                                <td>
                                                  {{ number_format($sold_qty,3) }}
                                                </td>
                                                <td>
                                                  {{ number_format($unsold_qty,3) }}
                                                </td>
                                                <td>
                                                  {{ number_format($lifted_qty,3) }}
                                                </td>
                                              </tr>
                                          @endforeach
                                    @endforeach
                                  </tbody>
                                </table>
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
      <div class="modal-body text-left">
        <p id="full-contract-msg">
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

  @push('scripts')
  
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script>
          $(document).ready(function() {
              var table = $('#kt_datatable_example').DataTable();

              $('#vessel').on('change', function() {
                  table.column(1).search(this.value).draw();
              });
              
              $('#seller').on('change', function() {
                  table.column(3).search(this.value).draw();
              });

              $('#product').on('change', function() {
                  table.column(4).search(this.value).draw();
              });

              $('#bl_qty').on('keyup', function() {
                  table.column(5).search(this.value).draw();
              });

              $('#shortage').on('keyup', function() {
                  table.column(6).search(this.value).draw();
              });

              $('#contract_status').on('change', function() {
                  table.column(11).search(this.value).draw();
              });

              $('#buyer').on('change', function() {
                  table.column(12).search(this.value).draw();
              });

              $('#type').on('change', function() {
                  table.column(13).search(this.value).draw();
              });

              $('#contract_date_to, #contract_date_from').on('change', function() {
                  table.draw();
              });

              $.fn.dataTable.ext.search.push(
                  function(settings, data, dataIndex) {
                      var minDate = $('#contract_date_to').val();
                      var maxDate = $('#contract_date_from').val();
                      var date = data[14];

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
          
          $('#full-contract-msg').html("{!! html_entity_decode(Session::get('contract-success')) !!}");
          $('#WhatsappMessage').modal('toggle');
        /*
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
        */

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
                  columns: [1,2,3,4,7,8,9,10]
              },
                  title: documentTitle
              },
              {
                  extend: 'excelHtml5',
                  exportOptions: {
                  columns: [1,2,3,4,7,8,9,10]
              },
                  title: documentTitle
              },
              {
                  extend: 'csvHtml5',
                  exportOptions: {
                  columns: [1,2,3,4,7,8,9,10]
              },
                  title: documentTitle
              },
              {
                  extend: 'pdfHtml5',
                                      exportOptions: {
                  columns: [1,2,3,4,7,8,9,10]
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