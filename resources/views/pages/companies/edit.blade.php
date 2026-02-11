<x-default-layout>

	<div id="kt_app_toolbar_container" class="my-5 container-xxl d-flex flex-stack ">
    <!--begin::Page title-->
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
       <!--begin::Title-->
       <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
				Buyer/Sellers
       </h1>
       <!--end::Title-->
       <!--begin::Breadcrumb-->
       <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
          <!--begin::Item-->
          <li class="breadcrumb-item text-muted">
             <a href="/" class="text-muted text-hover-primary">
             Dashboard</a>
          </li>
          <!--end::Item-->
          <!--begin::Item-->
          <li class="breadcrumb-item">
             <span class="bullet bg-gray-500 w-5px h-2px"></span>
          </li>
          <!--end::Item-->
          <!--begin::Item-->
          <li class="breadcrumb-item text-muted">
            <a href="javascript:void(0);" class="text-muted text-hover-primary">
							Buyer/Sellers</a>
         </li>
         <!--end::Item-->
       </ul>
       <!--end::Breadcrumb-->
    </div>
    <!--end::Page title-->
    <!--begin::Actions-->
  <div class="d-flex align-items-center gap-2 gap-lg-3">
    <!--begin::Filter menu-->
    <div class="m-0">
       <!--begin::Menu toggle-->
       <a href="/companies" class="btn btn-sm btn-flex btn-secondary fw-bold">               
       View All Buyer/Sellers
       </a>
       <!--end::Menu toggle-->        
    </div>
    <!--end::Filter menu-->
    <!--begin::Secondary button-->
    <!--end::Secondary button-->
 </div>
 <!--end::Actions-->
  </div>


	<!--begin::Table widget 14-->
<div class="card card-flush h-md-100 mb-4">
	<!--begin::Body-->
	<div class="card-body pt-6">
		<form class="pt-1" method="POST" action="/companies/{{ $company->id }}">
			@csrf
			@method('PUT')
			<div class="row">
				<div class="col-md-3">
					@if ($inventories->count() > 0 || $local_contracts->count() > 0)
					<input type="text" class="form-control form-control-lg border-secondary" placeholder="Company Name" name="name" value="{{ $company->name }}" readonly />
					@else
					<input type="text" class="form-control form-control-lg border-secondary" placeholder="Company Name" name="name" value="{{ $company->name }}" />
					@endif
				</div>
				<div class="col-md-3">
					@if ($inventories->count() > 0 || $local_contracts->count() > 0)
					<input type="text" class="form-control form-control-lg border-secondary" placeholder="Company Code" name="code" value="{{ $company->code }}" readonly />
					@else
					<input type="text" class="form-control form-control-lg border-secondary" placeholder="Company Code" name="code" value="{{ $company->code }}" />
					@endif
				</div>
				<div class="col-md-3">
					<div class="form-check form-switch mb-3">
						<input class="form-check-input" name="local" type="checkbox" value="1" id="business_local" {{ ($company->local) == 1  ? 'checked' : ''}}>
						<label class="form-check-label text-dark" for="business_local">Local</label>
					</div>
					<div class="form-check form-switch">
						<input class="form-check-input" name="international" value="1" type="checkbox" id="business_intl" {{ ($company->international) == 1  ? 'checked' : ''}}>
						<label class="form-check-label text-dark" for="business_intl">International</label>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-check form-switch mb-3">
						<input class="form-check-input" name="buyer" type="checkbox" value="1" {{ ($company->buyer) == 1  ? 'checked' : ''}}>
						<label class="form-check-label text-dark">Buyer</label>
					</div>
					<div class="form-check form-switch">
						<input class="form-check-input" name="seller" value="1" type="checkbox" {{ ($company->seller) == 1  ? 'checked' : ''}}>
						<label class="form-check-label text-dark">Seller</label>
					</div>
				</div>
			</div>
			<!--begin::Repeater-->
			<div id="kt_docs_repeater_basic">
				<!--begin::Form group-->
				<div class="form-group">
						<div class="my-5" data-repeater-list="company_addresses">
								<div class="border-1 rounded-3 my-5 border-secondary border p-3" data-repeater-item>
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
												<div class="col-md-6">
														<label class="form-label">Address:</label>
														<input type="text" name="address" class="form-control mb-2 mb-md-0" placeholder="Enter Address" />
												</div>
												<div class="col-md-6">
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
								Add Another Address
						</a>
				</div>
				<!--end::Form group-->
		</div>
			<!--end::Repeater-->
			<div class="col-md-12 text-end">
				<button type="submit" class="btn btn-sm btn-light fw-bold btn-primary me-2">Update</button>
			</div>
			<!--begin::Input group-->
		</form>
	</div>
	<!--end: Card Body-->
</div>
<div class="card card-flush h-md-100">
	<div class="card-header pt-7">
		<!--begin::Title-->
		<h3 class="card-title align-items-start flex-column">
			<span class="card-label fw-bold text-gray-800">{{ $company->name }} Addresses</span>
			<!--begin::Search-->
			
			<!--end::Search-->
			<!--begin::Export buttons-->
				<div id="kt_datatable_example_1_export" class="d-none"></div>
				<!--end::Export buttons-->
		</h3>
		<!--end::Title-->
	</div>
						<div class="card-body pt-6">
								<table class="table align-middle table-row-bordered table-hover fs-6 gy-5"
												id="kt_datatable_example">
												<thead>
														<tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
																<th class="w-10px pe-2" hidden>
																		<div
																				class="form-check form-check-sm form-check-custom form-check-solid me-3">
																				<input class="form-check-input" type="checkbox"
																						data-kt-check="true"
																						data-kt-check-target="#kt_customers_table .form-check-input"
																						value="1" />
																		</div>
																</th>
																<th class="min-w-125px">Title</th>
																<th class="min-w-125px">City</th>
																<th class="min-w-125px">Country</th>
																<th class="text-center min-w-70px">Actions</th>
														</tr>
												</thead>
												<tbody class="fw-semibold text-gray-600">
													@foreach($company->addresses as $address)
														<tr>
																<td hidden>
																		<div
																				class="form-check form-check-sm form-check-custom form-check-solid">
																				<input class="form-check-input" type="checkbox" value="1" />
																		</div>
																</td>
																<td>
																		{{ $address->title }}
																</td>
																<td>
																		{{ $address->city }}
																</td>
																<td>
																	{{ $address->country }}
															</td>
																<td class="text-center">
																		<a href="#"
																				class="btn btn-sm btn-light-primary btn-flex btn-center btn-active-primary"
																				data-kt-menu-trigger="click"
																				data-kt-menu-placement="bottom-end">
																				Actions
																				<i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
																		<!--begin::Menu-->
																		<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
																				data-kt-menu="true">
																				
																				<div class="menu-item px-3">
																					{!! Form::open(['method' => 'DELETE','route' => ['company.address.delete', $address->id],'id' => 'form-delete'.'-'.$address->id ,'style'=>'display:inline']) !!}
																										{{-- {!! Form::submit('Delete', ['class' => 'menu-link px-3']) !!} --}}
																					{!! Form::close() !!}
																						<a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('form-delete-{{ $address->id }}').submit();" class="menu-link px-3"
																								data-kt-customer-table-filter="delete_row">
																								Delete
																						</a>
																				</div>
																					<!--begin::Menu item-->
																				<div class="menu-item px-3">
																					<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#EditAddress-{{ $address->id }}"
																							class="menu-link px-3">
																							Edit
																					</a>
																				</div>
																			<!--end::Menu item-->


																		</div>
																		<!--end::Menu-->
																</td>
														</tr>
														@endforeach
												</tbody>
												<!--end::Table body-->
										</table>
	</div>
</div>
<!--end::Table widget 14-->

	{{-- Edit Address Modal --}}
	@foreach($company->addresses as $address)
	<div class="modal fade modal-lg" id="EditAddress-{{ $address->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header bg-primary pt-5 pb-5">
					<h5 class="modal-title text-white fs-2" id="exampleModalLabel">Edit Address</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
	
					<form class="pt-1" method="POST" action="{{ route('company.address.update', $address->id) }}" id="update-company-{{ $address->id }}">
						@csrf
						@method('PUT')
								<!--begin::Form group-->
								<div class="form-group">
										<div class="my-5" data-repeater-list="company_addresses">
												<div class="border-1 rounded-3 my-5 border-secondary border p-3 border-dark" data-repeater-item>
														<div class="form-group row gy-3	">
																<div class="col-md-12">
																		<label class="form-label">Title:</label>
																		<input type="text" name="title" class="form-control mb-2 mb-md-0" placeholder="Enter Title for future reference" value="{{ $address->title }}" />
																</div>
																<div class="col-md-12">
																		<label class="form-label">Address:</label>
																		<input type="text" name="address" class="form-control mb-2 mb-md-0" placeholder="Enter Address" value="{{ $address->address }}" />
																</div>
																<div class="col-md-12">
																		<label class="form-label">Address 2:</label>
																		<input type="text" name="address2" class="form-control mb-2 mb-md-0" placeholder="Enter Address(Second Line)" value="{{ $address->address2 }}" />
																</div>
																<div class="col-md-6">
																		<label class="form-label">City:</label>
																		<input type="text" name="city" class="form-control mb-2 mb-md-0" placeholder="Enter City" value="{{ $address->city }}" />
																</div>
																<div class="col-md-6">
																		<label class="form-label">Country:</label>
																		<input type="text" name="country" class="form-control mb-2 mb-md-0" placeholder="Enter Country" value="{{ $address->country }}" />
																</div>
																<div class="col-md-4">
																		<label class="form-label">Phone:</label>
																		<input type="text" name="phone" class="form-control mb-2 mb-md-0" placeholder="Enter phone number" value="{{ $address->phone }}" />
																</div>
																<div class="col-md-4">
																		<label class="form-label">Fax:</label>
																		<input type="text" name="fax" class="form-control mb-2 mb-md-0" placeholder="Enter fax number" value="{{ $address->fax }}" />
																</div>
																<div class="col-md-4">
																		<label class="form-label">Email:</label>
																		<input type="email" name="email" class="form-control mb-2 mb-md-0" placeholder="Enter email " value="{{ $address->email }}" />
																</div>
														</div>
												</div>
										</div>
								</div>
								<!--end::Form group-->
					</form>
	
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" id="add-close-btn" data-bs-dismiss="modal">Close</button>
					<button type="button" onclick="$('#update-company-{{ $address->id }}').submit();" id="submit-add-btn" class="btn btn-primary">Update</button>
				</div>
			
			</div>
		</div>
	</div>
	@endforeach
	{{-- End Edit Address Modal --}}

{!! theme()->addVendor('formrepeater') !!}
@push('scripts')
<script>
	$('#kt_docs_repeater_basic').repeater({
    initEmpty: true,

    show: function () {
        $(this).slideDown();
    },

    hide: function (deleteElement) {
        $(this).slideUp(deleteElement);
    }
});
</script>
@endpush
</x-default-layout>