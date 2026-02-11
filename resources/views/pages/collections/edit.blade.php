<x-default-layout>
  <!--begin::Table widget 14-->
  <div class="card card-flush h-md-100">
      <!--begin::Header-->
      <div class="card-header pt-7">
          <!--begin::Title-->
          <h3 class="card-title align-items-start flex-column">
              <span class="card-label fw-bold text-gray-800">Edit Collection</span>
          </h3>
          <!--end::Title-->
      </div>
      <!--end::Header-->
      <!--begin::Body-->
      <div class="card-body pt-6">
          <form class="pt-1" method="POST" action="/collection/{{ $collection->id }}">
              @csrf
              @method('PUT')
              <div class="row justify-content-center">
                  <div class="col-md-4">
                      <label for="company_id" class="form-label">Buyer</label>
                      <select class="form-select form-select-lg mb-4" name="buyer_id">
                          @foreach ($buyers as $buyer)
                              <option value="{{ $buyer->id }}" {{ ($collection->buyer_id) == $buyer->id ? 'selected' : '' }}>{{ $buyer->name }}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="col-md-4">
                    <label for="" class="form-label">Voyage</label>
                    <input type="text" class="form-control form-control-lg" value="{{ $collection->voyage }}" name="voyage" required />
                </div>
                  <div class="col-md-4">
                      <label for="vessel_id" class="form-label">Vessel</label>
                      <select class="form-select form-select-lg mb-4" name="vessel_id">
                          @foreach ($inventories as $inventory)
                              <option value="{{ $inventory->id }}" {{ ($collection->vessel_id) == $inventory->id ? 'selected' : '' }}>{{ $inventory->vessel->name }}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="col-md-4">
                      <label for="vessel_id" class="form-label">Payment Mode</label>
                      <select class="form-select form-select-lg mb-4" name="payment_mode">
                          <option>-- Select Payment Mode --</option>
                          @foreach ($payment_modes as $payment)
                              <option value="{{ $payment->id }}" {{ ($collection->payment_mode) == $payment->id ? 'selected' : '' }}>{{ $payment->name }}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="col-md-4">
                    <label for="" class="form-label">Date</label>
                    <input type="date" class="form-control form-control-lg" value="{{ $collection->date }}" name="date" required />
                  </div>
                  <div class="col-md-4">
                    <label for="" class="form-label">Bank Code</label>
                    <input type="text" class="form-control form-control-lg" value="{{ $collection->bank_code }}" name="bank_code" required />
                  </div>
                  <div class="col-md-4">
                    <label for="" class="form-label">A/c Title</label>
                    <input type="text" class="form-control form-control-lg" value="{{ $collection->ac_title }}" name="ac_title" required />
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="" class="form-label">Branch</label>
                    <input type="text" class="form-control form-control-lg" value="{{ $collection->branch }}" name="branch" required />
                  </div>

                  <div class="col-md-4 mb-3">
                      <label for="" class="form-label">Slip #</label>
                      <input type="text" class="form-control form-control-lg border-dark" value="{{ $collection->slip_number }}" name="slip_number" required />
                  </div>

                  <div class="col-md-4 mb-3">
                      <label for="" class="form-label">Cheque #</label>
                      <input type="text" class="form-control form-control-lg border-dark" value="{{ $collection->cheque_number }}" name="cheque_number" required />
                  </div>

                  <div class="col-md-4 mb-3">
                    <label for="" class="form-label">Amount</label>
                    <input type="number" class="form-control form-control-lg border-dark" value="{{ $collection->amount }}" name="amount" placeholder="Amount" required />
                </div>

                <div class="col-md-4">
                  <label for="" class="form-label">Status</label>
                  <select class="form-select form-select-lg mb-4" name="status">
                    <option value="unverified" {{ ($collection->status) == 'unverified' ? 'selected' : '' }}>Unverified</option>
                    <option value="verified" {{ ($collection->status) == 'verified' ? 'selected' : '' }}>Verified</option>
                  </select>
              </div>

              <div class="col-md-4 mb-3">
                <label for="" class="form-label">Remarks</label>
                <input type="text" class="form-control form-control-lg" name="remarks" value="{{ $collection->remarks }}" required />
        </div>


              </div>
              
              <div class="text-center">
                  <button type="submit" class="btn btn-lg btn-light fw-bold btn-primary me-2"
                      data-kt-search-element="advanced-options-form-cancel">Update</button>
              </div>
          </form>
      </div>
      <!--end: Card Body-->
  </div>
  <!--end::Table widget 14-->
  {!! theme()->addVendor('formrepeater') !!}
</x-default-layout>
