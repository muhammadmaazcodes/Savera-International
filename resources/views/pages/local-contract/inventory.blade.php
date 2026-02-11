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
			            <th>Vessel</th>
			            <th>Voyage</th>
			            <th>Seller</th>
			            {{-- <th>Buyer</th> --}}
			            <th>Landed Qty</th>
			            <th>Sold Qty</th>
			            <th>Unsold Qty</th>
			            <th>Lifted Qty</th>
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
			            <td>{{ $inventory->vessel->name ?? 'N/A' }}</td>
			            <td>{{ $inventory->voyage_number ?? 'N/A' }}</td>
			            <td>{{ $inventory->seller->name ?? 'N/A' }}</td>
			            {{-- <td>{{ $inventory->buyer->name ?? 'N/A' }}</td> --}}
			            <td>{{ number_format($bl->sum('landed_quantity'),3) }}</td>
			            <td><span class="badge bg-success text-white">{{ number_format($contract->sum('quantity'),3) }}</span></td>
									<td><span class="badge bg-danger text-white">{{ number_format($bl->sum('bl_quantity') - $contract->sum('quantity'),3) }}</span></td>
									<td>{{ $lifted ? $contract->sum('quantity') - $lifted->sum('quantity') : 0 }}</td>
			            <td>
  							<a href="/inventories/{{ $inventory->id }}/detail" class="btn btn-sm btn-primary align-self-center">Detail</a>
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
</x-default-layout>