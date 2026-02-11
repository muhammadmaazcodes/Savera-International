<x-default-layout>
	<!--begin::Table widget 14-->
<div class="card card-flush h-md-100">
	<!--begin::Header-->
	<div class="card-header pt-7">
		<!--begin::Title-->
		<h3 class="card-title align-items-start flex-column">
			<span class="card-label fw-bold text-gray-800">Inventories</span>
		</h3>
		<!--end::Title-->
		<!--begin::Toolbar-->
		<div class="card-toolbar">
			<a href="/inventories/create" class="btn btn-sm btn-secondary">Add New</a>
		</div>
		<!--end::Toolbar-->
	</div>
	<!--end::Header-->
	<!--begin::Body-->
	<div class="card-body pt-6">
		<!--begin::Table container-->
		<div class="table-responsive">
			<!--begin::Table-->

			{{-- <table id="data-table-simple" class="table table-row-bordered gy-5">
			    <thead>
			        <tr class="fw-semibold fs-6 text-muted">
			            <!-- <th>Product Name</th> -->
			            <th>Vessel</th>
			            <th>Voyage</th>
			            <th>Seller</th>
			            <th>Buyer</th>
			            <th>Landed Qty</th>
			            <th>Unsold Qty</th>
			            <th>Lifted Qty</th>
			            <!-- <th>Shortage</th> -->
			            <th>Action</th>
			        </tr>
			    </thead>
			    <tbody>
			    	@foreach($inventories as $inventory)
					@php
						$bl = \App\Models\InventoryBL::where('inventory_id',$inventory->id)->get();
						$contract = \App\Models\LocalContract::where('inventory_id',$inventory->id)->get();
						$lifted = \App\Models\SaleContract::whereIn('contract_id',$contract->pluck('id')->toArray())->get();
					@endphp
			        <tr>
			            <!-- <td>{{ $inventory->product->name }}</td> -->
			            <td>{{ $inventory->vessel->name ?? 'N/A' }}</td>
			            <td>{{ $inventory->voyage_number ?? 'N/A' }}</td>
			            <td>{{ $inventory->seller->name ?? 'N/A' }}</td>
			            <td>{{ $inventory->buyer->name ?? 'N/A' }}</td>
			            <td>{{ number_format($bl->sum('landed_quantity'),3) }}</td>
			            <td>{{ number_format($bl->sum('bl_quantity') - $contract->sum('quantity'),3) }}</td>
			            <!-- <td>{{ number_format($bl->sum('bl_quantity'),3) }}</td> -->
									<td>{{ $lifted ? $contract->sum('quantity') - $lifted->sum('quantity') : 0 }}</td>
									<!-- <td>{{ number_format($bl->sum('bl_quantity') - $bl->sum('landed_quantity'),3) }}</td> -->
			            <!-- <td>{{ ($inventory->status) ? $inventory->bl_quantity : 'Pending' }}</td> -->
			            <td>
							<a href="/inventories/{{ $inventory->id }}/edit" class="btn btn-sm btn-primary align-self-center">Edit</a>
							<a href="/inventories/{{ $inventory->id }}/show" class="btn btn-sm btn-primary align-self-center">Show</a>
							<a href="/inventories/{{ $inventory->id }}/detail" class="btn btn-sm btn-primary align-self-center">Detail</a>
						</td>
			        </tr>
			        @endforeach
			</table> --}}

			<table id="data-table-simple" class="table table-row-bordered gy-5">
				<div class="row">
					<div class="col-md-2">
						<select name="seller" id="seller" class="form-control">
							<option disabled selected>Search Seller</option>
							@foreach ($sellers as $seller)
								<option value="{{ $seller->name }}">{{ $seller->name }}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-2">
						<select name="vessel" id="vessel" class="form-control">
							<option disabled selected>Search Vessel</option>
							@foreach ($vessels as $vessel)
								<option value="{{ $vessel->name }}">{{ $vessel->name }}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-2">
						<select name="product" id="product" class="form-control">
							<option disabled selected>Search Product</option>
							@foreach ($products as $product)
								<option value="{{ $product->code }}">{{ $product->code }}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-2">
						<input type="text" name="bl_qty" id="bl_qty" placeholder="BL Qty" class="form-control">
					</div>
					<div class="col-md-2">
						<input type="text" name="landed_qty" id="landed_qty" placeholder="Landed Qty" class="form-control">
					</div>
					<div class="col-md-2">
						<input type="text" name="shortage" id="shortage" placeholder="Shortage" class="form-control">
					</div>
				</div>
				<thead>
						<tr class="fw-semibold fs-6 text-muted">
								<th>Seller</th>
								<th>Vessel Name</th>
								<th>Product Code</th>
								<th>BL Quantity</th>
								<th>Landed Quantity</th>
								<th>Shortage</th>
								<th>Action</th>
						</tr>
				</thead>
				<tbody>
					@foreach($inventories as $inventory)
				@php
					$bl = \App\Models\InventoryBL::where('inventory_id',$inventory->id)->get();
					$contracts = \App\Models\LocalContract::where('inventory_id',$inventory->id)->get();
					$shortage_contract = $bl->sum('bl_quantity') - $bl->sum('landed_quantity');
				@endphp
						<tr>
								<td>{{ $inventory->seller->name }}</td>
								<td>{{ $inventory->vessel->name }}</td>
								<td>{{ $inventory->product->code }}</td>
								<td>{{ number_format($bl->sum('bl_quantity'),3) }}</td>
								<td>{{ number_format($bl->sum('bl_quantity') - $shortage_contract,3) }}</td>
								<td>{{ number_format($shortage_contract,3) }}</td>
								{{-- <td>{{ ($inventory->status) ? $inventory->bl_quantity : 'Pending' }}</td> --}}
								<td>
						@if ($contracts->count() > 0)
							<button class="btn btn-sm btn-danger align-self-center delete-has-contract">Delete</button>
							<button class="btn btn-sm btn-primary align-self-center has-contract">Edit</button>
						@else
							{!! Form::open(['method' => 'DELETE','route' => ['inventories.destroy', $inventory->id],'style'=>'display:inline']) !!}
												{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
							{!! Form::close() !!}
							<a href="/inventories/{{ $inventory->id }}/edit" class="btn btn-sm btn-primary align-self-center">Edit</a>
						@endif
						<a href="/inventories/{{ $inventory->id }}/show" class="btn btn-sm btn-primary align-self-center">Show</a>
					</td>
						</tr>
						@endforeach
		</table>

		</div>
		<!--end::Table-->
	</div>
	<!--end: Card Body-->
</div>
<!--end::Table widget 14-->
@push('scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
	$(document).ready(function() {
		var table = $('#data-table-simple').DataTable();

		$('#seller').on('change', function() {
			table.column(0).search(this.value).draw();
		});

		$('#vessel').on('change', function() {
			table.column(1).search(this.value).draw();
		});

		$('#product').on('change', function() {
			table.column(2).search(this.value).draw();
		});

		$('#bl_qty').on('keyup', function() {
			table.column(3).search(this.value).draw();
		});

		$('#landed_qty').on('keyup', function() {
			table.column(4).search(this.value).draw();
		});

		$('#shortage').on('keyup', function() {
			table.column(5).search(this.value).draw();
		});
});
</script>
		<script>
			$(document).on("click",".has-contract", function () {
				swal("This Inventory contain contracts !");
			});

			$(document).on("click",".delete-has-contract", function () {
				swal("This Inventory contain contracts !");
			});
		</script>
@endpush
</x-default-layout>