<x-default-layout>

	<div class="d-flex flex-column flex-column-fluid">

		<!--begin::Toolbar-->
		<div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

				<!--begin::Toolbar container-->
				<div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">

						<!--begin::Page title-->
						<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
								<!--begin::Title-->
								<h1
										class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
										Role Management
								</h1>
								<!--end::Title-->


								<!--begin::Breadcrumb-->
								<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
										<!--begin::Item-->
										<li class="breadcrumb-item text-muted">
												<a href="/" class="text-muted text-hover-primary">
														Dashboard </a>
										</li>
										<!--end::Item-->
										<!--begin::Item-->
										<li class="breadcrumb-item">
												<span class="bullet bg-gray-400 w-5px h-2px"></span>
										</li>
										<!--end::Item-->

										<!--begin::Item-->
										<li class="breadcrumb-item text-muted">
											Role Management </li>
										<!--end::Item-->
								</ul>
								<!--end::Breadcrumb-->
						</div>
						<!--end::Page title-->
				</div>
				<!--end::Toolbar container-->
		</div>
		<!--end::Toolbar-->

		<!--begin::Content-->
		<div id="kt_app_content" class="app-content  flex-column-fluid ">


				<!--begin::Content container-->
				<div id="kt_app_content_container" class="app-container  container-xxl ">
						<!--begin::Card-->
						<div class="card">
								<!--begin::Card header-->
								<div class="card-header border-0 pt-6">
										<!--begin::Card title-->
										<div class="card-title">
												<!--begin::Search-->
												<div class="d-flex align-items-center position-relative my-1">
													<i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5"><span
																	class="path1"></span><span class="path2"></span></i> <input
															type="text" data-kt-filter="search"
															class="form-control form-control-solid w-250px ps-13"
															placeholder="Search Role Management" />
											</div>
												<!--end::Search-->
												<!--begin::Export buttons-->
													<div id="kt_datatable_example_1_export" class="d-none"></div>
													<!--end::Export buttons-->
										</div>
										<!--begin::Card title-->

										<!--begin::Card toolbar-->
										<div class="card-toolbar">
											<!--begin::Export dropdown-->
													<button type="button" class="btn btn-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
														<i class="ki-duotone ki-exit-down fs-2"><span class="path1"></span><span class="path2"></span></i>
														Export
													</button>
													<!--begin::Menu-->
													<div id="kt_datatable_example_export_menu" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4" data-kt-menu="true">
														<!--begin::Menu item-->
														<div class="menu-item px-3">
															<a href="#" class="menu-link px-3" data-kt-export="excel">
															Export as Excel
															</a>
														</div>
														<!--end::Menu item-->
														<!--begin::Menu item-->
														<div class="menu-item px-3">
															<a href="#" class="menu-link px-3" data-kt-export="csv">
															Export as CSV
															</a>
														</div>
														<!--end::Menu item-->
														<!--begin::Menu item-->
														<div class="menu-item px-3">
															<a href="#" class="menu-link px-3" data-kt-export="pdf">
															Export as PDF
															</a>
														</div>
														<!--end::Menu item-->
													</div>
													<!--end::Menu-->
													<!--end::Export dropdown-->

												<!--begin::Hide default export buttons-->
												<div id="kt_datatable_example_buttons" class="d-none"></div>
												<!--end::Hide default export buttons -->
												<!--begin::Toolbar-->
												<div class="d-flex justify-content-end"
														data-kt-customer-table-toolbar="base">

														<!--begin::Add customer-->
														<a href="{{ route('roles.create') }}" class="btn btn-primary ms-2">
																Add New Role
														</a>
														<!--end::Add customer-->
												</div>
												<!--end::Toolbar-->

										</div>
										<!--end::Card toolbar-->
								</div>
								<!--end::Card header-->

								<!--begin::Card body-->
								<div class="card-body pt-0">

										<!--begin::Table-->
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
																<th class="min-w-125px">No.</th>
																<th class="min-w-125px">Name</th>
																<th class="text-center min-w-70px">Actions</th>
														</tr>
												</thead>
												<tbody class="fw-semibold text-gray-600">
													@foreach ($roles as $key => $role)
														<tr>
																<td hidden>
																		<div
																				class="form-check form-check-sm form-check-custom form-check-solid">
																				<input class="form-check-input" type="checkbox" value="1" />
																		</div>
																</td>
																<td>{{ ++$i }}</td>
                        				<td>{{ $role->name }}</td>
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
																				@can('role-delete')
																				<div class="menu-item px-3">
																					{!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'id' => 'form-delete'.'-'.$role->id ,'style'=>'display:inline']) !!}
																										{{-- {!! Form::submit('Delete', ['class' => 'menu-link px-3']) !!} --}}
																					{!! Form::close() !!}
																						<a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('form-delete-{{ $role->id }}').submit();" class="menu-link px-3"
																								data-kt-customer-table-filter="delete_row">
																								Delete
																						</a>
																				</div>
																				@endcan

																			@can('role-edit')
																					<!--begin::Menu item-->
																					<div class="menu-item px-3">
																						<a href="{{ route('roles.edit',$role->id) }}"
																								class="menu-link px-3">
																								Edit
																						</a>
																					</div>
																				<!--end::Menu item-->
																			@endcan

																		</div>
																		<!--end::Menu-->
																</td>
														</tr>
														@endforeach
												</tbody>
												<!--end::Table body-->
										</table>
										<!--end::Table-->
								</div>
								<!--end::Card body-->
						</div>
						<!--end::Card-->


						<!--end::Modal - Customers - Add--><!--begin::Modal - Adjust Balance-->
						<div class="modal fade" id="kt_customers_export_modal" tabindex="-1" aria-hidden="true">
								<!--begin::Modal dialog-->
								<div class="modal-dialog modal-dialog-centered mw-650px">
										<!--begin::Modal content-->
										<div class="modal-content">
												<!--begin::Modal header-->
												<div class="modal-header">
														<!--begin::Modal title-->
														<h2 class="fw-bold">Export Customers</h2>
														<!--end::Modal title-->

														<!--begin::Close-->
														<div id="kt_customers_export_close"
																class="btn btn-icon btn-sm btn-active-icon-primary">
																<i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
																				class="path2"></span></i>
														</div>
														<!--end::Close-->
												</div>
												<!--end::Modal header-->

												<!--begin::Modal body-->
												<div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
														<!--begin::Form-->
														<form id="kt_customers_export_form" class="form" action="#">
																<!--begin::Input group-->
																<div class="fv-row mb-10">
																		<!--begin::Label-->
																		<label class="fs-5 fw-semibold form-label mb-5">Select Export
																				Format:</label>
																		<!--end::Label-->

																		<!--begin::Input-->
																		<select name="country" data-control="select2"
																				data-placeholder="Select a format" data-hide-search="true"
																				name="format" class="form-select form-select-solid">
																				<option value="excell">Excel</option>
																				<option value="pdf">PDF</option>
																				<option value="cvs">CVS</option>
																				<option value="zip">ZIP</option>
																		</select>
																		<!--end::Input-->
																</div>
																<!--end::Input group-->

																<!--begin::Input group-->
																<div class="fv-row mb-10">
																		<!--begin::Label-->
																		<label class="fs-5 fw-semibold form-label mb-5">Select Date
																				Range:</label>
																		<!--end::Label-->

																		<!--begin::Input-->
																		<input class="form-control form-control-solid"
																				placeholder="Pick a date" name="date" />
																		<!--end::Input-->
																</div>
																<!--end::Input group-->

																<!--begin::Row-->
																<div class="row fv-row mb-15">
																		<!--begin::Label-->
																		<label class="fs-5 fw-semibold form-label mb-5">Payment
																				Type:</label>
																		<!--end::Label-->

																		<!--begin::Radio group-->
																		<div class="d-flex flex-column">
																				<!--begin::Radio button-->
																				<label
																						class="form-check form-check-custom form-check-sm form-check-solid mb-3">
																						<input class="form-check-input" type="checkbox"
																								value="1" checked="checked" name="payment_type" />
																						<span
																								class="form-check-label text-gray-600 fw-semibold">
																								All
																						</span>
																				</label>
																				<!--end::Radio button-->

																				<!--begin::Radio button-->
																				<label
																						class="form-check form-check-custom form-check-sm form-check-solid mb-3">
																						<input class="form-check-input" type="checkbox"
																								value="2" checked="checked" name="payment_type" />
																						<span
																								class="form-check-label text-gray-600 fw-semibold">
																								Visa
																						</span>
																				</label>
																				<!--end::Radio button-->

																				<!--begin::Radio button-->
																				<label
																						class="form-check form-check-custom form-check-sm form-check-solid mb-3">
																						<input class="form-check-input" type="checkbox"
																								value="3" name="payment_type" />
																						<span
																								class="form-check-label text-gray-600 fw-semibold">
																								Mastercard
																						</span>
																				</label>
																				<!--end::Radio button-->

																				<!--begin::Radio button-->
																				<label
																						class="form-check form-check-custom form-check-sm form-check-solid">
																						<input class="form-check-input" type="checkbox"
																								value="4" name="payment_type" />
																						<span
																								class="form-check-label text-gray-600 fw-semibold">
																								American Express
																						</span>
																				</label>
																				<!--end::Radio button-->
																		</div>
																		<!--end::Input group-->
																</div>
																<!--end::Row-->

																<!--begin::Actions-->
																<div class="text-center">
																		<button type="reset" id="kt_customers_export_cancel"
																				class="btn btn-light me-3">
																				Discard
																		</button>

																		<button type="submit" id="kt_customers_export_submit"
																				class="btn btn-primary">
																				<span class="indicator-label">
																						Submit
																				</span>
																				<span class="indicator-progress">
																						Please wait... <span
																								class="spinner-border spinner-border-sm align-middle ms-2"></span>
																				</span>
																		</button>
																</div>
																<!--end::Actions-->
														</form>
														<!--end::Form-->
												</div>
												<!--end::Modal body-->
										</div>
										<!--end::Modal content-->
								</div>
								<!--end::Modal dialog-->
						</div>
						<!--end::Modal - New Card-->
					<!--end::Modals-->


				</div>
				<!--end::Content container-->
		</div>
		<!--end::Content-->
</div>



{!! theme()->addVendor('formrepeater') !!}
@push('scripts')

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	<script>
		"use strict";

// Class definition
var KTDatatablesExample = function () {
    // Shared variables
    var table;
    var datatable;

    // Private functions
    var initDatatable = function () {
        // Set date data order
        const tableRows = table.querySelectorAll('tbody tr');

        tableRows.forEach(row => {
            const dateRow = row.querySelectorAll('td');
            const realDate = moment(dateRow[3].innerHTML, "DD MMM YYYY, LT").format(); // select date from 4th column in table
            dateRow[3].setAttribute('data-order', realDate);
        });

        // Init datatable --- more info on datatables: https://datatables.net/manual/
        datatable = $(table).DataTable({
            "info": false,
            'order': [],
            'pageLength': 10,
        });
    }

    // Hook export buttons
    var exportButtons = () => {
        const documentTitle = 'Products';
        var buttons = new $.fn.dataTable.Buttons(table, {
            buttons: [
                {
                    extend: 'copyHtml5',
										exportOptions: {
                    columns: [1,2]
                },
                    title: documentTitle
                },
                {
                    extend: 'excelHtml5',
										exportOptions: {
                    columns: [1,2]
                },
                    title: documentTitle
                },
                {
                    extend: 'csvHtml5',
										exportOptions: {
                    columns: [1,2]
                },
                    title: documentTitle
                },
                {
                    extend: 'pdfHtml5',
										exportOptions: {
                    columns: [1,2]
                },
                    title: documentTitle
                }
            ]
        }).container().appendTo($('#kt_datatable_example_buttons'));

        // Hook dropdown menu click event to datatable export buttons
        const exportButtons = document.querySelectorAll('#kt_datatable_example_export_menu [data-kt-export]');
        exportButtons.forEach(exportButton => {
            exportButton.addEventListener('click', e => {
                e.preventDefault();

                // Get clicked export value
                const exportValue = e.target.getAttribute('data-kt-export');
                const target = document.querySelector('.dt-buttons .buttons-' + exportValue);

                // Trigger click event on hidden datatable export buttons
                target.click();
            });
        });
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatable = () => {
        const filterSearch = document.querySelector('[data-kt-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            datatable.search(e.target.value).draw();
        });
    }

    // Public methods
    return {
        init: function () {
            table = document.querySelector('#kt_datatable_example');

            if ( !table ) {
                return;
            }

            initDatatable();
            exportButtons();
            handleSearchDatatable();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTDatatablesExample.init();
});
	</script>
@endpush
</x-default-layout>