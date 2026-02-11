<x-default-layout>
    <style>
        th {
      font-weight: bold !important;
      color: #000 !important;
      border-bottom: 1px solid #000 !important;
    }
  td {
      padding-top: 0.3em !important;
      padding-bottom: 0.3em !important;
      border-bottom: 1px solid #000 !important;
      color: #000 !important;
  }
    </style>
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="">

                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        Inventories
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
                            Inventories </li>
                        <!--end::Item-->

                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->

        <div class="mb-4">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button bg-secondary fw-bold text-dark fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      Filter Inventory
                    </button> 
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <select name="transaction_type" id="transaction_type" class="form-control">
                                    <option disabled selected>Search Trans. Type</option>
                                    <option value="">All</option>
                                    <option value="Local">Local</option>
                                    <option value="Import">Import</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-2">
                                <select name="seller" id="seller" class="form-control">
                                    <option disabled selected>Search Seller</option>
                                    <option value="">All</option>
                                    @foreach ($sellers as $seller)
                                        <option value="{{ $seller->name }}">{{ $seller->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-2">
                                <select name="vessel" id="vessel" class="form-control">
                                    <option disabled selected>Search Vessel</option>
                                    <option value="">All</option>
                                    @foreach ($vessels as $vessel)
                                        <option value="{{ $vessel->name }}">{{ $vessel->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-2">
                                <select name="product" id="product" class="form-control">
                                    <option disabled selected>Search Product</option>
                                    <option value="">All</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->code }}">{{ $product->code }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-2">
                                <input type="text" name="bl_qty" id="bl_qty" placeholder="BL Qty" class="form-control">
                            </div>
                            <div class="col-md-4 mb-2">
                                <select name="type" id="type" class="form-control">
                                    <option disabled selected>Search Type</option>
                                    <option value="">All</option>
                                    <option value="Local">Local</option>
                                    <option value="Import">Import</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-2">
                                <input type="text" name="shortage" id="shortage" placeholder="Shortage" class="form-control">
                            </div>
                            <div class="col-md-4 mb-2 d-flex">
                                <label for="" class="form-label">Arrival To</label>
                                <input type="date" id="arrival-to" class="form-control">
                            </div>
                            <div class="col-md-4 mb-2 d-flex">
                                <label for="" class="form-label">Arrival From</label>
                                <input type="date" id="arrival-from" class="form-control">
                            </div>


                        </div>
                    </div>
                  </div>
                </div>
              </div>
        </div>

        <!--begin::Content-->
        <div id="kt_app_content" class="app-content  flex-column-fluid ">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="">
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-6">
                        <!--begin::Card title-->
                        <div class="card-title">
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
                                    <a href="javascript:void(0);" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#AddPort">
                                    View on Screen
                                    </a>
                                </div>
                                <!--end::Menu item-->
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
                            <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">

                                <!--begin::Add customer-->
                                <a href="/inventories/create" class="btn btn-primary ms-3">
                                    Add New
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
                        <table class="table align-middle table-row-bordered table-hover fs-6 gy-5" id="kt_datatable_example">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="w-10px pe-2" hidden>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                            <input class="form-check-input" type="checkbox" data-kt-check="true"
                                                data-kt-check-target="#kt_customers_table .form-check-input"
                                                value="1" />
                                        </div>
                                    </th>
                                    <th class="min-w-125px">Seller</th>
                                    <th class="min-w-125px">Vessel</th>
                                    <th class="min-w-125px text-center">Arrival<br>Date</th>
                                    <th class="min-w-25px">Product</th>
                                    <th class="min-w-125px text-center">Vessel<br>Qty</th>
                                    <th class="min-w-125px text-center">Landed<br>Qty</th>
                                    <th class="min-w-125px text-end">Shortage</th>
                                    <th class="min-w-125px text-center">Transaction<br>Type</th>
                                    <th class="min-w-125px">Type</th>
                                    <th class="min-w-125px" hidden>Arrival Date</th>
                                    <th class="text-end min-w-70px">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                @foreach ($inventories as $inventory)
                                    @php
                                        $bl = \App\Models\InventoryBL::where('inventory_id', $inventory->inventory_id)->get();
                                        $contracts = \App\Models\LocalContract::where('inventory_id', $inventory->inventory_id)->get();
                                        $shortage_contract = $bl->sum('bl_quantity') - $bl->sum('landed_quantity');
                                        $stock_bls = \App\Models\InventoryBL::where('inventory_id',$inventory->inventory_id)->where('product_id',$inventory->product_id)->get();
                                        $shortage_bls = 0;
                                        foreach ($stock_bls as $key => $qty) {
                                            $shortage_bls += $qty->shortage_status() ?? 0;    
                                        }
                                    @endphp
                                    <tr>
                                        <td hidden>
                                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" value="1" />
                                            </div>
                                        </td>
                                        <td>
                                            @isset($inventory->inventory)
                                                {{ $inventory->inventory->seller->name }}    
                                            @endisset
                                        </td>
                                        <td>
                                            @isset($inventory->inventory)
                                                {{ $inventory->inventory->vessel->name }}
                                            @endisset
                                        </td>
                                        <td class="text-center">
                                            @isset($inventory->inventory)
                                                {{ date('M Y', strtotime($inventory->inventory->arrival_date)) }}
                                            @endisset
                                        </td>
                                        <td>
                                            @isset($inventory->inventory)
                                                {{ $inventory->product->code ?? 'N/A' }}
                                            @endisset
                                        </td>
                                        <td class="text-end">{{ number_format($inventory->inventory->vessel_qty,3) }}</td>
                                        {{-- <td class="text-end">{{ number_format($stock_bls->sum('landed_quantity'), 3) }}</td> --}}
                                        <td class="text-end">{{ number_format($bl->sum('landed_quantity'), 3) }}</td>
                                        <td class="text-end">
                                            @isset($inventory->inventory)
                                                {{ number_format($inventory->terminal_shortage, 3) }}
                                            @endisset
                                        </td>
                                        <td class="text-center">
                                            @isset($inventory->inventory)
                                                {{ $inventory->inventory->transaction_type }}
                                            @endisset
                                        </td>
                                        <td>
                                            @isset($inventory->inventory)
                                                {{ $inventory->inventory->type }}
                                            @endisset
                                        </td>
                                        <td hidden>
                                            @isset($inventory->inventory)
                                                {{ $inventory->inventory->arrival_date }}
                                            @endisset
                                        </td>
                                        <td class="text-end">
                                            <a href="#"
                                                class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                Actions
                                                <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                            <!--begin::Menu-->
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                data-kt-menu="true">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    @isset($inventory->inventory)
                                                    <a href="/inventories/{{ $inventory->inventory->id }}/show"
                                                        class="menu-link px-3 text-dark">
                                                        Show BL
                                                    </a>
                                                    @endisset
                                                </div>
                                                <!--end::Menu item-->

                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    @isset($inventory->inventory)
                                                    <a href="/inventories/{{ $inventory->id }}/view"
                                                        class="menu-link px-3 text-dark">
                                                        View
                                                    </a>
                                                    @endisset
                                                </div>
                                                <!--end::Menu item-->

                                                @if ($contracts->count() > 0)
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="javascript:void(0);"
                                                            class="menu-link px-3 has-contract text-dark">
                                                            Edit
                                                        </a>
                                                    </div>
                                                    <!--end::Menu item-->

                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="javascript:void(0);"
                                                            class="menu-link px-3 delete-has-contract text-dark">
                                                            Delete
                                                        </a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                @else
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        @isset($inventory->inventory)
                                                        <a href="/inventories/{{ $inventory->inventory->id }}/edit"
                                                            class="menu-link px-3 text-dark">
                                                            Edit
                                                        </a>
                                                        @endisset
                                                    </div>
                                                    <!--end::Menu item-->
                                                    {!! Form::open([
                                                        'method' => 'DELETE',
                                                        'url' => ['inventory/delete-stock/'.$inventory->id],
                                                        'id' => 'delete-form' . '-' . $inventory->id,
                                                        'style' => 'display:inline',
                                                    ]) !!}
                                                    {{-- {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!} --}}
                                                    {!! Form::close() !!}
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="javascript:void(0);"
                                                            onclick="event.preventDefault(); document.getElementById('delete-form-{{ $inventory->id }}').submit();"
                                                            class="menu-link px-3 text-dark">
                                                            Delete
                                                        </a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                @endif

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

                <!--begin::Modals-->
                <!--begin::Modal - Customers - Add-->
                <div class="modal fade" id="kt_modal_add_customer" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Form-->
                            <form class="form" action="#" id="kt_modal_add_customer_form"
                                data-kt-redirect="../../customers/list.html">
                                <!--begin::Modal header-->
                                <div class="modal-header" id="kt_modal_add_customer_header">
                                    <!--begin::Modal title-->
                                    <h2 class="fw-bold">Add a Customer</h2>
                                    <!--end::Modal title-->

                                    <!--begin::Close-->
                                    <div id="kt_modal_add_customer_close"
                                        class="btn btn-icon btn-sm btn-active-icon-primary">
                                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                                class="path2"></span></i>
                                    </div>
                                    <!--end::Close-->
                                </div>
                                <!--end::Modal header-->

                                <!--begin::Modal body-->
                                <div class="modal-body py-10 px-lg-17">
                                    <!--begin::Scroll-->
                                    <div class="scroll-y me-n7 pe-7" id="kt_modal_add_customer_scroll"
                                        data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                                        data-kt-scroll-max-height="auto"
                                        data-kt-scroll-dependencies="#kt_modal_add_customer_header"
                                        data-kt-scroll-wrappers="#kt_modal_add_customer_scroll"
                                        data-kt-scroll-offset="300px">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="required fs-6 fw-semibold mb-2">Name</label>
                                            <!--end::Label-->

                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid"
                                                placeholder="" name="name" value="Sean Bean" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold mb-2">
                                                <span class="required">Email</span>


                                                <span class="ms-1" data-bs-toggle="tooltip"
                                                    title="Email address must be active">
                                                    <i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span
                                                            class="path1"></span><span class="path2"></span><span
                                                            class="path3"></span></i></span> </label>
                                            <!--end::Label-->

                                            <!--begin::Input-->
                                            <input type="email" class="form-control form-control-solid"
                                                placeholder="" name="email" value="sean@dellito.com" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="fv-row mb-15">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold mb-2">Description</label>
                                            <!--end::Label-->

                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid"
                                                placeholder="" name="description" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Billing toggle-->
                                        <div class="fw-bold fs-3 rotate collapsible mb-7" data-bs-toggle="collapse"
                                            href="#kt_modal_add_customer_billing_info" role="button"
                                            aria-expanded="false" aria-controls="kt_customer_view_details">
                                            Shipping Information
                                            <span class="ms-2 rotate-180">
                                                <i class="ki-duotone ki-down fs-3"></i> </span>
                                        </div>
                                        <!--end::Billing toggle-->

                                        <!--begin::Billing form-->
                                        <div id="kt_modal_add_customer_billing_info" class="collapse show">
                                            <!--begin::Input group-->
                                            <div class="d-flex flex-column mb-7 fv-row">
                                                <!--begin::Label-->
                                                <label class="required fs-6 fw-semibold mb-2">Address
                                                    Line 1</label>
                                                <!--end::Label-->

                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" placeholder=""
                                                    name="address1" value="101, Collins Street" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Input group-->
                                            <div class="d-flex flex-column mb-7 fv-row">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold mb-2">Address Line
                                                    2</label>
                                                <!--end::Label-->

                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" placeholder=""
                                                    name="address2" value="" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Input group-->
                                            <div class="d-flex flex-column mb-7 fv-row">
                                                <!--begin::Label-->
                                                <label class="required fs-6 fw-semibold mb-2">Town</label>
                                                <!--end::Label-->

                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" placeholder=""
                                                    name="city" value="Melbourne" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Input group-->
                                            <div class="row g-9 mb-7">
                                                <!--begin::Col-->
                                                <div class="col-md-6 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="required fs-6 fw-semibold mb-2">State
                                                        / Province</label>
                                                    <!--end::Label-->

                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" placeholder=""
                                                        name="state" value="Victoria" />
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Col-->

                                                <!--begin::Col-->
                                                <div class="col-md-6 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="required fs-6 fw-semibold mb-2">Post
                                                        Code</label>
                                                    <!--end::Label-->

                                                    <!--begin::Input-->
                                                    <input class="form-control form-control-solid" placeholder=""
                                                        name="postcode" value="3000" />
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Input group-->
                                            <div class="d-flex flex-column mb-7 fv-row">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold mb-2">
                                                    <span class="required">Country</span>


                                                    <span class="ms-1" data-bs-toggle="tooltip"
                                                        title="Country of origination">
                                                        <i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span
                                                                class="path1"></span><span
                                                                class="path2"></span><span
                                                                class="path3"></span></i></span>
                                                </label>
                                                <!--end::Label-->

                                                <!--begin::Input-->
                                                
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Wrapper-->
                                                <div class="d-flex flex-stack">
                                                    <!--begin::Label-->
                                                    <div class="me-5">
                                                        <!--begin::Label-->
                                                        <label class="fs-6 fw-semibold">Use as a billing
                                                            adderess?</label>
                                                        <!--end::Label-->

                                                        <!--begin::Input-->
                                                        <div class="fs-7 fw-semibold text-muted">If you
                                                            need more info, please check budget planning
                                                        </div>
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Label-->

                                                    <!--begin::Switch-->
                                                    <label
                                                        class="form-check form-switch form-check-custom form-check-solid">
                                                        <!--begin::Input-->
                                                        <input class="form-check-input" name="billing"
                                                            type="checkbox" value="1"
                                                            id="kt_modal_add_customer_billing" checked="checked" />
                                                        <!--end::Input-->

                                                        <!--begin::Label-->
                                                        <span class="form-check-label fw-semibold text-muted"
                                                            for="kt_modal_add_customer_billing">
                                                            Yes
                                                        </span>
                                                        <!--end::Label-->
                                                    </label>
                                                    <!--end::Switch-->
                                                </div>
                                                <!--begin::Wrapper-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Billing form-->
                                    </div>
                                    <!--end::Scroll-->
                                </div>
                                <!--end::Modal body-->

                                <!--begin::Modal footer-->
                                <div class="modal-footer flex-center">
                                    <!--begin::Button-->
                                    <button type="reset" id="kt_modal_add_customer_cancel"
                                        class="btn btn-light me-3">
                                        Discard
                                    </button>
                                    <!--end::Button-->

                                    <!--begin::Button-->
                                    <button type="submit" id="kt_modal_add_customer_submit" class="btn btn-primary">
                                        <span class="indicator-label">
                                            Submit
                                        </span>
                                        <span class="indicator-progress">
                                            Please wait... <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>
                                    <!--end::Button-->
                                </div>
                                <!--end::Modal footer-->
                            </form>
                            <!--end::Form-->
                        </div>
                    </div>
                </div>
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
                                            data-placeholder="Select a format" data-hide-search="true" name="format"
                                            class="form-select form-select-solid">
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
                                        <input class="form-control form-control-solid" placeholder="Pick a date"
                                            name="date" />
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
                                                <input class="form-check-input" type="checkbox" value="1"
                                                    checked="checked" name="payment_type" />
                                                <span class="form-check-label text-gray-600 fw-semibold">
                                                    All
                                                </span>
                                            </label>
                                            <!--end::Radio button-->

                                            <!--begin::Radio button-->
                                            <label
                                                class="form-check form-check-custom form-check-sm form-check-solid mb-3">
                                                <input class="form-check-input" type="checkbox" value="2"
                                                    checked="checked" name="payment_type" />
                                                <span class="form-check-label text-gray-600 fw-semibold">
                                                    Visa
                                                </span>
                                            </label>
                                            <!--end::Radio button-->

                                            <!--begin::Radio button-->
                                            <label
                                                class="form-check form-check-custom form-check-sm form-check-solid mb-3">
                                                <input class="form-check-input" type="checkbox" value="3"
                                                    name="payment_type" />
                                                <span class="form-check-label text-gray-600 fw-semibold">
                                                    Mastercard
                                                </span>
                                            </label>
                                            <!--end::Radio button-->

                                            <!--begin::Radio button-->
                                            <label class="form-check form-check-custom form-check-sm form-check-solid">
                                                <input class="form-check-input" type="checkbox" value="4"
                                                    name="payment_type" />
                                                <span class="form-check-label text-gray-600 fw-semibold">
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
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Table widget 14-->

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
                                    <th>Seller</th>
                                    <th>Vessel</th>
                                    <th>Product</th>
                                    <th>Vessel Qty</th>
                                    <th>Landed Qty</th>
                                    <th>Shortage</th>
                                    <th>Trans. Type</th>
                                    <th>Type</th>
                                </thead>
                                <tbody>
                                    @foreach ($inventories as $inventory)
                                        @php
                                            $bl = \App\Models\InventoryBL::where('inventory_id', $inventory->inventory_id)->get();
                                            $contracts = \App\Models\LocalContract::where('inventory_id', $inventory->inventory_id)->get();
                                            $shortage_contract = $bl->sum('bl_quantity') - $bl->sum('landed_quantity');
                                        @endphp
                                        <tr>
                                            <td>
                                                @isset($inventory->inventory)
                                                {{ $inventory->inventory->seller->name }}
                                                @endisset
                                            </td>
                                            <td>
                                                @isset($inventory->inventory)
                                                {{ $inventory->inventory->vessel->name }}
                                                @endisset
                                            </td>
                                            <td>{{ $inventory->product->code ?? 'N/A' }}</td>
                                            <td>{{ number_format($inventory->vessel_qty,3) }}</td>
                                            <td>{{ number_format($bl->sum('bl_quantity') - $shortage_contract, 3) }}</td>
                                            <td>{{ number_format($inventory->terminal_shortage, 3) }}</td>
                                            <td>
                                                @isset($inventory->inventory)
                                                {{ $inventory->inventory->transaction_type }}
                                                @endisset
                                            </td>
                                            <td>
                                                @isset($inventory->inventory)
                                                {{ $inventory->inventory->type }}
                                                @endisset
                                            </td>
                                        </tr>
                                    @endforeach
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
    @push('scripts')
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        @if (Session::has('error'))
            <script>
                swal("{{ Session::get('error') }}","","error");
            </script>
        @endif
        <script>
            $(document).ready(function() {
                var table = $('#kt_datatable_example').DataTable();
                var table2 = $('#screen-view').DataTable({
                    info: false,
                    paging: false
                });
                
                $('#seller').on('change', function() {
                    table.column(1).search(this.value).draw();
                    table2.column(0).search(this.value).draw();
                });

                $('#vessel').on('change', function() {
                    table.column(2).search(this.value).draw();
                    table2.column(1).search(this.value).draw();
                });

                $('#product').on('change', function() {
                    table.column(4).search(this.value).draw();
                    table2.column(2).search(this.value).draw();
                });

                $('#bl_qty').on('keyup', function() {
                    table.column(5).search(this.value).draw();
                    table2.column(3).search(this.value).draw();
                });

                $('#shortage').on('keyup', function() {
                    table.column(7).search(this.value).draw();
                    table2.column(5).search(this.value).draw();
                });

        // Add event listener for range filtering
        $('#arrival-to, #arrival-from').on('change', function() {
            table.draw();
        });

        // Custom filtering function which will search data between two dates
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var minDate = $('#arrival-to').val();
                var maxDate = $('#arrival-from').val();
                var date = data[10]; // Assuming the date column is at index 1

                if ((minDate === '' && maxDate === '') ||
                    (minDate <= date && maxDate === '') ||
                    (minDate === '' && maxDate >= date) ||
                    (minDate <= date && maxDate >= date)) {
                    return true;
                }
                return false;
            }
        );

    });
    </script>
    <script>
            $(document).on("click", ".has-contract", function() {
                swal("This Inventory contain contracts !");
            });

            $(document).on("click", ".delete-has-contract", function() {
                swal("This Inventory contain contracts !");
            });
        </script>

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
            const documentTitle = 'Inventories';
            var buttons = new $.fn.dataTable.Buttons(table, {
                buttons: [
                    {
                        extend: 'copyHtml5',
                                            exportOptions: {
                        columns: [1,2,3,4,5,6,7,8,9]
                    },
                        title: documentTitle
                    },
                    {
                        extend: 'excelHtml5',
                                            exportOptions: {
                        columns: [1,2,3,4,5,6,7,8,9]
                    },
                        title: documentTitle
                    },
                    {
                        extend: 'csvHtml5',
                                            exportOptions: {
                        columns: [1,2,3,4,5,6,7,8,9]
                    },
                        title: documentTitle
                    },
                    {
                        extend: 'pdfHtml5',
                                            exportOptions: {
                        columns: [1,2,3,4,5,6,7,8,9]
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