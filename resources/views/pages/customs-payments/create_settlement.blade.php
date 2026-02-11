<x-default-layout>
  <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

    <div id="kt_app_toolbar_container">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
            <h1
                class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                Add Settlement
            </h1>

            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="/" class="text-muted text-hover-primary">
                        Dashboard </a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">
                  Settlement </li>
            </ul>
        </div>
    </div>
</div>

  {{-- Start Row --}}
  <div class="row">

    <div class="col-md-6">

      <div class="card">
        <div class="card-body">
          <form action="{{ url('custom-payments/store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')
                
                <div class="row mb-5">
                    <div class="col-md-12 row">
                      <div class="col-md-4">
                        <label for="posting_date" class="form-label">Posting Date</label>
                        <input type="date" name="posting_date" id="posting_date" class="form-control form-control-sm border border-dark">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <label for="customer_number" class="form-label">Customer #</label>
                      <input type="text" name="customer_number" id="customer_number" class="form-control form-control-sm border border-dark">
                    </div>
                    <div class="col-md-4">
                      <label for="customer_name" class="form-label">Customer Name</label>
                      <input type="text" name="customer_name" id="customer_name" class="form-control form-control-sm border border-dark">
                    </div>
                    <div class="col-md-4">
                      <label for="inventory_id" class="form-label">Vessel</label>
                      <select name="inventory_id" id="inventory_id" class="form-select form-select-sm border border-dark">
                        <option value="">-- Select --</option>
                        @foreach ($inventories as $inventory)
                            <option value="{{ $inventory->id }}">{{ $inventory->vessel->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-8">
                      <label for="settlement_name" class="form-label">Settlement Name</label>
                      <input type="text" name="settlement_name" id="settlement_name" class="form-control form-control-sm border border-dark">
                    </div>
                </div>
                <hr>
                <input type="hidden" name="type" value="settlement">
                <div class="row mb-5 justify-content-center">
                  <div class="col-md-4">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="text" name="amount" id="amount" class="form-control form-control-sm">
                  </div>
                  <div class="col-md-8">
                    <label for="remarks" class="form-label">Remarks</label>
                    <textarea name="remarks" id="remarks" class="form-control" cols="30" rows="1"></textarea>
                  </div>
                </div>
    
              <div class="row">
                  <div class="col-md-12 d-flex mt-3">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="status" id="status1" value="Verified">
                      <label class="form-check-label" for="status1">
                        Verified
                      </label>
                    </div>
                    <div class="form-check ms-3">
                      <input class="form-check-input" type="radio" name="status" id="status2" value="Cancel">
                      <label class="form-check-label" for="status2">
                        Cancelled
                      </label>
                    </div>
                  </div>
              </div>
                
              <div class="btn text-center">
                <button type="submit" class="btn btn-sm btn-primary">Save</button>
                <button type="submit" class="btn btn-sm btn-primary mx-2 my-2">Save & New Slip</button>
                <button type="button" class="btn btn-sm btn-primary">Move to Previous</button>
                <button type="button" class="btn btn-sm btn-primary">Move to Next</button>
              </div>
    
            </form>
        </div>
      </div>

    </div>

      <div class="col-md-6">

        <div class="row">
          <div class="col-md-3">
            <button type="button" class="btn btn-secondary btn-sm mb-2">Export</button>
          </div>
          <div class="col-md-3">
            <button type="button" class="btn btn-secondary btn-sm mb-2">Download</button>
          </div>
          <div class="col-md-3">
            {{-- <input type="date" class="form-control form-control-sm mb-2"> --}}
          </div>
          <div class="col-md-3">
            <select id="status" class="form-select form-select-sm mb-2">
              <option value="">All</option>
              <option value="Verified">Verified</option>
              <option value="Unverified">Unverified</option>
              <option value="Cancel">Cancelled</option>
            </select>
          </div>
        </div>

        <div class="row my-2">
          <div class="col-md-4">
            <p><strong>Total Trans.</strong>  <span>{{ $transaction['total'] }}</span></p>
          </div>
          <div class="col-md-4">
            <p><strong>Verified</strong>  <span>{{ $transaction['verified'] }}</span></p>
          </div>
          <div class="col-md-4">
            <p><strong>Unverified</strong>  <span>{{ $transaction['unverified'] }}</span></p>
          </div>
      </div>

      <div class="row my-2">
        <div class="col-md-4">
          <p><strong>Total Amo.</strong> <span> <small>{{ number_format($amount['total'],2) }}</small> </span></p>
        </div>
        <div class="col-md-4">
          <p><strong>Verified</strong>  <span> <small>{{ number_format($amount['verified'],2) }}</small> </span></p>
        </div>
        <div class="col-md-4">
          <p><strong>Unverified</strong>  <span> <small>{{ number_format($amount['unverified'],2) }}</small> </span></p>
        </div>
    </div>

    <div class="row my-2 justify-content-end">
      <div class="col-md-4">
        <input type="text" class="form-control form-control-sm" id="slip-number" placeholder="Enter Slip#">
      </div>
      <div class="col-md-4">
        <a href="#"
            class="btn btn-sm btn-light-primary border border-primary btn-flex btn-center btn-active-primary"
            data-kt-menu-trigger="click"
            data-kt-menu-placement="bottom-end">
            Sort By
            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
          <!--begin::Menu-->
          <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
              data-kt-menu="true">
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                  <a href="javascript:void(0);" id="customer-sorted" class="menu-link px-3">
                      Customer
                  </a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                  <a href="javascript:void(0);" id="vessel-sorted" class="menu-link px-3">
                      Vessel
                  </a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                  <a href="javascript:void(0);" id="posting-date-sorted" class="menu-link px-3">
                      Posting Date
                  </a>
                </div>
                <!--end::Menu item-->
          </div>
            <!--end::Menu-->
          </div>
        </div>

        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <!--begin::Table-->
              <table class="table align-middle table-row-bordered table-hover fs-6 gy-5"
              id="kt_datatable_example">
              <thead>
                  <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                      <th class="min-w-125px">Customer</th>
                      <th class="min-w-125px">Vessel</small></th>
                      <th class="min-w-125px">Amount</small></th>
                      <th class="min-w-125px">IBFT</small></th>
                      <th class="min-w-125px">Slip #</small></th>
                      <th class="min-w-125px">Bank</small></th>
                      <th class="min-w-125px">Posting Date</small></th>
                      <th class="min-w-125px">Status</small></th>
                      <th class="text-center min-w-70px action-th">Actions</th>
                  </tr>
              </thead>
              <tbody class="fw-semibold text-gray-600">
                @foreach ($payments as $payment)
                    <tr>
                      <td>{{ $payment->customer_name ?? '--' }}</td>
                      <td>{{ $payment->inventory->vessel->name ?? '--' }}</td>
                      <td>{{ $payment->amount ?? '--' }}</td>
                      <td>{{ $payment->ibft ?? '--' }}</td>
                      <td>{{ $payment->deposit_slip_number ?? '--' }}</td>
                      <td>{{ $payment->bank->name ?? '--' }}</td>
                      <td>{{ $payment->posting_date ?? '--' }}</td>
                      <td>{{ $payment->status ?? '--' }}</td>
                      <td class="text-center action-td">
                        <a href="#"
                            class="btn btn-sm btn-light-primary btn-flex btn-center btn-active-primary"
                            data-kt-menu-trigger="click"
                            data-kt-menu-placement="bottom-end">
                            Actions
                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                        <!--begin::Menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                            data-kt-menu="true">

                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                              <a href="{{ url('custom-payments/verify/'.$payment->id) }}"
                                  class="menu-link px-3">
                                  Verify
                              </a>
                            </div>
                          <!--end::Menu item-->
                            
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                              <a href="javascript:void(0);"
                                  class="menu-link px-3">
                                  View
                              </a>
                            </div>
                          <!--end::Menu item-->
                            
                            <!--begin::Menu item-->
                              <div class="menu-item px-3">
                                <a href="{{ url('custom-payments/edit-hawala/'.$payment->id) }}"
                                    class="menu-link px-3">
                                    Edit
                                </a>
                              </div>
                            <!--end::Menu item-->


                            <div class="menu-item px-3">
                                <a href="{{ url('custom-payments/cancel/'.$payment->id) }}" class="menu-link px-3">
                                    Cancel
                                </a>
                            </div>

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
  {{-- End Row --}}
  @push('scripts')
  <script>
    const table = $('#kt_datatable_example').DataTable({
        info: false
    });
    $('#status').on('change', function() {
        table.column(7).search(this.value).draw();
    });
    $('#customer-sorted').on('click',function () { 
        table.column(0).order('asc').draw();
    });
    $('#vessel-sorted').on('click',function () { 
        table.column(1).order('asc').draw();
    });
    $('#posting-date-sorted').on('click',function () { 
        table.column(6).order('asc').draw();
    });
    $('#slip-number').on("keyup", function () {
      table.column(4).search(this.value).draw();
    });
  </script>
  @endpush

</x-default-layout>