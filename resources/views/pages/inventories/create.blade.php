<x-default-layout>
<style>
    input[type='text'],
    input[type='date'],
    input[type='number'],
    textarea,
    select {
        background:#f5f8fa !important;
    }
</style>
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container">

            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    Add New Inventory
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
                        Add Inventory </li>
                    <!--end::Item-->

                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->

        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->

    <form class="pt-1" method="POST" action="/inventories" id="add-inv-form" enctype="multipart/form-data">

    <div class="row">
        <div class="col-md-6">
            <div class="card card-flush h-md-100">
                
                <!--begin::Body-->
                <div class="card-body pt-6">
                    <h4 class="mb-4">Vessel Details</h4>
                        @csrf
                        <div class="row">
                                    <div class="col-md-6">
                                        <label for="" class="form-label">Trans. Type<span class="text-danger">*</span></label>
                                        <select autocomplete="off" class="form-select form-select-sm mb-4" id="transaction_type" name="transaction_type" required>
                                            <option disabled selected value="">-- Please Select --</option>
                                            <option {{ old('transaction_type') == 'Normal' ? 'selected' : '' }} value="Normal">Normal</option>
                                            <option {{ old('transaction_type') == 'Barter' ? 'selected' : '' }} value="Barter">Barter</option>
                                            <option {{ old('transaction_type') == 'Temporary' ? 'selected' : '' }} value="Temporary">Temporary</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="form-label">Local/Import. <span class="text-danger">*</span></label>
                                        <select autocomplete="off" class="form-select form-select-sm mb-4" id="inv-type" name="type" required>
                                            <option disabled selected value="">-- Please Select --</option>
                                            <option {{ old('type') == 'Local' ? 'selected' : '' }} value="Local">Local</option>
                                            <option {{ old('type') == 'Import' ? 'selected' : '' }} value="Import">Import</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 seller">
                                        <label for="company_id" class="form-label">Seller <span class="text-danger">*</span></label>
                                        <select autocomplete="off" class="form-select form-select-sm mb-4" required name="company_id">
                                            <option value="">-- Select Seller --</option>
                                            @foreach ($sellers as $seller)
                                                <option {{ old('company_id') == $seller->id ? 'selected' : '' }} value="{{ $seller->id }}">{{ $seller->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 buyer">
                                        <label for="vessel_id" class="form-label">Buyer <span class="text-danger">*</span></label>
                                        <select autocomplete="off" class="form-select form-select-sm mb-4" name="buyer_id">
                                            <option>-- Select Business --</option>
                                            @foreach ($buyers as $buyer)
                                                <option {{ old('buyer_id') == $buyer->id ? 'selected' : '' }} value="{{ $buyer->id }}">{{ $buyer->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 vessel">
                                        <label for="vessel_id" class="form-label">Vessel <span class="text-danger">*</span></label>
                                        <select autocomplete="off" class="form-select form-select-sm mb-4" required name="vessel_id">
                                            <option value="">-- Select Vessel --</option>
                                            @foreach ($vessels as $vessel)
                                                <option {{ old('vessel_id') == $vessel->id ? 'selected' : '' }} value="{{ $vessel->id }}">{{ $vessel->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 voyage" id="voyage">
                                        <label for="voyage_number" class="form-label">Voyage Number </label>
                                        <input type="text" class="form-control form-control-sm"
                                            placeholder="Voyage Number" value="{{ old('voyage_number') }}" name="voyage_number" />
                                    </div>
                                    <div class="col-md-6 purchase_contract d-none">
                                        <label for="" class="form-label">Purchase Contract #<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm"
                                            placeholder="" name="purchase_contract" disabled />
                                    </div>
                                    <div class="col-md-6 chartered_party">
                                        <label for="" class="form-label">Chartered Party</label>
                                        <input type="text" class="form-control form-control-sm" value="{{ old('chartered_party') }}" name="chartered_party" />
                                    </div>
                                    <div class="col-md-6 vessel_qty">
                                        <label for="" class="form-label">Vessel Qty. <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control form-control-sm" value="{{ old('vessel_qty') }}" name="vessel_qty" step="0.001" required />
                                    </div>
                                    <div class="col-md-6 vessel_shortage">
                                        <div class="mt-2">
                                            <label for="" class="form-label">Vessel Shortage </label>
                                            <input type="number" class="form-control form-control-sm" value="{{ old('vessel_shortage') }}" step="0.001" name="vessel_shortage" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 clearing-agent">
                                        <div class="mt-2">
                                            <label for="clearing_agent" class="form-label">Clearing Agent</label>
                                            <select autocomplete="off" class="form-select form-select-sm mb-4" name="clearing_agent_id">
                                                <option value="">Select Clearing Agent</option>
                                                @foreach ($clearing_agents as $clearing_agent)
                                                    <option {{ old('clearing_agent_id') == $clearing_agent->id ? 'selected' : '' }} value="{{ $clearing_agent->id }}">{{ $clearing_agent->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3 igm-date" id="igm-date">
                                        <label for="igm_date" class="form-label">IGM Date</label>
                                        <input type="date" class="form-control form-control-sm" name="igm_date" value="{{ old('igm_date') }}" />
                                    </div>
                                    <div class="col-md-4 mb-3 arrival-date" id="arrival-date">
                                        <label for="arrival_date" class="form-label">Arrival Date</label>
                                        <input type="date" class="form-control form-control-sm" name="arrival_date" value="{{ old('arrival_date') }}" />
                                    </div>
                                    <div class="col-md-4 contract_date">
                                        <label for="" class="form-label">Contract Date</label>
                                        <input type="date" name="contract_date" class="form-control form-control-sm" value="{{ old('contract_date') }}">
                                    </div>
                                    <div class="col-md-6 surveyor">
                                        <label for="" class="form-label">Surveyor</label>
                                        <select autocomplete="off" class="form-select form-select-sm mb-4" name="surveyor_id">
                                            <option value="">-- Select Surveyor --</option>
                                            @foreach ($surveyors as $surveyor)
                                                <option {{ old('surveyor_id') == $surveyor->id ? 'selected' : '' }} value="{{ $surveyor->id }}">{{ $surveyor->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 align-items-center justify-content-center d-flex">
                                        <br>
                                        <div class="form-check form-check-solid form-check-custom form-switch mt-4">
                                            <input class="form-check-input w-45px h-30px" name="active_contract" type="checkbox"
                                                value="1" id="googleswitch" {{ old('active_contract') == 1 ? 'selected' : '' }}>
                                            <label class="form-check-label text-dark" for="googleswitch">Active for Contract</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 align-items-center justify-content-center d-flex mb-2">
                                        <button type="button" id="attachments-btn" class="btn btn-primary btn-sm"  data-bs-toggle="modal" data-bs-target="#Attachments">Attachments</button>
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

                                            <div class="col-md-4">
                                                <label class="form-label">Summary</label>
                                                <input type="file" accept="application/pdf, image/png, image/jpg, image/jpeg" name="summary" class="form-control mb-2 mb-md-0 doc-summary inv-docs" />
                                            </div>
                        
                                            <div class="col-md-4">
                                                <label class="form-label">Pro Data</label>
                                                <input type="file" accept="application/pdf, image/png, image/jpg, image/jpeg" name="pro_data" class="form-control mb-2 mb-md-0 doc-pro-data inv-docs"  />
                                            </div>
                        
                                            <div class="col-md-4">
                                                <label class="form-label">Survey Report</label>
                                                <input type="file" accept="application/pdf, image/png, image/jpg, image/jpeg" name="survey_report[]" class="form-control mb-2 mb-md-0 doc-survey-report inv-docs" multiple />
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mt-2">
                                                    <label class="form-label" for="">Remarks</label>
                                                    <input type="text" class="form-control" id="doc-remarks" value="" readonly>
                                                </div>
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
        
        <div class="col-md-6">
            <div class="card card-flush h-md-100">
                <div class="card-body pt-6">
                    <div>
                        <h4 class="mb-4">Product Terminal Stock</h4>
                            <!--begin::Repeater-->
                            <div class="form-group">
                                <div class="form-group row gy-3 ">
                                    <div class="col-md stock_product">
                                        <label class="form-label">Product</label>
                                    </div>
                                    <div class="col-md stock_terminal">
                                        <label class="form-label">Terminal</label>
                                    </div>
                                    <div class="col-md stock_terminal_qty">
                                        <label class="form-label">BL Qty.</label>
                                    </div>
                                    <div class="col-md stock_terminal_shortage">
                                        <label class="form-label">Shortage</label>
                                    </div>
                                    <div class="col-md">
                                    </div>
                                </div>
                            </div>
                            <div id="terminal_stock_repeater">
                                <!--begin::Form group-->
                                <div class="form-group">
                                    <div class="my-5" data-repeater-list="inventory_stock">

                                    <div class="border-1 rounded-3 my-5 border-secondary border p-3" data-repeater-item>
                                        <div class="form-group row gy-3 ">
                                            <div class="col-md stock_product">
                                                <select name="product_id" class="form-select form-select-sm pe-0" required>
                                                    <option selected value="">---</option>
                                                    @foreach ($products as $product)
                                                        <option value="{{ $product->id }}">{{ $product->code }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md stock_terminal">
                                                <select name="terminal_id" class="form-select form-select-sm pe-0">
                                                    <option selected value="">---</option>
                                                    @foreach ($terminals as $terminal)
                                                        <option value="{{ $terminal->id }}">{{ $terminal->code }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md stock_terminal_qty">
                                                <input type="number" name="terminal_quantity" class="form-control form-control-sm terminal-qty" step="0.001" required>
                                            </div>
                                            <div class="col-md stock_terminal_shortage">
                                                <input type="number" name="terminal_shortage" class="form-control form-control-sm terminal-shortage" step="0.001" required>
                                            </div>
                                            <div class="col-md">
                                                <a href="javascript:;" data-repeater-delete
                                                    class="btn btn-sm btn-light-danger">
                                                    <i class="fa fa-cancel fs-5"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>


                                    </div>
                                </div>
                                <!--end::Form group-->

                                <!--Start Total-->
                                <div class="border border-3 border-light">
                                    <div class="py-2 px-3 d-flex justify-content-end">
                                        <p class="me-4 mb-0">
                                            <small>
                                                <span class="fw-bold">Total Qty:</span>
                                                <span class="total-terminal-qty">0.000</span>
                                            </small>
                                        </p>
                                        <p class="mb-0">
                                            <small>
                                                <span class="fw-bold">Total Shortage:</span>
                                                <span class="total-terminal-shortage">0.000</span>
                                            </small>
                                        </p>
                                    </div>
                                </div>
                                <!--End Total-->

                                <!--begin::Form group-->
                                <div class="form-group mt-5">
                                    <a href="javascript:;" data-repeater-create class="btn btn-light-primary btn-sm">
                                        <i class="ki-duotone ki-plus fs-3"></i>
                                        Add Product Terminal Stock
                                    </a>
                                </div>
                                <!--end::Form group-->
                            </div>
                            <!--end::Repeater-->
                            <div class="mt-5 remarks">
                                <label for="" class="form-label">Remarks</label>
                                <textarea name="remarks" cols="30" rows="2" form="add-inv-form" class="form-control">{{ old('remarks') }}</textarea>
                            </div>

                    
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
        <input type="hidden" name="redirection_type" value="">
    <div class="text-center mt-5">
        <button type="submit" class="btn btn-md btn-light fw-bold btn-primary me-2 add-another">Submit & Add Another</button>
        <button type="submit" class="btn btn-md btn-light fw-bold btn-primary me-2">Submit</button>
    </div>
            </form>
    <!--end::Table widget 14-->
    {!! theme()->addVendor('formrepeater') !!}
    @push('scripts')
        <script>
            $(document).ready(function () {
                
                var inventoryStock = @json(old('inventory_stock'));
               
                var defaultItems = inventoryStock;
                console.log(defaultItems);
                var $repeater = $('#terminal_stock_repeater').repeater({
                    initEmpty: false,
    
                    show: function() {
                        $(this).slideDown();
                    },
    
                    hide: function(deleteElement) {
                        $(this).slideUp(deleteElement);
                    },
                    ready: function(setIndexes) {
                        setIndexes();
                    }
                });

                    if (inventoryStock != null) {
                        var $repeaterList = $repeater.find('[data-repeater-list="inventory_stock"]');
                        $.each(defaultItems,function(key, item) {
                            var $itemTemplate = $repeater.find('[data-repeater-item]').last().clone();
                            $itemTemplate.find('.stock_terminal_qty').find('input').val(item['terminal_quantity']);
                            $itemTemplate.find('.stock_terminal_shortage').find('input').val(item['terminal_shortage']);
                            $itemTemplate.find('.stock_product').find('select option[value="'+item['product_id']+'"]').prop('selected',true);
                            $itemTemplate.find('.stock_terminal').find('select option[value="'+item['terminal_id']+'"]').prop('selected',true);
                            $repeaterList.append($itemTemplate);
                        });

                        // Trigger the repeater to update the indexes
                        $repeater.repeater('setIndexes');

                        $repeaterList.find('[data-repeater-item]').each(function() {
                        var $item = $(this);
                        if (!$item.find('.stock_product select').val() && !$item.find('.stock_terminal select').val()) {
                            $item.remove();
                        }
                    });
                    }

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
                    var option = '<option disabled selected>-- Select --</option>' +
                    '<option value="Local">Local</option>';
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
    $(document).on("change",'.inv-docs', function () {
        
        var doc_summary = $(this).parents('.row').find('.doc-summary').val();
        var doc_pro_data = $(this).parents('.row').find('.doc-pro-data').val();
        var doc_survey_report = $(this).parents('.row').find('.doc-survey-report').val();
        
        var count = 0;
        var remarks = '';

        if (doc_summary !== '') {
            count++;
        }
        else {
            remarks += 'Summary Document,';
        }
        
        if (doc_pro_data !== '') {
        count++;
        }
        else {
            remarks += 'Pro Data Document,';
        }
        
        if (doc_survey_report !== '') {
        count++;
        }
        else {
            remarks += 'Survey Report Document';
        }

        $('#doc-remarks').val(remarks + ' Not Attached!');
        $('#attachments-btn').text(count + ' File Attached');

    });
  </script>

  <script>
        $(document).on("keyup",".terminal-qty", function () {
            var terminal_qty = 0;
            $('.terminal-qty').each(function (index, element) {
                terminal_qty += parseFloat($(element).val());
            });

            $('.total-terminal-qty').text(terminal_qty.toFixed(3));
        });

        $(document).on("keyup",".terminal-shortage", function () {
            var terminal_shortage = 0;
            $('.terminal-shortage').each(function (index, element) {
                terminal_shortage += parseFloat($(element).val());
            });

            $('.total-terminal-shortage').text(terminal_shortage.toFixed(3));
        });
  </script>

  <script>
    $(document).on("click",".add-another", function () {
        $('input[name="redirection_type"]').val('add-another');
    });
  </script>
  <script>
    // swal("dwds","","warning")
  </script>
  @if (Session::has('error'))
    <script>
        swal("{{ Session::get('error') }}","","warning")
    </script>
    <script>
         $('#inv-type').trigger('change');
    </script>
  @endif
    @endpush
</x-default-layout>