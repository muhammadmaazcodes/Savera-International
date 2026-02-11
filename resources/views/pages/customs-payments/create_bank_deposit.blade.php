<x-default-layout>

  <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

    <div id="kt_app_toolbar_container">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
            <h1
                class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                Add Bank-Deposit
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
                  Bank-Deposit </li>
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
                    <div class="col-md-6 mb-2">
                      <label for="buyer_id" class="form-label">Customer Name</label>
                      <select name="buyer_id" id="buyer_id" class="form-select form-select-sm border border-dark" required>
                        <option value="">---</option>
                        @foreach ($buyers as $buyer)
                            <option value="{{ $buyer->id }}" {{ old('buyer_id') == $buyer->id ? 'selected' : '' }} >{{ $buyer->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-6 mb-2">
                      <label for="inventory_id" class="form-label">Vessel</label>
                      <select name="inventory_id" id="inventory_id" class="form-select form-select-sm border border-dark">
                        <option value="">-- Select --</option>
                        @foreach ($inventories as $inventory)
                          <option value="{{ $inventory->id }}" {{ old('inventory_id') == $inventory->id ? 'selected' : '' }}>{{ $inventory->vessel->name }} ({{ $inventory->voyage_number }})</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label for="posting_date" class="form-label">Posting Date</label>
                      <input type="date" name="posting_date" id="posting_date" value="{{ old('posting_date') }}" class="form-control form-control-sm border border-dark">
                    </div>
                    <div class="col-md-6">
                      <label for="bank_acc_title" class="form-label">Bank A/C Title</label>
                      <select name="bank_acc_title" id="bank_acc_title" class="form-select form-select-sm border border-dark">
                        <option value="">-- Select Bank --</option>
                        @foreach ($bank_accounts as $bank)
                            <option value="{{ $bank->account_title }}" {{ old('bank_acc_title') == $bank->account_title ? 'selected' : '' }} >{{ $bank->account_title }}</option>
                        @endforeach
                      </select>
                    </div>
                </div>
                <hr>
                <div class="row mb-5 justify-content-center">
                  <div class="col-md-4 mb-2">
                    <label for="bank_id" class="form-label">Bank Name</label>
                    <select name="bank_id" class="form-select form-select-sm border border-dark" id="bank_id" required>
                      <option value="">---</option>
                      @foreach ($bank_accounts as $bank)
                        <option value="{{ $bank->id }}">{{ $bank->bank_name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-4 mb-2">
                    <label for="bank_branch" class="form-label">Bank Branch</label>
                    <input type="text" name="bank_branch" id="bank_branch" class="form-control form-control-sm border border-dark">
                  </div>
                  <div class="col-md-4 mb-2">
                    <label for="deposit_slip_number" class="form-label">Deposit Slip #</label>
                    <input type="text" name="deposit_slip_number" id="deposit_slip_number" class="form-control form-control-sm border border-dark">
                  </div>
                  <div class="col-md-6">
                    <label for="stamp_date" class="form-label">Stamp Date</label>
                    <input type="date" name="stamp_date" id="stamp_date" class="form-control form-control-sm border border-dark">
                  </div>
                  <div class="col-md-6">
                    <label for="attachment_deposit_slip" class="form-label">Attach Dep. Slip</label>
                    <input type="file" name="attachment_deposit_slip" id="attachment_deposit_slip" class="form-control form-control-sm border border-dark">
                  </div>
                </div>
                <input type="hidden" name="type" value="bank_deposit">
                
              <div id="kt_docs_repeater_basic">
                  <div class="form-group">

                    <div class="mb-3" data-repeater-list="payment_cheques">
                      <div class="row border border-dark p-3 rounded-3 mb-2" data-repeater-item>
                        
                        <div class="col-md-4 mb-3">
                          <label for="trans_type" class="form-label">Type</label>
                          <select name="trans_type" id="trans_type" class="form-select form-select-sm">
                            <option value="">-- Select Type --</option>
                            <option value="cash">Cash</option>
                            <option value="cheque">Cheque</option>
                            <option value="ibft">IBFT</option>
                          </select>
                        </div>
                        <div class="col-md-4 mb-3 cheque_number" style="display: none;">
                          <label for="cheque_number" class="form-label">Cheque #</label>
                          <input type="text" name="cheque_number" id="cheque_number" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-4 mb-3 ibft_number" style="display: none;">
                          <label for="ibft" class="form-label">IBFT #</label>
                          <input type="text" name="ibft" id="ibft" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-4">
                          <label for="amount" class="form-label">Amount</label>
                          <input type="number" name="amount" id="amount" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-4">
                          <label for="clearing_date" class="form-label">Clearing Date</label>
                          <input type="date" name="clearing_date" id="clearing_date" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-6">
                          <label for="remarks" class="form-label">Remarks</label>
                          <input type="text" name="remarks" id="remarks" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-2 mt-3">
                          <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-5">
                            <i class="fa fa-cancel"></i>
                          </a>
                        </div>
                    </div>

                  </div>

                  </div>
                  <button type="button" id="add-more" class="btn btn-light-primary btn-sm" data-repeater-create>Add More</button>

              </div>



              <div class="row">
                  <div class="col-md-12 d-flex mt-3">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="status" id="status1" value="Verified">
                      <label class="form-check-label" for="status1">
                        Verified
                      </label>
                    </div>
                    <div class="form-check mx-3">
                      <input class="form-check-input" type="radio" name="status" id="status2" checked value="Unverified">
                      <label class="form-check-label" for="status2">
                        Unverified
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="status" id="status2" value="Cancel">
                      <label class="form-check-label" for="status2">
                        Cancelled
                      </label>
                    </div>
                  </div>
              </div>
              <input type="hidden" name="save_and_new">
              <div class="btn text-center">
                <button type="submit" class="btn btn-sm btn-primary">Save</button>
                <button type="submit" id="save_and_new" class="btn btn-sm btn-primary mx-2 my-2">Save & New Slip</button>
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
            <div id="kt_datatable_example_export_menu">
              <button type="button" data-kt-export="excel" class="btn btn-secondary btn-sm mb-2">Export</button>
            </div>
          </div>
          <div class="col-md-3">
            <button type="button" class="btn btn-secondary btn-sm mb-2">Download</button>
          </div>
          <div class="col-md-3">
            {{-- Date --}}
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
          <p><strong>Total Amo.</strong> <span> <small>{{ number_format($amount['total']) }}</small> </span></p>
        </div>
        <div class="col-md-4">
          <p><strong>Verified</strong>  <span> <small>{{ number_format($amount['verified']) }}</small> </span></p>
        </div>
        <div class="col-md-4">
          <p><strong>Unverified</strong>  <span> <small>{{ number_format($amount['unverified']) }}</small> </span></p>
        </div>
    </div>

    <div class="row my-2 justify-content-end">
      <div class="col-md-4">
        <input type="text" class="form-control form-control-sm" id="slip-number" placeholder="Enter Slip#">
      </div>
      <div class="col-md-4">
        <input type="text" class="form-control form-control-sm" id="chq_num" placeholder="Enter Chq#">
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

        <div class="card">
          <div class="card-body pt-0">

            <div class="table-responsive">
              <!--begin::Table-->
              <table class="table align-middle table-row-bordered table-hover fs-6 gy-5"
              id="kt_datatable_example">
              <thead>
                  <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                      <th><input type="checkbox" id="select-all" class="form-check-input border-dark"></th>
                      <th class="min-w-7px">Customer</th>
                      <th class="min-w-7px">Vessel</small></th>
                      <th class="min-w-7px">Amount</small></th>
                      <th class="min-w-7px">IBFT</small></th>
                      <th class="min-w-7px">Slip #</small></th>
                      <th class="min-w-7px">Bank</small></th>
                      <th class="min-w-7px">Posting Date</small></th>
                      <th class="min-w-7px">Status</small></th>
                      <th hidden>Chq. No.</th>
                      <th class="text-center action-th">Actions</th>
                  </tr>
              </thead>
              <tbody class="fw-semibold text-gray-600">
                @foreach ($cheques as $cheque)
                    <tr>
                      <td><input type="checkbox" name="payment_ids[]" form="bulk-status" value="{{ $cheque->payment->id }}" class="form-check-input select-payment"></td>
                      <td>{{ $cheque->payment->customer->name ?? '--' }}</td>
                      <td>{{ $cheque->payment->inventory->vessel->name ?? '--' }}</td>
                      <td>{{ number_format($cheque->amount) ?? '--' }}</td>
                      <td>{{ $cheque->payment->ibft ?? '--' }}</td>
                      <td>{{ $cheque->payment->deposit_slip_number ?? '--' }}</td>
                      <td>{{ $cheque->payment->bank->name ?? '--' }}</td>
                      <td>{{ $cheque->payment->posting_date ?? '--' }}</td>
                      <td>{{ $cheque->payment->status ?? '--' }}</td>
                      <td hidden>{{ $cheque->cheque_number }}</td>
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
                              <a href="{{ url('custom-payments/verify/'.$cheque->payment->id) }}"
                                  class="menu-link px-3">
                                  Verify
                              </a>
                            </div>
                          <!--end::Menu item-->
                            
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                              <a href="{{ url('custom-payments/view-bank-deposit/'.$cheque->payment->id) }}"
                                  class="menu-link px-3">
                                  View
                              </a>
                            </div>
                          <!--end::Menu item-->
                            
                            <!--begin::Menu item-->
                              <div class="menu-item px-3">
                                <a href="{{ url('custom-payments/edit-bank-deposit/'.$cheque->payment->id) }}"
                                    class="menu-link px-3">
                                    Edit
                                </a>
                              </div>
                            <!--end::Menu item-->
    
    
                            <div class="menu-item px-3">
                              <a href="{{ url('custom-payments/cancel/'.$cheque->payment->id) }}" class="menu-link px-3">
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
  {!! theme()->addVendor('formrepeater') !!}
@push('scripts')

@if (Session::has('error'))
    <script>
        swal("{{ Session::get('error') }}","","warning");
    </script>
@endif
@if (Session::has('success'))
    <script>
        swal("{{ Session::get('success') }}","","success");
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

<script>
  const table = $('#kt_datatable_example').DataTable({
      info: false,
      order: false
  });
  $('#status').on('change', function() {
      table.column(8).search(this.value).draw();
  });
  $('#chq_num').on('keyup', function() {
      table.column(9).search(this.value).draw();
  });
  $('#customer-sorted').on('click',function () { 
      table.column(1).order('asc').draw();
   });
   $('#vessel-sorted').on('click',function () { 
      table.column(2).order('asc').draw();
   });
   $('#posting-date-sorted').on('click',function () { 
      table.column(7).order('asc').draw();
   });
   $('#slip-number').on("keyup", function () {
      table.column(5).search(this.value).draw();
   });
</script>
<script>
  $(document).ready(function () {
      $('#add-more').trigger('click');
  });
</script>
  <script>
      $(document).on("click","#save_and_new", function () {
          $('input[name="save_and_new"]').val('yes');
      });
  </script>
  <script>
    $(document).on("change","#trans_type", function () {
        var value = $(this).find('option:selected').val();
        if (value == 'cash') {
          $(this).closest(".row").find('.cheque_number').hide();
          $(this).closest(".row").find('.ibft_number').hide();
        }
        else if(value == 'cheque') {
          $(this).closest(".row").find('.cheque_number').show();
          $(this).closest(".row").find('.ibft_number').hide();
        }
        else if(value == 'ibft') {
          $(this).closest(".row").find('.cheque_number').hide();
          $(this).closest(".row").find('.ibft_number').show();
        }
    });
  </script>
@endpush

</x-default-layout>