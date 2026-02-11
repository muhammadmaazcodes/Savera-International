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
                            <div class="d-flex align-items-center mb-1">
                                <a href="#" class="text-gray-800 text-hover-primary fs-2 fw-bold me-3">Inventory</a>
                            </div>
                            <!--end::Status-->
    
                            <!--begin::Description-->
                            <!--end::Description-->
                        </div>
                        <!--end::Details-->
    
                        <!--begin::Actions-->
                        <div class="d-flex mb-4">
                            <a href="/inventories/{{ $inventory->id }}/edit" class="btn btn-sm btn-bg-light btn-active-color-primary me-3">Edit Inventory</a>
                            <a href="{{ route('show.bl',$inventory->id) }}" class="btn btn-sm btn-primary me-3">Show BL</a>
                            <a href="{{ route('show.liftings',$inventory->id) }}" class="btn btn-sm btn-primary me-3">Show Lifting</a>
                            <!--begin::Menu-->
                            <div class="me-0">
                            </div>
                            <!--end::Menu-->
                        </div>
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
                                        <div class="fs-4 fw-bold counted" data-kt-countup="true" data-kt-countup-value="75" data-kt-initialized="1">{{ $inventory->product->name ?? 'N/A' }}</div>
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
                                    <div class="fs-4 fw-bold counted" data-kt-countup="true" data-kt-countup-value="15000" data-kt-countup-prefix="$" data-kt-initialized="1">{{ $inventory->terminal->name ?? 'N/A' }}</div>
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

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <h2>Inventory BLs</h2>
            <table id="data-table-simple" class="table table-row-bordered table-responsive">
              
              <thead class="fw-bold">
                <th>BL Number</th>
                <th>Bl Qty</th>
                <th>Landed Quantity</th>
                <th>Shortage</th>
                <th>Balance Qty</th>
              </thead>

              <tbody>
                @foreach ($inventory->bls as $bl)
                <tr>
                  <td>{{ $bl->bl_number }}</td>
                  <td>{{ number_format($bl->bl_quantity,3) }}</td>
                  <td>{{ number_format($bl->landed_quantity,3) }}</td>
                  <td>{{ number_format($bl->bl_quantity - $bl->landed_quantity,3) }}</td>
                  <td>{{ $bl->qty_status() }}</td>
                </tr>
                @endforeach
              </tbody>

            </table>
          </div>
        </div>
      </div>
    </div>

<br>

    <h2 class="ms-4">Files</h2>
    
    <div class="row">
        
        <div class="col-md-4">
            <!--begin::Card-->
            <div class="card h-100 ">
                <!--begin::Card body-->
                @if ($doc_summary)
                <a href="{{ route('document.delete',$doc_summary->id) }}"><button class="btn btn-sm btn-light-danger mx-5 mt-3 mt-md-8 w-25">Delete</button></a>
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
                    <button type="submit" class="btn btn-primary btn-sm w-25 mt-3">Add</button>
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
                <a href="{{ route('document.delete',$doc_pro_data->id) }}"><button class="btn btn-sm btn-light-danger mx-5 mt-3 mt-md-8 w-25">Delete</button></a>
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
                        <button type="submit" class="btn btn-primary btn-sm w-25 mt-3">Add</button>
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
                <a href="{{ route('document.delete',$doc_survey_report->id) }}"><button class="btn btn-sm btn-light-danger mx-5 mt-3 mt-md-8 w-25">Delete</button></a>
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
                        <button type="submit" class="btn btn-primary btn-sm w-25 mt-3">Add</button>
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


    <!--end::Table widget 14-->
<div class="card card-flush h-md-100" hidden>
	<div class="card-header pt-7">
		<!--begin::Title-->
		<h3 class="card-title align-items-start flex-column">
			<span class="card-label fw-bold text-gray-800">Edit Inventory BLs</span>
		</h3>
		<!--end::Title-->
	</div>
	<div class="card-body pt-6">
		@foreach($inventory->bls as $bl)
		<form class="pt-1" method="POST" action="{{ route('inventory.bls.update', $bl->id) }}" enctype="multipart/form-data">
			@csrf
			@method('PUT')
		<div class="form-group">
        <div class="my-5">
          <div {!! ($bl->status) == 0 ? 'style="background-color:#f2f2f2"' : 'style="background-color:#e0f4e8"' !!} class="border-1 rounded-3 my-5 {{ ($bl->status) == 0 ? 'border-secondary' : 'border-success' }} border p-3" data-repeater-item>
            <div class="form-group row gy-3	">
                <div class="col-md-6">
                    <label class="form-label">BL Number:</label>
                    <input type="text" name="bl_number" class="form-control mb-2 mb-md-0" placeholder="BL Number" value="{{ $bl->bl_number }}" required />
                </div>
                <div class="col-md-6">
                    <label class="form-label">BL Quantity:</label>
                    <input type="number" name="bl_quantity" class="form-control mb-2 mb-md-0" placeholder="Enter BL Quantity" step=".0001" value="{{ $bl->bl_quantity }}" required />
                </div>
                <div class="col-md-6">
                    <label class="form-label">Landed Quantity</label>
                    <input type="number" name="landed_quantity" class="form-control mb-2 mb-md-0" placeholder="Enter Landed Quantity" step=".0001" value="{{ $bl->landed_quantity }}" required />
                </div>
                <div class="col-md-6">
                    <label class="form-label">Document</label>
                    <input type="file" name="bl_document" class="form-control mb-2 mb-md-0" placeholder="Enter BL Document" />
                </div>
                <div class="col-md-6">
                    <label class="form-label">Commercial Invoice</label>
                    <input type="file" name="commercial_invoice" class="form-control mb-2 mb-md-0" placeholder="" />
                </div>
                <div class="col-md-6">
                    <label class="form-label">BL</label>
                    <input type="file" name="bl" class="form-control mb-2 mb-md-0" placeholder="" />
                </div>
                <div class="col-md-6">
                    <label class="form-label">Shipping DO</label>
                    <input type="file" name="shipping_do" class="form-control mb-2 mb-md-0" placeholder="" />
                </div>
                <div class="col-md-6">
                    <br>
                    <div class="form-check form-check-solid form-check-custom form-switch mt-4">
                        <input class="form-check-input w-45px h-30px" {{ ($bl->status) == 1 ? 'checked' : '' }} name="status" type="checkbox" value="1" id="googleswitch">
                        <label class="form-check-label" for="googleswitch">Status</label>
                    </div>
                </div>

                <div class="col-md-12 text-center py-3">
                	<button type="submit" class="btn btn-sm btn-light fw-bold btn-primary me-2" data-kt-search-element="advanced-options-form-cancel">Update</button>
                  <a href="javascript:;" data-action="{{ route('inventory.bls.delete', $bl->id) }}" data-method="post" data-lmethod="delete" data-csrf="{{ csrf_token() }}" data-reload="true" class="button-ajax btn btn-sm btn-light-danger">
                        <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                        Delete
                  </a>
                </div>
            </div>
          </div>
        </div>
	    </div>
		</form>
		@endforeach
	</div>
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