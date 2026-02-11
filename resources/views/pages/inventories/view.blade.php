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
  
  
      <div class="row">
          <div class="col-md-6">
              <div class="card card-flush h-md-100">
                  
                  <!--begin::Body-->
                  <div class="card-body pt-6">
                          @csrf
                          <div class="row">
                            <div class="col-md-6">
                                <label for="" class="form-label">Trans. Type</label>
                                <select autocomplete="off" class="form-select form-select-sm mb-4" id="transaction_type" name="transaction_type" disabled>
                                    <option disabled selected value="">-- Please Select --</option>
                                    <option {{ $inventory->transaction_type == 'Normal' ? 'selected' : '' }} value="Normal">Normal</option>
                                    <option {{ $inventory->transaction_type == 'Barter' ? 'selected' : '' }} value="Barter">Barter</option>
                                    <option {{ $inventory->transaction_type == 'Temporary' ? 'selected' : '' }} value="Temporary">Temporary</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Local/Import. </label>
                                <select autocomplete="off" class="form-select form-select-sm mb-4" id="inv-type" name="type" disabled>
                                    <option disabled selected value="">-- Please Select --</option>
                                    <option {{ $inventory->type == 'Local' ? 'selected' : '' }} value="Local">Local</option>
                                    <option {{ $inventory->type == 'Import' ? 'selected' : '' }} value="Import">Import</option>
                                </select>
                            </div>
                            <div class="col-md-6 seller">
                                <label for="company_id" class="form-label">Seller </label>
                                <select autocomplete="off" class="form-select form-select-sm mb-4" disabled name="company_id">
                                    @foreach ($sellers as $seller)
                                    <option value="{{ $seller->id }}"
                                        {{ $seller->id == $inventory->company_id ? 'selected' : '' }}>{{ $seller->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 buyer">
                                <label for="vessel_id" class="form-label">Buyer </label>
                                <select autocomplete="off" class="form-select form-select-sm mb-4" name="buyer_id" disabled>
                                    <option>-- Select Business --</option>
                                    @foreach ($buyers as $buyer)
                                    <option value="{{ $buyer->id }}"
                                        {{ $buyer->id == $inventory->buyer_id ? 'selected' : '' }}>{{ $buyer->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 vessel">
                                <label for="vessel_id" class="form-label">Vessel </label>
                                <select autocomplete="off" class="form-select form-select-sm mb-4" disabled name="vessel_id">
                                    @foreach ($vessels as $vessel)
                                    <option value="{{ $vessel->id }}"
                                        {{ $vessel->id == $inventory->vessel_id ? 'selected' : '' }}>{{ $vessel->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 voyage" id="voyage">
                                <label for="voyage_number" class="form-label">Voyage Number  </label>
                                <input type="text" class="form-control form-control-sm"
                                    placeholder="Voyage Number" name="voyage_number" value="{{ $inventory->voyage_number }}" disabled />
                            </div>
                            <div class="col-md-6 purchase_contract d-none">
                                <label for="" class="form-label">Purchase Contract #</label>
                                <input type="text" class="form-control form-control-sm"
                                    placeholder="" name="purchase_contract" value="{{ $inventory->purchase_contract }}" disabled />
                            </div>
                            <div class="col-md-6 chartered_party">
                                <label for="" class="form-label">Chartered Party</label>
                                <input type="text" class="form-control form-control-sm" value="{{ $inventory->chartered_party }}" name="chartered_party" disabled />
                            </div>
                            <div class="col-md-6 vessel_qty">
                                <label for="" class="form-label">Vessel Qty. </label>
                                <input type="number" class="form-control form-control-sm" value="{{ $inventory->vessel_qty }}" name="vessel_qty" disabled />
                            </div>
                            <div class="col-md-6 vessel_shortage">
                                <div class="mt-2">
                                    <label for="" class="form-label">Vessel Shortage </label>
                                    <input type="number" class="form-control form-control-sm" value="{{ $inventory->vessel_shortage }}" name="vessel_shortage" disabled />
                                </div>
                            </div>
                            <div class="col-md-6 clearing-agent">
                                <div class="mt-2">
                                    <label for="clearing_agent" class="form-label">Clearing Agent </label>
                                    <select autocomplete="off" class="form-select form-select-sm mb-4" disabled name="clearing_agent_id">
                                        @foreach ($clearing_agents as $clearing_agent)
                                        <option value="{{ $clearing_agent->id }}"
                                            {{ $clearing_agent->id == $inventory->clearing_agent_id ? 'selected' : '' }}>
                                            {{ $clearing_agent->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3 igm-date" id="igm-date">
                                <label for="igm_date" class="form-label">IGM Date </label>
                                <input type="date" class="form-control form-control-sm" value="{{ $inventory->igm_date }}" name="igm_date" disabled />
                            </div>
                            <div class="col-md-4 mb-3 arrival-date" id="arrival-date">
                                <label for="arrival_date" class="form-label">Arrival Date </label>
                                <input type="date" class="form-control form-control-sm" value="{{ $inventory->arrival_date }}" name="arrival_date" disabled />
                            </div>
                            <div class="col-md-4 contract_date">
                                <label for="clearing_agent" class="form-label">Contract Date</label>
                                <input type="date" name="contract_date" value="{{ $inventory->contract_date }}" class="form-control form-control-sm" disabled>
                            </div>
                            <div class="col-md-6 surveyor">
                                <label for="clearing_agent" class="form-label">Surveyor </label>
                                <select autocomplete="off" class="form-select form-select-sm mb-4" disabled name="surveyor_id">
                                    @foreach ($surveyors as $surveyor)
                                    <option value="{{ $surveyor->id }}"
                                        {{ $surveyor->id == $inventory->surveyor_id ? 'selected' : '' }}>
                                        {{ $surveyor->title }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 align-items-center justify-content-center d-flex">
                                <br>
                                <div class="form-check form-check-solid form-check-custom form-switch mt-4">
                                    <input class="form-check-input w-45px h-30px" name="active_contract" type="checkbox"
                                        value="1" id="googleswitch" {{ $inventory->active_contract == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label text-dark" for="googleswitch">Active for Contract</label>
                                </div>
                            </div>
                        </div>


                    
                    {{-- Start Attachment Modal --}}
                    
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
                                          <label class="form-label">Quantity</label>
                                      </div>
                                      <div class="col-md stock_terminal_shortage">
                                          <label class="form-label">Shortage</label>
                                      </div>
                                      <div class="col-md">
                                      </div>
                                  </div>
                              </div>
                              <div id="kt_docs_repeater_basic">
                                  <!--begin::Form group-->
                                  <div class="form-group">
                                      <div class="my-5" data-repeater-list="inventory_stock">
                                        @foreach ($stocks as $stock)
                                            <div class="border-1 rounded-3 my-5 border-secondary border p-3">
                                                <div class="form-group row gy-3 ">
                                                    <div class="col-md-3 stock_product">
                                                        <select name="product_id" class="form-select form-select-sm" disabled>
                                                            <option selected value="">---</option>
                                                            @foreach ($products as $product)
                                                                <option {{ $stock->product_id == $product->id ? 'selected' : '' }} value="{{ $product->id }}">{{ $product->code }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3 stock_terminal">
                                                        <select name="terminal_id" class="form-select form-select-sm" disabled>
                                                            <option selected value="">---</option>
                                                            @foreach ($terminals as $terminal)
                                                                <option {{ $stock->terminal_id == $terminal->id ? 'selected' : '' }} value="{{ $terminal->id }}">{{ $terminal->code }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3 stock_terminal_qty">
                                                        <input type="number" name="terminal_quantity" value="{{ $stock->terminal_quantity }}" class="form-control form-control-sm" disabled>
                                                    </div>
                                                    <div class="col-md-3 stock_terminal_shortage">
                                                        <input type="number" name="terminal_shortage" value="{{ $stock->terminal_shortage }}" class="form-control form-control-sm" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                      </div>
                                  </div>
                                  <!--end::Form group-->

                                  <!--Start Total-->
                                  <div class="border border-3 border-light">
                                    <div class="py-2 px-3 d-flex justify-content-end">
                                        <p class="me-4 mb-0">
                                            <small>
                                                <span class="fw-bold">Total Qty:</span>
                                                <span class="total-terminal-qty">
                                                    @isset($inventory->stocks)
                                                    {{ number_format($inventory->stocks->sum('terminal_quantity'),3) }}
                                                    @endisset 
                                                </span>
                                            </small>
                                        </p>
                                        <p class="mb-0">
                                            <small>
                                                <span class="fw-bold">Total Shortage:</span>
                                                <span class="total-terminal-shortage">
                                                    @isset($inventory->stocks)
                                                    {{ number_format($inventory->stocks->sum('terminal_shortage'),3) }}
                                                    @endisset
                                                </span>
                                            </small>
                                        </p>
                                    </div>
                                </div>
                            <!--End Total-->
  
                              </div>
                              <!--end::Repeater-->
                      
                          </div>
                  </div>
              </div>
          </div>
      </div>
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
  
          if (doc_summary !== '') {
          count++;
          }
          
          if (doc_pro_data !== '') {
          count++;
          }
          
          if (doc_survey_report !== '') {
          count++;
          }
  
          $('#attachments-btn').text(count + ' File Attached');
  
      });
    </script>
      @endpush
  </x-default-layout>