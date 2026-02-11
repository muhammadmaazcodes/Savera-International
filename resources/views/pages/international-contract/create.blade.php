<x-default-layout>
	<!--begin::Table widget 14-->
<div class="card card-flush h-md-100">
	<!--begin::Header-->
	<div class="card-header pt-7">
		<!--begin::Title-->
		<h3 class="card-title align-items-start flex-column">
			<span class="card-label fw-bold text-gray-800">Create New International Contract</span>
		</h3>
		<!--end::Title-->
	</div>
	<!--end::Header-->
	<!--begin::Body-->
	<div class="card-body pt-6">
		<form class="pt-1" method="POST" action="/international-contract">
			@csrf
			<div class="row justify-content-center">
				<div class="col-md-4">
					<label for="company_id" class="form-label">Businesses</label>
					<select class="form-select form-select-lg mb-4" name="business_id" required>
						<option>-- Select Business --</option>
						@foreach($businesses as $business)
							<option value="{{ $business->id }}">{{ $business->name }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-md-4">
					<label for="company_id" class="form-label">Seller</label>
					<select class="form-select form-select-lg mb-4" name="seller_id" required>
						<option>-- Select Seller --</option>
						@foreach($companies as $seller)
							<option value="{{ $seller->id }}">{{ $seller->name }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-md-4">
					<label for="vessel_id" class="form-label">Buyer</label>
					<select class="form-select form-select-lg mb-4" name="buyer_id" required>
						<option>-- Select Buyer --</option>
						@foreach($companies as $buyer)
							<option value="{{ $buyer->id }}">{{ $buyer->name }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-md-4">
					<label for="product_id" class="form-label">Product</label>
					<select class="form-select form-select-lg mb-4" name="product_id" required>
						<option>-- Select Product --</option>
						@foreach($products as $product)
							<option value="{{ $product->id }}">{{ $product->name }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-md-4">
					<label for="product_id" class="form-label">Quantity</label>
					<input type="number" name="quantity" placeholder="Enter Quantity" class="form-control" required>
				</div>
				<div class="col-md-4">
					<label for="product_id" class="form-label">Status</label>
					<select class="form-select form-select-lg mb-4" name="status" required>
						<option value="normal">Normal</option>
						<option value="washout">Washout</option>
						<option value="split">Split</option>
					</select>
				</div>
			</div>
			
			<div class="text-center">
					<button type="submit" class="btn btn-lg btn-light fw-bold btn-primary me-2" data-kt-search-element="advanced-options-form-cancel">Create</button>
			</div>
		</form>
	</div>
	<!--end: Card Body-->
</div>
<!--end::Table widget 14-->
{!! theme()->addVendor('formrepeater') !!}
@push('scripts')

@endpush
</x-default-layout>