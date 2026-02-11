<x-default-layout>
  <style>
    .nav-link.active {
      background-color: #4bcbf1 !important;
    }

    .nav-link {
      font-size: 13px;
    }
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
                      Contracts
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
                        Contracts </li>
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

      </div>

              <!--begin::Card-->
              <div class="card">
                  <!--begin::Card header-->
                  <div class="card-header border-0 pt-6">
                      <!--begin::Card title-->
                      <div class="card-title">
                          <!--begin::Search-->
                          <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                              <button class="nav-link active tabs-link" id="pills-vessel" data-bs-toggle="pill" data-bs-target="#pills-vessel" type="button" role="tab" aria-controls="pills-vessel" aria-selected="true">Vessel</button>
                            </li>
                            <li class="nav-item" role="presentation">
                              <button class="nav-link tabs-link" id="pills-buyer" data-bs-toggle="pill" data-bs-target="#pills-buyer" type="button" role="tab" aria-controls="pills-buyer" aria-selected="false">Buyer</button>
                            </li>
                            <li class="nav-item" role="presentation">
                              <button class="nav-link tabs-link" id="pills-seller" data-bs-toggle="pill" data-bs-target="#pills-seller" type="button" role="tab" aria-controls="pills-seller" aria-selected="false">Seller</button>
                            </li>
                            <li class="nav-item" role="presentation">
                              <button class="nav-link tabs-link" id="pills-contract" data-bs-toggle="pill" data-bs-target="#pills-contract" type="button" role="tab" aria-controls="pills-contract" aria-selected="false">Contracts</button>
                            </li>
                          </ul>

                          <!--end::Search-->
                      </div>
                      <!--begin::Card title-->

                      <!--begin::Card toolbar-->
                      <div class="card-toolbar">

                          <!--begin::Toolbar-->
                          <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                            
                              
                          <!--begin::Add customer-->
                          <button data-bs-toggle="modal" data-bs-target="#ExportModal" class="btn btn-secondary border border-1 border-dark ms-3">
                            <i class="fa fa-download"></i> Export
                          </button>
                          <!--end::Add customer-->

                          <!--begin::Add customer-->
                              <a href="/local-contract/create" class="btn btn-primary ms-3">
                                New Contract
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
                    <div class="">
                      
                      <div class="tab-content">
                        <div class="tab-pane fade show active" id="pills-vessel" role="tabpanel" aria-labelledby="pills-vessel">

                              <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                  <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button bg-secondary fw-bold text-dark fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                      Filter Contracts
                                    </button> 
                                  </h2>
                                  <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                          <div class="col-md-3 mb-2">
                                            <select name="type" id="type" class="form-select">
                                                <option disabled selected>Transaction Type</option>
                                                <option value="">All</option>
                                                <option value="normal">Normal</option>
                                                <option value="barter">Barter</option>
                                                <option value="temp">Temporary</option>
                                            </select>
                                        </div>
                                          <div class="col-md-3 mb-2">
                                            <select name="seller" id="seller" class="form-select">
                                                  <option disabled selected>Search Seller</option>
                                                  <option value="">All</option>
                                                  @foreach ($businesses as $business)
                                                    <option value="{{ $business->name }}">{{ $business->name }}</option>
                                                  @endforeach
                                              </select>
                                          </div>
                                          <div class="col-md-3 mb-2">
                                            <select name="buyer" id="buyer" class="form-select">
                                                <option disabled selected>Search Buyer</option>
                                                <option value="">All</option>
                                                @foreach ($companies as $company)
                                                  <option value="{{ $company->name }}">{{ $company->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                            <div class="col-md-3 mb-2">
                                                <select name="vessel" id="vessel" class="form-select">
                                                    <option disabled selected>Search Vessel</option>
                                                    <option value="">All</option>
                                                    @foreach ($vessels as $vessel)
                                                      <option value="{{ $vessel->name }}">{{ $vessel->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <select name="product" id="product" class="form-select">
                                                    <option disabled selected>Search Product</option>
                                                    <option value="">All</option>
                                                    @foreach ($products as $product)
                                                      <option value="{{ $product->name }}">{{ $product->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <input type="text" name="bl_qty" id="bl_qty" placeholder="BL Qty" class="form-control">
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <input type="text" name="shortage" id="shortage" placeholder="Shortage" class="form-control">
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <select name="contract_status" id="contract_status" class="form-select">
                                                  <option disabled selected>Contract Status</option>
                                                  <option value="">All</option>
                                                  <option value="Waiting for Lifting">Waiting for Lifting</option>
								                                  <option value="Lifting in progress">Lifting in progress</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                              <label for="contract_date_to" class="form-label">Cont. Date To</label>
                                                <input type="date" name="contract_date_to" id="contract_date_to" placeholder="Shortage" class="form-control">
                                            </div>
                                            <div class="col-md-3 mb-2">
                                              <label for="contract_date_from" class="form-label">Cont. Date From</label>
                                              <input type="date" name="contract_date_from" id="contract_date_from" class="form-control">
                                          </div>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="table-responsive">
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
                                          <th class="min-w-125px">Vessel</th>
                                          <th class="min-w-125px">Voyage</th>
                                          <th class="min-w-125px">Seller</th>
                                          <th class="min-w-125px">Product</th>
                                          <th hidden>BL Qty</th>
                                          <th hidden>Shortage</th>
                                          <th class="min-w-125px">Landed Quantity</th>
                                          <th class="min-w-125px">Sold Qty.</th>
                                          <th class="min-w-125px">Unsold Qty.</th>
                                          <th class="min-w-125px">Lifted Qty.</th>
                                          <td hidden>Contract Status</td>
                                          <td hidden>Buyer</td>
                                          <td hidden>Type</td>
                                          <th hidden>Contract Date</th>
                                          <th class="text-end min-w-70px">Actions</th>
                                      </tr>
                                  </thead>
                                  <tbody class="fw-semibold text-gray-600">
                                    @foreach ($contracts as $contract)
                                    
                                      @if ($contract->liftings->count() == 0)
                                        @if (isset($contract->inventory) && $contract->inventory->stocks()->count() > 0)
                                          @foreach ($contract->inventory->stocks as $stock)
                                          <tr>
                                            <td hidden>
                                              <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                  <input class="form-check-input" type="checkbox" value="1" />
                                              </div>
                                          </td>
                                            <td>{{ $contract->inventory->vessel->name ?? 'N/A' }}</td>
                                            <td>{{ $contract->inventory->voyage_number ?? 'N/A' }}</td>
                                            <td>{{ $contract->business->name ?? 'N/A' }}</td>
                                            <td>{{ $stock->product->name ?? 'N/A' }}</td>
                                            <td hidden>{{ $contract->inventory->bl_quantity ?? 'N/A' }}</td>
                                            <td hidden>{{ $stock->terminal_shortage }}</td>
                                            <td>{{ $contract->inventory->landed_qty ?? 'N/A' }}</td>
                                            <td><span class="text-success fw-bold">{{ $contract->inventory->sold_qty() }}</span></td>
                                            <td><span class="text-danger fw-bold">{{ $contract->inventory->unsold_qty() }}</td>
                                            <td>{{ $contract->inventory->lifted_qty() }}</td>
                                            <td hidden>{{ $contract->contract_status }}</td>
                                            <td hidden>{{ $contract->buyer->name ?? 'N/A' }}</td>
                                            <td hidden>{{ $contract->type }}</td>
                                            <td hidden>{{ $contract->date }}</td>
                                            <td class="text-end">
                                              <a href="#"
                                                  class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                  data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                  Actions
                                                  <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                              <!--begin::Menu-->
                                              <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                  data-kt-menu="true">
                                                      {!! Form::open([
                                                          'method' => 'DELETE',
                                                          'route' => ['local-contract.destroy', $contract->id],
                                                          'id' => 'delete-form' . '-' . $contract->id,
                                                          'style' => 'display:inline',
                                                      ]) !!}
                                                      {!! Form::close() !!}
                                                      <!--begin::Menu item-->
                                                      <div class="menu-item px-3">
                                                          <a href="javascript:void(0);"
                                                              onclick="event.preventDefault(); document.getElementById('delete-form-{{ $contract->id }}').submit();"
                                                              class="menu-link px-3 text-dark">
                                                              Delete
                                                          </a>
                                                      </div>
                                                      <!--end::Menu item-->
                                              </div>
                                              <!--end::Menu-->
                                          </td>
                                        </tr>
                                          @endforeach
                                        @else
                                        <tr>
                                          <td hidden>
                                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" value="1" />
                                            </div>
                                        </td>
                                          <td>{{ $contract->inventory->vessel->name ?? 'N/A' }}</td>
                                          <td>{{ $contract->inventory->voyage_number ?? 'N/A' }}</td>
                                          <td>{{ $contract->business->name ?? 'N/A' }}</td>
                                          <td>{{ $contract->product->name ?? 'N/A' }}</td>
                                          <td hidden>{{ $contract->inventory->bl_quantity ?? 'N/A' }}</td>
                                          <td hidden>{{ isset($contract->inventory) ? $contract->inventory->shortage() : 'N/A' }}</td>
                                          <td>{{ $contract->inventory->landed_qty ?? 'N/A' }}</td>
                                          <td>{!! isset($contract->inventory) ? '<span class="text-success fw-bold">'.$contract->inventory->sold_qty().'</span>' : 'N/A' !!}</td>
                                          <td>{!! isset($contract->inventory) ? '<span class="text-danger fw-bold">'.$contract->inventory->unsold_qty().'</span>' : 'N/A' !!}</td>
                                          <td>{{ isset($contract->inventory) ? $contract->inventory->lifted_qty() : 'N/A' }}</td>
                                          <td hidden>{{ $contract->contract_status }}</td>
                                          <td hidden>{{ $contract->buyer->name ?? 'N/A' }}</td>
                                          <td hidden>{{ $contract->type }}</td>
                                          <td hidden>{{ $contract->date }}</td>
                                          <td class="text-end">
                                            <a href="#"
                                                class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                Actions
                                                <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                            <!--begin::Menu-->
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                data-kt-menu="true">
                                                    {!! Form::open([
                                                        'method' => 'DELETE',
                                                        'route' => ['local-contract.destroy', $contract->id],
                                                        'id' => 'delete-form' . '-' . $contract->id,
                                                        'style' => 'display:inline',
                                                    ]) !!}
                                                    {!! Form::close() !!}
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="javascript:void(0);"
                                                            onclick="event.preventDefault(); document.getElementById('delete-form-{{ $contract->id }}').submit();"
                                                            class="menu-link px-3 text-dark">
                                                            Delete
                                                        </a>
                                                    </div>
                                                    <!--end::Menu item-->
    
                                            </div>
                                            <!--end::Menu-->
                                        </td>
                                      </tr>
                                        @endif
                                      @endif
                                      
                                    @endforeach


                                    @foreach ($contracts as $contract)
                                    
                                      @if ($contract->liftings->count() > 0)
                                        <tr>
                                          <td hidden>
                                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" value="1" />
                                            </div>
                                        </td>
                                          <td>{{ $contract->inventory->vessel->name ?? 'N/A' }}</td>
                                          <td>{{ $contract->inventory->voyage_number ?? 'N/A' }}</td>
                                          <td>{{ $contract->business->name ?? 'N/A' }}</td>
                                          <td>{{ $contract->product->name ?? 'N/A' }}</td>
                                          <td hidden>{{ $contract->inventory->bl_quantity ?? 'N/A' }}</td>
                                          <td hidden>{{ isset($contract->inventory) ? $contract->inventory->shortage() : 'N/A' }}</td>
                                          <td>{{ $contract->inventory->landed_qty ?? 'N/A' }}</td>
                                          <td>{!! isset($contract->inventory) ? '<span class="text-success fw-bold">'.$contract->inventory->sold_qty().'</span>' : 'N/A' !!}</td>
                                          <td>{!! isset($contract->inventory) ? '<span class="text-danger fw-bold">'.$contract->inventory->unsold_qty().'</span>' : 'N/A' !!}</td>
                                          <td>{{ isset($contract->inventory) ? $contract->inventory->lifted_qty() : 'N/A' }}</td>
                                          <td hidden>{{ $contract->contract_status }}</td>
                                          <td hidden>{{ $contract->buyer->name ?? 'N/A' }}</td>
                                          <td hidden>{{ $contract->type }}</td>
                                          <td hidden>{{ $contract->date }}</td>
                                          <td class="text-end">
                                            <a href="#"
                                                class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                Actions
                                                <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                            <!--begin::Menu-->
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                data-kt-menu="true">
                                                    {!! Form::open([
                                                        'method' => 'DELETE',
                                                        'route' => ['local-contract.destroy', $contract->id],
                                                        'id' => 'delete-form' . '-' . $contract->id,
                                                        'style' => 'display:inline',
                                                    ]) !!}
                                                    {!! Form::close() !!}
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="javascript:void(0);"
                                                            onclick="event.preventDefault(); document.getElementById('delete-form-{{ $contract->id }}').submit();"
                                                            class="menu-link px-3 text-dark">
                                                            Delete
                                                        </a>
                                                    </div>
                                                    <!--end::Menu item-->
    
                                            </div>
                                            <!--end::Menu-->
                                        </td>
                                      </tr>
                                      @endif
                                      
                                    @endforeach
                                  </tbody>
                                  <!--end::Table body-->
                                </table>
                              </div>
                            </div>
                          
                            <div class="tab-pane show fade" id="pills-buyer" role="tabpanel" aria-labelledby="pills-buyer">
                              
                              <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                  <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button bg-secondary fw-bold text-dark fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                                      Filter Contracts
                                    </button> 
                                  </h2>
                                  <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                          <div class="col-md-3 mb-2">
                                            <select name="type" id="type2" class="form-select">
                                                <option disabled selected>Transaction Type</option>
                                                <option value="">All</option>
                                                <option value="normal">Normal</option>
                                                <option value="barter">Barter</option>
                                                <option value="temp">Temporary</option>
                                            </select>
                                        </div>
                                          <div class="col-md-3 mb-2">
                                            <select name="seller" id="seller2" class="form-select">
                                                  <option disabled selected>Search Seller</option>
                                                  <option value="">All</option>
                                                  @foreach ($businesses as $business)
                                                    <option value="{{ $business->name }}">{{ $business->name }}</option>
                                                  @endforeach
                                              </select>
                                          </div>
                                          <div class="col-md-3 mb-2">
                                            <select name="buyer" id="buyer2" class="form-select">
                                                <option disabled selected>Search Buyer</option>
                                                <option value="">All</option>
                                                @foreach ($companies as $company)
                                                  <option value="{{ $company->name }}">{{ $company->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                            <div class="col-md-3 mb-2">
                                                <select name="vessel" id="vessel2" class="form-select">
                                                    <option disabled selected>Search Vessel</option>
                                                    <option value="">All</option>
                                                    @foreach ($vessels as $vessel)
                                                      <option value="{{ $vessel->name }}">{{ $vessel->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <select name="product" id="product2" class="form-select">
                                                    <option disabled selected>Search Product</option>
                                                    <option value="">All</option>
                                                    @foreach ($products as $product)
                                                      <option value="{{ $product->name }}">{{ $product->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <input type="text" name="bl_qty" id="bl_qty2" placeholder="BL Qty" class="form-control">
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <input type="text" name="shortage" id="shortage2" placeholder="Shortage" class="form-control">
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <select name="contract_status" id="contract_status2" class="form-select">
                                                  <option disabled selected>Contract Status</option>
                                                  <option value="">All</option>
                                                  <option value="Waiting for Lifting">Waiting for Lifting</option>
								                                  <option value="Lifting in progress">Lifting in progress</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                              <label for="contract_date_to_2" class="form-label">Cont. Date To</label>
                                                <input type="date" name="contract_date_to_2" id="contract_date_to_2" placeholder="Shortage" class="form-control">
                                            </div>
                                            <div class="col-md-3 mb-2">
                                              <label for="contract_date_from_2" class="form-label">Cont. Date From</label>
                                              <input type="date" name="contract_date_from_2" id="contract_date_from_2" class="form-control">
                                          </div>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
      
                              <div class="table-responsive">
                                <!--begin::Table-->
                                  <table class="table align-middle table-row-bordered table-hover fs-6 gy-5" id="kt_datatable_example_2">
                                    <thead>
                                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                            <th class="w-10px pe-2" hidden>
                                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                    <input class="form-check-input" type="checkbox" data-kt-check="true"
                                                        data-kt-check-target="#kt_customers_table .form-check-input"
                                                        value="1" />
                                                </div>
                                            </th>
                                            <th class="min-w-125px">Buyer</th>
                                            <th class="min-w-125px">Vessel</th>
                                            <th class="min-w-125px">Product</th>
                                            <th class="min-w-125px">Contract Qty.</th>
                                            <th class="min-w-125px">Lifted Qty</th>
                                            <th class="min-w-125px">Balance Qty.</th>
                                            <th class="min-w-125px">Contracts</th>
                                            <th hidden>Seller</th>
                                            <th hidden>BL Qty.</th>
                                            <th hidden>Shortage</th>
                                            <th hidden>Contract Status</th>
                                            <th hidden>Type</th>
                                            <th hidden>Contract Date</th>
                                            <th class="text-end min-w-70px">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                      @foreach ($contracts as $contract)
                                          <tr>
                                            <td hidden>
                                              <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                  <input class="form-check-input" type="checkbox" value="1" />
                                              </div>
                                            </td>
                                            <td>{{ $contract->buyer->name ?? 'N/A' }}</td>
                                            <td>{{ $contract->inventory->vessel->name ?? 'N/A' }}</td>
                                            <td>{{ $contract->product->name ?? 'N/A' }}</td>
                                            <td>{{ $contract->quantity ?? '0.00' }}</td>
                                            <td>0.00</td>
                                            <td>0.00</td>
                                            <td>0</td>
                                            <td hidden>{{ $contract->business->name ?? 'N/A' }}</td>
                                            <td hidden>{{ $contract->inventory->bl_quantity ?? 'N/A' }}</td>
                                            <td hidden>{{ $contract->inventory->vessel_shortage ?? 'N/A' }}</td>
                                            <td hidden>{{ $contract->contract_status }}</td>
                                            <td hidden>{{ $contract->type }}</td>
                                            <td hidden>{{ $contract->date }}</td>
                                            <td class="text-end">
                                              <a href="#"
                                                  class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                  data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                  Actions
                                                  <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                              <!--begin::Menu-->
                                              <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                  data-kt-menu="true">
      
                                                      {!! Form::open([
                                                          'method' => 'DELETE',
                                                          'route' => ['local-contract.destroy', $contract->id],
                                                          'id' => 'delete-form' . '-' . $contract->id,
                                                          'style' => 'display:inline',
                                                      ]) !!}
                                                      {!! Form::close() !!}
                                                      <!--begin::Menu item-->
                                                      <div class="menu-item px-3">
                                                          <a href="javascript:void(0);"
                                                              onclick="event.preventDefault(); document.getElementById('delete-form-{{ $contract->id }}').submit();"
                                                              class="menu-link px-3 text-dark">
                                                              Delete
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
      
                            </div>
      
                            <div class="tab-pane show fade" id="pills-seller" role="tabpanel" aria-labelledby="pills-seller">
      
                              <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                  <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button bg-secondary fw-bold text-dark fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
                                      Filter Contracts
                                    </button> 
                                  </h2>
                                  <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                          <div class="col-md-3 mb-2">
                                            <select name="type" id="type3" class="form-select">
                                                <option disabled selected>Transaction Type</option>
                                                <option value="">All</option>
                                                <option value="normal">Normal</option>
                                                <option value="barter">Barter</option>
                                                <option value="temp">Temporary</option>
                                            </select>
                                        </div>
                                          <div class="col-md-3 mb-2">
                                            <select name="seller" id="seller3" class="form-select">
                                                  <option disabled selected>Search Seller</option>
                                                  <option value="">All</option>
                                                  @foreach ($businesses as $business)
                                                    <option value="{{ $business->name }}">{{ $business->name }}</option>
                                                  @endforeach
                                              </select>
                                          </div>
                                            <div class="col-md-3 mb-2">
                                                <select name="vessel" id="vessel3" class="form-select">
                                                    <option disabled selected>Search Vessel</option>
                                                    <option value="">All</option>
                                                    @foreach ($vessels as $vessel)
                                                      <option value="{{ $vessel->name }}">{{ $vessel->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <select name="product" id="product3" class="form-select">
                                                    <option disabled selected>Search Product</option>
                                                    <option value="">All</option>
                                                    @foreach ($products as $product)
                                                      <option value="{{ $product->name }}">{{ $product->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <input type="text" name="bl_qty" id="bl_qty3" placeholder="BL Qty" class="form-control">
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <input type="text" name="shortage" id="shortage3" placeholder="Shortage" class="form-control">
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <select name="contract_status" id="contract_status3" class="form-select">
                                                  <option disabled selected>Contract Status</option>
                                                  <option value="">All</option>
                                                  <option value="1">Active</option>
                                                  <option value="0">Deactive</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-2">
                                              <label for="contract_date_to_3" class="form-label">Cont. Date To</label>
                                                <input type="date" name="contract_date_to_3" id="contract_date_to_3" placeholder="Shortage" class="form-control">
                                            </div>
                                            <div class="col-md-4 mb-2">
                                              <label for="contract_date_from_3" class="form-label">Cont. Date From</label>
                                              <input type="date" name="contract_date_from_3" id="contract_date_from_3" class="form-control">
                                          </div>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
      
                              <div class="table-responsive">
                                <!--begin::Table-->
                                  <table class="table align-middle table-row-bordered table-hover fs-6 gy-5" id="kt_datatable_example_3">
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
                                            <th class="min-w-125px">Product</th>
                                            <th class="min-w-125px">Contract Qty.</th>
                                            <th class="min-w-125px">Lifted Qty.</th>
                                            <th class="min-w-125px">Balance Qty.</th>
                                            <th class="min-w-125px">Contracts</th>
                                            <th hidden>BL Qty.</th>
                                            <th hidden>Shortage</th>
                                            <th hidden>Contract Status</th>
                                            <th hidden>Type</th>
                                            <th hidden>Contract Date</th>
                                            <th class="text-end min-w-70px">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                      @foreach ($contracts as $contract)
                                          <tr>
                                            <td hidden>
                                              <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                  <input class="form-check-input" type="checkbox" value="1" />
                                              </div>
                                          </td>
                                          <td>{{ $contract->business->name ?? 'N/A' }}</td>
                                          <td>{{ $contract->inventory->vessel->name ?? 'N/A' }}</td>
                                          <td>{{ $contract->product->name ?? 'N/A' }}</td>
                                          <td>{{ $contract->quantity ?? '0.00' }}</td>
                                          <td>{{ isset($contract->inventory) ? $contract->inventory->lifted_qty() : 'N/A' }}</td>
                                          <td>0.00</td>
                                          <td>0</td>
                                          <td hidden>{{ $contract->inventory->bl_quantity ?? 'N/A' }}</td>
                                          <td hidden>{{ $contract->inventory->vessel_shortage ?? 'N/A' }}</td>
                                          <td hidden>{{ $contract->contract_status }}</td>
                                          <td hidden>{{ $contract->type }}</td>
                                          <td hidden>{{ $contract->date }}</td>
                                            <td class="text-end">
                                              <a href="#"
                                                  class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                  data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                  Actions
                                                  <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                              <!--begin::Menu-->
                                              <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                  data-kt-menu="true">
      
                                                      {!! Form::open([
                                                          'method' => 'DELETE',
                                                          'route' => ['local-contract.destroy', $contract->id],
                                                          'id' => 'delete-form' . '-' . $contract->id,
                                                          'style' => 'display:inline',
                                                      ]) !!}
                                                      {!! Form::close() !!}
                                                      <!--begin::Menu item-->
                                                      <div class="menu-item px-3">
                                                          <a href="javascript:void(0);"
                                                              onclick="event.preventDefault(); document.getElementById('delete-form-{{ $contract->id }}').submit();"
                                                              class="menu-link px-3 text-dark">
                                                              Delete
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
      
                            </div>
      
                            <div class="tab-pane show fade" id="pills-contract" role="tabpanel" aria-labelledby="pills-contract">
                                
                              <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                  <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button bg-secondary fw-bold text-dark fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="true" aria-controls="collapse5">
                                      Filter Contracts
                                    </button> 
                                  </h2>
                                  <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                          <div class="col-md-3 mb-2">
                                            <select name="type" id="type4" class="form-select">
                                                <option disabled selected>Transaction Type</option>
                                                <option value="">All</option>
                                                <option value="normal">Normal</option>
                                                <option value="barter">Barter</option>
                                                <option value="temp">Temporary</option>
                                            </select>
                                        </div>
                                          <div class="col-md-3 mb-2">
                                            <select name="seller" id="seller4" class="form-select">
                                                  <option disabled selected>Search Seller</option>
                                                  <option value="">All</option>
                                                  @foreach ($businesses as $business)
                                                    <option value="{{ $business->name }}">{{ $business->name }}</option>
                                                  @endforeach
                                              </select>
                                          </div>
                                            <div class="col-md-3 mb-2">
                                                <select name="vessel" id="vessel4" class="form-select">
                                                    <option disabled selected>Search Vessel</option>
                                                    <option value="">All</option>
                                                    @foreach ($vessels as $vessel)
                                                      <option value="{{ $vessel->name }}">{{ $vessel->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <select name="product" id="product4" class="form-select">
                                                    <option disabled selected>Search Product</option>
                                                    <option value="">All</option>
                                                    @foreach ($products as $product)
                                                      <option value="{{ $product->code }}">{{ $product->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <input type="text" name="bl_qty" id="bl_qty4" placeholder="BL Qty" class="form-control">
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <input type="text" name="shortage" id="shortage4" placeholder="Shortage" class="form-control">
                                            </div>
                                            <div class="col-md-12 row">
                                              <div class="col-md-3 mb-2">
                                                <label for="contract_date_to_4" class="form-label">Cont. Date To</label>
                                                  <input type="date" name="contract_date_to_4" id="contract_date_to_4" placeholder="Shortage" class="form-control">
                                              </div>
                                              <div class="col-md-3 mb-2">
                                                <label for="contract_date_from_4" class="form-label">Cont. Date From</label>
                                                <input type="date" name="contract_date_from_4" id="contract_date_from_4" class="form-control">
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
      
                              <div class="table-responsive">
                                <!--begin::Table-->
                                  <table class="table align-middle table-row-bordered table-hover fs-6 gy-5" id="kt_datatable_example_4">
                                    <thead>
                                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                            <th class="w-10px pe-2" hidden>
                                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                    <input class="form-check-input" type="checkbox" data-kt-check="true"
                                                        data-kt-check-target="#kt_customers_table .form-check-input"
                                                        value="1" />
                                                </div>
                                            </th>
                                            <th class="min-w-125px">Transaction Type</th>
                                            <th class="min-w-125px">Contract#</th>
                                            <th class="min-w-125px">Contract Date</th>
                                            <th class="min-w-125px">Product</th>
                                            <th class="min-w-125px">Buyer</th>
                                            <th class="min-w-125px">Selling Price</th>
                                            <th class="min-w-125px">Contract Qty.</th>
                                            <th class="min-w-125px">Bal Qty.</th>
                                            <th hidden>Seller</th>
                                            <th hidden>Vessel</th>
                                            <th hidden>BL Qty.</th>
                                            <th hidden>Shortage</th>
                                            <th class="text-end min-w-70px">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                      @foreach ($contracts as $contract)
                                          <tr>
                                            <td hidden>
                                              <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                  <input class="form-check-input" type="checkbox" value="1" />
                                              </div>
                                          </td>
                                            <td>{{ $contract->type ?? 'N/A' }}</td>
                                            <td>{{ $contract->code ?? 'N/A' }}</td>
                                            <td>{{ $contract->date ?? 'N/A' }}</td>
                                            <td>{{ $contract->product->code ?? 'N/A' }}</td>
                                            <td>{{ $contract->buyer->name ?? 'N/A' }}</td>
                                            <td>{{ $contract->selling_price ?? '0.00' }}</td>
                                            <td>{{ $contract->quantity ?? '0.00' }}</td>
                                            <td>0.00</td>
                                            <td hidden>{{ $contract->business->name ?? 'N/A' }}</td>
                                            <td hidden>{{ $contract->inventory->vessel->name ?? 'N/A' }}</td>
                                            <td hidden>{{ $contract->inventory->bl_quantity ?? 'N/A' }}</td>
                                            <td hidden>{{ $contract->inventory->vessel_shortage ?? 'N/A' }}</td>
                                            <td class="text-end">
                                              <a href="#"
                                                  class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                  data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                  Actions
                                                  <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                              <!--begin::Menu-->
                                              <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                  data-kt-menu="true">
      
                                                      {!! Form::open([
                                                          'method' => 'DELETE',
                                                          'route' => ['local-contract.destroy', $contract->id],
                                                          'id' => 'delete-form' . '-' . $contract->id,
                                                          'style' => 'display:inline',
                                                      ]) !!}
                                                      {!! Form::close() !!}
                                                      <!--begin::Menu item-->
                                                      <div class="menu-item px-3">
                                                          <a href="javascript:void(0);"
                                                              onclick="event.preventDefault(); document.getElementById('delete-form-{{ $contract->id }}').submit();"
                                                              class="menu-link px-3 text-dark">
                                                              Delete
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
      
                            </div>
                            
                      </div>


                    </div>

                  </div>
                  <!--end::Card body-->
              </div>
              <!--end::Card-->
  </div>
  <!--end::Table widget 14-->

<!-- Modal -->
<div class="modal fade" id="WhatsappMessage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Whatsapp Message</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <p id="full-contract-msg">
         <span id="new-contract-date">05-FEB-2024</span> <br>
         <span id="new-contract-number">AS-24/FEB/PO/024</span> <br> 
         <span id="new-contract-product">RBD Palm Oil 150 MT @ 12,150</span> <br> 
         <span id="new-contract-payment"> Payment 8 days after lifting.</span> <br>
         <span id="new-contract-buyer"> Buyer : Mushtaq Bhai</span>  <br>
         <span id="new-contract-lifting">Lifting 15-Feb To 29-Feb </span> <br>
         <span id="new-contract-business"> Seller option. AGROSTAR </span> 
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- Export Modal -->
<div class="modal fade" id="ExportModal" tabindex="-1" aria-labelledby="ExportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ExportModalLabel">Export Contract</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-vessel-tab" data-bs-toggle="pill" data-bs-target="#vessel-tab" type="button" role="tab" aria-controls="vessel-tab" aria-selected="true">Vessel</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-buyer-tab" data-bs-toggle="pill" data-bs-target="#buyer-tab" type="button" role="tab" aria-controls="buyer-tab" aria-selected="false">Buyer</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-seller-tab" data-bs-toggle="pill" data-bs-target="#seller-tab" type="button" role="tab" aria-controls="seller-tab" aria-selected="false">Seller</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-contracts-tab" data-bs-toggle="pill" data-bs-target="#contracts-tab" type="button" role="tab" aria-controls="contracts-tab" aria-selected="false">Contracts</button>
          </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade show active" id="vessel-tab" role="tabpanel" aria-labelledby="pills-vessel-tab">
            <form action="{{ route('local-contract.export') }}" method="post">
              @csrf
              @method('POST')
              <input type="hidden" name="type" value="vessel">
              <div class="btn-group border" role="group" aria-label="Basic checkbox toggle button group">
                {{-- Export Button Start --}}
                <button type="button" class="btn btn-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                    <i class="ki-duotone ki-exit-down fs-2"><span class="path1"></span><span class="path2"></span></i>
                    Export
                </button>
                <div id="kt_datatable_example_export_menu" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4" data-kt-menu="true">
                    <div class="menu-item px-3">
                        <a href="javascript:void(0);" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#AddPort">
                        View on Screen
                        </a>
                    </div>
                    <div class="menu-item px-3">
                        <a href="#" class="menu-link px-3" data-kt-export="excel">
                        Export as Excel
                        </a>
                    </div>
                    <div class="menu-item px-3">
                        <a href="#" class="menu-link px-3" data-kt-export="csv">
                        Export as CSV
                        </a>
                    </div>
                    <div class="menu-item px-3">
                        <a href="#" class="menu-link px-3" data-kt-export="pdf">
                        Export as PDF
                        </a>
                    </div>                    
                </div>

                <div id="kt_datatable_example_buttons" class="d-none"></div>
              {{-- Export Button End --}}
              
              </div>
              
            </form>
          </div>

          <div class="tab-pane fade" id="buyer-tab" role="tabpanel" aria-labelledby="pills-buyer-tab">
            <form action="{{ route('local-contract.export') }}" method="post">
              @csrf
              @method('POST')
              
            {{-- Export Button Start --}}
            <button type="button" class="btn btn-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
              <i class="ki-duotone ki-exit-down fs-2"><span class="path1"></span><span class="path2"></span></i>
              Export
          </button>
          <div id="kt_datatable_example_2_export_menu" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4" data-kt-menu="true">
              <div class="menu-item px-3">
                  <a href="javascript:void(0);" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#AddPort">
                  View on Screen
                  </a>
              </div>
              <div class="menu-item px-3">
                  <a href="#" class="menu-link px-3" data-kt-export="excel">
                  Export as Excel
                  </a>
              </div>
              <div class="menu-item px-3">
                  <a href="#" class="menu-link px-3" data-kt-export="csv">
                  Export as CSV
                  </a>
              </div>
              <div class="menu-item px-3">
                  <a href="#" class="menu-link px-3" data-kt-export="pdf">
                  Export as PDF
                  </a>
              </div>                    
          </div>

          <div id="kt_datatable_example_2_buttons" class="d-none"></div>
          {{-- Export Button End --}}
          {{-- Export Button End --}}

            </form>
          </div>

          <div class="tab-pane fade" id="seller-tab" role="tabpanel" aria-labelledby="pills-seller-tab">
            <form action="{{ route('local-contract.export') }}" method="post">
              @csrf
              @method('POST')
              <input type="hidden" name="type" value="seller">
              <div class="btn-group border" role="group" aria-label="Basic checkbox toggle button group">
                <input type="checkbox" class="btn-check" name="column[]" value="seller_name" id="btncheck16" autocomplete="off">
                <label class="btn btn-outline-primary border" for="btncheck16">Seller</label>
              
                <input type="checkbox" class="btn-check" name="column[]" value="vessel_name" id="btncheck17" autocomplete="off">
                <label class="btn btn-outline-primary border" for="btncheck17">Vessel</label>
              
                <input type="checkbox" class="btn-check" name="column[]" value="product" id="btncheck18" autocomplete="off">
                <label class="btn btn-outline-primary border" for="btncheck18">Product</label>

                <input type="checkbox" class="btn-check" name="column[]" value="contract_qty" id="btncheck19" autocomplete="off">
                <label class="btn btn-outline-primary border" for="btncheck19">Contract Qty</label>

                <input type="checkbox" class="btn-check" name="column[]" value="lifted_quantity" id="btncheck20" autocomplete="off">
                <label class="btn btn-outline-primary border" for="btncheck20">Lifted Qty.</label>

                <input type="checkbox" class="btn-check" name="column[]" value="balance_quantity" id="btncheck21" autocomplete="off">
                <label class="btn btn-outline-primary border" for="btncheck21">Balance Qty.</label>

                <input type="checkbox" class="btn-check" name="column[]" value="contracts" id="btncheck22" autocomplete="off">
                <label class="btn btn-outline-primary border" for="btncheck22">Contracts</label>
              </div>
              <br>
              <div class="text-center">
                <button class="btn btn-secondary mt-3" type="submit">Submit</button>
              </div>
            </form>
          </div>

          <div class="tab-pane fade" id="contracts-tab" role="tabpanel" aria-labelledby="pills-contracts-tab">
            <form action="{{ route('local-contract.export') }}" method="post">
              @csrf
              @method('POST')
              <input type="hidden" name="type" value="contracts">
              <div class="btn-group border" role="group" aria-label="Basic checkbox toggle button group">
                <input type="checkbox" class="btn-check" name="column[]" value="trans_type" id="btncheck23" autocomplete="off">
                <label class="btn btn-outline-primary border" for="btncheck23">Trans. Type</label>
              
                <input type="checkbox" class="btn-check" name="column[]" value="contract_number" id="btncheck24" autocomplete="off">
                <label class="btn btn-outline-primary border" for="btncheck24">Contract#</label>
              
                <input type="checkbox" class="btn-check" name="column[]" value="contract_date" id="btncheck25" autocomplete="off">
                <label class="btn btn-outline-primary border" for="btncheck25">Contract Date</label>

                <input type="checkbox" class="btn-check" name="column[]" value="product" id="btncheck26" autocomplete="off">
                <label class="btn btn-outline-primary border" for="btncheck26">Product</label>

                <input type="checkbox" class="btn-check" name="column[]" value="buyer" id="btncheck27" autocomplete="off">
                <label class="btn btn-outline-primary border" for="btncheck27">Buyer</label>

                <input type="checkbox" class="btn-check" name="column[]" value="selling_price" id="btncheck28" autocomplete="off">
                <label class="btn btn-outline-primary border" for="btncheck28">Selling Price</label>

                <input type="checkbox" class="btn-check" name="column[]" value="contracts_quantity" id="btncheck29" autocomplete="off">
                <label class="btn btn-outline-primary border" for="btncheck29">Contracts</label>

                <input type="checkbox" class="btn-check" name="column[]" value="balance_quantity" id="btncheck30" autocomplete="off">
                <label class="btn btn-outline-primary border" for="btncheck30">Balance Quantity</label>
              </div>
              <br>
              <div class="text-center">
                <button class="btn btn-secondary mt-3" type="submit">Submit</button>
              </div>
            </form>
          </div>

      </div>
    </div>
  </div>
</div>


  @push('scripts')
  
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script>
          $(document).ready(function() {
              console.clear = () => {}
              var table = $('#kt_datatable_example').DataTable();

              $('#vessel').on('change', function() {
                  table.column(1).search(this.value).draw();
              });
              
              $('#seller').on('change', function() {
                  table.column(3).search(this.value).draw();
              });

              $('#product').on('change', function() {
                  table.column(4).search(this.value).draw();
              });

              $('#bl_qty').on('keyup', function() {
                  table.column(5).search(this.value).draw();
              });

              $('#shortage').on('keyup', function() {
                  table.column(6).search(this.value).draw();
              });

              $('#contract_status').on('change', function() {
                  table.column(11).search(this.value).draw();
              });

              $('#buyer').on('change', function() {
                  table.column(12).search(this.value).draw();
              });

              $('#type').on('change', function() {
                  table.column(13).search(this.value).draw();
              });

              $('#contract_date_to, #contract_date_from').on('change', function() {
                  table.draw();
              });

              $.fn.dataTable.ext.search.push(
                  function(settings, data, dataIndex) {
                      var minDate = $('#contract_date_to').val();
                      var maxDate = $('#contract_date_from').val();
                      var date = data[14];

                      if ((minDate === '' && maxDate === '') ||
                          (minDate <= date && maxDate === '') ||
                          (minDate === '' && maxDate >= date) ||
                          (minDate <= date && maxDate >= date)) {
                          return true;
                      }
                      return false;
                  }
              );

              // Table 2
              var table2 = $('#kt_datatable_example_2').DataTable();

              $('#buyer2').on('change', function() {
                  table2.column(1).search(this.value).draw();
              });

              $('#vessel2').on('change', function() {
                  table2.column(2).search(this.value).draw();
              });

              $('#product2').on('change', function() {
                  table2.column(3).search(this.value).draw();
              });
              
              $('#seller2').on('change', function() {
                  table2.column(8).search(this.value).draw();
              });

              $('#bl_qty2').on('keyup', function() {
                  table2.column(9).search(this.value).draw();
              });

              $('#shortage2').on('keyup', function() {
                  table2.column(10).search(this.value).draw();
              });

              $('#contract_status2').on('change', function() {
                  table2.column(11).search(this.value).draw();
              });

              $('#type2').on('change', function() {
                  table2.column(12).search(this.value).draw();
              });

              $('#contract_date_to_2, #contract_date_from_2').on('change', function() {
                  table2.draw();
              });

              $.fn.dataTable.ext.search.push(
                  function(settings, data, dataIndex) {
                      var minDate = $('#contract_date_to_2').val();
                      var maxDate = $('#contract_date_from_2').val();
                      var date = data[13];

                      if ((minDate === '' && maxDate === '') ||
                          (minDate <= date && maxDate === '') ||
                          (minDate === '' && maxDate >= date) ||
                          (minDate <= date && maxDate >= date)) {
                          return true;
                      }
                      return false;
                  }
              );

              // Table 3
              var table3 = $('#kt_datatable_example_3').DataTable();

              $('#seller3').on('change', function() {
                  table3.column(1).search(this.value).draw();
              });

              $('#vessel3').on('change', function() {
                  table3.column(2).search(this.value).draw();
              });

              $('#product3').on('change', function() {
                  table3.column(3).search(this.value).draw();
              });

              $('#bl_qty3').on('keyup', function() {
                  table3.column(8).search(this.value).draw();
              });

              $('#shortage3').on('keyup', function() {
                  table3.column(9).search(this.value).draw();
              });

              $('#contract_status3').on('change', function() {
                  table3.column(10).search(this.value).draw();
              });

              $('#type3').on('change', function() {
                  table3.column(11).search(this.value).draw();
              });

              $('#contract_date_to_3, #contract_date_from_3').on('change', function() {
                  table3.draw();
              });

              $.fn.dataTable.ext.search.push(
                  function(settings, data, dataIndex) {
                      var minDate = $('#contract_date_to_3').val();
                      var maxDate = $('#contract_date_from_3').val();
                      var date = data[12];

                      if ((minDate === '' && maxDate === '') ||
                          (minDate <= date && maxDate === '') ||
                          (minDate === '' && maxDate >= date) ||
                          (minDate <= date && maxDate >= date)) {
                          return true;
                      }
                      return false;
                  }
              );

              var table4 = $('#kt_datatable_example_4').DataTable();

              $('#type4').on('change', function() {
                  table4.column(1).search(this.value).draw();
              });

              $('#product4').on('change', function() {
                  table4.column(4).search(this.value).draw();
              });

              $('#seller4').on('change', function() {
                  table4.column(9).search(this.value).draw();
              });

              $('#vessel4').on('change', function() {
                  table4.column(10).search(this.value).draw();
              });

              $('#bl_qty4').on('keyup', function() {
                  table4.column(11).search(this.value).draw();
              });

              $('#shortage4').on('keyup', function() {
                  table4.column(12).search(this.value).draw();
              });

              $('#contract_date_to_4, #contract_date_from_4').on('change', function() {
                  table4.draw();
              });

              $.fn.dataTable.ext.search.push(
                  function(settings, data, dataIndex) {
                      var minDate = $('#contract_date_to_4').val();
                      var maxDate = $('#contract_date_from_4').val();
                      var date = data[3];

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
        $(document).on("click",".tabs-link", function () {
            $('.tabs-link').removeClass('active');
            $(this).addClass('active');

            var id = $(this).attr('id');
            
            $('.tab-pane').removeClass('active');
            $('div#'+id).addClass('active');

        });
      </script>

      @if (Session::has('contract-success'))
      <script>
        $(document).ready(function () {
          $.ajax({
            type: "GET",
            url: "{{ route('get.contract',Session::get('contract-success')) }}",
            success: function (data) {
              $('#new-contract-date').text(data.date);
              $('#new-contract-number').text(data.code);
              $('#new-contract-product').text(data.product + ' ' + data.quantity + ' ' + data.selling_price);
              $('#new-contract-payment').text(data.payment_terms);
              $('#new-contract-buyer').text('Buyer : ' + data.buyer);
              $('#new-contract-lifting').text('Lifting : ' + data.lifting_date);
              $('#new-contract-business').text('Seller Option : ' +  data.bussiness);
            }
          });
          $('#WhatsappMessage').modal('toggle');

          var message = $('#full-contract-msg').html();
          var contract_id = "{{ Session::get('contract-success') }}";
          $.ajax({
            type: "POST",
            url: "{{ route('save.message') }}",
            data: {
              _token: "{{ csrf_token() }}",
              contract_id: contract_id,
              message: message
            },
            success: function (response) {
            }
          });

        });
      </script>
      @endif

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
      datatable = $(table).DataTable();
  }

  // Hook export buttons
  var exportButtons = () => {
      const documentTitle = 'Contract Buyer';
      var buttons = new $.fn.dataTable.Buttons(table, {
          buttons: [
              {
                  extend: 'copyHtml5',
                  exportOptions: {
                  columns: [1,2,3,4,5,6,7]
              },
                  title: documentTitle
              },
              {
                  extend: 'excelHtml5',
                  exportOptions: {
                  columns: [1,2,3,4,5,6,7]
              },
                  title: documentTitle
              },
              {
                  extend: 'csvHtml5',
                  exportOptions: {
                  columns: [1,2,3,4,5,6,7]
              },
                  title: documentTitle
              },
              {
                  extend: 'pdfHtml5',
                                      exportOptions: {
                  columns: [1,2,3,4,5,6,7]
              },
                  title: documentTitle
              }
          ]
      }).container().appendTo($('#kt_datatable_example_2_buttons'));

      // Hook dropdown menu click event to datatable export buttons
      const exportButtons = document.querySelectorAll('#kt_datatable_example_2_export_menu [data-kt-export]');
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
          table = document.querySelector('#kt_datatable_example_2');

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
 datatable = $(table).DataTable();
}

// Hook export buttons
var exportButtons2 = () => {
 const documentTitle = 'Contract Vessel';
 var buttons = new $.fn.dataTable.Buttons(table, {
     buttons: [
         {
             extend: 'copyHtml5',
             exportOptions: {
             columns: [1,2,3,4,7,8,9,10]
         },
             title: documentTitle
         },
         {
             extend: 'excelHtml5',
             exportOptions: {
             columns: [1,2,3,4,7,8,9,10]
         },
             title: documentTitle
         },
         {
             extend: 'csvHtml5',
             exportOptions: {
             columns: [1,2,3,4,7,8,9,10]
         },
             title: documentTitle
         },
         {
             extend: 'pdfHtml5',
                                 exportOptions: {
             columns: [1,2,3,4,7,8,9,10]
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
     exportButtons2();
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