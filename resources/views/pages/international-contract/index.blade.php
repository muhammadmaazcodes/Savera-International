<x-default-layout>
  <style>
    a.disabled {
    pointer-events: none;
    color: #ccc;
}
  </style>
	<!--begin::Table widget 14-->
<div class="card card-flush h-md-100">
	<!--begin::Header-->
	<div class="card-header pt-7">
		<!--begin::Title-->
		<h3 class="card-title align-items-start flex-column">
			<span class="card-label fw-bold text-gray-800">International Contracts</span>
		</h3>
		<!--end::Title-->
		<!--begin::Toolbar-->
		<div class="card-toolbar">
			<a href="/international-contract/create" class="btn btn-sm btn-secondary">Add New</a>
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
			            <th>Product</th>
			            <th>Buyer</th>
			            <th>Seller</th>
			            <th>Business</th>
			            <th>Quantity</th>
			            <th>Status</th>
			            <th>Edit</th>
			            <th>Split</th>
			            <th>Washout</th>
			        </tr>
			    </thead>
			    <tbody>
			    	@foreach($internationals as $international)
			        <tr>
			            <td>{{ $international->product->name }}</td>
			            <td>{{ $international->buyer->name }}</td>
			            <td>{{ $international->seller->name }}</td>
			            <td>{{ $international->business->name }}</td>
			            <td>{{ $international->quantity }}</td>
			            <td><span class="badge badge-success">{{ ucfirst($international->status) }}</span></td>
			            <td>
                    <a href="{{ route('international-contract.edit',$international->id) }}" class="btn btn-sm btn-primary {{ ($international->status) == 'washout' ? 'disabled' : '' }}">Edit</a>
                  </td>
                  <td>
                    <a href="{{ route('contract.split',$international->id) }}" class="btn btn-sm btn-primary {{ ($international->status) == 'washout' ? 'disabled' : '' }} {{ ($international->parent_id) != 0 ? 'disabled' : '' }}">Split</a>
                  </td>
                  <td>
                    <a href="{{ route('washout',$international->id) }}" class="btn btn-sm btn-primary">Washout</a>
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