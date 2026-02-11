<x-default-layout>
	<!--begin::Table widget 14-->
<div class="card card-flush h-md-100">
	<!--begin::Header-->
	<div class="card-header pt-7">
		<!--begin::Title-->
		<h3 class="card-title align-items-start flex-column">
			<span class="card-label fw-bold text-gray-800">Payment Terms</span>
		</h3>
		<!--end::Title-->
		<!--begin::Toolbar-->
		<div class="card-toolbar">
			<a href="/payment-terms/create" class="btn btn-sm btn-secondary">Add New</a>
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
			            <th>Local</th>
			            <th>International</th>
			            <th>Action</th>
			        </tr>
			    </thead>
			    <tbody>
			    	@foreach($payment_terms as $payment_term)
								@php
										$contracts = \App\Models\LocalContract::where('payment_term',$payment_term->id)->get();
								@endphp
			        <tr>
			            <td>{{ $payment_term->name }}</td>
			            <td>{!! ($payment_term->local) == 1 ? '<i class="fa fa-check text-dark fs-2"></i>' : '<i class="fa fa-xmark text-dark fs-2"></i>' !!}</td>
			            <td>{!! ($payment_term->international) == 1 ? '<i class="fa fa-check text-dark fs-2"></i>' : '<i class="fa fa-xmark text-dark fs-2"></i>' !!}</td>
			            <td>
										@if ($contracts->count() > 0)
											<button class="btn btn-sm btn-danger align-self-center delete-has-contract">Delete</button>
											<button class="btn btn-sm btn-primary align-self-center has-contract">Edit</button>
										@else
											{!! Form::open(['method' => 'DELETE','route' => ['payment-terms.destroy', $payment_term->id],'style'=>'display:inline']) !!}
																{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
											{!! Form::close() !!}
											<a href="/payment-terms/{{ $payment_term->id }}/edit" class="btn btn-sm btn-primary align-self-center">Edit</a>
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
			$(document).on("click",".has-contract", function () {
				swal("This Payment term contain Contract !");
			});

			$(document).on("click",".delete-has-contract", function () {
				swal("This Payment term contain Contract !");
			});
		</script>
@endpush
</x-default-layout>