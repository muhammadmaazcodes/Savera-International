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
    <div class="row">
      <div class="col-md-6">
        <p>
          <span class="fs-2hx fw-bold text-gray-900 counted">{{ $company->name }}</span>
          <span class="fs-2 fw-bold text-gray-900 counted">({{ $company->code }})</span>
        </p>
        <p>
          {!! ($company->local) == 1  ? '<span class="badge badge-light-success fs-7 fw-bold me-2">Local</span>' : '' !!} 
          {!! ($company->international) == 1  ? '<span class="badge badge-light-success fs-7 fw-bold me-2">International</span>' : ''!!}
        </p>
      </div>
      <div class="col-md-6 text-end">
        <a href="/companies/{{ $company->id }}/edit" class="btn btn-sm btn-light-primary me-3"><i class="fa fa-edit"></i> Edit</a>
      </div>
    </div>
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
																<th class="min-w-125px">Address</th>
																<th class="min-w-125px">Phone</th>
																<th class="min-w-125px">Fax</th>
																<th class="min-w-125px">Email</th>
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
                                    {{ $address->address }} {{ $address->address2 }}<br>
																		{{ $address->city }}, {{ $address->country }}
																</td>
																<td>
																	{{ $address->phone }}
															</td>
                              <td>
                                {{ $address->fax }}
                            </td>
                            <td>
                              {{ $address->email }}
                          </td>
														</tr>
														@endforeach
												</tbody>
												<!--end::Table body-->
										</table>
	</div>
</div>
<!--end::Table widget 14-->

{!! theme()->addVendor('formrepeater') !!}
@push('scripts')

@endpush
</x-default-layout>