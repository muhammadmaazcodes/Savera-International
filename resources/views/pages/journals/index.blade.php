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
										Journals
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
											Journals </li>
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
															placeholder="Search Journal" />
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
														<!--begin::Menu item-->
														<div class="menu-item px-3">
															<a href="javascript:void(0);" class="menu-link px-3 view-screen" data-bs-toggle="modal" data-bs-target="#AddPort">
															View Screen
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
														<button type="button" class="btn btn-primary ms-2" data-bs-toggle="modal" data-bs-target="#AddProduct">
																Add New Journal
														</button>
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
																<th class="min-w-125px">Journal ID</th>
																<th class="min-w-125px">Journal Date</th>
																<th class="min-w-125px">Journal Description</th>
																<th class="text-center min-w-70px action-th">Actions</th>
														</tr>
												</thead>
												<tbody class="fw-semibold text-gray-600">
													@foreach($journals as $journal)
														<tr>
																<td hidden>
																		<div
																				class="form-check form-check-sm form-check-custom form-check-solid">
																				<input class="form-check-input" type="checkbox" value="1" />
																		</div>
																</td>
																<td>
																		{{ $journal->id }}
																</td>
																<td>
																		{{ $journal->journal_date }}
																</td>
																<td>
																	{{ $journal->description }}
																</td>
																<td class="text-center action-td">
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
																					{!! Form::open(['method' => 'DELETE','route' => ['journals.destroy', $journal->id],'id' => 'form-delete'.'-'.$journal->id ,'style'=>'display:inline']) !!}
																										{{-- {!! Form::submit('Delete', ['class' => 'menu-link px-3']) !!} --}}
																					{!! Form::close() !!}
																						<a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('form-delete-{{ $journal->id }}').submit();" class="menu-link px-3"
																								data-kt-customer-table-filter="delete_row">
																								Delete
																						</a>
																				</div>

																					<!--begin::Menu item-->
																					<div class="menu-item px-3">
																						<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#EditProduct-{{ $journal->id }}"
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
										<!--end::Table-->
								</div>
								<!--end::Card body-->
						</div>
						<!--end::Card-->

						<!--begin::Create BUsiness Modals-->
						<div class="modal fade modal-lg" id="AddProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
								<div class="modal-content">
									<div class="modal-header bg-primary pt-5 pb-5">
										<h5 class="modal-title text-white fs-2" id="exampleModalLabel">Add New Journal</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<div class="modal-body">
						
										<form class="pt-1" id="add-product-form" method="POST" action="/journals">
											@csrf
											<div class="row justify-content-center align-items-center">
												<div class="col-md-4">
													<label class="form-label">Journal Date<span class="text-danger">*</span></label>
													<input type="date" class="form-control form-control-lg border-dark" placeholder="" name="journal_date" value="{{ old('journal_date') }}" required />
												</div>
												<div class="col-md-8">
													<label class="form-label">Journal Description</label>
													<textarea name="description" class="form-control" cols="30" rows="2"></textarea>
												</div>
						
											</div>
										</form>
						
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" id="add-close-btn" data-bs-dismiss="modal">Close</button>
										<button type="button" onclick="$('#add-product-form').submit();" id="submit-add-btn" class="btn btn-primary">Submit</button>
									</div>
								
								</div>
							</div>
						</div>
						<!--End::Create Business Modals-->
						
			{{-- EDIT Products START --}}
			@foreach ($journals as $journal)
						<div class="modal fade modal-lg" id="EditProduct-{{ $journal->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
								<div class="modal-content">
									<div class="modal-header bg-primary pt-5 pb-5">
										<h5 class="modal-title text-white fs-2" id="exampleModalLabel">Edit Journal</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<div class="modal-body">
						
										<form class="pt-1" id="edit-product-form-{{ $journal->id }}" method="POST" action="/journals/{{ $journal->id }}">
											@csrf
											@method('PUT')
											<div class="row justify-content-center align-items-center">
												<div class="col-md-4">
													<label class="form-label">Journal Name<span class="text-danger">*</span></label>
													<input type="date" class="form-control form-control-lg border-dark" name="journal_date" value="{{ $journal->journal_date }}" required />
												</div>
												<div class="col-md-8">
													<label class="form-label">Description</label>
													<textarea name="description" class="form-control" cols="30" rows="2">{{ $journal->description }}</textarea>
												</div>
						
											</div>
										</form>
						
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" id="add-close-btn" data-bs-dismiss="modal">Close</button>
										<button type="button" onclick="$('#edit-product-form-{{ $journal->id }}').submit();" id="submit-update-btn" class="btn btn-primary">Update</button>
									</div>
								
								</div>
							</div>
						</div>
				@endforeach
			{{-- END Products END --}}


				</div>
				<!--end::Content container-->
		</div>
		<!--end::Content-->
</div>


	<!--begin::View Screen Modals-->
<div class="modal fade modal-lg" id="AddPort" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
					<div class="modal-header bg-primary pt-5 pb-5">
							<h5 class="modal-title text-white fs-2" id="exampleModalLabel">View Screen</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">

									<div class="row justify-content-center align-items-center">
											<table class="table" id="screen-view">
													<thead>
															<th>Journal ID</th>
															<th>Journal Date</th>
															<th>Journal Description</th>
													</thead>
													<tbody>
															
													</tbody>
											</table>
											
									</div>

					</div>
					<div class="modal-footer">
							<button type="button" class="btn btn-secondary" id="add-close-btn" data-bs-dismiss="modal">Close</button>
					</div>
			
			</div>
	</div>
</div>
<!--End::View Screen Modals-->


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
        const documentTitle = 'Journals';
        var buttons = new $.fn.dataTable.Buttons(table, {
            buttons: [
                {
                    extend: 'copyHtml5',
										exportOptions: {
                    columns: [1,2,3]
                },
                    title: documentTitle
                },
                {
                    extend: 'excelHtml5',
										exportOptions: {
                    columns: [1,2,3]
                },
                    title: documentTitle
                },
                {
                    extend: 'csvHtml5',
										exportOptions: {
                    columns: [1,2,3]
                },
                    title: documentTitle
                },
                {
                    extend: 'pdfHtml5',
										exportOptions: {
                    columns: [1,2,3]
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

	<script>
		$(document).on("click",".view-screen", function () {
				var main_table = $('#kt_datatable_example').html();
				$('#screen-view').html(main_table);

				$('#screen-view').find('.action-td').remove();
				$('#screen-view').find('.action-th').remove();
		});
	</script>
@endpush
</x-default-layout>