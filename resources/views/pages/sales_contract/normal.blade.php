<x-default-layout>
	<!--begin::Table widget 14-->
<div class="card card-flush h-md-100">
	<!--begin::Header-->
	<div class="card-header pt-7">
		<!--begin::Title-->
		<h3 class="card-title align-items-start flex-column">
			<span class="card-label fw-bold text-gray-800">Normal Contracts</span>
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
			            <th>Company</th>
			            <th>BL Quantity</th>
									<th>Shortage</th>
									<th>Landed Quantity</th>
									<th>Unsold Quantity</th>
									<th>Lifted Quantity</th>
									<th>Action</th>
			        </tr>
			    </thead>
			    <tbody>
			    	@foreach($contracts as $contract)
						@php
								$lifted = \App\Models\SaleContract::where('contract_id',$contract->id)->get();
								$bl = \App\Models\InventoryBL::where('inventory_id',$contract->inventory_id)->get(); 
						@endphp
			        <tr>
			            <td>{{ $contract->inventory->vessel->name ?? 'N/A' }}</td>
			            <td>{{ $contract->inventory->voyage_number ?? 'N/A' }}</td>
			            <td>{{ $contract->buyer->name ?? 'N/A' }}</td>
			            <td>{{ number_format($bl->sum('bl_quantity'),3) }}</td>
			            <td>{{ number_format($bl->sum('bl_quantity') - $bl->sum('landed_quantity'),3) }}</td>
			            <td>{{ number_format($bl->sum('landed_quantity'),3) }}</td>
			            <td>{{ $lifted ? $contract->quantity - $lifted->sum('quantity') : $contract->quantity }}</td>
									<td>{{ $lifted ? number_format($lifted->sum('quantity'),3) : 'Not Lifted' }}</td>
									<td>
										@if ($lifted->count() > 0)
										<button type="button" class="btn btn-danger btn-sm has-liftings my-2">Delete</button>
											<button type="button" class="btn btn-primary btn-sm has-liftings">Edit</button>
										@else
										{!! Form::open(['method' => 'DELETE','route' => ['local-contract.destroy', $contract->id],'style'=>'display:inline']) !!}
												{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm my-2']) !!}
										{!! Form::close() !!}
											<a href="{{ url('local-contract/'.$contract->id.'/edit') }}" class="btn btn-primary btn-sm">Edit</a>
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

<script>
	$(document).on("click",".has-liftings", function () {
		swal("This contract is in Lifting !", "");
	});
	</script>
@endpush
</x-default-layout>