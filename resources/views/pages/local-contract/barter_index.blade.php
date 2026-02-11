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
			    <thead>
			        <tr class="fw-semibold fs-6 text-muted">
			            <th>Vessel Name</th>
			            <th>Business Name</th>
			            <th>Buyer Name</th>
			            <th>Date</th>
			            <th>lifting Date</th>
			            <th>Quantity</th>
			            <th>Status</th>
			            <th>Return</th>
			        </tr>
			    </thead>
			    <tbody>
			    	@foreach($contracts as $contract)
						@php
								$inventory = App\Models\Inventory::where('contract_id',$contract->id)->first();
						@endphp
			        <tr>
			            <td>{{ $contract->inventory->vessel->name }}</td>
			            <td>{{ $contract->business->name }}</td>
			            <td>{{ $contract->buyer->name }}</td>
			            <td>{{ $contract->date }}</td>
			            <td>{{ $contract->lifting_date }}</td>
			            <td>{{ $contract->quantity }}</td>
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
			        </tr>
			        @endforeach
			</table>
		</div>
		<!--end::Table-->
	</div>
	<!--end: Card Body-->
</div>
<!--end::Table widget 14-->
</x-default-layout>