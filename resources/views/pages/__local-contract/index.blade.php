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
			    <thead>
			        <tr class="fw-semibold fs-6 text-muted">
			            <th>Product Name</th>
			            <th>Business Name</th>
			            <th>Buyer Name</th>
			            <th>Vessel Name</th>
			            <th>Quantity</th>
			            <th>Date</th>
			            <th>Edit</th>
			        </tr>
			    </thead>
			    <tbody>
			    	@foreach($contracts as $contract)
                    @php
                        $bl = \App\Models\ContractBL::where('contract_id',$contract->id)->first();
                        $vessel = \App\Models\InventoryBL::where('id',$bl->inventorybl_id)->first();
                    @endphp
			        <tr>
			            <td>{{ $contract->product->name }}</td>
			            <td>{{ $contract->business->name }}</td>
			            <td>{{ $contract->buyer->name }}</td>
			            <td>{{ $vessel->inventory->vessel->name }}</td>
			            <td>{{ $contract->quantity }}</td>
			            <td>{{ $contract->created_at->format('d-m-Y') }}</td>
			            <td><a href="" class="btn btn-sm btn-primary align-self-center">Edit</a></td>
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