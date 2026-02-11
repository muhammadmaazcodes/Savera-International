<x-default-layout>
	<style>
		table td .btn {
   visibility:hidden;
}
table tr:hover td .btn {
   visibility:visible;
}
	</style>
	<!--begin::Table widget 14-->
<div class="card card-flush h-md-100">
	<!--begin::Header-->
	<div class="card-header pt-7">
		<!--begin::Title-->
		<h3 class="card-title align-items-start flex-column">
			<span class="card-label fw-bold text-gray-800">Businesses</span>
		</h3>
		<!--end::Title-->
		<!--begin::Toolbar-->
		<div class="card-toolbar">
			{{-- <a href="/businesses/create" class="btn btn-sm btn-secondary">Add New</a> --}}
			<button class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#AddBusiness">Add New</button>
		</div>
		<!--end::Toolbar-->
	</div>
	<!--end::Header-->
	<!--begin::Body-->
	<div class="card-body pt-6">
		<!--begin::Table container-->
		<div class="table-responsive">
			<!--begin::Table-->
			<table id="data-table-simple" class="table gy-5 dataTable no-footer table-bordered table-striped table-hover border-dark">
			    <thead>
			        <tr class="fw-semibold fs-6 text-muted">
			            <th>Name</th>
			            <th>Short Code</th>
			            <th>Action</th>
			        </tr>
			    </thead>
			    <tbody id="business-tbody">
			    	@foreach($businesses as $business)
							@php
									$inventories = \App\Models\Inventory::where('buyer_id',$business->id)->get();
							@endphp
			        <tr>
			            <td>{{ $business->name }}</td>
			            <td>{{ $business->code }}</td>
			            <td>
										@if ($inventories->count() > 0)
											<button class="btn btn-sm btn-danger align-self-center delete-has-inv">Delete</button>
											<button class="btn btn-sm btn-primary align-self-center has-inv">Edit</button>
										@else
											{!! Form::open(['method' => 'DELETE','route' => ['businesses.destroy', $business->id],'style'=>'display:inline']) !!}
																{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm del-btn']) !!}
											{!! Form::close() !!}
											{{-- <a href="/businesses/{{ $business->id }}/edit" class="btn btn-sm btn-primary align-self-center">Edit</a> --}}
											<button class="btn btn-sm btn-primary align-self-center" data-bs-toggle="modal" data-bs-target="#EditBusiness-{{ $business->id }}">Edit</button>
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

<!-- Create Business Modal -->
<div class="modal fade modal-lg" id="AddBusiness" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-primary pt-5 pb-5">
        <h5 class="modal-title text-white fs-2" id="exampleModalLabel">Add New Business</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form class="pt-1" id="add-business-form" method="POST" action="/businesses">
					@csrf
					<div class="row justify-content-center align-items-center">
						<div class="col-md-6">
							<input type="text" class="form-control form-control-lg border-dark" placeholder="Company Name*" name="name" value="{{ old('name') }}" required />
						</div>
						<div class="col-md-3">
							<input type="text" class="form-control form-control-lg border-dark" placeholder="Company Code*" name="code" value="{{ old('code') }}" required />
						</div>

						<div class="col-md-3">
							<div class="form-check form-switch mb-3">
								<input class="form-check-input" name="local" type="checkbox" value="1" id="business_local">
								<label class="form-check-label text-dark" for="business_local">Local</label>
							</div>
							<div class="form-check form-switch">
								<input class="form-check-input" name="international" value="1" type="checkbox" id="business_intl">
								<label class="form-check-label text-dark" for="business_intl">International</label>
							</div>
						</div>
						
						<div class="col-md-6 mt-4">
						</div>

					</div>
					<!--begin::Repeater-->
					<div id="kt_docs_repeater_basic">
							<!--begin::Form group-->
							<div class="form-group">
									<div class="my-5" data-repeater-list="company_addresses">
											<div class="border-1 rounded-3 my-5 border-secondary border p-3 border-dark" data-repeater-item>
													<div class="form-group row gy-3	">
															<div class="col-md-6">
																	<label class="form-label">Title:</label>
																	<input type="text" name="title" class="form-control mb-2 mb-md-0" placeholder="Enter Title for future reference" />
															</div>
															<div class="col-md-6 text-end">
																	<a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8">
																			<i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
																			Delete
																	</a>
															</div>
															<div class="col-md-12">
																	<label class="form-label">Address:</label>
																	<input type="text" name="address" class="form-control mb-2 mb-md-0" placeholder="Enter Address" />
															</div>
															<div class="col-md-12">
																	<label class="form-label">Address 2:</label>
																	<input type="text" name="address2" class="form-control mb-2 mb-md-0" placeholder="Enter Address(Second Line)" />
															</div>
															<div class="col-md-6">
																	<label class="form-label">City:</label>
																	<input type="text" name="city" class="form-control mb-2 mb-md-0" placeholder="Enter City" />
															</div>
															<div class="col-md-6">
																	<label class="form-label">Country:</label>
																	<input type="text" name="country" class="form-control mb-2 mb-md-0" placeholder="Enter Country" />
															</div>
															<div class="col-md-4">
																	<label class="form-label">Phone:</label>
																	<input type="text" name="phone" class="form-control mb-2 mb-md-0" placeholder="Enter phone number" />
															</div>
															<div class="col-md-4">
																	<label class="form-label">Fax:</label>
																	<input type="text" name="fax" class="form-control mb-2 mb-md-0" placeholder="Enter fax number" />
															</div>
															<div class="col-md-4">
																	<label class="form-label">Email:</label>
																	<input type="email" name="email" class="form-control mb-2 mb-md-0" placeholder="Enter email " />
															</div>
													</div>
											</div>
									</div>
							</div>
							<!--end::Form group-->
		
							<!--begin::Form group-->
							<div class="form-group mt-5">
									<a href="javascript:;" data-repeater-create class="btn btn-light-primary">
											<i class="ki-duotone ki-plus fs-3"></i>
											Add Address
									</a>
							</div>
							<!--end::Form group-->
					</div>
					<!--end::Repeater-->
				</form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="add-close-btn" data-bs-dismiss="modal">Close</button>
        <button type="button" onclick="$('#add-business-form').submit();" id="submit-add-btn" class="btn btn-primary">Submit</button>
      </div>
		
    </div>
  </div>
</div>
{{-- End Create Modal --}}


{{-- Edit Business Modal --}}
@foreach($businesses as $business)
<!-- Modal -->
<div class="modal fade" id="EditBusiness-{{ $business->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Business</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form class="pt-1" id="EditForm-{{ $business->id }}" method="POST" action="/businesses/{{ $business->id }}">
					@csrf
					@method('PUT')
					<div class="row justify-content-center">
						<div class="col-md-6">
							<input type="text" class="form-control form-control-lg border-secondary" placeholder="Company Name" name="name" value="{{ $business->name }}" />
						</div>
						<div class="col-md-6">
							<input type="text" class="form-control form-control-lg border-secondary" placeholder="Company Code" name="code" value="{{ $business->code }}" />
						</div>
						
						<div class="col-md-6 mt-4">
							<div class="form-check form-switch">
								<input class="form-check-input" name="local" type="checkbox" value="1" id="flexSwitchCheckChecked" {{ $business->local == 1 ? 'checked' : '' }}>
								<label class="form-check-label text-dark" for="flexSwitchCheckChecked">Local</label>
							</div>
						</div>
						
						<div class="col-md-6 mt-4">
							<div class="form-check form-switch">
								<input class="form-check-input" name="international" value="1" type="checkbox" id="flexSwitchCheckChecked" {{ $business->international == 1 ? 'checked' : '' }}>
								<label class="form-check-label text-dark" for="flexSwitchCheckChecked">International</label>
							</div>
						</div>

					</div>
						{{-- Repeater here --}}
				</form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" onclick="$('#EditForm-{{ $business->id }}').submit();" class="btn btn-primary">Update</button>
      </div>
    </div>
  </div>
</div>
@endforeach
{{-- End Edit Business Modal --}}


{!! theme()->addVendor('formrepeater') !!}
@push('scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script>
		$('#kt_docs_repeater_basic').repeater({
    initEmpty: true,

    defaultValues: {
        'text-input': 'foo'
    },

    show: function () {
        $(this).slideDown();
    },

    hide: function (deleteElement) {
        $(this).slideUp(deleteElement);
    }
});
	</script>
		<script>
			$(document).on("click",".has-inv", function () {
				swal("This Business contain Inventory !");
			});

			$(document).on("click",".delete-has-inv", function () {
				swal("This Business contain Inventory !");
			});
		</script>

		<script>
		$(document).on("click",".del-btn", function (e) {
				e.preventDefault();
			swal({
				title: "Are you sure ?",
				text: "Once deleted, you will not be able to recover this!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					$(this).closest("form").submit();
				} else {
					swal("Your Record is safe!");
				}
			});

	});
		</script>
@endpush
</x-default-layout>