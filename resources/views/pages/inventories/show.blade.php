<x-default-layout>
    <style>
        .add-new-card:hover {
            background-color: #ebebeb;
            color: #aba8a8;
            border-color: #aba8a8 !important;
            cursor: pointer;
        }

        .add-new-plus:hover {
            border-color: #aba8a8 !important;
        }

        .stock-card:hover {
            box-shadow: 0 1rem 2rem 0rem rgba(0, 0, 0, 0.1) !important;
            cursor: pointer;
        }

        .close-button {
            position: absolute;
            top: -10px;
            right: -10px;
            width: 30px;
            height: 30px;
            background-color: #fff;
            color: #000;
            border: 1px solid #b1afaf;
            border-radius: 50%;
            cursor: pointer;
            font-size: 14px;
        }
    input[type='text'],
    input[type='date'],
    input[type='number'],
    textarea,
    select {
        background:#f5f8fa !important;
    }
    .form-check-input {
        border-color: #000;
        width: 1.3em;
        height: 1.3em;
    }
    table#bl-table tr td:nth-child(5),
    table#bl-table tr td:nth-child(6), 
    table#bl-table tr td:nth-child(7),
    table#bl-table tr td:nth-child(8),
    table#bl-table tr td:nth-child(9),
    table#bl-table tfoot th {
        text-align:right;
    }
    table#bl-table tfoot {
        border-top:1px solid #000;
    }
</style>
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

    @if ($bl_id)
        <!--begin::Table widget 14-->
  <div class="card card-flush h-md-100 mb-4">
    <!--begin::Body-->
    <div class="card-body pb-0 pt-6">
            <div class="row">
                <h3>BL Info:</h3>
                <div class="col-md-12">
                    <div class="row">
                       <div class="col-md-2">
                          <p class="fw-bold fs-5 mb-0">Serial No. </p>
                          <p class="fs-5">{{ $bl_id->serial_number ?? 'N/A' }}</p>
                        </div>

                        <div class="col-md-2">
                            <p class="fw-bold fs-5 mb-0">Product </p>
                            <p class="fs-5">{{ $bl_id->product->name ?? 'N/A' }}</p>
                        </div>

                        <div class="col-md-2">
                          <p class="fw-bold fs-5 mb-0">Terminal </p>
                          <p class="fs-5">{{ $bl_id->terminal->name ?? 'N/A' }}</p>
                        </div>

                        <div class="col-md-2">
                          <p class="fw-bold fs-5 mb-0">BL Number </p>
                          <p class="fs-5">{{ $bl_id->bl_number ?? 'N/A' }}</p>
                        </div>

                        <div class="col-md-2">
                          <p class="fw-bold fs-5 mb-0">BL Quantity </p>
                          <p class="fs-5">{{ number_format($bl_id->bl_quantity,3) ?? '0.000' }}</p>
                        </div>

                        <div class="col-md-2">
                          <p class="fw-bold fs-5 mb-0">Landed Quantity </p>
                          <p class="fs-5">{{ number_format($bl_id->landed_quantity,3) ?? '0.000' }}</p>
                        </div>

                        <div class="col-md-2">
                          <p class="fw-bold fs-5 mb-0">Shortage </p>
                          <p class="fs-5">{{ number_format($bl_id->shortage_status(),3) ?? '0.000' }}</p>
                        </div>

                        <div class="col-md-2">
                          <p class="fw-bold fs-5 mb-0">Lifted </p>
                          <p class="fs-5">{{ $bl_id->lifted_qty() }}</p>
                        </div>

                        <div class="col-md-2">
                            <p class="fw-bold fs-5 mb-0">Balance </p>
                            <p class="fs-5">{{ number_format($bl_id->landed_quantity - $bl_id->lifted_qty(),3) ?? '--' }}</p>
                        </div>
                        
                        <div class="col-md-2">
                            <p class="fw-bold fs-5 mb-0">Status </p>
                            <p class="fs-5">{{ $bl_id->bl_status }}</p>
                        </div>

                    </div>
                </div>

            
            </div>

          </div>
          <!--end: Card Body-->
      </div>
      <!--end::Table widget 14-->
    @endif


  <!--begin::Table widget 14-->
  <div class="card card-flush h-md-100">
      <!--begin::Body-->
      <div class="card-body pb-0 pt-6">
              <div class="row">

                  <div class="col-md-12">
                      <div class="row">
                         <div class="col-md-2">
                            <p class="fw-bold fs-5 mb-0">Vessel </p>
                            <p class="fs-5">{{ $inventory->vessel->name ?? 'N/A' }}</p>
                          </div>

                          <div class="col-md-2">
                              <p class="fw-bold fs-5 mb-0">Inventory Type </p>
                              <p class="fs-5">{{ $inventory->type }}</p>
                          </div>

                          <div class="col-md-2">
                            <p class="fw-bold fs-5 mb-0">Transaction Type </p>
                            <p class="fs-5">{{ $inventory->transaction_type }}</p>
                          </div>

                          <div class="col-md-2">
                            <p class="fw-bold fs-5 mb-0">Seller </p>
                            <p class="fs-5">{{ $inventory->seller->name ?? 'N/A' }}</p>
                          </div>

                          <div class="col-md-2">
                            <p class="fw-bold fs-5 mb-0">Buyer </p>
                            <p class="fs-5">{{ $inventory->buyer->name ?? 'N/A' }}</p>
                          </div>

                          <div class="col-md-2">
                            <p class="fw-bold fs-5 mb-0">Vessel Quantity </p>
                            <p class="fs-5">{{ $inventory->vessel_qty ?? '0.000' }}</p>
                          </div>

                          <div class="col-md-2">
                            <p class="fw-bold fs-5 mb-0">BL Quantity </p>
                            <p class="fs-5">{{ number_format($inventory->bls->sum('bl_quantity'),3) ?? '0.000' }}</p>
                          </div>

                          <div class="col-md-2">
                            <p class="fw-bold fs-5 mb-0">Landed Quantity </p>
                            <p class="fs-5">{{ number_format($inventory->landed_qty(),3) ?? '0.000' }}</p>
                          </div>

                          <div class="col-md-2">
                            <p class="fw-bold fs-5 mb-0">Shortage </p>
                            <p class="fs-5">{{ number_format($inventory->vessel_shortage,3) ?? '0.000' }}</p>
                          </div>

                          @php
                            $lifted_qty = 0;
                              foreach ($inventory->bls as $key => $bl) {
                                $lifted_qty += $bl->lifted_qty();
                              }
                          @endphp

                        <div class="col-md-2">
                            <p class="fw-bold fs-5 mb-0">Lifted Qty </p>
                            <p class="fs-5">{{ number_format($lifted_qty,3) ?? '0.000' }}</p>
                        </div>

                      </div>
                  </div>

              
              </div>

            </div>
            <!--end: Card Body-->
        </div>
        <!--end::Table widget 14-->

        <div class="accordion mt-4" id="accordionExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button bg-white fw-bold text-dark fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Product Terminal Stock
                </button> 
              </h2>
              <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="card card-flush h-md-100">
                        <!--begin::Body-->
                        <div class="card-body pt-6">
            
                          <div class="row">
                            
                            @foreach ($stocks as $stock)
                            <div class="col-md-3">
                                <!--begin::box-->
                                    <div class="card mb-2 stock-card border border-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add BL">
                                        <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Stock" onclick="$('#delete-stock-{{ $stock->id }}').submit();" class="close-button shadow">x</button>
                                        <form id="delete-stock-{{ $stock->id }}" action="{{ route('inventory.delete.stock',$stock->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <div class="card-body d-flex flex-center flex-column p-4" style="min-height:80px">
                                            <p class="mb-1 prod-termi" data-pro="{{ $stock->product->id ?? '' }}" data-termi="{{ $stock->terminal->id ?? '' }}">{{ $stock->product->code ?? '--' }} / {{ $stock->terminal->code ?? '--' }}</p>
                                            <p class="mb-1"> {{ number_format($stock->terminal_quantity,3) }} / {{ number_format($stock->terminal_shortage,3) }}</p>
                                        </div>
                                    </div>
                                <!--end::box-->
                            </div>
                            @endforeach
            
                            <div class="col-md-3">
                                <!--begin::box-->
                                    <div class="card border border-secondary add-new-card shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Add New Stock" style="min-height:80px">
                                        <div class="card-body d-flex flex-center flex-column p-4">
                                                <p class="text-center fw-bold fs-3 mb-0">Add New <span class="fs-1 rounded-circle border border-dark mb-1 px-2 add-new-plus">+</span></p>
                                        </div>
                                    </div>
                                <!--end::box-->
                            </div>
            
            
                          </div>
            
                        </div>
                        <!--End::Body-->
            
                        {{-- Add New Inventory Stock --}}
                        <!-- Modal -->
                        <div class="modal fade new-inv-stock" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <form action="{{ route('inventory.add.stock',$inventory->id) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Add Product Terminal Stock</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
            
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6 stock_product mb-2">
                                                <label for="">Product</label>
                                                <select name="product_id" class="form-select form-select-sm border-dark" required>
                                                    <option selected value="">-- Selected --</option>
                                                    @foreach ($all_products as $product)
                                                        <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>{{ $product->code }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 stock_terminal mb-2">
                                                <label for="">Terminal</label>
                                                <select name="terminal_id" class="form-select form-select-sm border-dark">
                                                    <option selected value="">-- Selected --</option>
                                                    @foreach ($all_terminals as $terminal)
                                                        <option value="{{ $terminal->id }}" {{ old('terminal_id') == $terminal->id ? 'selected' : '' }}>{{ $terminal->code }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 stock_terminal_qty mb-2">
                                                <label class="form-label">Terminal Quantity</label>
                                                <input type="number" name="terminal_quantity" class="form-control border-dark form-control-sm" value="{{ old('terminal_quantity') }}" step="0.0001">
                                            </div>
                                            <div class="col-md-6 stock_terminal_shortage mb-2">
                                                <label class="form-label">Terminal Shortage</label>
                                                <input type="number" name="terminal_shortage" class="form-control border-dark form-control-sm" value="{{ old('terminal_shortage') }}" step="0.0001">
                                            </div>
                                            <div class="col-md-12 stock_remarks">
                                                <label class="form-label">Remarks</label>
                                                <input type="text" name="remarks" class="form-control border-dark form-control-sm" value="{{ old('remarks') }}">
                                            </div>
                                        </div>    
                                    </div>
            
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                        {{-- End Inventory Stock --}}
            
            
                    </div>
                </div>
              </div>
            </div>
          </div>


          <div class="row">
            
            <div class="col-lg-4">
                <!--begin::Table widget 14-->
        <div class="card card-flush mt-5 h-md-100">
            <!--begin::Body-->
            <div class="card-body px-3 pt-3" id="left-card">

                <form class="pt-1" method="POST" action="{{ route('inventory.bls.add',$inventory->id) }}" id="bls-form" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                <!--begin::Repeater-->
                <div>
                    <!--begin::Form group-->
                    <div class="form-group">
                        <div class="mb-5">
                            <div class="rounded-3 p-3">
                                <div class="form-group row gy-3">

                                    <div class="col-md-6">
                                        <label class="form-label">Product <span class="text-danger">*</span></label>
                                        <select name="product_id" id="product_id" class="form-select form-select-sm" required>
                                        <option disabled selected value="">-- Select --</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}" data-val="{{ $product->code }}">{{ $product->code }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Terminal</label>
                                        <select name="terminal_id" id="terminal_id" class="form-select form-select-sm">
                                        <option selected value="">-- Select --</option>
                                        @foreach ($terminals as $terminal)
                                            <option value="{{ $terminal->id }}">{{ $terminal->code }}</option>
                                        @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6 date">
                                        <label class="form-label">Date <span class="text-danger">*</span></label>
                                        <input type="date" name="date" required
                                                class="form-control form-control-sm mb-2 mb-md-0" />
                                    </div>
                                    <div class="col-md-6 bl-number">
                                        <label class="form-label">BL Number: <span class="text-danger">*</span></label>
                                        <input type="text" name="bl_number" required class="form-control form-control-sm mb-2 mb-md-0"
                                            placeholder="BL Number" />
                                    </div>
                                    <div class="col-md-6 index-number">
                                        <label for="index_number" class="form-label">Index Number</label>
                                        <input type="text" class="form-control form-control-sm"
                                            placeholder="Index Number" name="index_number" required />
                                    </div>
                                    <div class="col-md-6 bl-qty">
                                        <label class="form-label">BL Quantity: <span class="text-danger">*</span></label>
                                        <input type="number" required name="bl_quantity" class="input_bl_quantity form-control-sm form-control mb-2 mb-md-0"
                                            placeholder="Enter BL Quantity" step=".0001" />
                                    </div>
                                    <div class="col-md-6 landed-qty">
                                        <label class="form-label">Landed Quantity <span class="text-danger">*</span></label>
                                        <input type="number" required name="landed_quantity"
                                            class="form-control mb-2 mb-md-0 input_landed_quantity form-control-sm" placeholder="Enter Landed Qty"
                                            step="0.0001" />
                                    </div>
                                    <div class="col-md-6 terminal-qty">
                                        <label class="form-label">Terminal Quantity <span class="text-danger">*</span></label>
                                        <input type="number" required name="terminal_quantity"
                                            class="form-control mb-2 mb-md-0 input_terminal_quantity all-terminal-qty form-control-sm" placeholder="Enter Terminal Qty"
                                            step="0.0001" />
                                    </div>

                                    <div class="col-md-6 shortage">
                                        <label class="form-label">Shortage</label>
                                        <input type="number"
                                            class="form-control mb-2 mb-md-0 shortage-input form-control-sm" disabled placeholder="0.00"
                                            step=".0001" />
                                    </div>

                                    <div class="col-md-6 shortage-percentage">
                                        <label class="form-label">Shortage Percentage</label>
                                        <input type="number"
                                            class="form-control mb-2 mb-md-0 shortage-input-percentage form-control-sm" disabled placeholder="0.00 %"
                                            step=".0001" />
                                    </div>

                                    <div class="col-md-6 provisional-price">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="form-label">Provisional Price: <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="input-group-text" id="basic-addon1">USD</span>
                                                    <input type="number" required name="provisional_price" class="provisional_price form-control-sm form-control mb-2 mb-md-0"
                                                            placeholder="Enter Provisional Price" required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 payment-method">
                                        <label class="form-label">Payment Method</label>
                                        <select name="payment_method" id="payment_method" class="form-control form-control-sm">
                                            <option value="">-- Select --</option>
                                            <option value="LC">LC</option>
                                            <option value="DA">DA</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 bank-account">
                                        <label class="form-label">Bank Account</label>
                                        <select name="bank_id" id="bank_account" class="form-control form-control-sm">
                                            <option value="">-- Select --</option>
                                            @foreach ($banks as $bank)
                                                <option value="{{ $bank->id }}">{{ $bank->bank_name }} ({{ $bank->account_title }})</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6 status">
                                        <label class="form-label">BL Status</label>
                                        <select name="bl_status" class="form-select form-select-sm" required>
                                            <option selected value="">-- Select --</option>
                                            <option value="Duty Paid">Duty Paid</option>
                                            <option value="DO Waiting">DO Waiting</option>
                                            <option value="Active for Lifting">Active for Lifting</option>
                                            <option value="Lifting Completed">Lifting Completed</option>
                                        </select>
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

                <!--begin::Repeater-->
                <div>
                    <!--begin::Form group-->
                    <div class="form-group">
                        <div class="mb-5">
                            <div class="rounded-3 p-3">
                                <div class="form-group row gy-3">

                                    <div class="col-md-6">
                                        <label class="form-label">Product <span class="text-danger">*</span></label>
                                        <select name="product_id" id="product_id" class="form-select form-select-sm" required>
                                        <option disabled selected value="">-- Select --</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}" data-val="{{ $product->name }}">{{ $product->code }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Terminal</label>
                                        <select name="terminal_id" id="terminal_id" class="form-select form-select-sm">
                                        <option selected value="">-- Select --</option>
                                        @foreach ($terminals as $terminal)
                                            <option value="{{ $terminal->id }}">{{ $terminal->code }}</option>
                                        @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6 date">
                                        <label class="form-label">Date <span class="text-danger">*</span></label>
                                        <input type="date" name="date" required
                                                class="form-control form-control-sm mb-2 mb-md-0" />
                                    </div>
                                    <div class="col-md-6 bl-number">
                                        <label class="form-label">BL Number: <span class="text-danger">*</span></label>
                                        <input type="text" name="bl_number" required class="form-control form-control-sm mb-2 mb-md-0"
                                            placeholder="BL Number" />
                                    </div>
                                    <div class="col-md-6 index-number">
                                        <label for="index_number" class="form-label">Index Number</label>
                                        <input type="text" class="form-control form-control-sm"
                                            placeholder="Index Number" name="index_number" required />
                                    </div>
                                    <div class="col-md-6 bl-qty">
                                        <label class="form-label">BL Quantity: <span class="text-danger">*</span></label>
                                        <input type="number" required name="bl_quantity" class="input_bl_quantity form-control form-control-sm mb-2 mb-md-0"
                                            placeholder="Enter BL Quantity" step=".0001" />
                                    </div>
                                    <div class="col-md-6 landed-qty">
                                        <label class="form-label">Landed Quantity <span class="text-danger">*</span></label>
                                        <input type="number" required name="landed_quantity"
                                            class="form-control mb-2 mb-md-0 input_landed_quantity form-control-sm" placeholder="Enter Landed Quantity"
                                            step=".0001" />
                                    </div>
                                    <div class="col-md-6 terminal-qty">
                                        <label class="form-label">Terminal Quantity <span class="text-danger">*</span></label>
                                        <input type="number" required name="terminal_quantity"
                                            class="form-control form-control-sm mb-2 mb-md-0 input_terminal_quantity all-terminal-qty" placeholder="Enter Terminal Quantity"
                                            step=".0001" />
                                    </div>

                                    <div class="col-md-6 shortage">
                                        <label class="form-label">Shortage</label>
                                        <input type="number"
                                            class="form-control mb-2 mb-md-0 form-control-sm shortage-input" disabled placeholder="0.00"
                                            step=".0001" />
                                    </div>

                                    <div class="col-md-6 shortage-percentage">
                                        <label class="form-label">Shortage Percentage</label>
                                        <input type="number"
                                            class="form-control mb-2 mb-md-0 form-control-sm shortage-input-percentage" disabled placeholder="0.00 %"
                                            step=".0001" />
                                    </div>

                                    <div class="col-md-6 provisional-price">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="form-label">Provisional Price: <span class="text-danger">*</span></label>                                                    
                                                    <input type="number" required name="provisional_price" class="provisional_price form-control form-control-sm mb-2 mb-md-0"
                                                            placeholder="Enter Provisional Price" required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 payment-method">
                                        <label class="form-label">Payment Method</label>
                                        <select name="payment_method" id="payment_method" class="form-control form-control-sm">
                                            <option value="">-- Select --</option>
                                            <option value="LC">LC</option>
                                            <option value="DA">DA</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 bank-account">
                                        <label class="form-label">Bank Account</label>
                                        <select name="bank_id" id="bank_account" class="form-control form-control-sm">
                                            <option value="">-- Select --</option>
                                            @foreach ($banks as $bank)
                                                <option value="{{ $bank->id }}">{{ $bank->bank_name }} ({{ $bank->account_title }})</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6 status">
                                        <label class="form-label">BL Status</label>
                                        <select name="bl_status" id="bl_status" class="form-select form-select-sm" required>
                                            <option selected value="">-- Select --</option>
                                            <option value="Duty Paid">Duty Paid</option>
                                            <option value="DO Waiting">DO Waiting</option>
                                            <option value="Active for Lifting">Active for Lifting</option>
                                            <option value="Lifting Completed">Lifting Completed</option>
                                        </select>
                                        </div>
                                    
                                    <div class="col-md-12 d-none">
                                        <button type="button" class="btn btn-sm btn-primary bl-attachment">BL Attachments</button>
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
            <!--end: Card Body-->
        </div>
     <!--end::Table widget 14-->
            </div>

    <div class="col-lg-8">
                {{-- All BLs --}}
        <div class="card card-flush mt-5 h-md-100">
            <div class="card-body px-4 pt-4">
                <div class="bulk-action mb-2 row">
                    <div class="col-md-6" id="move_terminal" style="visibility: hidden;">
                        <select name="move_terminal" class="form-select form-select-sm">
                            <option selected disabled value="">-- Select Terminal --</option>
                            @foreach ($all_terminals as $terminal)
                                <option value="{{ $terminal->id }}">{{ $terminal->code }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <button type="button" id="move-terminal-btn" class="btn btn-danger btn-sm" style="visibility: hidden;"><span id="num_bls"></span> Move</button>
                    </div>
                </div>

                <div class="nav bg-light rounded-pill" style="width: max-content !important;">
                    <div class="row">
                        <div class="col-md-6">
                            <select id="filter-product" class="form-select form-select-sm">
                                <option selected value="">Search Product</option>
                                @foreach ($products as $product)
                                    <option>{{ $product->code }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select id="filter-terminal" class="form-select form-select-sm">
                                <option selected value="">Search Terminal</option>
                                @foreach ($terminals as $terminal)
                                    <option>{{ $terminal->code }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>

                <table class="table align-middle table-row-bordered table-hover mt-5" id="bl-table">
                    <thead class="bg-secondary fw-bold">
                        <tr>
                            <th><input type="checkbox" id="select-all" class="form-check-input border-dark"></th>
                            <th>P</th>
                            <th>T</th>
                            <th>BL#</th>
                            <th>BL Qty</th>
                            <th>L Qty</th>
                            <th>Shortage</th>
                            <th>Unlifted</th>
                            <th>Unsold</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="bls-tbody">
                        
                    </tbody>
                    <tfoot class="fw-bold">
                        <th>Total</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th id="bl-qty-total"></th>
                        <th id="landed-qty-total"></th>
                        <th id="shortage-total"></th>
                        <th id="lifted-qty-total"></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tfoot>
                </table>
            </div>
        </div>
    {{-- End BLs --}}
            </div>

          </div>


    {{-- Commingle Modal --}}
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Commingle BL</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="commingle-body">
                
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" onclick="$('#commingle-save-form').submit();" class="btn btn-primary">Save</button>
            </div>
        </div>
        </div>
    </div>



  {!! theme()->addVendor('formrepeater') !!}
  @push('scripts')
  <script src="https://malsup.github.io/jquery.form.js"></script> 
  <script src="https://cdn.datatables.net/plug-ins/2.0.5/api/sum().js"></script>
  @if (Session::has('warning'))
    <script>
        swal("{{ Session::get('warning') }}","","warning");
    </script>
  @elseif(Session::has('success'))
    <script>
        swal("{{ Session::get('success') }}","","success");
    </script>
  @endif

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
        $(document).on("click",".add-new-card", function () {
            $('.new-inv-stock').modal('toggle');
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
              var shortage_percentage = shortage * 100 / bl_quantity;
              $(this).closest('.row').find('.shortage-input').val(shortage.toFixed(3));
              $(this).closest('.row').find('.shortage-input-percentage').val(parseFloat(shortage_percentage).toFixed(2));
          });

          $(document).on("keyup",".input_landed_quantity", function () {
              var landed_quantity = $(this).val();
              var bl_quantity = $(this).closest('.row').find('.input_bl_quantity').val();
              var shortage = bl_quantity - landed_quantity;
              var shortage_percentage = shortage * 100 / bl_quantity;
              $(this).closest('.row').find('.shortage-input').val(shortage.toFixed(3));
              $(this).closest('.row').find('.shortage-input-percentage').val(parseFloat(shortage_percentage).toFixed(2));                
          });
      </script>

      <script>
          $(document).on("blur",".input_landed_quantity", function () {
           var this_shortage = $(this).closest('.row').find('.shortage-input').val();
           var current_shortage = "{{ $inventory->shortage() }}";
           var vessel_shortage = "{{ $inventory->vessel_shortage }}";
           var total = parseInt(this_shortage) + parseInt(current_shortage);
        });
      </script>

      <script>
        $(document).on("blur",".input_terminal_quantity", function () {
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
                    paging: false,
                    destroy: true,
                    ordering: true,
                    ajax: "{{ route('inventories.show',$inventory->id) }}",
                    columns: [
                        {data: 'checkbox', name: "checkbox", orderable: false, searchable: false},
                        //{data: 'serial_number', name: 'serial_number'},
                        {data: 'product_name', name: 'product_name'},
                        {data: 'terminal_name', name: 'terminal_name'},
                        {data: 'bl_number', name: 'bl_number'},
                        {data: 'bl_quantity', name: 'bl_quantity'},
                        {data: 'landed_quantity', name: 'landed_quantity'},
                        {data: 'shortage', name: 'shortage'},
                        {data: 'lifted', name: 'lifted'},
                        {data: 'balance_qty', name: 'balance_qty'},
                        {data: 'bl_status', name: 'bl_status'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ],
                    "initComplete": function(settings, json) {
                        var bl_qty = json.bl_qty;    
                        $('#bl-qty-total').text(bl_qty);

                        var landed_qty = json.landed_qty;    
                        $('#landed-qty-total').text(landed_qty);

                        var bl_shortage = json.bl_shortage;    
                        $('#shortage-total').text(bl_shortage.toFixed(3));

                        var lifted_qty = json.lifted_qty;    
                        $('#lifted-qty-total').text(lifted_qty);
                    },
                    "footerCallback": function (row, data, start, end, display) {
                        let api = this.api();
                 
                        // Remove the formatting to get integer data for summation
                        let intVal = function (i) {
                            return typeof i === 'string'
                                ? i.replace(/[\$,]/g, '') * 1
                                : typeof i === 'number'
                                ? i
                                : 0;
                        };
                 
                        // Total over all pages
                        total = api
                            .column(8)
                            .data()
                            .reduce((a, b) => intVal(a) + intVal(b), 0);
                        // Update footer
                        api.column(8).footer().innerHTML = total.toFixed(3);
                    }
                    });

            $('.search_products').on('click', function() {
                var name = $(this).attr('data-name');
                table.column(2).search(name).draw();
                $(this).removeClass('btn-light').addClass('btn-primary');
                $('.search_products').not(this).removeClass('btn-primary').addClass('btn-light');
                $("#product_id option:contains("+name+")").prop("selected", true);
            });

            $(document).on('click',"#filter-product", function() {
                var code = $(this).find(':selected').val();
                table.column(1).search(code).draw();
            });

            $(document).on('click',"#filter-terminal", function() {
                var code = $(this).find(':selected').val();
                table.column(2).search(code).draw();
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
                terminal_qty += parseFloat($(this).val());
            });
            if (terminal_qty == landed_qty) {
                $("#bls-form").ajaxSubmit(
                    {
                        url: "{{ route('inventory.bls.add',$inventory->id) }}",
                        type: 'post',
                        success: function(response) { 
                            swal("BL Added Successfully!", "", "success");
                            $('#bls-form')[0].reset();
                            $('#product_id option[value='+product_id+']').attr('selected','selected');
                            $('#terminal_id option[value='+terminal_id+']').attr('selected','selected');
                            BlDataTable();
                            $('.bl-attachment').text('BL Attachments');
                        },
                        error: function(xhr, textStatus, error) {
                            var error_msg = JSON.parse(xhr.responseText);
                            if (error_msg.error) {
                                swal(""+ error_msg.error +"", "", "warning");
                            }
                            else if(error_msg.message) {
                                swal(""+ error_msg.message +"", "", "warning");
                            }
                            else {
                                swal("Error Occured!", "", "warning");
                            }
                         }
                    }
                );
            }
            else {
                swal("Please make sure that Terminal Quantity should be equal to landed quantity!", "", "warning");
            }
        });

        $(document).on("click","#move-terminal-btn", function () {
            var terminal_id = $('select[name="move_terminal"]').find(':selected').val();
            var bls = [];
            $('.select-bl:checked').each(function() {
                bls.push($(this).attr('data-id'));
            });
            
            $.ajax({
                type: "GET",
                url: "{{ url('edit-bl-terminal') }}",
                data: {
                    terminal_id : terminal_id,
                    bls : bls
                },
                success: function (response) {
                    swal(response.success,"","success");
                    BlDataTable();
                    $('#move-terminal-btn').css('visibility','hidden');
                    $('#move_terminal').css('visibility','hidden');
                    $('#select-all').prop('checked',false)
                    $('#left-card').show();
                },
                error: function(xhr, textStatus, error) {
                    var error_msg = JSON.parse(xhr.responseText);
                    if (error_msg.error) {
                        swal(""+ error_msg.error +"", "", "warning");
                    }
                    else {
                        swal("Error Occured!", "", "warning");
                    }
                }
            });
        });
    </script>

    <script>
        $(document).on("click",".stock-card", function () {
            var product_id = $(this).find('.prod-termi').attr('data-pro');
            var terminal_id = $(this).find('.prod-termi').attr('data-termi');

            $('#product_id option').removeAttr('selected');
            $('#product_id option[value='+product_id+']').attr('selected','selected');
            $('#terminal_id option').removeAttr('selected');
            $('#terminal_id option[value='+terminal_id+']').attr('selected','selected');
        });
    </script>

    <script>
        $(document).on("click","#select-all", function () {
            if ($(this).is(':checked')) {
                $('.select-bl').prop('checked',true)
                $('#move-terminal-btn').css('visibility','visible');
                $('#move_terminal').css('visibility','visible');
                var num_bls = $('.select-bl').length;
                $('#num_bls').text('('+num_bls+')');
                $('#left-card').hide();
            }
            else {
                $('.select-bl').prop('checked',false)
                $('#move-terminal-btn').css('visibility','hidden');
                $('#move_terminal').css('visibility','hidden');
                $('#left-card').show();
            }
        });

        $(document).on("click",".select-bl", function () {
            var checkeds =  $('.select-bl:checked').length;
            
            if (checkeds > 0) {
                $('#move-terminal-btn').css('visibility','visible');
                $('#move_terminal').css('visibility','visible');
                $('#num_bls').text('('+checkeds+')');
                $('#left-card').hide();
            }
            else {
                $('#move-terminal-btn').css('visibility','hidden');
                $('#move_terminal').css('visibility','hidden');
                $('#left-card').show();
            }
        });
    </script>

    <script>
        $(document).on("click",".edit-bl", function () {
            
            var url = $(this).attr('data-info');
            var action = $(this).attr('data-route');
            $(this).closest("tr").addClass('bg-secondary');

            
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
                        $('#edit-bl-form').find('#bl_status option[value="'+data.bl_status+'"]').attr('selected','selected');
                        $('#edit-bl-form').find('#payment_method option[value="'+data.payment_method+'"]').attr('selected','selected');
                        $('#edit-bl-form').find('#bank_account option[value="'+data.bank_id+'"]').attr('selected','selected');
                        $('#edit-bl-form').find('input[name="date"]').val(data.date);
                        $('#edit-bl-form').find('input[name="bl_number"]').val(data.bl_number);
                        //$('#edit-bl-form').find('input[name="serial_number"]').val(data.serial_number);
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
            var landed_qty = $(this).closest('form').find('.input_landed_quantity').val();
            var terminal_qty = 0;
            $(this).closest('form').find('.all-terminal-qty').each(function (i, j) {
                terminal_qty += parseFloat($(this).val());
            });

        // if (terminal_qty == landed_qty) {
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
                    swal("Error Occured!","","warning");
                }
            });
        // }
        // else {
        //     swal("Please make sure that terminal qty should be equal to landed qty!","","warning");
        // }
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

    <script>
        // Edit Commingle
        $(document).on("click",".commingle-btn", function () {
            var route = $(this).attr('data-route');

            $.ajax({
                type: "GET",
                url: route,
                data: {},
                success: function (response) {
                    $('#commingle-body').html(response);
                    $('#exampleModal').modal('toggle');
                }
            });
        });

        // Add Commingle Item
        $(document).on("click",".add-commingle-item", function () {
            var content = '' + 
            '<div class="border-1 rounded-3 my-5 border-secondary border p-3 border-secondary added-commingle" data-repeater-item="">' + 
            '  <div class="form-group row gy-3">' + 
            '    <div class="col-md-12 text-end"><a href="javascript:;" class="btn btn-sm btn-light-danger mt-3 mt-md-8 delete-commingle-item">' + 
            '        <i class="ki-duotone ki-trash fs-5"><span' + 
            '            class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span' + 
            '            class="path5"></span></i>Delete</a></div>' + 
            '<input type="hidden" name="commingle_id[]" value="0">' +
            '    <div class="col-md-12"><label class="form-label">Commingle Terminal</label>' + 
            '      <select name="commingle_terminal_id[]" id="commingle_terminal" class="form-select" required="">' + 
            '        <option selected="" value="">-- Select --</option>' + 
            ' @foreach($all_terminals as $terminal) <option value="{{ $terminal->id }}">{{ $terminal->code }}</option> @endforeach' +
            '      </select></div>' +
            '    <div class="col-md-12">' +
            '        <label class="form-label">Terminal Quantity:</label>' + 
            '        <input type="number" required name="commingle_quantity[]" class="form-control mb-2 mb-md-0" placeholder="Enter Terminal Quantity" step=".0001">' + 
            '      </div>' + 
            '  </div>' + 
            '</div>' + 
            '';
            $('.commingle-item:last').after(content);
        });
    </script>

    <script>
        $(document).on("click",".delete-commingle-item", function () {
            $(this).closest(".added-commingle").slideUp();
            setTimeout(() => {
                $(this).closest(".added-commingle").remove();
            }, 1000);
        });
    </script>
    <script>
        $(document).on("click",".destroy-commingle", function () {
            var route = $(this).attr('data-route');
            var $t = $(this);
            $.ajax({
                type: "GET",
                url: route,
                data: {},
                success: function (response) {
                    $t.closest(".commingle-item").slideUp();
                    setTimeout(() => {
                        $t.closest(".commingle-item").remove();
                    }, 500);
                    swal(response.success,"","success");                    
                }
            });
        });
    </script>
  @endpush
</x-default-layout>