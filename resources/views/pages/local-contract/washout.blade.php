<x-default-layout>
	<!--begin::Table widget 14-->
<div class="card card-flush h-md-100">
	<!--begin::Header-->
	<div class="card-header pt-7">
		<!--begin::Title-->
		<h3 class="card-title align-items-start flex-column">
			<span class="card-label fw-bold text-gray-800">Contract (Washout)</span>
		</h3>
		<!--end::Title-->
		<h3 class="card-title align-items-end flex-column">
			<span class="card-label fw-bold fs-6 text-gray-800" id="contract_code">WO Contract# {{ $contract->code }}-WO</span>
		</h3>

	</div>
	<!--end::Header-->
	<!--begin::Body-->

	{{-- Begin Tabs --}}
			<div class="card-body pt-6">
				<form class="pt-1" id="contract-form" method="POST" action="/local-contracts/washout/{{ $contract->id }}">
					@csrf
					
          <div class="row">
            <div class="col-lg-8">

              <div class="row">
                  <div class="col-md-4">
                    <label for="" class="form-label">Contract Date</label>
                    <input type="date" class="form-control" name="contract_date" required>
                  </div>
                  <div class="col-md-4">
                    <label for="" class="form-label">Contract Bal. Qty</label>
                    <input type="number" class="form-control" value="{{ $contract->quantity - $contract->liftings->sum('quantity') }}" disabled>
                  </div>
                  <div class="col-md-4">
                    <label for="" class="form-label">Washout. Qty</label>
                    <input type="number" class="form-control" name="washout_qty" required>
                  </div>
                  <div class="col-md-4 mt-2">
                    <label for="" class="form-label">Rate (PKR)</label>
                    <input type="number" class="form-control" value="{{ $contract->rate }}" name="rate" required>
                  </div>
                  <div class="col-md-4 mt-2">
                    <label for="" class="form-label">Selling Price</label>
                    <input type="number" class="form-control" value="{{ $contract->selling_price }}" name="selling_price" required>
                  </div>
              </div>

            </div>

            <div class="col-lg-4">
              <label for="" class="form-label">Remarks</label>
              <textarea name="remarks" class="form-control" cols="30" rows="4"></textarea>
            </div>
            
          </div>
					
					<div class="text-center mt-15">
							<button type="submit" class="btn btn-lg btn-light fw-bold btn-primary me-2 contract-submit">Confirm</button>
					</div>
				</form>
			</div>

	
	<!--end: Card Body-->
</div>
<!--end::Table widget 14-->

</x-default-layout>