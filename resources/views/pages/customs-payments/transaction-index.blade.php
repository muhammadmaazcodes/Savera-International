<x-default-layout>
  <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

    <div id="kt_app_toolbar_container">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
            <h1
                class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                Transactions
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
                  View-Transactions </li>
            </ul>
        </div>
    </div>
</div>

      <div class="accordion mb-4" id="accordionExample">
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button bg-secondary fw-bold text-dark fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              Filter Inventory
            </button> 
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <div class="row">
                    <div class="col-md-3 mb-1">
                      <label for="customer_number" class="form-label">Customer</label>
                      <input type="text" name="customer_number" id="customer_number" class="form-control form-control-sm border border-dark">
                    </div>
                    <div class="col-md-3 mb-1">
                        <label for="vessel_id" class="form-label">Vessel</label>
                        <select name="vessel_id" id="vessel_id" class="form-select form-select-sm border border-dark">
                          <option value="">-- Select --</option>
                          @foreach ($vessels as $vessel)
                              <option>{{ $vessel->name }}</option>
                          @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-1">
                      <label for="posting_date" class="form-label">Posting Date</label>
                      <input type="date" name="posting_date" id="posting_date" class="form-control form-control-sm border border-dark">
                    </div>
                    <div class="col-md-3 mb-1">
                      <label for="status" class="form-label">Status</label>
                      <select name="status" id="status" class="form-select form-select-sm border-dark">
                        <option value="">-- Select --</option>
                        <option value="Verified">Verified</option>
                        <option value="Unverified">Unverified</option>
                      </select>
                    </div>
                    <div class="col-md-3 mb-1">
                      <label for="deposit_slip" class="form-label">Deposit Slip #</label>
                      <input type="text" name="deposit_slip" id="deposit_slip" class="form-control form-control-sm border border-dark">
                    </div>
                    <div class="col-md-3 mb-1">
                      <label for="payment_type" class="form-label">Payment Type</label>
                      <select name="payment_type" id="payment_type" class="form-select form-select-sm border border-dark">
                        <option value="">-- Select --</option>
                        <option value="Bank Deposit">Bank Deposit</option>
                        <option value="Online">Online</option>
                        <option value="Cash">Cash</option>
                        <option value="Cheque">Cheque</option>
                      </select>
                    </div>
                    <div class="col-md-3 mb-1">
                      <label for="cheque_number" class="form-label">Cheque #</label>
                      <input type="text" name="cheque_number" id="cheque_number" class="form-control form-control-sm border border-dark">
                    </div>
                    <div class="col-md-3 mb-1">
                      <label for="bank_name" class="form-label">Bank Name</label>
                      <select name="bank_name" id="bank_name" class="form-select border border-dark form-select-sm">
                        <option value="">-- Select --</option>
                        @foreach ($banks as $bank)
                            <option>{{ $bank->name }}</option>
                        @endforeach
                      </select>
                    </div>

                </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="bulk-action mb-2 row">
            <form id="bulk-status" action="{{ url('custom-payments/update-bulk-status') }}" method="post">
              @csrf
              @method('POST')
            </form>
            <div class="col-md-6" id="move_terminal" style="visibility: hidden;">
                <select name="bulk_status" form="bulk-status" class="form-select form-select-sm">
                    <option selected disabled value="">-- Select Status --</option>
                    <option value="Verified">Verified</option>
                    <option value="Unverified">Unverified</option>
                    <option value="Cancel">Cancel</option>
                </select>
            </div>
            <div class="col-md-6">
                <button type="submit" form="bulk-status" id="move-terminal-btn" class="btn btn-danger btn-sm" style="visibility: hidden;"><span id="num_bls"></span> Update</button>
            </div>
        </div>
        </div>
      </div>

  <div class="card">

      <div class="card-header border-0 pt-6">
        <ul class="nav nav-pills mb-2">
          <li class="nav-item">
            <a class="nav-link" href="/custom-payments/posting-date">Posting Date</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/custom-payments/vessel">Vessel</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/custom-payments/customer">Customer</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/custom-payments/transaction">All Trans.</a>
          </li>
        </ul>
        <div class="card-toolbar">
          <p>
            <strong>Total:</strong> {{ $transaction['total'] }}
          </p>
          <p class="mx-4">
            <strong>Verified:</strong> {{ $transaction['verified'] }}
          </p>
          <p>
            <strong>Unverified:</strong> {{ $transaction['unverified'] }}
          </p>
        </div>
    </div>

    
    <div class="card-body">
        <div class="table-responsive">
            
          <!--begin::Table-->
            <table class="table align-middle table-row-bordered table-hover fs-6 gy-5" id="kt_datatable_example">
            <thead>
                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                    <th><input type="checkbox" id="select-all" class="form-check-input border-dark"></th>
                    <th class="min-w-125px">Customer</th>
                    <th class="min-w-125px">Vessel</th>
                    <th class="min-w-125px">Amount</th>
                    <th class="min-w-125px">Payment Type</th>
                    <th class="min-w-125px">Slip #</small></th>
                    <th class="min-w-125px">Bank</small></th>
                    <th class="min-w-125px">Remarks</small></th>
                    <th class="min-w-125px">Status</small></th>
                    <th hidden>Posting Date</th>
                    <th hidden>Cheque No.</th>
                    <th class="text-center min-w-70px action-th">Actions</th>
                </tr>
            </thead>
            <tbody class="fw-semibold text-gray-600">
              @foreach ($payments as $payment)
                <tr>
                  <td><input type="checkbox" name="payment_ids[]" form="bulk-status" value="{{ $payment->id }}" class="form-check-input select-payment"></td>
                  <td>{{ $payment->customer->name ?? '--' }}</td>
                  <td>{{ $payment->inventory->vessel->name ?? '--' }}</td>
                  <td>{{ number_format($payment->amount,2) ?? '--' }}</td>
                  <td>{{ $payment->type ?? '--' }}</td>
                  <td>{{ $payment->deposit_slip_number ?? '--' }}</td>
                  <td>{{ $payment->bank->name ?? '--' }}</td>
                  <td>{{ $payment->remarks ?? '--' }}</td>
                  <td>{{ $payment->status ?? '--' }}</td>
                  <td hidden>{{ $payment->posting_date }}</td>
                  <td hidden>{{ $payment->cheques->cheque_number }}</td>
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
                      @if ($payment->type == 'bank_deposit')
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                          <a href="{{ url('custom-payments/view-bank-deposit/'.$payment->id) }}"
                              class="menu-link px-3">
                              View
                          </a>
                        </div>
                      <!--end::Menu item-->
                      @endif
                      @if ($payment->type == 'Bank Deposit')
                      <!--begin::Menu item-->
                        <div class="menu-item px-3">
                          <a href="{{ url('custom-payments/edit-bank-deposit/'.$payment->id) }}"
                              class="menu-link px-3">
                              Edit
                          </a>
                        </div>
                      <!--end::Menu item-->
                      @elseif($payment->type == 'Cash')
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                          <a href="{{ url('custom-payments/edit-cash/'.$payment->id) }}"
                              class="menu-link px-3">
                              Edit
                          </a>
                        </div>
                      <!--end::Menu item-->
                      @else
                      <!--begin::Menu item-->
                        <div class="menu-item px-3">
                          <a href="{{ url('custom-payments/edit-settlement/'.$payment->id) }}"
                              class="menu-link px-3">
                              Edit
                          </a>
                        </div>
                      <!--end::Menu item-->
                      @endif

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
@push('scripts')
<script>
  const table = $('#kt_datatable_example').DataTable({
      info: false,
      order: false
  });
  $('#status').on('change', function() {
      table.column(8).search(this.value).draw();
  });
  $('#cheque_number').on('keyup', function() {
      table.column(10).search(this.value).draw();
  });
  $('#customer_number').on('keyup',function () { 
      table.column(1).search(this.value).draw();
   });
   $('#vessel_id').on('change',function () { 
      table.column(2).search(this.value).draw();
   });
   $('#deposit_slip').on('keyup',function () { 
      table.column(5).search(this.value).draw();
   });
   $('#payment_type').on("change", function () {
      table.column(4).search(this.value).draw();
   });
   $('#posting_date').on("change", function () {
      table.column(9).search(this.value).draw();
   });
   $('#bank_name').on("change", function () {
      table.column(6).search(this.value).draw();
   });
</script>
<script>
  $(document).on("click","#select-all", function () {
      if ($(this).is(':checked')) {
          $('.select-payment').prop('checked',true)
          $('#move-terminal-btn').css('visibility','visible');
          $('#move_terminal').css('visibility','visible');
          var num_bls = $('.select-payment').length;
          $('#num_bls').text('('+num_bls+')');
          $('#left-card').hide();
      }
      else {
          $('.select-payment').prop('checked',false)
          $('#move-terminal-btn').css('visibility','hidden');
          $('#move_terminal').css('visibility','hidden');
          $('#left-card').show();
      }
  });

    $(document).on("click",".select-payment", function () {
          var checkeds =  $('.select-payment:checked').length;
          
          if (checkeds > 0) {
              $('#move-terminal-btn').css('visibility','visible');
              $('#move_terminal').css('visibility','visible');
              $('#num_bls').text('('+checkeds+')');
              $('#left-card').hide();
          }
          else {
              $('#move-terminal-btn').css('visibility','hidden');
              $('#move_terminal').css('visibility','hidden');
              $('#left-card').show();
          }
      });
</script>
@endpush
</x-default-layout>