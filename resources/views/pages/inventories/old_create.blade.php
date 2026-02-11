<x-default-layout>
    <!--begin::Table widget 14-->
    <div class="card card-flush h-md-100">
        <!--begin::Header-->
        <div class="card-header pt-7">
            <!--begin::Title-->
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold text-gray-800">Add New Inventory</span>
            </h3>
            <!--end::Title-->
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body pt-6">
            <form class="pt-1" method="POST" action="/inventories" enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-md-3 seller">
                        <label for="company_id" class="form-label">Seller <span class="text-danger">*</span></label>
                        <select autocomplete="off" class="form-select form-select-lg mb-4" required name="company_id">
                            @foreach ($sellers as $seller)
                                <option value="{{ $seller->id }}">{{ $seller->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 buyer">
                        <label for="vessel_id" class="form-label">Buyer <span class="text-danger">*</span></label>
                        <select autocomplete="off" class="form-select form-select-lg mb-4" name="buyer_id">
                            <option>-- Select Business --</option>
                            @foreach ($buyers as $buyer)
                                <option value="{{ $buyer->id }}">{{ $buyer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 product">
                        <label for="product_id" class="form-label">Product <span class="text-danger">*</span></label>
                        <select autocomplete="off" class="form-select form-select-lg mb-4" required name="product_id">
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 voyage">
                        <label for="voyage_number" class="form-label">Voyage Number  <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg border-dark"
                            placeholder="Voyage Number" name="voyage_number" required />
                    </div>

                    
                    <div class="col-md-3 vessel">
                        <label for="vessel_id" class="form-label">Vessel <span class="text-danger">*</span></label>
                        <select autocomplete="off" class="form-select form-select-lg mb-4" required name="vessel_id">
                            @foreach ($vessels as $vessel)
                                <option value="{{ $vessel->id }}">{{ $vessel->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-md-3 terminal">
                        <label for="terminal_id" class="form-label">Terminal <span class="text-danger">*</span></label>
                        <select autocomplete="off" class="form-select form-select-lg mb-4" required name="terminal_id">
                            @foreach ($terminals as $terminal)
                                <option value="{{ $terminal->id }}">{{ $terminal->code }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 clearing-agent">
                        <label for="clearing_agent" class="form-label">Clearing Agent <span class="text-danger">*</span></label>
                        <select autocomplete="off" class="form-select form-select-lg mb-4" required name="clearing_agent_id">
                            @foreach ($clearing_agents as $clearing_agent)
                                <option value="{{ $clearing_agent->id }}">{{ $clearing_agent->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 surveyor">
                        <label for="clearing_agent" class="form-label">Surveyor <span class="text-danger">*</span></label>
                        <select autocomplete="off" class="form-select form-select-lg mb-4" required name="surveyor_id">
                            @foreach ($surveyors as $surveyor)
                                <option value="{{ $surveyor->id }}">{{ $surveyor->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3 mb-3 igm-date">
                                <label for="igm_date" class="form-label">IGM Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control form-control-lg" name="igm_date" required />
                            </div>
        
                            <div class="col-md-3 mb-3 arrival-date">
                                <label for="arrival_date" class="form-label">Arrival Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control form-control-lg" name="arrival_date" required />
                            </div>

                            <div class="col-md-6 text-end">
                                <br>
                                <div class="form-check form-check-solid form-check-custom form-switch mt-4">
                                    <input class="form-check-input w-45px h-30px" name="active_contract" type="checkbox"
                                        value="1" id="googleswitch">
                                    <label class="form-check-label text-dark" for="googleswitch">Active for Contract</label>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Summary</label>
                        <input type="file" name="summary" class="form-control mb-2 mb-md-0" />
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Pro Data</label>
                        <input type="file" name="pro_data" class="form-control mb-2 mb-md-0"  />
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Survey Report</label>
                        <input type="file" name="survey_report" class="form-control mb-2 mb-md-0" />
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

                                    <div class="col-md-12 provisional-price">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="form-label">Provisional Price: <span class="text-danger">*</span></label>
                                                <input type="number" required name="provisional_price" class="provisional_price form-control mb-2 mb-md-0"
                                                        placeholder="Enter Provisional Price" required />
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 doc-com">
                                        <label class="form-label">Commercial Invoice</label>
                                        <input type="file" name="commercial_invoice"
                                            class="form-control mb-2 mb-md-0" placeholder="Enter BL Document"
                                             />
                                    </div>
                                    <div class="col-md-4 doc-bl">
                                        <label class="form-label">BL</label>
                                        <input type="file" name="bl" class="form-control mb-2 mb-md-0"
                                            placeholder="Enter BL Document" />
                                    </div>
                                    <div class="col-md-4 doc-ship">
                                        <label class="form-label">Shipping DO</label>
                                        <input type="file" name="shipping_do" class="form-control mb-2 mb-md-0"
                                            placeholder="Enter BL Document" />
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
                            Add Another BL
                        </a>
                    </div>
                    <!--end::Form group-->
                </div>
                <!--end::Repeater-->
                <div class="text-center">
                    <button type="submit" class="btn btn-lg btn-light fw-bold btn-primary me-2"
                        data-kt-search-element="advanced-options-form-cancel">Add</button>
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
    @endpush
</x-default-layout>
