<x-default-layout>
	<!--begin::Table widget 14-->
    <div class="card ">
        <div class="card-body pt-9 pb-0">
            <!--begin::Details-->
            <div class="d-flex flex-wrap flex-sm-nowrap mb-6">
                <!--begin::Image-->
                <!--end::Image-->
    
                <!--begin::Wrapper-->
                <div class="flex-grow-1">
                    <!--begin::Head-->
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                        <!--begin::Details-->
                        <div class="d-flex flex-column">
                            <!--begin::Status-->
                            <!--end::Status-->
    
                            <!--begin::Description-->
                            <!--end::Description-->
                        </div>
                        <!--end::Details-->
    
                        <!--begin::Actions-->
                        <!--end::Actions-->
                    </div>
                    <!--end::Head-->
    
                    <!--begin::Info-->
                    <div class="d-flex flex-wrap justify-content-start">
                        <!--begin::Stats-->
                        <div class="d-flex flex-wrap">
                            <!--begin::Stat-->
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <!--begin::Number-->
                                <div class="d-flex align-items-center">
                                    <div class="fs-4 fw-bold">{{ $inventory->vessel->name }}</div>
                                </div>
                                <!--end::Number-->
    
                                <!--begin::Label-->
                                <div class="fw-semibold fs-6 text-gray-400">Vessel Name</div>
                                <!--end::Label-->
                            </div>
                            <!--end::Stat-->
    
                            <!--begin::Stat-->
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <!--begin::Number-->
                                <div class="d-flex align-items-center">
                                    <i class="ki-duotone ki-arrow-down fs-3 text-danger me-2"><span class="path1"></span><span class="path2"></span></i>
                                        <div class="fs-4 fw-bold counted" data-kt-countup="true" data-kt-countup-value="75" data-kt-initialized="1">{{ $inventory->product->name }}</div>
                                </div>
                                <!--end::Number-->
    
                                <!--begin::Label-->
                                <div class="fw-semibold fs-6 text-gray-400">Product Name</div>
                                <!--end::Label-->
                            </div>
                            <!--end::Stat-->
    
                            <!--begin::Stat-->
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <!--begin::Number-->
                                <div class="d-flex align-items-center">
                                    <i class="ki-duotone ki-arrow-up fs-3 text-success me-2"><span class="path1"></span><span class="path2"></span></i>                                
                                    <div class="fs-4 fw-bold counted" data-kt-countup="true" data-kt-countup-value="15000" data-kt-countup-prefix="$" data-kt-initialized="1">{{ $inventory->seller->name }}</div>
                                </div>
                                <!--end::Number-->                                
    
                                <!--begin::Label-->
                                <div class="fw-semibold fs-6 text-gray-400">Seller Name</div>
                                <!--end::Label-->
                            </div>
                            <!--end::Stat-->
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <!--begin::Number-->
                                <div class="d-flex align-items-center">
                                    <i class="ki-duotone ki-arrow-up fs-3 text-success me-2"><span class="path1"></span><span class="path2"></span></i>                                
                                    <div class="fs-4 fw-bold counted" data-kt-countup="true" data-kt-countup-value="15000" data-kt-countup-prefix="$" data-kt-initialized="1">{{ $inventory->clearing_agent->name }}</div>
                                </div>
                                <!--end::Number-->                                
    
                                <!--begin::Label-->
                                <div class="fw-semibold fs-6 text-gray-400">Clearing Agent</div>
                                <!--end::Label-->
                            </div>

                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <!--begin::Number-->
                                <div class="d-flex align-items-center">
                                    <i class="ki-duotone ki-arrow-up fs-3 text-success me-2"><span class="path1"></span><span class="path2"></span></i>                                
                                    <div class="fs-4 fw-bold counted" data-kt-countup="true" data-kt-countup-value="15000" data-kt-countup-prefix="$" data-kt-initialized="1">{{ $inventory->terminal->name }}</div>
                                </div>
                                <!--end::Number-->                                
    
                                <!--begin::Label-->
                                <div class="fw-semibold fs-6 text-gray-400">Terminal</div>
                                <!--end::Label-->
                            </div>

                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <!--begin::Number-->
                                <div class="d-flex align-items-center">
                                    <i class="ki-duotone ki-arrow-up fs-3 text-success me-2"><span class="path1"></span><span class="path2"></span></i>                                
                                    <div class="fs-4 fw-bold counted" data-kt-countup="true" data-kt-countup-value="15000" data-kt-countup-prefix="$" data-kt-initialized="1">{{ $inventory->voyage_number }}</div>
                                </div>
                                <!--end::Number-->                                
    
                                <!--begin::Label-->
                                <div class="fw-semibold fs-6 text-gray-400">Voyage Number</div>
                                <!--end::Label-->
                            </div>

                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <!--begin::Number-->
                                <div class="d-flex align-items-center">
                                    <i class="ki-duotone ki-arrow-up fs-3 text-success me-2"><span class="path1"></span><span class="path2"></span></i>                                
                                    <div class="fs-4 fw-bold counted" data-kt-countup="true" data-kt-countup-value="15000" data-kt-countup-prefix="$" data-kt-initialized="1">{{ $inventory->bl_quantity }}</div>
                                </div>
                                <!--end::Number-->                                
    
                                <!--begin::Label-->
                                <div class="fw-semibold fs-6 text-gray-400">Quantity</div>
                                <!--end::Label-->
                            </div>

                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <!--begin::Number-->
                                <div class="d-flex align-items-center">
                                    <i class="ki-duotone ki-arrow-up fs-3 text-success me-2"><span class="path1"></span><span class="path2"></span></i>                                
                                    <div class="fs-4 fw-bold counted" data-kt-countup="true" data-kt-countup-value="15000" data-kt-countup-prefix="$" data-kt-initialized="1">{{ $inventory->bls->count() }}</div>
                                </div>
                                <!--end::Number-->                                
    
                                <!--begin::Label-->
                                <div class="fw-semibold fs-6 text-gray-400">Number Of BL</div>
                                <!--end::Label-->
                            </div>

                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <!--begin::Number-->
                                <div class="d-flex align-items-center">
                                    <i class="ki-duotone ki-arrow-up fs-3 text-success me-2"><span class="path1"></span><span class="path2"></span></i>                                
                                    <div class="fs-4 fw-bold counted" data-kt-countup="true" data-kt-countup-value="15000" data-kt-countup-prefix="$" data-kt-initialized="1">{{ $inventory->buyer->name }}</div>
                                </div>
                                <!--end::Number-->                                
    
                                <!--begin::Label-->
                                <div class="fw-semibold fs-6 text-gray-400">Buyer</div>
                                <!--end::Label-->
                            </div>

                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <!--begin::Number-->
                                <div class="d-flex align-items-center">
                                    <i class="ki-duotone ki-arrow-up fs-3 text-success me-2"><span class="path1"></span><span class="path2"></span></i>                                
                                    <div class="fs-4 fw-bold counted" data-kt-countup="true" data-kt-countup-value="15000" data-kt-countup-prefix="$" data-kt-initialized="1">{{ $inventory->igm_date ?? 'N/A' }}</div>
                                </div>
                                <!--end::Number-->                                
    
                                <!--begin::Label-->
                                <div class="fw-semibold fs-6 text-gray-400">IGM Date</div>
                                <!--end::Label-->
                            </div>

                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <!--begin::Number-->
                                <div class="d-flex align-items-center">
                                    <i class="ki-duotone ki-arrow-up fs-3 text-success me-2"><span class="path1"></span><span class="path2"></span></i>                                
                                    <div class="fs-4 fw-bold counted" data-kt-countup="true" data-kt-countup-value="15000" data-kt-countup-prefix="$" data-kt-initialized="1">{{ $inventory->arrival_date ?? 'N/A' }}</div>
                                </div>
                                <!--end::Number-->                                
    
                                <!--begin::Label-->
                                <div class="fw-semibold fs-6 text-gray-400">Arrival Date</div>
                                <!--end::Label-->
                            </div>

                        </div>
                        <!--end::Stats-->
    
                        <!--begin::Users-->
                        
                        <!--end::Users-->
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Details-->
    
            <div class="separator"></div>
    
            <!--begin::Nav-->
            <!--end::Nav-->
        </div>
    </div>

<br>

    <h2 class="ms-4">Contracts</h2>
    
    <div class="card card-flush h-md-100">
      <!--begin::Header-->
      <div class="card-header pt-7">
        <!--begin::Toolbar-->
        <div class="card-toolbar">
          <a href="/local-contract/create" class="btn btn-sm btn-secondary">Add New</a>
        </div>
        <!--end::Toolbar-->
      </div>
      <!--end::Header-->
      <!--begin::Body-->
      <div class="card-body pt-6">
        <!--begin::Table container-->
        <div class="table-responsive">
          <!--begin::Table-->
        <table id="data-table-simple" class="table table-row-bordered gy-5">
              <thead>
                  <tr class="fw-semibold fs-6 text-muted">
                      <th>Contract#</th>
                      <th>Buyer</th>
                      <th>Date</th>
                      <th>Payment Terms</th>
                      <th>Selling Price</th>
                      <th>Contract Type</th>
                  </tr>
              </thead>

              <tbody>
                @foreach($contracts as $contract)
    
                @php
                  $inventory = App\Models\Inventory::where('contract_id',$contract->id)->first();
                  if ($inventory) {
                    $return_quantity = App\Models\InventoryBL::where('inventory_id',$inventory->id)->sum('bl_quantity');
                  }
                  else {
                    $return_quantity = [];
                  }
                  
                  $lifted = \App\Models\SaleContract::where('contract_id',$contract->id)->get();
              @endphp
    
    
                  <tr>
                      <td>{{ $contract->code }}</td>
                      <td>{{ $contract->buyer->name }}</td>
                      <td>{{ $contract->date }}</td>
                      <td>{{ isset($contract->payment_terms->name) ? $contract->payment_terms->name : 'N/A' }}</td>
                      <td>{{ $contract->selling_price ?? '-' }}</td>
                      <td>{{ ($contract->type) == 'temp' ? 'Temporary' : ucfirst($contract->type) }}</td>
                  </tr>
                  @endforeach
          </table>
        </div>
        <!--end::Table-->
      </div>
      <!--end: Card Body-->
    </div>


    
<!--end::Table widget 14-->
{{-- {!! theme()->addVendor('formrepeater') !!} --}}
{{-- @push('scripts')
<script>
	$('#kt_docs_repeater_basic').repeater({
    initEmpty: true,

    defaultValues: {
        'text-input': 'foo'
    },

    show: function () {
        $(this).slideDown();
    },

    hide: function (deleteElement) {
        $(this).slideUp(deleteElement);
    }
});
</script>
@endpush --}}
</x-default-layout>