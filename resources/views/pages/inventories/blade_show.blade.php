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
                                          <input type="file"  accept="application/pdf, image/png, image/jpg, image/jpeg" name="file" class="form-control" required>
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
                                              <input type="file"  accept="application/pdf, image/png, image/jpg, image/jpeg" name="file" class="form-control" required>
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
                                              <input type="file"  accept="application/pdf, image/png, image/jpg, image/jpeg" name="file" class="form-control" required>
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

        <!--begin::Table widget 14-->
    <div class="card card-flush mt-5 h-md-100">
        <!--begin::Body-->
        <div class="card-body pt-6">
            <div class="row">
                <div class="col-lg-6">

            <form class="pt-1" method="POST" action="{{ route('inventory.bls.add',$inventory->id) }}" id="bls-form" enctype="multipart/form-data">
                @csrf
                @method('POST')
              <div class="row justify-content-center">

                <div class="col-md-4">
                  <label class="form-label">Product <span class="text-danger">*</span></label>
                  <select name="product_id" id="product_id" class="form-select" required>
                    <option disabled selected>-- Select --</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" data-val="{{ $product->name }}">{{ $product->name }}</option>
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

                {{-- <div class="col-md-6">
                    <label class="form-label">Product Inventory Stock <span class="text-danger">*</span></label>
                    <select name="stock_id" id="stock_id" class="form-select" required>
                      <option disabled selected>-- Select --</option>
                      @foreach ($stocks as $stock)
                          <option value="{{ $stock->id }}">{{ $stock->product->name }}/{{ $stock->terminal_quantity }}</option>
                      @endforeach
                    </select>
                </div> --}}

              </div>

              <!--begin::Repeater-->
              <div>
                  <!--begin::Form group-->
                  <div class="form-group">
                      <div class="my-5">
                          <div class="rounded-3 my-5 p-3">
                              <div class="form-group row gy-3">

                                  <div class="col-md-6 date">
                                      <label class="form-label">Date <span class="text-danger">*</span></label>
                                      <input type="date" name="date" required
                                              class="form-control mb-2 mb-md-0" />
                                  </div>
                                  <div class="col-md-6 bl-number">
                                      <label class="form-label">BL Number: <span class="text-danger">*</span></label>
                                      <input type="text" name="bl_number" required class="form-control mb-2 mb-md-0"
                                          placeholder="BL Number" />
                                  </div>
                                  <div class="col-md-6 index-number">
                                      <label for="index_number" class="form-label">Index Number</label>
                                      <input type="text" class="form-control form-control-lg border-dark"
                                          placeholder="Index Number" name="index_number" required />
                                  </div>
                                  <div class="col-md-6 bl-qty">
                                      <label class="form-label">BL Quantity: <span class="text-danger">*</span></label>
                                      <input type="number" required name="bl_quantity" class="input_bl_quantity form-control mb-2 mb-md-0"
                                          placeholder="Enter BL Quantity" step=".0001" />
                                  </div>
                                  <div class="col-md-6 landed-qty">
                                      <label class="form-label">Landed Quantity <span class="text-danger">*</span></label>
                                      <input type="number" required name="landed_quantity"
                                          class="form-control mb-2 mb-md-0 input_landed_quantity" placeholder="Enter Landed Quantity"
                                          step=".0001" />
                                  </div>
                                  <div class="col-md-6 terminal-qty">
                                    <label class="form-label">Terminal Quantity <span class="text-danger">*</span></label>
                                    <input type="number" required name="terminal_quantity"
                                        class="form-control mb-2 mb-md-0 input_terminal_quantity all-terminal-qty" placeholder="Enter Terminal Quantity"
                                        step=".0001" />
                                  </div>

                                  <div class="col-md-6 shortage">
                                      <label class="form-label">Shortage</label>
                                      <input type="number"
                                          class="form-control mb-2 mb-md-0 shortage-input" disabled placeholder="0.00"
                                          step=".0001" />
                                  </div>

                                  <div class="col-md-6 shortage-percentage">
                                      <label class="form-label">Shortage Percentage</label>
                                      <input type="number"
                                          class="form-control mb-2 mb-md-0 shortage-input-percentage" disabled placeholder="0.00 %"
                                          step=".0001" />
                                  </div>

                                  <div class="col-md-6 provisional-price">
                                      <div class="row">
                                          <div class="col-md-12">
                                              <label class="form-label">Provisional Price: <span class="text-danger">*</span></label>
                                              <input type="number" required name="provisional_price" class="provisional_price form-control mb-2 mb-md-0"
                                                      placeholder="Enter Provisional Price" required />
                                          </div>
                                      </div>
                                  </div>

                                  <div class="col-md-6 status">
                                    <br>
                                        <div class="form-check form-check-solid form-check-custom form-switch mt-4">
                                            <input class="form-check-input w-45px h-30px" name="status" type="checkbox"
                                                value="1" id="googleswitch">
                                            <label class="form-check-label" for="googleswitch">Status</label>
                                        </div>
                                    </div>
                                  
                                  <div class="col-md-12">
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
                                                <input type="file"  accept="application/pdf, image/png, image/jpg, image/jpeg" name="commercial_invoice"
                                                    class="form-control mb-2 mb-md-0 doc-com bls-doc" placeholder="Enter BL Document"
                                                     />
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">BL</label>
                                                <input type="file"  accept="application/pdf, image/png, image/jpg, image/jpeg" name="bl" class="form-control mb-2 mb-md-0 doc-bl bls-doc"
                                                    placeholder="Enter BL Document" />
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Shipping DO</label>
                                                <input type="file"  accept="application/pdf, image/png, image/jpg, image/jpeg" name="shipping_do" class="form-control mb-2 mb-md-0 doc-ship bls-doc"
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


                        <div id="kt_docs_repeater_basic" class="commingle-terminal-col" style="display: none;">
                            <!--begin::Form group-->
                            <div class="form-group">
                                <div class="my-5" data-repeater-list="commingle_terminals">
                                    <div class="border-1 rounded-3 my-5 border-secondary border p-3 border-secondary" data-repeater-item>
                                        <div class="form-group row gy-3	">
                                            <div class="col-md-12 text-end">
                                                <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                        <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                                        Delete
                                                </a>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">Commingle Terminal</label>
                                                <select name="commingle_terminal" id="commingle_terminal" class="form-select">
                                                    <option selected disabled value="">-- Select --</option>
                                                    @foreach ($terminals as $terminal)
                                                        <option value="{{ $terminal->id }}">{{ $terminal->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">Terminal Quantity:</label>
                                                <input type="number" required name="commingle_quantity" class="form-control mb-2 mb-md-0 all-terminal-qty" placeholder="Enter Terminal Quantity" step=".0001" />
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
                                        Add Commingle Terminal
                                </a>
                            </div>
                            <!--end::Form group-->
                        </div>

                              </div>
                          </div>
                      </div>
                  </div>
                  <!--end::Form group-->

              </div>
              <!--end::Repeater-->
              <div class="text-center">
                  <button type="button" id="check-submit-btn" class="btn btn-lg btn-light fw-bold btn-primary me-2">Submit</button>
              </div>
            </form>

            <form class="pt-1 d-none" method="POST" action="" id="edit-bl-form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
              <div class="row justify-content-center">
                <div class="col-md-4">
                  <label class="form-label">Product <span class="text-danger">*</span></label>
                  <select name="product_id" id="product_id" class="form-select" required>
                    <option disabled selected>-- Select --</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" data-val="{{ $product->name }}">{{ $product->name }}</option>
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
              <div>
                  <!--begin::Form group-->
                  <div class="form-group">
                      <div class="my-5">
                          <div class="rounded-3 my-5 p-3">
                              <div class="form-group row gy-3">

                                  <div class="col-md-6 date">
                                      <label class="form-label">Date <span class="text-danger">*</span></label>
                                      <input type="date" name="date" required
                                              class="form-control mb-2 mb-md-0" />
                                  </div>
                                  <div class="col-md-6 bl-number">
                                      <label class="form-label">BL Number: <span class="text-danger">*</span></label>
                                      <input type="text" name="bl_number" required class="form-control mb-2 mb-md-0"
                                          placeholder="BL Number" />
                                  </div>
                                  <div class="col-md-6 index-number">
                                      <label for="index_number" class="form-label">Index Number</label>
                                      <input type="text" class="form-control form-control-lg border-dark"
                                          placeholder="Index Number" name="index_number" required />
                                  </div>
                                  <div class="col-md-6 bl-qty">
                                      <label class="form-label">BL Quantity: <span class="text-danger">*</span></label>
                                      <input type="number" required name="bl_quantity" class="input_bl_quantity form-control mb-2 mb-md-0"
                                          placeholder="Enter BL Quantity" step=".0001" />
                                  </div>
                                  <div class="col-md-6 landed-qty">
                                      <label class="form-label">Landed Quantity <span class="text-danger">*</span></label>
                                      <input type="number" required name="landed_quantity"
                                          class="form-control mb-2 mb-md-0 input_landed_quantity" placeholder="Enter Landed Quantity"
                                          step=".0001" />
                                  </div>
                                  <div class="col-md-6 terminal-qty">
                                    <label class="form-label">Terminal Quantity <span class="text-danger">*</span></label>
                                    <input type="number" required name="terminal_quantity"
                                        class="form-control mb-2 mb-md-0 input_terminal_quantity all-terminal-qty" placeholder="Enter Terminal Quantity"
                                        step=".0001" />
                                  </div>

                                  <div class="col-md-6 shortage">
                                      <label class="form-label">Shortage</label>
                                      <input type="number"
                                          class="form-control mb-2 mb-md-0 shortage-input" disabled placeholder="0.00"
                                          step=".0001" />
                                  </div>

                                  <div class="col-md-6 shortage-percentage">
                                      <label class="form-label">Shortage Percentage</label>
                                      <input type="number"
                                          class="form-control mb-2 mb-md-0 shortage-input-percentage" disabled placeholder="0.00 %"
                                          step=".0001" />
                                  </div>

                                  <div class="col-md-6 provisional-price">
                                      <div class="row">
                                          <div class="col-md-12">
                                              <label class="form-label">Provisional Price: <span class="text-danger">*</span></label>
                                              <input type="number" required name="provisional_price" class="provisional_price form-control mb-2 mb-md-0"
                                                      placeholder="Enter Provisional Price" required />
                                          </div>
                                      </div>
                                  </div>

                                  <div class="col-md-6 status">
                                    <br>
                                        <div class="form-check form-check-solid form-check-custom form-switch mt-4">
                                            <input class="form-check-input w-45px h-30px" name="status" type="checkbox"
                                                value="1" id="googleswitch">
                                            <label class="form-check-label" for="googleswitch">Status</label>
                                        </div>
                                    </div>
                                  
                                  <div class="col-md-12 d-none">
                                    <button type="button" class="btn btn-sm btn-primary bl-attachment">BL Attachments</button>
                                  </div>

                                {{-- Start Attachment Modal --}}
                                <div class="modal fade modal-lg d-none" id="BL-Attachments" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                      <div class="modal-content">
                                        <div class="modal-header bg-primary pt-5 pb-5">
                                          <h5 class="modal-title text-white fs-2" id="exampleModalLabel">Edit BL Attachments</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                  
                                          <div class="row justify-content-center align-items-center">

                                              <div class="col-md-4">
                                                <label class="form-label">Commercial Invoice</label>
                                                <input type="file"  accept="application/pdf, image/png, image/jpg, image/jpeg" name="commercial_invoice"
                                                    class="form-control mb-2 mb-md-0 doc-com bls-doc" placeholder="Enter BL Document"
                                                     />
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">BL</label>
                                                <input type="file"  accept="application/pdf, image/png, image/jpg, image/jpeg" name="bl" class="form-control mb-2 mb-md-0 doc-bl bls-doc"
                                                    placeholder="Enter BL Document" />
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Shipping DO</label>
                                                <input type="file"  accept="application/pdf, image/png, image/jpg, image/jpeg" name="shipping_do" class="form-control mb-2 mb-md-0 doc-ship bls-doc"
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


                        <div id="kt_docs_repeater_basic" class="commingle-terminal-col" style="display: none;">
                            <!--begin::Form group-->
                            <div class="form-group">
                                <div class="my-5" data-repeater-list="commingle_terminals">
                                    <div class="border-1 rounded-3 my-5 border-secondary border p-3 border-secondary" data-repeater-item>
                                        <div class="form-group row gy-3	">
                                            <div class="col-md-12 text-end">
                                                <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                        <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                                        Delete
                                                </a>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">Commingle Terminal</label>
                                                <select name="commingle_terminal" id="commingle_terminal" class="form-select">
                                                    <option selected disabled value="">-- Select --</option>
                                                    @foreach ($terminals as $terminal)
                                                        <option value="{{ $terminal->id }}">{{ $terminal->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">Terminal Quantity:</label>
                                                <input type="number" required name="commingle_quantity" class="form-control mb-2 mb-md-0 all-terminal-qty" placeholder="Enter Terminal Quantity" step=".0001" />
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
                                        Add Commingle Terminal
                                </a>
                            </div>
                            <!--end::Form group-->
                        </div>

                              </div>
                          </div>
                      </div>
                  </div>
                  <!--end::Form group-->

              </div>
              <!--end::Repeater-->
              <div class="text-center">
                  <button type="button" id="edit-submit-btn" class="btn btn-lg btn-light fw-bold btn-primary me-2">Update</button>
              </div>
            </form>

            </div>

            <div class="col-lg-6 pt-4 border-secondary border-start border-3">
                <button type="button" id="rdb_palm_oil" class="btn btn-sm btn-light border border-1 border-primary">RDB Palm Oil</button>
                <button type="button" id="rdb_palm_olein" class="btn btn-sm btn-light border border-1 border-primary">RBD Palm Olein</button>
                <table class="table align-middle table-row-bordered table-hover mt-5" id="bl-table">
                    <thead class="bg-secondary fw-bold">
                        <tr>
                            <th></th>
                            <th>Product</th>
                            <th>BL Number</th>
                            <th>Bl Quanity</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="bls-tbody">
                        
                    </tbody>
                </table>
            </div>


        </div>

        </div>
        <!--end: Card Body-->
    </div>
    <!--end::Table widget 14-->

  {!! theme()->addVendor('formrepeater') !!}
  @push('scripts')
  <script src="https://malsup.github.io/jquery.form.js"></script> 
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
            var landed_quantity = $(this).closest('form').find('.landed-qty').find('input').val();
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
                            $('.commingle-terminal-col').show();
                        } else {
                            $('.commingle-terminal-col').hide();
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

    <script>
        function BlDataTable() {
                        var table = $("#bl-table").DataTable({
                            processing: true,
                            serverSide: true,
                            info: false,
                            paging: true,
                            destroy: true,
                            ajax: "{{ route('inventories.show',$inventory->id) }}",
                            columns: [
                                {data: null, "defaultContent": "" },
                                {data: 'product_name', name: 'product_name'},
                                {data: 'bl_number', name: 'bl_number'},
                                {data: 'bl_quantity', name: 'bl_quantity'},
                                {data: 'action', name: 'action', orderable: false, searchable: false},
                            ],
                            
                            columnDefs: [{
                                targets: 1,
                                searchable: true,
                                visible: false
                            }]
        
                    });

            $('#product_id').on('change', function() {
                var value = $(this).find(':selected').attr('data-val');
                table.column(1).search(value).draw();

                if (value == 'RBD PALM OIL') {
                    $('#rdb_palm_oil').removeClass('btn-light').addClass('btn-primary');      
                    $('#rdb_palm_olein').removeClass('btn-primary').addClass('btn-light');      
                }
                else if(value == 'RBD PALM OLEIN') {
                    $('#rdb_palm_olein').removeClass('btn-light').addClass('btn-primary');
                    $('#rdb_palm_oil').removeClass('btn-primary').addClass('btn-light');
                }
        });

            $('#rdb_palm_oil').on('click', function() {
                table.column(1).search('RBD PALM OIL').draw();
                $(this).removeClass('btn-light').addClass('btn-primary');
                $('#rdb_palm_olein').removeClass('btn-primary').addClass('btn-light');
                $("#product_id option:contains(RBD PALM OIL)").prop("selected", true);
            });

            $('#rdb_palm_olein').on('click', function() {
                table.column(1).search('RBD PALM OLEIN').draw();
                $(this).removeClass('btn-light').addClass('btn-primary');
                $('#rdb_palm_oil').removeClass('btn-primary').addClass('btn-light');
                $("#product_id option:contains(RBD PALM OLEIN)").prop("selected", true);
            });

            return table;
        }

        $(document).ready(function() {
            BlDataTable();
        });

    
        $(document).on('click','#check-submit-btn', function () {
            var product_id = $('#product_id').val();
            var terminal_id = $('#terminal_id').val();
            var landed_qty = $('.input_landed_quantity').val();
            
            var terminal_qty = 0;
            $(this).closest('form').find('.all-terminal-qty').each(function (i, j) {
                terminal_qty += parseInt($(this).val());
            });
            if (terminal_qty == landed_qty) {
                $("#bls-form").ajaxSubmit(
                    {
                        url: "{{ route('inventory.bls.add',$inventory->id) }}",
                        type: 'post',
                        success:    function(response) { 
                            
                            swal("BL Added Successfully!", "", "success");
                            $('#bls-form')[0].reset();
                            $('#product_id option[value='+product_id+']').attr('selected','selected');
                            $('#terminal_id option[value='+terminal_id+']').attr('selected','selected');
                            BlDataTable();
                        },
                        error:    function() {
                            swal("Error Occured!", "", "warning");
                         }
                    }
                    );
            }
            else {
                swal("Please make sure that Terminal Quantity should be equal to landed quantity!", "", "warning");
            }
        });
    </script>

    <script>
        $(document).on("click",".edit-bl", function () {
            
            var url = $(this).attr('data-info');
            var action = $(this).attr('data-route');

            $.ajax({
                type: "GET",
                url: url,
                success: function (data) {
                    $('#edit-bl-form').attr('action',action);
                    $('#edit-bl-form').removeClass('d-none');
                    $('#bls-form').addClass('d-none');

                    // Assign Values
                    $('#edit-bl-form').find('#product_id option[value='+data.product_id+']').attr('selected','selected');
                    $('#edit-bl-form').find('#terminal_id option[value='+data.terminal_id+']').attr('selected','selected');
                    $('#edit-bl-form').find('input[name="date"]').val(data.date);
                    $('#edit-bl-form').find('input[name="bl_number"]').val(data.bl_number);
                    $('#edit-bl-form').find('input[name="index_number"]').val(data.index_number);
                    $('#edit-bl-form').find('input[name="bl_quantity"]').val(data.bl_quantity);
                    $('#edit-bl-form').find('input[name="landed_quantity"]').val(data.landed_quantity);
                    $('#edit-bl-form').find('input[name="terminal_quantity"]').val(data.terminal_quantity);
                    $('#edit-bl-form').find('input[name="provisional_price"]').val(data.provisional_price);
                    $('#edit-bl-form').find('#edit-submit-btn').text('Update')
                    $('#edit-bl-form').find('input[name="landed_quantity"]').trigger('keyup');
                    if (data.status == 1) {
                        $('#edit-bl-form').find('input[name="status"]').prop('checked',true);
                    }
                    else {
                        $('#edit-bl-form').find('input[name="status"]').prop('checked',false);
                    }
                }
            });
        });
    </script>

    <script>
        $(document).on("click","#edit-submit-btn", function () {
            
            var url = $(this).closest('form').attr('action');
            var formData = $(this).closest('form').serialize();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                type: "PUT",
                url: url,
                data: formData,
                success: function (response) {
                    swal("BL Updated Successfully!", "", "success");
                        $('#edit-bl-form')[0].reset();
                        BlDataTable();

                        $('#edit-bl-form').attr('action',"");
                        $('#edit-bl-form').addClass('d-none');
                        $('#bls-form').removeClass('d-none');
                },
                error:  function() {
                    swal("Error Occured!", "", "warning");
                }
            });
        });
    </script>

    <script>
        $(document).on("click","#delete-bl", function () {
            var url = $(this).attr('data-route');

            swal({
                title: "Are you sure you want to delete ?",
                text: "",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: "DELETE",
                        url: url,
                        data: {
                            _token : "{{ csrf_token() }}"
                        },
                        success: function (response) {
                            swal("BL Deleted Successfully !","","success");
                            BlDataTable();  
                        },
                        error : function () {
                            swal("Error Occured!", "", "warning");
                        }
                    });
                    
                } else {
                    swal("Your Record is Safe","","success");
                }
            });
        });
    </script>
  @endpush
</x-default-layout>