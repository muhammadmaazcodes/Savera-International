 <x-default-layout>
    <!--begin::Table widget 14-->
<div class="card card-flush h-md-100">
	<!--begin::Header-->
	<div class="card-header pt-7">
		<!--begin::Title-->
		<h3 class="card-title align-items-start flex-column">
			<span class="card-label fw-bold text-gray-800"><img src="{{ asset('assets/media/icons/sales-add.png') }}" height="40" alt=""> Edit Sales Request</span>
		</h3>
		<!--end::Title-->
	</div>
	<!--end::Header-->
	<!--begin::Body-->
	<div class="card-body pt-6">
		<form class="pt-1" method="POST" action="{{ route('sales.update',$sale->id) }}">
            @csrf
			<div class="row justify-content-center">
                <div class="col-md-4">
					<label for="vessel_id" class="form-label">Buyer</label>
					<select class="form-select form-select-lg mb-4" name="buyer_id" required>
						<option>-- Select Buyer --</option>
						@foreach($buyers as $buyer)
							<option value="{{ $buyer->id }}" {{ ($sale->buyer_id) ==  $buyer->id ? 'selected' : ''}}>{{ $buyer->name }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-md-4">
					<label for="vessel_id" class="form-label">Product</label>
					<select class="form-select form-select-lg mb-4" name="product_id" required>
						<option>-- Select Product --</option>
						@foreach($products as $product)
							<option value="{{ $product->id }}" {{ ($sale->product_id) ==  $product->id ? 'selected' : ''}}>{{ $product->code }}</option>
						@endforeach
					</select>
				</div>

                <div class="col-md-4">
					<label for="vessel_id" class="form-label">Vessels</label>
					<select class="form-select form-select-lg mb-4" name="inventory_id" required>
						<option>-- Select Vessel --</option>
						@foreach($vessels as $vessel)
							<option value="{{ $vessel->id }}"  {{ ($sale->inventory_id) ==  $vessel->id ? 'selected' : ''}}>{{ $vessel->vessel->name }} ({{ $vessel->vessel->voyage_number ?? 'LOCAL' }})</option>
						@endforeach
					</select>
				</div>

				<div class="col-md-3">
                    <label for="" class="form-label">Quantity</label>
					<input type="number" class="form-control form-control-lg border-dark" placeholder="Quantity" name="quantity" value="{{ $sale->quantity }}" required />
				</div>
			
            <div class="col-md-3">
                <label for="" class="form-label">Vehicle Number</label>
                <input type="text" name="vehicle_number" class="form-control" required placeholder="Enter Vehicle Number" value="{{ $sale->vehicle_number }}">
            </div>
        </div>
        </div>

			<div class="text-center mt-4 pb-4">
					<button type="submit" class="btn btn-lg btn-light fw-bold btn-primary me-2" data-kt-search-element="advanced-options-form-cancel">Update</button>
			</div>
		</form>
	</div>
    <br>
	<!--end: Card Body-->
    
</div>
<!--end::Table widget 14-->
</x-default-layout>