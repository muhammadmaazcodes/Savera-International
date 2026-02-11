 <x-default-layout>
    <!--begin::Table widget 14-->
<div class="card card-flush h-md-100">
	<!--begin::Header-->
	<div class="card-header pt-7">
		<!--begin::Title-->
		<h3 class="card-title align-items-start flex-column">
			<span class="card-label fw-bold text-gray-800"><img src="{{ asset('assets/media/icons/sales-add.png') }}" height="40" alt=""> Add Sales Request</span>
		</h3>
		<!--end::Title-->
	</div>
	<!--end::Header-->
	<!--begin::Body-->
	<div class="card-body pt-6">
		<form class="pt-1" method="POST" action="{{ route('sales.request.store') }}">
            @csrf
			<div class="row justify-content-center">
                <div class="col-md-4">
					<label for="vessel_id" class="form-label">Buyer</label>
					<select class="form-select form-select-lg mb-4" name="buyer_id" required>
						<option>-- Select Buyer --</option>
						@foreach($buyers as $buyer)
							<option value="{{ $buyer->id }}">{{ $buyer->name }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-md-4">
					<label for="vessel_id" class="form-label">Product</label>
					<select class="form-select form-select-lg mb-4" name="product_id" required>
						<option>-- Select Product --</option>
						@foreach($products as $product)
							<option value="{{ $product->id }}">{{ $product->name }}</option>
						@endforeach
					</select>
				</div>

                <div class="col-md-4">
					<label for="vessel_id" class="form-label">Vessels</label>
					<select class="form-select form-select-lg mb-4" name="inventory_id" required>
						<option>-- Select Vessel --</option>
						@foreach($vessels as $vessel)
							<option value="{{ $vessel->id }}">{{ $vessel->vessel->name }}</option>
						@endforeach
					</select>
				</div>

				<div class="col-md-3">
                    <label for="" class="form-label">Quantity</label>
					<input type="number" class="form-control form-control-lg border-dark" placeholder="Quantity" name="quantity" value="" required />
				</div>
			
            <div class="col-md-3">
                <label for="" class="form-label">Vehicle Number</label>
                <input type="text" name="vehicle_number" class="form-control" required placeholder="Enter Vehicle Number">
            </div>
        </div>
        </div>

			<div class="text-center mt-4 pb-4">
					<button type="submit" class="btn btn-lg btn-light fw-bold btn-primary me-2" data-kt-search-element="advanced-options-form-cancel">Add</button>
			</div>
		</form>
	</div>
    <br>
	<!--end: Card Body-->
    <div class="card">
        <div class="card-header pt-7">
            <!--begin::Title-->
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold text-gray-800"><img src="{{ asset('assets/media/icons/sales-view.png') }}" height="40" alt=""> Requested Sales</span>
            </h3>
            <!--end::Title-->

        </div>
        <div class="card-body pt-6">
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table id="data-table-simple" class="table table-row-bordered gy-5">
                    <thead>
                        <tr class="fw-semibold fs-6 text-muted">
                            <th>Buyer</th>
                            <th>Vessel</th>
                            <th>Vehicle Number</th>
                            <th><img src="{{ asset('assets/media/icons/product.png') }}" height="20" alt="">  Product</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sales as $sale)
                            <tr>
                                <td><strong>{{ $sale->buyer->name }}</strong></td>
                                <td>{{ $sale->inventory->vessel->name }}</td>
                                <td>{{ $sale->vehicle_number }}</td>
                                <td>{{ $sale->product->name }}</td>
                                <td>{{ $sale->quantity }} (Ton)</td>
                                <td>
                                    <div class="d-flex">
                                            <a href="{{ route('sales.add_lifting',$sale->id) }}" class="btn btn-primary btn-sm">{{ ($sale->lifting_bls) == '[]' ? 'Add Lift' :'Show' }}</a>
                                            &nbsp; <a href="{{ route('sales.edit',$sale->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        {{-- @if ($sale->lifting_bls != '[]')
                                            &nbsp; <a href="{{ route('sales.contract',$sale->id) }}" class="btn btn-primary btn-sm">Contract</a>
                                    @endif --}}
                                </div>
                                </td>
                            </tr>
                        @endforeach
                </table>
            </div>
            <!--end::Table-->
        </div>
    </div>
</div>
<!--end::Table widget 14-->
</x-default-layout>