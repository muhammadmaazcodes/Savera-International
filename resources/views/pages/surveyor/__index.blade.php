<x-default-layout>
	<!--begin::Table widget 14-->
<div class="card card-flush h-md-100">
	<!--begin::Header-->
	<div class="card-header pt-7">
		<!--begin::Title-->
		<h3 class="card-title align-items-start flex-column">
			<span class="card-label fw-bold text-gray-800">Surveyor</span>
		</h3>
		<!--end::Title-->
		<!--begin::Toolbar-->
		<div class="card-toolbar">
			<a href="/surveyor/create" class="btn btn-sm btn-secondary">Add New</a>
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
			            <th>Company Name</th>
			            <th>Name</th>
			            <th>Edit</th>
			        </tr>
			    </thead>
			    <tbody>
			    	@foreach($surveyors as $surveyor)
							@php
									$inventories = \App\Models\Inventory::where('surveyor_id',$surveyor->id)->get();
							@endphp
			        <tr>
			            <td>{{ $surveyor->title }}</td>
			            <td>{{ $surveyor->name }}</td>
			            <td>
										@if ($inventories->count() > 0)
											<button class="btn btn-sm btn-danger align-self-center delete-has-inv">Delete</button>
											<button class="btn btn-sm btn-primary align-self-center has-inv">Edit</button>
										@else
											{!! Form::open(['method' => 'DELETE','route' => ['surveyor.destroy', $surveyor->id],'style'=>'display:inline']) !!}
																{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
											{!! Form::close() !!}
											<a href="/surveyor/{{ $surveyor->id }}/edit" class="btn btn-sm btn-primary align-self-center">Edit</a>
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
			$(document).on("click",".has-inv", function () {
				swal("This Surveyor contain Inventory !");
			});

			$(document).on("click",".delete-has-inv", function () {
				swal("This Surveyor contain Inventory !");
			});
		</script>
@endpush
</x-default-layout>