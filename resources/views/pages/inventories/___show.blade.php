<x-default-layout>
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="">

            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    View Inventory
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
                        View Inventory </li>
                    <!--end::Item-->

                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->

        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->

  <!--begin::Table widget 14-->
  <div class="card card-flush h-md-100">
      <!--begin::Body-->
      <div class="card-body pt-6">
              <div class="row">

                  <div class="col-md-12">
                      <div class="row">
                          <div class="col-md-3">
                              <p class="fw-bold fs-4 mb-0">Inventory Type :</p>
                              <p class="fs-5">{{ $inventory->type }}</p>
                          </div>

                          <div class="col-md-3">
                            <p class="fw-bold fs-4 mb-0">Transaction Type :</p>
                            <p class="fs-5">{{ $inventory->transaction_type }}</p>
                          </div>

                          <div class="col-md-3">
                            <p class="fw-bold fs-4 mb-0">Seller :</p>
                            <p class="fs-5">{{ $inventory->seller->name ?? 'N/A' }}</p>
                          </div>

                          <div class="col-md-3">
                            <p class="fw-bold fs-4 mb-0">Buyer :</p>
                            <p class="fs-5">{{ $inventory->buyer->name ?? 'N/A' }}</p>
                          </div>

                          <div class="col-md-3">
                            <p class="fw-bold fs-4 mb-0">Vessel :</p>
                            <p class="fs-5">{{ $inventory->vessel->name ?? 'N/A' }}</p>
                          </div>

                          @if ($inventory->type == 'Import')
                          <div class="col-md-3">
                            <p class="fw-bold fs-4 mb-0">Voyage Number :</p>
                            <p class="fs-5">{{ $inventory->voyage_number ?? 'N/A' }}</p>
                          </div>

                          <div class="col-md-3">
                            <p class="fw-bold fs-4 mb-0">IGM Date :</p>
                            <p class="fs-5">{{ $inventory->igm_date ?? 'N/A' }}</p>
                          </div>

                          <div class="col-md-3">
                            <p class="fw-bold fs-4 mb-0">Arrival Date :</p>
                            <p class="fs-5">{{ $inventory->arrival_date ?? 'N/A' }}</p>
                          </div>
                          @endif

                          <div class="col-md-3">
                            <p class="fw-bold fs-4 mb-0">Clearing Agent :</p>
                            <p class="fs-5">{{ $inventory->clearing_agent->name ?? 'N/A' }}</p>
                          </div>

                          <div class="col-md-3">
                            <p class="fw-bold fs-4 mb-0">Surveyor :</p>
                            <p class="fs-5">{{ $inventory->surveyor->name ?? 'N/A' }}</p>
                          </div>

                          <div class="col-md-3">
                            <p class="fw-bold fs-4 mb-0">Active for Contract ? :</p>
                            <p class="fs-5">{{ $inventory->active_contract == 1 ? 'Yes' : 'No'  }}</p>
                          </div>

                          <div class="col-md-3">
                            <p class="fw-bold fs-4 mb-0">Contract Date :</p>
                            <p class="fs-5">{{ $inventory->contract_date ?? 'N/A' }}</p>
                          </div>

                          <div class="col-md-3">
                            <p class="fw-bold fs-4 mb-0">Remarks :</p>
                            <p class="fs-5">{{ $inventory->remarks ?? 'N/A' }}</p>
                          </div>
                          <div class="col-md-6 my-3">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#Attachments">{{ $documents_count }} Files Attached</button>
                          </div>

                      </div>
                  </div>

              {{-- Start Attachment Modal --}}
              <div class="modal fade modal-lg" id="Attachments" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                      <div class="modal-header bg-primary pt-5 pb-5">
                        <h5 class="modal-title text-white fs-2" id="exampleModalLabel">Attachments</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                
                          <div class="row justify-content-center align-items-center">

                            <div class="row">
                    
                              <div class="col-md-4">
                                  <!--begin::Card-->
                                  <div class="card h-100 ">
                                      <!--begin::Card body-->
                                      @if ($doc_summary)
                                      <a href="{{ route('document.delete',$doc_summary->id) }}"><button class="btn btn-sm btn-light-danger mx-5 mt-3 mt-md-8">Delete</button></a>
                                      @endif
                                      <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                          <!--begin::Name-->
                                          @if ($doc_summary)
                                          <a href="{{ asset('documents/'.$doc_summary->type.'/'.$doc_summary->document) }}" target="_blank" class="text-gray-800 text-hover-primary d-flex flex-column">
                                              <!--begin::Image-->
                                              <div class="symbol symbol-60px mb-5">
                                                  <img src="{{ asset('assets/media/icons/file-icon.png') }}" class="theme-light-show" alt=""/>
                                                      <img src="{{ asset('assets/media/icons/file-icon.png') }}" class="theme-dark-show" alt=""/>                          
                                              </div>
                                              <!--end::Image-->
          
                                              <!--begin::Title-->
                                              <div class="fs-5 fw-bold mb-2">{{ Str::limit($doc_summary->document,20) }}</div>
                                              <!--end::Title-->
                                          </a>
                                          @endif
                                          <!--end::Name-->
          
                                          <!--begin::Description-->
                                          <div class="fs-7 fw-semibold text-dark-400">Summary</div>
                                          @if(!$doc_summary)
                                          <form action="{{ route('add.inventory.document') }}" method="post" enctype="multipart/form-data">
                                          @csrf
                                          <input type="file" name="file" class="form-control" required>
                                          <input type="hidden" name="file_type" value="summary">
                                          <input type="hidden" name="inventory_id" value="{{ $inventory->id }}">
                                          <button type="submit" class="btn btn-primary btn-sm mt-3">Add</button>
                                      </form>
                                          @endif
                                          <!--end::Description-->
                                      </div>
                                      <!--end::Card body-->
                                  </div>
                                  <!--end::Card-->
                              </div>
                              <!--end::Col-->
                              
                              <div class="col-md-4">
                                  <!--begin::Card-->
                                  <div class="card h-100 ">
                                      <!--begin::Card body-->
                                      @if ($doc_pro_data)
                                      <a href="{{ route('document.delete',$doc_pro_data->id) }}"><button class="btn btn-sm btn-light-danger mx-5 mt-3 mt-md-8">Delete</button></a>
                                      @endif
                                      <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                          <!--begin::Name-->
                                          @if ($doc_pro_data)
                                          <a href="{{ asset('documents/'.$doc_pro_data->type.'/'.$doc_pro_data->document) }}" target="_blank" class="text-gray-800 text-hover-primary d-flex flex-column">
                                              <!--begin::Image-->
                                              <div class="symbol symbol-60px mb-5">
                                                  <img src="{{ asset('assets/media/icons/file-icon.png') }}" class="theme-light-show" alt=""/>
                                                      <img src="{{ asset('assets/media/icons/file-icon.png') }}" class="theme-dark-show" alt=""/>                          
                                              </div>
                                              <!--end::Image-->
          
                                              <!--begin::Title-->
                                              <div class="fs-5 fw-bold mb-2">{{ Str::limit($doc_pro_data->document,20) }}</div>
                                              <!--end::Title-->
                                          </a>
                                          @endif
                                          <!--end::Name-->
          
                                          <!--begin::Description-->
                                          <div class="fs-7 fw-semibold text-dark-400">Pro Data</div>
                                          @if(!$doc_pro_data)
                                          <form action="{{ route('add.inventory.document') }}" method="post" enctype="multipart/form-data">
                                              @csrf
                                              <input type="file" name="file" class="form-control" required>
                                              <input type="hidden" name="file_type" value="pro_data">
                                              <input type="hidden" name="inventory_id" value="{{ $inventory->id }}">
                                              <button type="submit" class="btn btn-primary btn-sm w-100 mt-3">Add</button>
                                          </form>
                                          @endif
                                          <!--end::Description-->
                                      </div>
                                      <!--end::Card body-->
                                  </div>
                                  <!--end::Card-->
                              </div>
                              <!--end::Col-->
          
          
                              <div class="col-md-4">
                                  <!--begin::Card-->
                                  <div class="card h-100 ">
                                      <!--begin::Card body-->
                                      @if ($doc_survey_report)
                                      <a href="{{ route('document.delete',$doc_survey_report->id) }}"><button class="btn btn-sm btn-light-danger mx-5 mt-3 mt-md-8">Delete</button></a>
                                      @endif
                                      <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                          <!--begin::Name-->
                                          @if ($doc_survey_report)
                                          <a href="{{ asset('documents/'.$doc_survey_report->type.'/'.$doc_survey_report->document) }}" target="_blank" class="text-gray-800 text-hover-primary d-flex flex-column">
                                              <!--begin::Image-->
                                              <div class="symbol symbol-60px mb-5">
                                                  <img src="{{ asset('assets/media/icons/file-icon.png') }}" class="theme-light-show" alt=""/>
                                                      <img src="{{ asset('assets/media/icons/file-icon.png') }}" class="theme-dark-show" alt=""/>                          
                                              </div>
                                              <!--end::Image-->
          
                                              <!--begin::Title-->
                                              <div class="fs-5 fw-bold mb-2">{{ Str::limit($doc_survey_report->document,20) }}</div>
                                              <!--end::Title-->
                                          </a>
                                          @endif
                                          <!--end::Name-->
          
                                          <!--begin::Description-->
                                          <div class="fs-7 fw-semibold text-dark-400">Survey Report</div>
                                          @if(!$doc_survey_report)
                                          <form action="{{ route('add.inventory.document') }}" method="post" enctype="multipart/form-data">
                                              @csrf
                                              <input type="file" name="file" class="form-control" required>
                                              <input type="hidden" name="file_type" value="survey_report">
                                              <input type="hidden" name="inventory_id" value="{{ $inventory->id }}">
                                              <button type="submit" class="btn btn-primary btn-sm w-100 mt-3">Add</button>
                                          </form>
                                          @endif
                                          <!--end::Description-->
                                      </div>
                                      <!--end::Card body-->
                                  </div>
                                  <!--end::Card-->
                              </div>
                              <!--end::Col-->
                          </div>
                
                          </div>
                
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="add-close-btn" data-bs-dismiss="modal">Close</button>
                      </div>
                    
                    </div>
                  </div>
                </div>
              {{-- End Attachmemt Modal --}}
              </div>

            </div>
            <!--end: Card Body-->
        </div>
        <!--end::Table widget 14-->


        {{-- Show All BLS --}}
        <!--begin::Table widget 14-->
        <div class="card card-flush mt-5 h-md-100">
            <!--begin::Header-->
            <div class="card-header pt-7">
                <!--begin::Title-->
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-gray-800">Show All BLs</span>
                </h3>
                <!--end::Title-->
            </div>
        <!--end::Header-->
        <!--begin::Body-->
            <div class="card-body pt-6">
                @foreach ($bls as $key => $values)
                    @php
                        $product = \App\Models\Product::find($key);
                    @endphp
                    
                    
                        <div class="accordion mb-2" id="accordionExample-{{ $key }}">
                            <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button bg-light fw-bold text-dark fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $key }}" aria-expanded="true" aria-controls="collapse-{{ $key }}">
                                {{ $product->name }}
                                </button> 
                            </h2>
                            <div id="collapse-{{ $key }}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample-{{ $key }}">
                                <div class="accordion-body">
                                
                                    <table class="table align-middle table-row-bordered table-hover">
                                        <thead class="bg-secondary fw-bold">
                                            <tr>
                                                <th></th>
                                                <th>BL Number</th>
                                                <th>Product</th>
                                                <th>Terminal</th>
                                                <th>Bl. Qty</th>
                                                <th>Landed. Qty</th>
                                                <th>Shortage</th>
                                                <th>Lifted. Qty</th>
                                                <th>Balance. Qty</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($values as $bl)
                                            <tr>
                                                <td></td>
                                                <td>{{ $bl->bl_number }}</td>
                                                <td>{{ $bl->product->name }}</td>
                                                <td>{{ $bl->terminal->name }}</td>
                                                <td>{{ $bl->bl_quantity }}</td>
                                                <td>{{ number_format($bl->landed_quantity,2) }}</td>
                                                <td>{{ $bl->shortage_status() }}</td>
                                                <td>{{ $bl->lifted_qty() }}</td>
                                                <td>{{ $bl->qty_status() }}</td>
                                                <td>
                                                 <a href="#"
                                                    class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                    Actions
                                                <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                                <!--begin::Menu-->
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                        data-kt-menu="true">
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="javascript:void(0);"
                                                                class="menu-link px-3">
                                                                Edit
                                                            </a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="javascript:void(0);"
                                                                class="menu-link px-3">
                                                                Delete
                                                            </a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            </div>
                        </div>
                   

                @endforeach

            </div>
        <!--End::Body-->
        </div>
        <!--End::Table widget 14-->
        {{-- End Show BLS --}}

        <!--begin::Table widget 14-->
        <div class="card card-flush mt-5 h-md-100">
            <!--begin::Header-->
            <div class="card-header pt-7">
                <!--begin::Title-->
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-gray-800">Add New BLs</span>
                </h3>
                <!--end::Title-->
            </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body pt-6">
            <form class="pt-1" method="POST" action="{{ route('inventory.bls.add',$inventory->id) }}" enctype="multipart/form-data">
                @csrf
                @method('POST')
              <div class="row justify-content-center">
                <div class="col-md-4">
                  <label class="form-label">Product <span class="text-danger">*</span></label>
                  <select name="product_id" class="form-select" required>
                    <option disabled selected>-- Select --</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Terminal <span class="text-danger">*</span></label>
                  <select name="terminal_id" id="terminal_id" class="form-select" required>
                    <option disabled selected>-- Select --</option>
                    @foreach ($terminals as $terminal)
                        <option value="{{ $terminal->id }}">{{ $terminal->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <!--begin::Repeater-->
              <div id="kt_docs_repeater_basic">
                  <!--begin::Form group-->
                  <div class="form-group">
                      <div class="my-5" data-repeater-list="inventory_bls">
                          <div class="border-1 rounded-3 my-5 border-secondary border p-3" data-repeater-item>
                              <div class="form-group row gy-3	">
                                  
                                  <div class="col-md-12 text-end delete">
                                      <a href="javascript:;" data-repeater-delete
                                          class="btn btn-sm btn-light-danger">
                                          <i class="fa fa-cancel fs-5"></i>
                                          Remove
                                      </a>
                                  </div>

                                  <div class="col-md-3 date">
                                      <label class="form-label">Date <span class="text-danger">*</span></label>
                                      <input type="date" name="date" required
                                              class="form-control mb-2 mb-md-0" />
                                  </div>
                                  <div class="col-md-3 bl-number">
                                      <label class="form-label">BL Number: <span class="text-danger">*</span></label>
                                      <input type="text" name="bl_number" required class="form-control mb-2 mb-md-0"
                                          placeholder="BL Number" />
                                  </div>
                                  <div class="col-md-3 index-number">
                                      <label for="index_number" class="form-label">Index Number</label>
                                      <input type="text" class="form-control form-control-lg border-dark"
                                          placeholder="Index Number" name="index_number" required />
                                  </div>
                                  <div class="col-md-3 status">
                                      <br>
                                      <div class="form-check form-check-solid form-check-custom form-switch mt-4">
                                          <input class="form-check-input w-45px h-30px" name="status" type="checkbox"
                                              value="1" id="googleswitch">
                                          <label class="form-check-label" for="googleswitch">Status</label>
                                      </div>
                                  </div>
                                  <div class="col-md-3 bl-qty">
                                      <label class="form-label">BL Quantity: <span class="text-danger">*</span></label>
                                      <input type="number" required name="bl_quantity" class="input_bl_quantity form-control mb-2 mb-md-0"
                                          placeholder="Enter BL Quantity" step=".0001" />
                                  </div>
                                  <div class="col-md-3 landed-qty">
                                      <label class="form-label">Landed Quantity <span class="text-danger">*</span></label>
                                      <input type="number" required name="landed_quantity"
                                          class="form-control mb-2 mb-md-0 input_landed_quantity" placeholder="Enter Landed Quantity"
                                          step=".0001" />
                                  </div>
                                  <div class="col-md-3 terminal-qty">
                                    <label class="form-label">Terminal Quantity <span class="text-danger">*</span></label>
                                    <input type="number" required name="terminal_quantity"
                                        class="form-control mb-2 mb-md-0 input_terminal_quantity" placeholder="Enter Terminal Quantity"
                                        step=".0001" />
                                  </div>

                                  <div class="col-md-3 commingle-terminal-col" style="display: none;">
                                    <label class="form-label">Commingle Terminal</label>
                                    <select name="commingle_terminal" id="commingle_terminal" class="form-select">
                                        <option selected disabled value="">-- Select --</option>
                                        @foreach ($terminals as $terminal)
                                            <option value="{{ $terminal->id }}">{{ $terminal->name }}</option>
                                        @endforeach
                                    </select>
                                  </div>

                                  <div class="col-md-3 shortage">
                                      <label class="form-label">Shortage</label>
                                      <input type="number"
                                          class="form-control mb-2 mb-md-0 shortage-input" disabled placeholder="0.00"
                                          step=".0001" />
                                  </div>

                                  <div class="col-md-3 shortage-percentage">
                                      <label class="form-label">Shortage Percentage</label>
                                      <input type="number"
                                          class="form-control mb-2 mb-md-0 shortage-input-percentage" disabled placeholder="0.00 %"
                                          step=".0001" />
                                  </div>

                                  <div class="col-md-3 provisional-price">
                                      <div class="row">
                                          <div class="col-md-12">
                                              <label class="form-label">Provisional Price: <span class="text-danger">*</span></label>
                                              <input type="number" required name="provisional_price" class="provisional_price form-control mb-2 mb-md-0"
                                                      placeholder="Enter Provisional Price" required />
                                          </div>
                                      </div>
                                  </div>
                                  
                                  <div class="col-md-12">
                                    {{-- <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#BL-Attachments">BL Attachments</button> --}}
                                    <button type="button" class="btn btn-sm btn-primary bl-attachment">BL Attachments</button>
                                  </div>

                                {{-- Start Attachment Modal --}}
                                  <div class="modal fade modal-lg" id="BL-Attachments" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                      <div class="modal-content">
                                        <div class="modal-header bg-primary pt-5 pb-5">
                                          <h5 class="modal-title text-white fs-2" id="exampleModalLabel">BL Attachments</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                  
                                          <div class="row justify-content-center align-items-center">

                                              <div class="col-md-4">
                                                <label class="form-label">Commercial Invoice</label>
                                                <input type="file" name="commercial_invoice"
                                                    class="form-control mb-2 mb-md-0 doc-com bls-doc" placeholder="Enter BL Document"
                                                     />
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">BL</label>
                                                <input type="file" name="bl" class="form-control mb-2 mb-md-0 doc-bl bls-doc"
                                                    placeholder="Enter BL Document" />
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Shipping DO</label>
                                                <input type="file" name="shipping_do" class="form-control mb-2 mb-md-0 doc-ship bls-doc"
                                                    placeholder="Enter BL Document" />
                                            </div>
                                          </div>
                                  
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" id="add-close-btn" data-bs-dismiss="modal">Close</button>
                                        </div>
                                      
                                      </div>
                                    </div>
                                  </div>
                                {{-- End Attachmemt Modal --}}

                              </div>
                          </div>
                      </div>
                  </div>
                  <!--end::Form group-->

                  <!--begin::Form group-->
                  <div class="form-group mt-5">
                      <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                          <i class="ki-duotone ki-plus fs-3"></i>
                          Add Another BL
                      </a>
                  </div>
                  <!--end::Form group-->
              </div>
              <!--end::Repeater-->
              <div class="text-center">
                  <button type="submit" class="btn btn-lg btn-light fw-bold btn-primary me-2"
                      data-kt-search-element="advanced-options-form-cancel">Submit</button>
              </div>
          </form>
      
        </div>
        <!--end: Card Body-->
    </div>
    <!--end::Table widget 14-->

  {!! theme()->addVendor('formrepeater') !!}
  @push('scripts')
      <script>
          $('#kt_docs_repeater_basic').repeater({
              initEmpty: true,

              defaultValues: {
                  'text-input': 'foo'
              },

              show: function() {
                  $(this).slideDown();
              },

              hide: function(deleteElement) {
                  $(this).slideUp(deleteElement);
              }
          });
      </script>

      <script>
        $(document).on("click",".bl-attachment", function () {
            var targetModal = $(this).parent().next();
            targetModal.modal('toggle');
        });
      </script>

      <script>
        $(document).on("change",'.bls-doc', function () {
            
            var doc_com = $(this).parents('.row').find('.doc-com').val();
            var doc_bl = $(this).parents('.row').find('.doc-bl').val();
            var doc_ship = $(this).parents('.row').find('.doc-ship').val();
            
            var count = 0;
    
            if (doc_com !== '') {
            count++;
            }
            
            if (doc_bl !== '') {
            count++;
            }
            
            if (doc_ship !== '') {
            count++;
            }
            
            $(this).parents('.row').find('.bl-attachment').text(count + ' File Attached');

        });
      </script>

      <script>
          $(document).on("keyup",".input_bl_quantity", function () {
              var bl_quantity = $(this).val();
              var landed_quantity = $(this).closest('.row').find('.input_landed_quantity').val();
              var shortage = bl_quantity - landed_quantity;
              var shortage_percentage = landed_quantity * 100 / bl_quantity;
              $(this).closest('.row').find('.shortage-input').val(shortage);
              $(this).closest('.row').find('.shortage-input-percentage').val(parseFloat(shortage_percentage).toFixed(2));
          });

          $(document).on("keyup",".input_landed_quantity", function () {
              var landed_quantity = $(this).val();
              var bl_quantity = $(this).closest('.row').find('.input_bl_quantity').val();
              var shortage = bl_quantity - landed_quantity;
              var shortage_percentage = landed_quantity * 100 / bl_quantity;
              $(this).closest('.row').find('.shortage-input').val(shortage);
              $(this).closest('.row').find('.shortage-input-percentage').val(parseFloat(shortage_percentage).toFixed(2));                
          });
      </script>

      <script>
          $(document).on("change","#transaction_type", function () {
              
              var transaction_type = $(this).val();
              
              if (transaction_type == 'Normal') {
                  var option = '<option disabled selected>-- Select --</option>' +
                              '<option value="Local">Local</option>' +
                              '<option value="Import">Import</option>';
                  $('#inv-type').html(option);
              }
              if (transaction_type == 'Temporary' || transaction_type == 'Barter') {
                  var option = '<option value="Local">Local</option>';
                  $('#inv-type').html(option);
              }
          });
      </script>

      <script>
          $(document).on("change","#inv-type", function () {
              var value = $(this).val();

              if (value == 'Local') {
                  $('#voyage').hide();
                  $('#igm-date').hide();
                  $('#arrival-date').hide();
              }
              else {
                  $('#voyage').show();
                  $('#igm-date').show();
                  $('#arrival-date').show();
              }
          });
      </script>

      <script>
        $(document).on("keyup",".input_terminal_quantity", function () {
            var landed_quantity = $(this).parents('.row').find('.landed-qty').find('input').val();
            setTimeout(() => {
                var terminal_qty = $(this).val();
                if (terminal_qty != landed_quantity) {
                    swal({
                        title: "Landed Quantity and Terminal Quantity are not same, do you want to commingle ?",
                        text: "",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                        })
                        .then((willDelete) => {
                        if (willDelete) {
                            $(this).parent().next().show();
                        } else {
                            $(this).parents('.row').find('.commingle-terminal-col').hide();
                            $(this).val(landed_quantity);
                        }
                    });
                }
                else {
                    $(this).parents('.row').find('.commingle-terminal-col').hide();
                }
            }, 1500);
        });
      </script>
  @endpush
</x-default-layout>