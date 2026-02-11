<x-default-layout>
	<!--begin::Table widget 14-->
<div class="card card-flush h-md-100">
	<!--begin::Header-->
	<div class="card-header pt-7">
		<!--begin::Title-->
		<h3 class="card-title align-items-start flex-column">
			<span class="card-label fw-bold text-gray-800">Barter Contracts</span>
		</h3>
		<!--end::Title-->
		<!--begin::Toolbar-->
		<div class="card-toolbar">
			<a href="/local-contract/barter/create" class="btn btn-sm btn-secondary">Add New</a>
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
								<th>Buyer</th>
								<th>Lifted Quantity</th>
								<th>Return Quantity</th>
								<th>Status</th>
								<th>Return Contract</th>
								<th>Edit</th>
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
			            <td>{{ $contract->buyer->name }}</td>
			            <td>{{ $lifted ? number_format($lifted->sum('quantity'),3) : 'Not Lifted' }}</td>
			            <td>{{ $return_quantity ? $return_quantity : 'Not Returned Yet' }}</td>
			            @if ($inventory)
						<td><span class="badge badge-success">{{ ($contract->quantity) > $inventory->bl_quantity ? 'Partially Returned' : 'Completed' }}</span></td>
						@else
						<td><span class="badge badge-secondary">Pending</span></td>
						@endif
						
					@if ($inventory)
						@if ($inventory->bl_quantity > $contract->quantity || $inventory->bl_quantity == $contract->quantity)
			            <td><a href="javascript:void(0)" class="btn btn-sm btn-secondary align-self-center">Returned</a></td>
						@elseif($contract->quantity > $inventory->bl_quantity)
			            <td><a href="{{ route('barter.return_contract_edit',$inventory->id) }}" class="btn btn-sm btn-primary align-self-center">Return</a></td>
						@endif
					@else
					<td><a href="{{ route('barter.return_contract',$contract->id) }}" class="btn btn-sm btn-primary align-self-center">Return</a></td>
					@endif

					<td>
						@if ($lifted->count() > 0)
							<button type="button" class="btn btn-danger btn-sm has-liftings">Delete</button>
							<button type="button" class="btn btn-primary btn-sm has-liftings">Edit</button>
						@else
						{!! Form::open(['method' => 'DELETE','route' => ['local-contract.destroy', $contract->id],'style'=>'display:inline']) !!}
												{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm my-2']) !!}
							{!! Form::close() !!}
						<a href="{{ url('/barter-contract/edit/'.$contract->id) }}" class="btn btn-primary btn-sm">Edit</a>
						@endif
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
		$(document).on("click",".has-liftings", function () {
			swal("This contract is in Lifting !", "");
		});
	</script>
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