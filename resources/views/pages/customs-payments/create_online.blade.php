<x-default-layout>
  <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

    <div id="kt_app_toolbar_container">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
            <h1
                class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                Add Payment-Online
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
                  Payment-Online </li>
            </ul>
        </div>
    </div>
</div>

  <div class="card">
    <div class="card-body">
        <form action="" method="post">
            
            <div class="row mb-5">
                <div class="col-md">
                  <label for="customer_number" class="form-label">Customer #</label>
                  <input type="number" name="customer_number" id="customer_number" class="form-control form-control-sm border border-dark">
                </div>
                <div class="col-md">
                  <label for="customer_name" class="form-label">Customer Name</label>
                  <input type="number" name="customer_name" id="customer_name" class="form-control form-control-sm border border-dark">
                </div>
                <div class="col-md">
                  <label for="vessel_id" class="form-label">Vessel</label>
                  <select name="vessel_id" id="vessel_id" class="form-select form-select-sm border border-dark">
                    <option value="">-- Select --</option>
                  </select>
                </div>
                <div class="col-md">
                  <label for="payment_type" class="form-label">Payment Type</label>
                  <select name="payment_type" id="payment_type" class="form-select form-select-sm border border-dark">
                    <option value="">-- Select --</option>
                    <option value="Bank Deposit">Bank Deposit</option>
                    <option value="Online">Online</option>
                    <option value="Cash">Cash</option>
                    <option value="Cheque">Cheque</option>
                  </select>
                </div>
                <div class="col-md">
                  <label for="posting_date" class="form-label">Posting Date</label>
                  <input type="date" name="posting_date" id="posting_date" class="form-control form-control-sm border border-dark">
                </div>
            </div>

            <div class="row mb-5 justify-content-center">
              <div class="col-md-3">
                <label for="bank_name" class="form-label">Bank Name</label>
                <input type="text" name="bank_name" id="bank_name" class="form-control form-control-sm border border-dark">
              </div>
              <div class="col-md-3">
                <label for="bank_branch" class="form-label">Bank Branch</label>
                <input type="text" name="bank_branch" id="bank_branch" class="form-control form-control-sm border border-dark">
              </div>
              <div class="col-md-3">
                <label for="acc_ttile" class="form-label">Bank A/c Title</label>
                <input type="text" name="acc_ttile" id="acc_ttile" class="form-control form-control-sm border border-dark">
              </div>
            </div>

            <div class="row border border-dark p-3 rounded-3">
              <div class="col-md">
                <label for="ibft_number" class="form-label">IBFT #</label>
                <input type="date" name="ibft_number" id="ibft_number" class="form-control form-control-sm">
              </div>
              <div class="col-md">
                <label for="transaction_date" class="form-label">Trans. Date</label>
                <input type="date" name="transaction_date" id="transaction_date" class="form-control form-control-sm">
              </div>
              <div class="col-md">
                <label for="amount" class="form-label">Amount</label>
                <input type="number" name="amount" id="amount" class="form-control form-control-sm">
              </div>
              <div class="col-md">
                <label for="remarks" class="form-label">Remarks</label>
                <input type="text" name="remarks" id="remarks" class="form-control form-control-sm">
              </div>
              <div class="col-md">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select form-select-sm">
                  <option value="">-- Select --</option>
                  <option value="Verified">Verified</option>
                  <option value="Unverified">Unverified</option>
                </select>
              </div>
          </div>

          <div id="btns" class="mt-4 text-center">
            <button type="button" class="btn btn-sm btn-primary">Save</button>
            <button type="button" class="btn btn-sm btn-primary">New</button>
            <button type="button" class="btn btn-sm btn-primary">Save & New Slip</button>
            <button type="button" class="btn btn-sm btn-primary">Move To Previous Entry</button>
            <button type="button" class="btn btn-sm btn-primary">Move To Next Entry</button>
          </div>
            

        </form>
    </div>
  </div>

</x-default-layout>
