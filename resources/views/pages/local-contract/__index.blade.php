<x-default-layout>
	<!--begin::Table widget 14-->
<div class="card card-flush h-md-100">
	<!--begin::Header-->
	<div class="card-header pt-7">
		<!--begin::Title-->
		<h3 class="card-title align-items-start flex-column">
			<span class="card-label fw-bold text-gray-800">Local Contracts</span>
		</h3>
		<!--end::Title-->
		<!--begin::Toolbar-->
		<div class="card-toolbar">
			<a href="/local-contract/create" class="btn btn-sm btn-secondary">Add New</a>
		</div>
		<!--end::Toolbar-->
	</div>
	<!--end::Header-->
	<!--begin::Body-->
	<div class="card-body pt-6">
		<!--begin::Table container-->
		<div class="table-responsive">
			<!--begin::Table-->
		<table id="data-table-simple" class="table table-row-bordered gy-5">
			<div class="row">
				<div class="col-md-3">
					<select name="company" id="company" class="form-control">
						<option disabled selected>Search Company</option>
						@foreach ($companies as $company)
							<option value="{{ $company->name }}">{{ $company->name }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-md-3">
					<select name="vessel" id="vessel" class="form-control">
						<option disabled selected>Search Vessel</option>
						@foreach ($vessels as $vessel)
							<option value="{{ $vessel->name }}">{{ $vessel->name }}</option>
						@endforeach
					</select>
				</div>
			</div>
			    <thead>
			        <tr class="fw-semibold fs-6 text-muted">
			            <th>Vessel</th>
			            <th>Voyage #</th>
			            <th>Seller</th>
			            <th>Buyer</th>
			            <th>Contract Quantity</th>
			            <th>Lifted Quantity</th>
			            <th>Selling Price</th>
			            <th>Contract Type</th>
			        </tr>
			    </thead>

					<tbody>
			    	@foreach($contracts as $contract)

						@php
							$inventory = App\Models\Inventory::where('contract_id',$contract->id)->first();
							if ($inventory) {
								$return_quantity = App\Models\InventoryBL::where('inventory_id',$inventory->id)->sum('bl_quantity');
							}
							else {
								$return_quantity = [];
							}
							
							$lifted = \App\Models\SaleContract::where('contract_id',$contract->id)->get();
					@endphp


			        <tr>
			            <td>{{ $contract->inventory->vessel->name }}</td>
			            <td>{{ $contract->inventory->voyage_number }}</td>
			            <td>{{ $contract->business->name }}</td>
			            <td>{{ $contract->buyer->name }}</td>
			            <td>{{ number_format($contract->quantity,3) }}</td>
			            <td>{{ $lifted ? number_format($lifted->sum('quantity'),3) : 'Not Lifted' }}</td>
			            <td>{{ $contract->selling_price ?? '-' }}</td>
			            <td>{{ ($contract->type) == 'temp' ? 'Temporary' : ucfirst($contract->type) }}</td>
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
<script>
			$(document).ready(function() {
	  	var table = $('#data-table-simple').DataTable();

		$('#vessel').on('change', function() {
			table.column(0).search(this.value).draw();
		});

		$('#company').on('change', function() {
			table.column(2).search(this.value).draw();
		});
});
		</script>
@endpush
</x-default-layout>