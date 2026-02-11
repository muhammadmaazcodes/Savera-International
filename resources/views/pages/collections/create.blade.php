<x-default-layout>
  <!--begin::Table widget 14-->
  <div class="card card-flush h-md-100">
      <!--begin::Header-->
      <div class="card-header pt-7">
          <!--begin::Title-->
          <h3 class="card-title align-items-start flex-column">
              <span class="card-label fw-bold text-gray-800">Add New Collection</span>
          </h3>
          <!--end::Title-->
      </div>
      <!--end::Header-->
      <!--begin::Body-->
      <div class="card-body pt-6">
          <form class="pt-1" method="POST" action="/collection">
              @csrf
              <div class="row justify-content-center">
                  <div class="col-md-4">
                      <label for="company_id" class="form-label">Buyer</label>
                      <select class="form-select form-select-lg mb-4" name="buyer_id">
                          @foreach ($buyers as $buyer)
                              <option value="{{ $buyer->id }}">{{ $buyer->name }}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="col-md-4">
                    <label for="" class="form-label">Voyage</label>
                    <input type="text" class="form-control form-control-lg" name="voyage" required />
                </div>
                  <div class="col-md-4">
                      <label for="vessel_id" class="form-label">Vessel</label>
                      <select class="form-select form-select-lg mb-4" name="vessel_id">
                          @foreach ($inventories as $inventory)
                              <option value="{{ $inventory->id }}">{{ $inventory->vessel->name }}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="col-md-4">
                      <label for="vessel_id" class="form-label">Payment Mode</label>
                      <select class="form-select form-select-lg mb-4" name="payment_mode">
                          <option>-- Select Payment Mode --</option>
                          @foreach ($payment_modes as $payment)
                              <option value="{{ $payment->id }}">{{ $payment->name }}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="col-md-4">
                    <label for="" class="form-label">Date</label>
                    <input type="date" class="form-control form-control-lg" name="date" required />
                  </div>
                  <div class="col-md-4">
                    <label for="" class="form-label">Bank Code</label>
                    <input type="text" class="form-control form-control-lg" name="bank_code" required />
                  </div>
                  <div class="col-md-4">
                    <label for="" class="form-label">A/c Title</label>
                    <input type="text" class="form-control form-control-lg" name="ac_title" required />
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="" class="form-label">Branch</label>
                    <input type="text" class="form-control form-control-lg" name="branch" required />
                  </div>

                  <div class="col-md-4 mb-3">
                      <label for="" class="form-label">Slip #</label>
                      <input type="text" class="form-control form-control-lg border-dark" name="slip_number" required />
                  </div>

                  <div class="col-md-4 mb-3">
                      <label for="" class="form-label">Cheque #</label>
                      <input type="text" class="form-control form-control-lg border-dark" name="cheque_number" required />
                  </div>

                  <div class="col-md-4 mb-3">
                    <label for="" class="form-label">Amount</label>
                    <input type="number" class="form-control form-control-lg border-dark" name="amount" placeholder="Amount" required />
                </div>

                <div class="col-md-4">
                  <label for="" class="form-label">Status</label>
                  <select class="form-select form-select-lg mb-4" name="status">
                    <option value="unverified">Unverified</option>
                    <option value="verified">Verified</option>
                  </select>
              </div>

              <div class="col-md-4 mb-3">
                <label for="" class="form-label">Remarks</label>
                <input type="text" class="form-control form-control-lg" name="remarks" required />
        </div>


              </div>
              
              <div class="text-center">
                  <button type="submit" class="btn btn-lg btn-light fw-bold btn-primary me-2"
                      data-kt-search-element="advanced-options-form-cancel">Add</button>
              </div>
          </form>
      </div>
      <!--end: Card Body-->
  </div>
  <!--end::Table widget 14-->
  {!! theme()->addVendor('formrepeater') !!}
</x-default-layout>
