<x-default-layout>
  <div class="row">
    <div class="col-lg-6">
      <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
        <div id="kt_app_toolbar_container">
          <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
            <h1
                class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                View Bank-Deposit
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
    </div>

    <div class="col-lg-6">
      <div class="text-end mt-5">
        <a href="{{ url('custom-payments/create-bank-deposit') }}" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left"></i> Back to Bank Deposit</a>
      </div>
  </div>

</div>

  {{-- Start Row --}}
  <div class="row">

    <div class="col-md-12">

      <div class="card">
        <div class="card-body">
            <form action="" id="edit-form" method="post" enctype="multipart/form-data">
                <div class="row mb-5">
                    <div class="col-md-4 mb-2">
                      <label for="buyer_id" class="form-label">Customer Name</label>
                      <select name="buyer_id" id="buyer_id" disabled class="form-select form-select-sm border border-dark" required>
                        <option>{{ $custom_payment->customer->name ?? '--' }}</option>
                      </select>
                    </div>
                    <div class="col-md-4">
                      <label for="inventory_id" class="form-label">Vessel</label>
                      <select name="inventory_id" id="inventory_id" disabled class="form-select form-select-sm border border-dark">
                        <option>{{ $custom_payment->inventory->vessel->name ?? '--' }}</option>
                      </select>
                    </div>
                    <div class="col-md-4">
                      <label for="posting_date" class="form-label">Posting Date</label>
                      <input type="date" name="posting_date" disabled id="posting_date" value="{{ $custom_payment->posting_date }}" class="form-control form-control-sm border border-dark">
                    </div>
                    <div class="col-md-6">
                      <label for="bank_acc_title" class="form-label">Bank A/C Title</label>
                      <select name="bank_acc_title" disabled id="bank_acc_title" class="form-select form-select-sm border border-dark">
                        <option value="">-- Select Bank --</option>
                        <option>{{ $custom_payment->bank_acc_title ?? '--' }}</option>
                      </select>
                    </div>
                </div>
                <hr>
                <div class="row mb-5 justify-content-center">
                  <div class="col-md-4 mb-2">
                    <label for="bank_id" class="form-label">Bank Name</label>
                    <select name="bank_id" disabled class="form-select form-select-sm border border-dark" id="bank_id" required>
                      <option>{{ $custom_payment->bank->bank_name ?? '--' }}</option>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label for="bank_id" class="form-label">Bank Branch</label>
                    <input type="text" disabled name="bank_branch" id="bank_branch" value="{{ $custom_payment->bank_branch }}" class="form-control form-control-sm border border-dark">
                  </div>
                  <div class="col-md-4">
                    <label for="deposit_slip_number" class="form-label">Deposit Slip #</label>
                    <input type="text" disabled name="deposit_slip_number" id="deposit_slip_number" value="{{ $custom_payment->deposit_slip_number }}" class="form-control form-control-sm border border-dark">
                  </div>
                  <div class="col-md-6">
                    <label for="stamp_date" class="form-label">Stamp Date</label>
                    <input type="date" disabled name="stamp_date" id="stamp_date" value="{{ $custom_payment->stamp_date }}" class="form-control form-control-sm border border-dark">
                  </div>
                  <div class="col-md-6">
                    <label for="attachment_deposit_slip" class="form-label">Attach Dep. Slip</label>
                    <input type="file" disabled name="attachment_deposit_slip" id="attachment_deposit_slip" class="form-control form-control-sm border border-dark">
                  </div>
                </div>
                <input type="hidden" name="type" value="bank_deposit">
                
              <div id="kt_docs_repeater_basic">
                  <div class="form-group">

                    <div class="mb-3" data-repeater-list="payment_cheques">

                        <div class="row border border-dark p-3 rounded-3 mb-2">
                          <div class="col-md-4">
                            <label for="cheque_number" class="form-label">Cheque #</label>
                            <input type="text" name="cheque_number" value="{{ $custom_payment->cheques->cheque_number }}" readonly id="cheque_number" class="form-control form-control-sm">
                          </div>
                          <div class="col-md-4">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" name="amount" id="amount" value="{{ $custom_payment->cheques->amount }}" readonly class="form-control form-control-sm">
                          </div>
                          <div class="col-md-4">
                            <label for="clearing_date" class="form-label">Clearing Date</label>
                            <input type="date" name="clearing_date" readonly value="{{ $custom_payment->cheques->clearing_date }}" id="clearing_date" class="form-control form-control-sm">
                          </div>
                          <div class="col-md-6">
                            <label for="remarks" class="form-label">Remarks</label>
                            <input type="text" name="remarks" readonly id="remarks" value="" class="form-control form-control-sm">
                          </div>
                      </div>
                    
                  </div>

                  </div>

              </div>
    
            </form>
        </div>
      </div>

    </div>

  </div>
  {{-- End Row --}}
  {!! theme()->addVendor('formrepeater') !!}

</x-default-layout>
