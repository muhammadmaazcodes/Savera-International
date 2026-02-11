<x-default-layout>
  <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

    <div id="kt_app_toolbar_container">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
            <h1
                class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                Edit Settlement
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
          <form action="{{ url('custom-payments/update/'.$custom_payment->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                
                <div class="row mb-5">
                    <div class="col-md-4">
                      <label for="customer_number" class="form-label">Customer #</label>
                      <input type="text" name="customer_number" id="customer_number" value="{{ $custom_payment->customer_number }}" class="form-control form-control-sm border border-dark">
                    </div>
                    <div class="col-md-4">
                      <label for="customer_name" class="form-label">Customer Name</label>
                      <input type="text" name="customer_name" id="customer_name" value="{{ $custom_payment->customer_name }}" class="form-control form-control-sm border border-dark">
                    </div>
                    <div class="col-md-4">
                      <label for="inventory_id" class="form-label">Vessel</label>
                      <select name="inventory_id" id="inventory_id" class="form-select form-select-sm border border-dark">
                        <option value="">-- Select --</option>
                        @foreach ($inventories as $inventory)
                            <option value="{{ $inventory->id }}" {{ $custom_payment->inventory_id == $inventory->id ? 'selected' : '' }}>{{ $inventory->vessel->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-4">
                      <label for="posting_date" class="form-label">Posting Date</label>
                      <input type="date" name="posting_date" id="posting_date" value="{{ $custom_payment->posting_date }}" class="form-control form-control-sm border border-dark">
                    </div>
                    <div class="col-md-8">
                      <label for="settlement_name" class="form-label">Settlement Name</label>
                      <input type="text" name="settlement_name" id="settlement_name" value="{{ $custom_payment->settlement_name }}" class="form-control form-control-sm border border-dark">
                    </div>
                </div>
                <hr>
                <input type="hidden" name="type" value="hawala">
                <div class="row mb-5 justify-content-center">
                  <div class="col-md-4">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="text" name="amount" id="amount" value="{{ $custom_payment->amount }}" class="form-control form-control-sm">
                  </div>
                  <div class="col-md-8">
                    <label for="remarks" class="form-label">Remarks</label>
                    <textarea name="remarks" id="remarks" class="form-control" cols="30" rows="3">{{ $custom_payment->remarks }}</textarea>
                  </div>
                </div>
    
              <div class="row">
                  <div class="col-md-12 d-flex mt-3">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="status" id="status1" value="Verified" {{ $custom_payment->status == 'Verified' ? 'checked' : '' }}>
                      <label class="form-check-label" for="status1">
                        Verified
                      </label>
                    </div>
                    <div class="form-check ms-3">
                      <input class="form-check-input" type="radio" name="status" id="status2" value="Cancel" {{ $custom_payment->status == 'Cancel' ? 'checked' : '' }}>
                      <label class="form-check-label" for="status2">
                        Cancel
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

        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <!--begin::Table-->
              <table class="table align-middle table-row-bordered table-hover fs-6 gy-5"
              id="kt_datatable_example">
              <thead>
                  <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                      <th class="w-10px pe-2" hidden>
                          <div
                              class="form-check form-check-sm form-check-custom form-check-solid me-3">
                              <input class="form-check-input" type="checkbox"
                                  data-kt-check="true"
                                  data-kt-check-target="#kt_customers_table .form-check-input"
                                  value="1" />
                          </div>
                      </th>
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
                              {!! Form::open(['method' => 'DELETE','url' => ['custom-payments/destroy/'.$payment->id],'id' => 'form-delete'.'-'.$payment->id ,'style'=>'display:inline']) !!}
                              {!! Form::close() !!}
                                <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('form-delete-{{ $payment->id }}').submit();" class="menu-link px-3"
                                    data-kt-customer-table-filter="delete_row">
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

</x-default-layout>