<x-default-layout>
  <style>
  tr > td:nth-child(1) {
  font-weight: bold !important;
  }
  .tab-pane table {
  min-width:600px;
  }
  td {
  padding: .5rem !important;
  }
  td.text-end {
  padding-left:3rem;
  }
  </style>
<div id="kt_app_toolbar_container" class="my-5 container-xxl d-flex flex-stack ">
  <!--begin::Page title-->
  <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
     <!--begin::Title-->
     <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
        Calculator
     </h1>
     <!--end::Title-->
     <!--begin::Breadcrumb-->
     <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">
           <a href="/" class="text-muted text-hover-primary">
           Dashboard</a>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item">
           <span class="bullet bg-gray-500 w-5px h-2px"></span>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">
           Calculator                                            
        </li>
        <!--end::Item-->
     </ul>
     <!--end::Breadcrumb-->
  </div>
  <!--end::Page title-->
  <!--begin::Actions-->
  <div class="d-flex align-items-center gap-2 gap-lg-3">
     <!--begin::Filter menu-->
     <div class="m-0">
        <!--begin::Menu toggle-->
        <a href="/options" class="btn btn-sm btn-flex btn-secondary fw-bold">               
        Manage Configuration
        </a>
        <!--end::Menu toggle-->        
     </div>
     <!--end::Filter menu-->
     <!--begin::Secondary button-->
     <!--end::Secondary button-->
  </div>
  <!--end::Actions-->
</div>

  <!--begin::Table widget 14-->
  <div class="card card-flush">
    <div class="card-body">
      <form action="" method="post" id="calculate-form">
        <div class="row">
          <div class="col-md-3 mb-4">
            <label for="" class="form-label">Product</label>
            <select name="" id="product" name="product" class="form-select">
              <option value="palm_olein">PALM OLEIN</option>
              <option value="rbd_oil">RBD-PALM OIL</option>
            </select>
          </div>
          <div class="col-md-8 offset-md-1">
            <div class="row">
              <div class="col-md-3">
                <div class="mb-4">
                  <label class="form-label" for="">Invoice Value</label>
                  <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">$</span>
                    <input type="number" class="form-control inv_val" id="inv_val" required placeholder="0.000" step=".00001" value="">
                  </div>
                </div>
                <label class="form-label" for="">Exchange Rate <small>(Supplier Payment)</small></label>
                <div class="input-group">
                  <span class="input-group-text" id="basic-addon1">PKR</span>
                  <input type="number" class="form-control supply_payment" required id="supply_payment" placeholder="0.00" value="">
                </div>
              </div>
              <div class="col-md-3">
                <div class="mb-4">
                  <label class="form-label" for="">Today Market Rate</label>
                  <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">PKR</span>
                    <input type="number" id="today_market_input" class="form-control" required placeholder="0.00" value="">
                  </div>
                </div>
                <label class="form-label" for="">LC / CAD /<br> Other Charges</label>
                <select name="" class="form-select lc_cad" id="" required>
                  <option value="0.25">LC</option>
                  <option value="0.45">CAD</option>
                  <option value="other">Other ($ Rate / MT)</option>
                </select>
              </div>
              <div class="col-md-3">
                <div class="mb-4">
                  <label class="form-label" for="">No. of BL</label>
                  <input type="number" id="no_bl" class="form-control" required placeholder="No. of BL" value="1">
                </div>
                <div id="other_charges_container" style="display: none;">
                  <label class="form-label" for="">Other<br> Charges</label>
                  <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">$</span>
                    <input type="number" class="form-control other_charges" placeholder="0.00" value="0" required>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="mb-4">
                  <label class="form-label" for="">Handling Charges</label>
                  <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">$</span>
                    <input type="number" class="form-control" placeholder="0.00" value="0" required id="handing_charges_input">
                  </div>
                </div>
                <label class="form-label" for="">Miscellaneous<br> Charges </label>
                <div class="input-group">
                  <span class="input-group-text" id="basic-addon1">PKR</span>
                  <input type="number" class="form-control" value="0" placeholder="0" required id="misc_charges_input">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          
          
          
          
          <div class="col-md-12">
            <div class="m-0">
              <!--begin::Heading-->
              <div class="d-flex align-items-center collapsible py-3 toggle mb-0 collapsed" data-bs-toggle="collapse" data-bs-target="#kt_job_1_1" aria-expanded="false">
                <!--begin::Icon-->
                <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                  <i class="ki-duotone ki-minus-square toggle-on text-primary fs-1"><span class="path1"></span><span class="path2"></span></i>
                  <i class="ki-duotone ki-plus-square toggle-off fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                </div>
                <!--end::Icon-->
                
                <!--begin::Title-->
                <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">
                Details
                </h4>
                <!--end::Title-->
              </div>
              <!--end::Heading-->
              <!--begin::Body-->
              <div id="kt_job_1_1" class="fs-6 ms-1 collapse" style="">
                <!--begin::Item-->
                <div class="mb-4">
                  
                  <div class="row justify-content-center">
                    
                    <div class="col-md-2 mb-4">
                      <label class="form-label" for="">Provisional/Market Value</label>
                      <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">$</span>
                        <input type="number" class="form-control prov_val" step="0.00001" placeholder="0.00">
                      </div>
                    </div>
                    
                    <div class="col-md-2 mb-4">
                      <label class="form-label" for="">Reuter Value</label>
                      <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">$</span>
                        <input type="number" class="form-control reut_val" step=".00001" placeholder="0.00">
                      </div>
                    </div>
                    
                    <div class="col-md-2 mb-4">
                      <label class="form-label" for="">Exchange Rate (Main Duty)</label>
                      <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">PKR</span>
                        <input type="number" class="form-control main_duty" placeholder="0.00">
                      </div>
                    </div>
                    <div class="col-md-2 mb-4">
                      <label class="form-label" for="">Exchange Rate (1% Duty)</label>
                      <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">PKR</span>
                        <input type="number" class="form-control 1_duty" placeholder="0.00">
                      </div>
                    </div>
                    <div class="col-md-2 mb-4">
                      <label class="form-label" for="">Exbonding  Quantity</label>
                      <input type="number" class="form-control exb_qty" id="exb_qty" value="250.000">
                    </div>
                    <div class="col-md-2 mb-4">
                      <label class="form-label" for="">Landed Quantity</label>
                      <input type="number" class="form-control landed_qty" step=".001">
                    </div>
                  </div>
                </div>
                <!--end::Item-->
                <!--begin::Separator-->
                <div class="separator separator-dashed"></div>
                <!--end::Separator-->
              </div>
            </div>
          </div>
          <div class="col-md-12 text-center mt-3">
            <button type="submit" class="btn btn-primary calculate-btn">Calculate</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="card card-flush mt-5 overflow-hidden" id="card-tabs">
    <div class="card-body">
      <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="landed-cost-olien-tab" data-bs-toggle="pill" data-bs-target="#landed-cost-olien" type="button" role="tab" aria-controls="landed-cost-olien" aria-selected="true">Cost Sheet</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="margin-value-tab" data-bs-toggle="pill" data-bs-target="#margin-value" type="button" role="tab" aria-controls="margin-value" aria-selected="true">Margin Value</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="main-duty-olein-tab" data-bs-toggle="pill" data-bs-target="#main-duty-olein" type="button" role="tab" aria-controls="main-duty-olein" aria-selected="false">Main Duty</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="duty-olein-tab" data-bs-toggle="pill" data-bs-target="#duty-olein" type="button" role="tab" aria-controls="duty-olein" aria-selected="false">1% Duty</button>
        </li>
      </ul>
      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane pt-5 fade show active" id="landed-cost-olien" role="tabpanel" aria-labelledby="landed-cost-olien-tab">
          {{-- Landed Cost Olien --}}
          <table class="table table-bordered border-dark w-auto table-responsive fw-bold">
            <tr>
              <td>USD/Ton</td>
              <td class="text-end"><span id="usd_ton"></span></td>
            </tr>
            <tr>
              <td>Product</td>
              <td class="text-end"><span id="product_name"></span></td>
            </tr>
            <tr class="border-0">
              <td class="border-bottom-1">EX Bond Qty</td>
              <td class="text-end"><span id="expected_qty"></span></td>
            </tr>
            <tr class="border-0">
              <td class="border-bottom-1">Received Quantity</td>
              <td class="text-end"><span id="landed_qty"></span></td>
            </tr>
            <tr class="border-0">
              <td class="border-bottom-1">Exchange Rate</td>
              <td class="text-end"><span id="exchange_rate"></span></td>
            </tr>
            <tr class="d-none">
              <td>Shortage</td>
              <td class="text-end"><span id="shortage"></span></td>
            </tr>
            <tr class="border-0">
              <td class="border-bottom-1 border-top-1">Import Value</td>
              <td class="text-end border-top-0 border-bottom-1"><span id="import_value_1"></span></td>
            </tr>
            <tr class="border-0">
              <td class="border-bottom-1">Import Value</td>
              <td class="text-end"><span id="import_value_2" class="fw-bold"></span></td>
            </tr>
            <tr class="border-0">
              <td class="border-bottom-1">L/C/ (CAD) Bank Charges + M.M.Charges (<span id="other_charges"></span> USD/PMT)</td>
  
              <td class="text-end"><span id="lc_charge" class="fw-bold"></span></td>
            </tr>
            <tr class="border-0">
              <td class="border-bottom-1">Collector of Customs (<span id="collector_customs_details"></span>)</td>
              <td class="text-end"><span id="collector_customs" class="fw-bold"></span></td>
            </tr>
            <tr class="border-0">
              <td class="border-bottom-1">COC PQA (<span id="coc_pqa_details"></span>% on import value)</td>
              <td class="text-end"><span id="coc_pqa" class="fw-bold"></span></td>
            </tr>
            <tr class="border-0">
              <td class="border-bottom-1">PQA / MT (<span id="pqa_mt_details"></span> PKR PMT)</td>
              <td class="text-end"><span id="pqa_mt" class="fw-bold"></span></td>
            </tr>
            <tr class="border-0">
              <td class="border-bottom-1">E & T (PQA) (<span id="et_pqa_details"></span>% on import value)</td>
              <td class="text-end"><span id="et_pqa" class="fw-bold"></span></td>
            </tr>
            <tr class="border-0">
              <td class="border-bottom-1">Per Vessel Charges (Fixed per vessel)</td>
              <td class="text-end"><span id="per_vessel_charges" class="fw-bold"></span></td>
            </tr>
            <tr class="border-0">
              <td class="border-bottom-1">Marking (<span id="marking_details"></span>% on import value)</td>
              <td class="text-end"><span id="marking" class="fw-bold"></span></td>
            </tr>
            <tr class="border-0">
              <td class="border-bottom-1">Storage/Handling/C. Agent (375 PMT storage+ 3500 surveyor+12000 per BL)</td>
              <td class="text-end"><span id="storage_agent" class="fw-bold"></span></td>
            </tr>
            <tr class="border-0">
              <td class="border-bottom-1">Insurance Charges (<span id="insurance_charge_details"></span>% on import value)</td>
              <td class="text-end border-bottom-1"><span id="insurance_charge" class="fw-bold"></span></td>
            </tr>
            <tr class="border-0">
              <td class="border-bottom-1">LANDED COST BEFORE TAXES</td>
              <td class="text-end"><span id="landed_cost" class="fw-bold"></span></td>
            </tr>
            <tr class="border-0">
              <td class="border-bottom-1">LESS : INPUT TAX</td>
              <td class="text-end"><span id="less_input_tax" class="fw-bold"></span></td>
            </tr>
            <tr class="border-0">
              <td class="border-bottom-1">ADD : OUTPUT TAX</td>
              <td class="text-end border-bottom-1"><span id="add_output_tax" class="fw-bold"></span></td>
            </tr>
            <tr class="border-0">
              <td class="border-bottom-1">SUBTOTAL</td>
              <td class="text-end"><span id="subtotal" class="fw-bold"></span></td>
            </tr>
            <tr class="border-0">
              <td class="border-bottom-1">ADD : WITHHOLDING TAX 1%</td>
              <td class="text-end"><span id="add_withholding_tax" class="fw-bold"></span></td>
            </tr>
            <tr class="border-0">
              <td class="border-bottom-1">Miscellaneous Charges</td>
              <td class="text-end"><span id="misc_charges_calc" class="fw-bold"></span></td>
            </tr>
            <tr class="border-0">
              <td class="border-bottom-1">Handling Charges (@ <span id="handling_charges"></span> per Ton)</td>
              <td class="text-end"><span id="handling_charges_calc" class="fw-bold"></span></td>
            </tr>
            <tr>
              <td>LANDED COST AFTER TAXES</td>
              <td class="text-end"><span id="landed_cost_after_taxes" class="fw-bold"></span></td>
            </tr>
            <tr class="border-0" style="height: 45px;">
                <td class="border-0"></td>
                <td class="border-0"></td>
            </tr>
            <tr>
              <td class="text-end">Cost per Ton</td>
              <td class="text-end"><span id="cost_per_ton" class="fw-bold"></span></td>
            </tr>
            
            <tr>
              <td class="text-end">Cost per Maund</td>
              <td class="text-end"><span id="cost_per_maund" class="fw-bold"></span></td>
            </tr>
            
          </table>
        </div>
        
        <div class="tab-pane pt-5 fade" id="margin-value" role="tabpanel" aria-labelledby="margin-value-tab">
          <table class="table table-bordered border-dark fw-bold w-auto table-responsive">
            <tr class="d-none">
              <td>TODAY MARKET</td>
              <td class="text-end"><span id="today_market"></span></td>
            </tr>
            <tr class="d-none">
              <td>Exchange Rate</td>
              <td class="text-end"><span id="exch_rate_margin"></span></td>
            </tr>
            <tr class="d-none">
              <td>Invoice Value in USD</td>
              <td class="text-end"><span id="inv_value_margin"></span></td>
            </tr>
            <tr class="d-none">
              <td>Provisional/Market Price</td>
              <td class="text-end"><span id="prov_market_price"></span></td>
            </tr>
            <tr>
              <td>Margin per ton (USD)</td>
              <td class="text-end"><span id="margin_per_ton"></span></td>
            </tr>
            <tr>
              <td>Price Difference $</td>
              <td class="text-end"><span id="price_difference"></span></td>
            </tr>
            <tr>
              <td>M.M. Service Charges</td>
              <td class="text-end"><span id="mm_charges"></span></td>
            </tr>
            <tr>
              <td>NET Margin</td>
              <td class="text-end"><span id="net_margin"></span></td>
            </tr>
          </table>
        </div>
        <div class="tab-pane pt-5 fade" id="main-duty-olein" role="tabpanel" aria-labelledby="main-duty-olein-tab">
          <table class="table table-bordered border-dark w-auto table-responsive fw-bold">
            <tr class="fw-bolder">
              <th></th>
              <th>RATE</th>
              <th>AMOUNT</th>
            </tr>
            <tr>
              <td>IMPORT VALUE</td>
              <td>&nbsp;</td>
              <td class="text-end"><span id="landed-cost-olien-imp-val"></span></td>
            </tr>
            <tr>
              <td>CUSTOM DUTY</td>
              <td class="text-end"><span id="custom_duty_percent"></span></td>
              <td class="text-end"><span id="custom-duty-charge"></span></td>
            </tr>
            <tr>
              <td>REGULAR DUTY</td>
              <td class="text-end"><span id="regular_duty_percent"></span></td>
              <td class="text-end"><span id="regular-duty-charge"></span></td>
            </tr>
            <tr>
              <td>ADDITIONAL CUSTOM DUTY</td>
              <td class="text-end"><span id="additional_custom_duty_percent"></span></td>
              <td class="text-end"><span id="additional-custom-duty-charge"></span></td>
            </tr>
            <tr>
              <td>SALE TAX</td>
              <td class="text-end"><span id="sale_tax_percent"></span></td>
              <td class="text-end"><span id="sale-tax-charge"></span></td>
            </tr>
            <tr>
              <td>INCOME TAX</td>
              <td class="text-end"><span id="income_tax_percent"></span></td>
              <td class="text-end"><span id="income-tax-charge"></span></td>
            </tr>
            <tr>
              <td>ADDITIONAL SALES TAX</td>
              <td class="text-end"><span id="additional_sales_tax_percent"></span></td>
              <td class="text-end">
                -
                <!-- <span id="additional-sales-tax-charge"></span> -->
              </td>
            </tr>
            <tr>
              <td>PENAL SURCHRAGED</td>
              <td class="text-end"><span id="penal-sub-percent">-</span></td>
              <td class="text-end"><span id="penal-sub-charge">-</span></td>
            </tr>
            <tr>
              <td><span class="fw-bolder">GRAND TOTAL</span></td>
              <td></td>
              <td class="text-end"><span id="grand_total" class="fw-bold"></span></td>
            </tr>
          </table>
        </div>
        <div class="tab-pane pt-5 fade" id="duty-olein" role="tabpanel" aria-labelledby="duty-olein-tab">
          <table class="table table-bordered border-dark w-auto fw-bold table-responsive">
            <tr class="d-none">
              <td>QUANTITY AS PER B/L</td>
              <td></td>
              <td><span id="duty_olein_qty_bl"></span></td>
            </tr>
            <tr class="d-none">
              <td>INSURANCE PREMIUM</td>
              <td></td>
              <td><span id="duty_olein_insurance_premium"></span></td>
            </tr>
            <tr class="d-none">
              <td>INVOICE VALUE IN U$</td>
              <td></td>
              <td><span id="duty_olein_inv_val"></span></td>
            </tr>
            <tr class="d-none">
              <td>ASSESMENT ON REUTER IN U$</td>
              <td></td>
              <td><span id="duty_olein_assesment_reuter"></span></td>
            </tr>
            <tr class="d-none">
              <td>EXCHANGE RATE  U$</td>
              <td></td>
              <td><span id="duty_olein_exchange_rate"></span></td>
            </tr>
            <tr class="fw-bolder">
              <th></th>
              <th>RATE</th>
              <th>AMOUNT</th>
            </tr>
            <tr>
              <td>IMPORT VALUE</td>
              <td></td>
              <td class="text-end"><span id="duty_olein_import_val"></span></td>
            </tr>
            <tr>
              <td>COLLECTOR OF CUSTOM PORT QASIM</td>
              <td><span id="pay_order_collector_rate"></span></td>
              <td class="text-end"><span id="pay_order_oil_mills_amount"></span></td>
            </tr>
            <tr>
              <td>EXCISE AND TAXTATION OFFICER PORT QASIM </td>
              <td><span id="pay_order_excise_rate"></span></td>
              <td class="text-end"><span id="pay_order_blank_amount"></span></td>
            </tr>
            <tr>
              <td>SINDH STAMP DUTY </td>
              <td></td>
              <td class="text-end"><span id="pay_order_sindh_stamp_amount"></span></td>
            </tr>
            <tr class="bg-secondary d-none">
              <td></td>
              <td>TOTAL</td>
              <td class="text-end"><span id="pay_order_ac_oil_amount"></span></td>
            </tr>
            <tr>
              <td>PORT QASIM AUTHORITY</td>
              <td><span id="pay_order_port_qasim_amount"></span>PER TON</td>
              <td class="text-end"><span id="pay_order_ac_pvt_amount"></span></td>
            </tr>
            <tr>
              <td>PSQCA-SDC-IMPORT-EXPORT</td>
              <td>INSPECTION</td>
              <td class="text-end"><span id="pay_order_PSQCA_amount"></span></td>
            </tr>
            <tr>
              <td></td>
              <td>MARKING</td>
              <td class="text-end"><span id="pay_order_oil_mm_amount"></span></td>
            </tr>
            <tr class="bg-secondary d-none">
              <td></td>
              <td>TOTAL</td>
              <td class="text-end"><span id="pay_order_oil_total_amount"></span></td>
            </tr>
            <tr>
              <td>MISC CHARGES (PVMA REPRESENTATIVE)</td>
              <td></td>
              <td class="text-end"><span id="psqca_misc"></span></td>
            </tr>
            <tr class="bg-secondary">
              <td></td>
              <td>GRAND TOTAL</td>
              <td class="text-end"><span id="onepercent_total"></span></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
  @push('scripts')
  <script>
  </script>
  <script>
  $(document).on("keydown",".inv_val",function () {
    var inv = $(this).val();
    $('.reut_val').val(inv);
    $('.prov_val').val(inv);
  });
  
  $(document).on("keyup",".supply_payment",function () {
    var exh = $(this).val();
    $('.main_duty').val(exh);
    $('.1_duty').val(exh);
  });
  
  function calc_landed_qty() {
    var exb = $('#exb_qty').val();
    var landed_qty = exb - (exb * 0.005);
    $('.landed_qty').val(landed_qty);
  }
  $(document).on("keyup","#exb_qty", function () {
    calc_landed_qty();
  });
  
  $(document).ready(function() {
    calc_landed_qty();
  
    $('#card-tabs').animate({height:0},200);
    
    var inv = $('.inv_val').val();
    $('.reut_val').val(inv);
    var exh = $('.supply_payment').val();
    $('.main_duty').val(exh);
    $('.1_duty').val(exh);
  });
  function addCommas(number) {
  var typeConvertedNumber = parseFloat(number);
  var formattedNumber = typeConvertedNumber.toLocaleString() ;
  return formattedNumber;
  }
  $(document).on("submit","#calculate-form", function (e) {
  
  e.preventDefault();
  
  $('#card-tabs').animate({height:'auto'},2000);
  $('.card-flush').css('height','auto');
  
  var usd_ton = $('#inv_val').val();
  var exb = $('.exb_qty').val();
  var landed_qty = $('.landed_qty').val();
  var shortage = exb - landed_qty;
  var today_market_input = $('#today_market_input').val();
  var supply_payment =$('#supply_payment').val();
  
  $('#usd_ton').text('USD ' + addCommas(usd_ton));
  $('#expected_qty').text(exb);
  $('#landed_qty').text(landed_qty);
  $('#shortage').text(shortage);
  $('#exchange_rate').text('PKR ' +  addCommas(supply_payment));
  
  var import_value_1 = $('#inv_val').val() * $('.exb_qty').val();
  $('#import_value_1').text('USD ' + addCommas(import_value_1));
  
  var import_value_2 = $('#inv_val').val() * $('.exb_qty').val() * $('#supply_payment').val();
  $('#import_value_2').text('PKR ' + addCommas(import_value_2));
  
  // var insurance_charge = import_value_2 * 0.0005;
  var insurance_charge = parseFloat("{{ $values['cc_insurance_charges'] }}");
  $('#insurance_charge_details').text(insurance_charge);
  $('#insurance_charge').text(addCommas(insurance_charge));
  
  var product = $('#product').val();
  if(product === 'palm_olein'){
    $('#product_name').text('PALM OLEIN');
    var custom_duty_percent = 7692.5;
    // var collector_customs_details = "7742.50 PKR/MT";
    var collector_customs_details = "{{ $values['collector_of_customs_palm_oil'] }} PKR/MT";
  }
  else {
    $('#product_name').text('RBD - PALM OIL');
    var custom_duty_percent = 9180;
    var collector_customs_details = "{{ $values['collector_of_customs_rbd_olein'] }}  PKR/MT";
  }
  
  $('#collector_customs_details').text(collector_customs_details);
  
  var lc_cad = $('.lc_cad').val();
  if (lc_cad != 'other') {
    var lc_charge = (import_value_2 * lc_cad)/100;
    $('#other_charges').text(lc_cad);
  }
  else {
    var lc_charge = supply_payment * exb * $('.other_charges').val();
    $('#other_charges').text($('.other_charges').val());
  }
  
  $('#lc_charge').text(addCommas(lc_charge));
  // var storage_agent = (375 * exb)+(12000 * $('#no_bl').val())+(3500)+60000;
  var storage_agent = "{{ $values['cc_handling'] }}";
  $('#storage_agent').text(addCommas(storage_agent));
  
  // Landed Cost
  var inv_val = $('#inv_val').val();
  var reut_val = $('.reut_val').val();
  var main_duty = $('.main_duty').val();
  var exh_rate_1_duty = $('.1_duty').val();
  var landed_cost_olien_insurance_pre = import_value_2 * 0.0005;
  var landed_random = ((exb * reut_val * main_duty) + insurance_charge) / 100 ;
  $('#landed-cost-olien-exb-qty').text(exb);
  $('#landed-cost-olien-inv-qty').text(inv_val);
  $('#landed-cost-olien-pvm-reuter').text(reut_val);
  $('#landed-cost-olien-insurance-pre').text(addCommas(landed_cost_olien_insurance_pre));
  $('#landed-cost-olien-exchan-rate').text(addCommas(main_duty));
  //var landed_cost_olien_imp_val = exb * reut_val * main_duty + (import_value_2 * 0.0005) + landed_random;
  var landed_cost_olien_imp_val = (exb * reut_val * main_duty) + insurance_charge + landed_random;
  $('#landed-cost-olien-imp-val').text(addCommas(Math.round(landed_cost_olien_imp_val)));
  $('#custom_duty_percent').text(custom_duty_percent);
  var custom_duty_charge = custom_duty_percent * exb;
  $('#custom-duty-charge').text(addCommas(custom_duty_charge));
  var regular_duty_percent = 50;
  $('#regular_duty_percent').text(regular_duty_percent);
  var regular_duty_charge = regular_duty_percent * exb;
  $('#regular-duty-charge').text(addCommas(regular_duty_charge));
  var additional_custom_duty_percent = 2;
  $('#additional_custom_duty_percent').text(additional_custom_duty_percent + '%');
  var additional_custom_duty_charge =  Math.round(landed_cost_olien_imp_val * (additional_custom_duty_percent / 100));
  $('#additional-custom-duty-charge').text(addCommas(additional_custom_duty_charge));
  var sale_tax_percent = 18;
  $('#sale-tax-percent').text(sale_tax_percent + '%');
  var sale_tax_charge = (landed_cost_olien_imp_val + custom_duty_charge + regular_duty_charge + additional_custom_duty_charge) * (sale_tax_percent / 100);
  $('#sale-tax-charge').text(addCommas(Math.round(sale_tax_charge)));
  var additional_sales_tax_percent = 3;
  $('#additional-sales-tax-percent').text(additional_sales_tax_percent);
  var additional_sales_tax_charge = (landed_cost_olien_imp_val + custom_duty_charge + regular_duty_charge + additional_custom_duty_charge) * (additional_sales_tax_percent / 100) * 0;
  $('#additional-sales-tax-charge').text(addCommas(Math.round(additional_sales_tax_charge)));
  income_tax_percent = 2;
  $('#income_tax_percent').text(income_tax_percent + '%')
  var income_tax_charge = (landed_cost_olien_imp_val + custom_duty_charge + regular_duty_charge + additional_custom_duty_charge + sale_tax_charge + additional_sales_tax_charge) * (income_tax_percent / 100);
  $('#income-tax-charge').text(addCommas(Math.round(income_tax_charge)));
  var grand_total = custom_duty_charge + regular_duty_charge + additional_custom_duty_charge + sale_tax_charge + income_tax_charge + additional_sales_tax_charge;
  $('#grand_total').text(addCommas(Math.round(grand_total)));
  var collector_customs = $('#collector_customs').text(addCommas(Math.round(grand_total)));
  var duty_olein_qty_bl = exb;
  
  var duty_onepercent_onep = (exb * exh_rate_1_duty * reut_val + insurance_charge) / 100;
  
  $('#duty_olein_qty_bl').text(duty_olein_qty_bl);
  var duty_olein_insurance_premium = insurance_charge;
  $('#duty_olein_insurance_premium').text(addCommas(duty_olein_insurance_premium));
  var duty_olein_inv_val = inv_val;
  $('#duty_olein_inv_val').text(duty_olein_inv_val);
  var duty_olein_assesment_reuter = reut_val;
  $('#duty_olein_assesment_reuter').text(duty_olein_assesment_reuter);
  var duty_olein_exchange_rate = exh_rate_1_duty;
  $('#duty_olein_exchange_rate').text(addCommas(duty_olein_exchange_rate));
  var duty_olein_import_val = duty_olein_qty_bl * duty_olein_exchange_rate * duty_olein_assesment_reuter + duty_olein_insurance_premium + duty_onepercent_onep;
  $('#duty_olein_import_val').text(addCommas(Math.round(duty_olein_import_val)));
  var pay_order_collector_rate = 0.25;
  $('#pay_order_collector_rate').text(pay_order_collector_rate + '%');
  var pay_order_oil_mills_amount = parseInt(duty_olein_import_val) * (pay_order_collector_rate / 100);
  $('#pay_order_oil_mills_amount').text(addCommas(Math.round(pay_order_oil_mills_amount)));
  var pay_order_excise_rate = 1.25;
  $('#pay_order_excise_rate').text(pay_order_excise_rate + '%');
  var pay_order_blank_amount = parseInt(duty_olein_import_val) * (pay_order_excise_rate / 100);
  $('#pay_order_blank_amount').text(addCommas(Math.round(pay_order_blank_amount)));
  var pay_order_sindh_stamp_amount = 1000;
  $('#pay_order_sindh_stamp_amount').text(addCommas(pay_order_sindh_stamp_amount));
  var pay_order_ac_oil_amount = parseInt(pay_order_sindh_stamp_amount)  + pay_order_blank_amount;
  $('#pay_order_ac_oil_amount').text(addCommas(Math.round(pay_order_ac_oil_amount)));
  var pay_order_port_qasim_amount = 35.03;
  $('#pay_order_port_qasim_amount').text(addCommas(pay_order_port_qasim_amount));
  var pay_order_ac_pvt_amount = pay_order_port_qasim_amount * duty_olein_qty_bl;
  $('#pay_order_ac_pvt_amount').text(Math.round(pay_order_ac_pvt_amount));
  var pay_order_PSQCA_amount = 11000;
  $('#pay_order_PSQCA_amount').text(addCommas(pay_order_PSQCA_amount));
  var pay_order_oil_mm_amount = parseInt(duty_olein_import_val) * (0.05 / 100);
  $('#pay_order_oil_mm_amount').text(addCommas(Math.round(pay_order_oil_mm_amount)));
  var pay_order_oil_total_amount = parseInt(pay_order_PSQCA_amount) + parseInt(pay_order_oil_mm_amount);
  $('#pay_order_oil_total_amount').text(addCommas(Math.round(pay_order_oil_total_amount)));
  // var coc_pqa = pay_order_oil_mills_amount;
  var coc_pqa = parseFloat("{{ $values['coc_pqa'] }}");
  $('#coc_pqa_details').text(addCommas(Math.round(coc_pqa)));
  $('#coc_pqa').text(addCommas(Math.round(coc_pqa)));
  // var pqa_mt = pay_order_ac_pvt_amount;
  var pqa_mt = parseFloat("{{ $values['cc_pqa'] }}");
  $('#pqa_mt_details').text(pqa_mt);
  $('#pqa_mt').text(addCommas(Math.round(pqa_mt)));
  // var et_pqa = pay_order_ac_oil_amount;
  var et_pqa = parseFloat("{{ $values['cc_e_and_t'] }}");
  $('#et_pqa_details').text(et_pqa);
  $('#et_pqa').text(addCommas(Math.round(et_pqa)));
  // var per_vessel_charges = pay_order_PSQCA_amount;
  var per_vessel_charges = parseFloat("{{ $values['cc_per_vessel_charges'] }}");
  $('#per_vessel_charges').text(addCommas(per_vessel_charges));
  // var marking = pay_order_oil_mm_amount;
  var marking = parseFloat("{{ $values['cc_marking'] }}");
  $('#marking_details').text(marking);
  $('#marking').text(addCommas(Math.round(marking)));
  var landed_cost = import_value_2 + lc_charge + grand_total + coc_pqa + pqa_mt + et_pqa + parseInt(per_vessel_charges) + parseInt(marking) + parseInt(storage_agent) + parseInt(insurance_charge);
  $('#landed_cost').text(addCommas(Math.round(landed_cost)));
  var less_input_tax = sale_tax_charge;
  $('#less_input_tax').text(addCommas(Math.round(less_input_tax)));
  var add_output_tax = landed_cost * 0.18;
  $('#add_output_tax').text(addCommas(Math.round(add_output_tax)));
  var subtotal = landed_cost - less_input_tax + add_output_tax;
  $('#subtotal').text(addCommas(Math.round(subtotal)));
  
  $('#today_market').text('USD ' + today_market_input);
  $('#exch_rate_margin').text('PKR ' + supply_payment);
  $('#inv_value_margin').text('USD ' + inv_val);
  var prov_market_price = $('.prov_val').val();
  $('#prov_market_price').text('USD ' + prov_market_price);
  
  var psqca_misc = 2400
  $('#psqca_misc').text(addCommas(psqca_misc));
  var onepercent_total = pay_order_oil_mills_amount + pay_order_blank_amount + pay_order_sindh_stamp_amount + pay_order_ac_pvt_amount + pay_order_PSQCA_amount + pay_order_oil_mm_amount + psqca_misc;
  $('#onepercent_total').text(addCommas(Math.round(onepercent_total)));
  
  var handling_charges = $('#handing_charges_input').val();
  $("#handling_charges").text(handling_charges);
  var handling_charges_calc = handling_charges * exb * supply_payment;
  $('#handling_charges_calc').text(addCommas(Math.round(handling_charges_calc)));
  
  
  var misc_charges = $('#misc_charges_input').val();
  var misc_charges_calc = import_value_1 * misc_charges;
  $('#misc_charges_calc').text(addCommas(Math.round(misc_charges_calc)));
  
  // var add_withholding_tax = subtotal * 0.01;
  var add_withholding_tax = parseFloat("{{ $values['cc_withholding'] }}");
  $('#add_withholding_tax').text(addCommas(Math.round(add_withholding_tax)));
  
  var landed_cost_after_taxes = subtotal + add_withholding_tax + handling_charges_calc + misc_charges_calc;
  $('#landed_cost_after_taxes').text(addCommas(Math.round(landed_cost_after_taxes)));
  
  var cost_per_ton = landed_cost_after_taxes / landed_qty;
  $('#cost_per_ton').text(addCommas(Math.round(cost_per_ton)));
  
  var cost_per_maund = (cost_per_ton/1000) * 37.324;
  $('#cost_per_maund').text(addCommas(Math.round(cost_per_maund)));
  
  //Margin tab
  var margin_per_ton = ((today_market_input - cost_per_maund) / 37.324 * 1000) / supply_payment;
  console.log(margin_per_ton);
  $('#margin_per_ton').text('USD ' + margin_per_ton.toFixed(2));
  
  var price_difference = inv_val - prov_market_price;
  $('#price_difference').text('USD ' + price_difference);
  
  // var mm_charges = 0;
  var mm_charges = parseFloat("{{ $values['cc_mm_charges'] }}");
  $('#mm_charges').text(mm_charges);
  
  var net_margin = margin_per_ton + price_difference - mm_charges;
  $('#net_margin').text('USD ' + net_margin.toFixed(2));
  
  });
  </script>
  <script>
  $(document).on("change",".lc_cad", function () {
  if($(this).val() == 'other') {
    $('#other_charges_container').fadeIn();
  }
  else {
    $('#other_charges_container').fadeOut();
  }
  });
  </script>
  @endpush
  </x-default-layout>