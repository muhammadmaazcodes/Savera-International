<x-default-layout>
	<!--begin::Table widget 14-->
<div class="card card-flush h-md-100">
	<!--begin::Header-->
	<div class="card-header pt-7">
		<!--begin::Title-->
		<h3 class="card-title align-items-start flex-column">
			<span class="card-label fw-bold text-gray-800">Terminals</span>
		</h3>
		<!--end::Title-->
		<!--begin::Toolbar-->
		<div class="card-toolbar">
			<a href="/terminals/create" class="btn btn-sm btn-secondary">Add New</a>
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
			            <th>Name</th>
			            <th>Short Code</th>
			            <th>Local</th>
			            <th>International</th>
			            <th>Edit</th>
			        </tr>
			    </thead>
			    <tbody>
			    	@foreach($terminals as $terminal)
							@php
									$inventories = \App\Models\Inventory::where('terminal_id',$terminal->id)->get();
							@endphp
			        <tr>
			            <td>{{ $terminal->name }}</td>
			            <td>{{ $terminal->code }}</td>
			            <td>{!! ($terminal->local) == 1 ? '<i class="fa fa-check text-dark fs-2"></i>' : '<i class="fa fa-xmark text-dark fs-2"></i>' !!}</td>
			            <td>{!! ($terminal->international) == 1 ? '<i class="fa fa-check text-dark fs-2"></i>' : '<i class="fa fa-xmark text-dark fs-2"></i>' !!}</td>
			            <td>
										@if ($inventories->count() > 0)
											<button class="btn btn-sm btn-danger align-self-center delete-has-inv">Delete</button>
											<button class="btn btn-sm btn-primary align-self-center has-inv">Edit</button>
										@else
											{!! Form::open(['method' => 'DELETE','route' => ['terminals.destroy', $terminal->id],'style'=>'display:inline']) !!}
																{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
											{!! Form::close() !!}
											<a href="/terminals/{{ $terminal->id }}/edit" class="btn btn-sm btn-primary align-self-center">Edit</a>
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
				swal("This Terminal contain Inventory !");
			});

			$(document).on("click",".delete-has-inv", function () {
				swal("This Terminal contain Inventory !");
			});
		</script>
@endpush
</x-default-layout>