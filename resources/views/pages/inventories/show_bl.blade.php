<x-default-layout>
    <div class="card card-flush h-md-100">
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
                    <div class="col-md-3 date">
                        <label class="form-label">Date <span class="text-danger">*</span></label>
                        <input type="date" value="{{ $bl->date }}" name="date" required
                                class="form-control border-dark mb-2 mb-md-0" />
                    </div>
                    <div class="col-md-3 bl-number">
                        <label class="form-label">BL Number: <span class="text-danger">*</span></label>
                        <input type="text" name="bl_number" value="{{ $bl->bl_number }}" required class="form-control border-dark mb-2 mb-md-0"
                            placeholder="BL Number" />
                    </div>
                    <div class="col-md-3 index-number">
                        <label for="index_number" class="form-label">Index Number</label>
                        <input type="text" class="form-control border-dark form-control-lg border-dark"
                            placeholder="Index Number" value="{{ $bl->index_number }}" name="index_number" required />
                    </div>
                    <div class="col-md-3 status">
                        <br>
                        <div class="form-check form-check-solid form-check-custom form-switch mt-4">
                            <input class="form-check-input w-45px h-30px" {{ ($bl->status) == 1 ? 'checked' : '' }} name="status" type="checkbox"
                                value="1" id="googleswitch">
                            <label class="form-check-label" for="googleswitch">Status</label>
                        </div>
                    </div>
                    <div class="col-md-3 bl-qty">
                        <label class="form-label">BL Quantity: <span class="text-danger">*</span></label>
                        <input type="number" required name="bl_quantity" value="{{ $bl->bl_quantity }}" class="input_bl_quantity border-dark form-control mb-2 mb-md-0"
                            placeholder="Enter BL Quantity" step=".0001" />
                    </div>
                    <div class="col-md-3 landed-qty">
                        <label class="form-label">Landed Quantity <span class="text-danger">*</span></label>
                        <input type="number" required name="landed_quantity" value="{{ $bl->landed_quantity }}"
                            class="form-control border-dark mb-2 mb-md-0 input_landed_quantity" placeholder="Enter Landed Quantity"
                            step=".0001" />
                    </div>

                    <div class="col-md-3 shortage">
                        <label class="form-label">Shortage</label>
                        <input type="number"
                            class="form-control border-dark mb-2 mb-md-0 shortage-input" disabled placeholder="0.00"
                            step=".0001" />
                    </div>

                    <div class="col-md-3 shortage-percentage">
                        <label class="form-label">Shortage Percentage</label>
                        <input type="number"
                            class="form-control border-dark mb-2 mb-md-0 shortage-input-percentage" disabled placeholder="0.00 %"
                            step=".0001" />
                    </div>

                    <div class="col-md-12 provisional-price">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="form-label">Provisional Price: <span class="text-danger">*</span></label>
                                <input type="number" required name="provisional_price" value="{{ $bl->provisional_price }}" class="provisional_price border-dark form-control mb-2 mb-md-0"
                                        placeholder="Enter Provisional Price" required />
                            </div>
                        </div>
                    </div>

                    {{-- <div class="col-md-6">&nbsp;</div> --}}
                    @php
                        $doc_commercial_invoice = $bl->documents->where('type','commercial_invoice')->first();
                        $doc_document = $bl->documents->where('type','document')->first();
                        $doc_bl = $bl->documents->where('type','BL')->first();
                        $doc_shipping_do = $bl->documents->where('type','shipping_do')->first();
                    @endphp
                    


                    <div class="col-md-4">
                        <!--begin::Card-->
                        <div class="card h-100">
                            <!--begin::Card body-->
                            <div class="card-body d-flex justify-content-center text-center flex-column p-1">
                                <!--begin::Name-->
                                @if ($doc_commercial_invoice)
                                <a href="{{ asset('documents/'.$doc_commercial_invoice->type.'/'.$doc_commercial_invoice->document) }}" target="_blank" class="text-gray-800 text-hover-primary d-flex flex-column">
                                    <!--begin::Image-->
                                    <div class="symbol symbol-60px mb-5">
                                        <img src="{{ asset('assets/media/icons/file-icon.png') }}" class="theme-light-show" alt=""/>
                                            <img src="{{ asset('assets/media/icons/file-icon.png') }}" class="theme-dark-show" alt=""/>                          
                                    </div>
                                    <!--end::Image-->
            
                                    <!--begin::Title-->
                                    <div class="fs-5 fw-bold mb-2">{{ Str::limit($doc_commercial_invoice->document,20) }}</div>
                                    <!--end::Title-->
                                </a>
                                @endif
                                <!--end::Name-->
            
                                <!--begin::Description-->
                                <div class="fs-7 fw-semibold text-dark-400">Commercial Invoice &nbsp;
                                    @if ($doc_commercial_invoice)
                                    <a href="{{ route('document.delete',$doc_commercial_invoice->id) }}"><button class="btn btn-sm btn-light-danger w-25">Delete</button></a>
                                    @endif
                                </div>
                                @if(!$doc_commercial_invoice)
                                <!--<label class="form-label">Commercial Invoice</label>-->
                                <input type="file" name="commercial_invoice" class="form-control mb-2 mb-md-0" placeholder="" />
                                @endif
                                <!--end::Description-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                    </div>

                    <div class="col-md-4">
                        <!--begin::Card-->
                        <div class="card h-100">
                            <!--begin::Card body-->
                            <div class="card-body d-flex justify-content-center text-center flex-column p-1">
                                <!--begin::Name-->
                                @if ($doc_bl)
                                <a href="{{ asset('documents/'.$doc_bl->type.'/'.$doc_bl->document) }}" target="_blank" class="text-gray-800 text-hover-primary d-flex flex-column">
                                    <!--begin::Image-->
                                    <div class="symbol symbol-60px mb-5">
                                        <img src="{{ asset('assets/media/icons/file-icon.png') }}" class="theme-light-show" alt=""/>
                                            <img src="{{ asset('assets/media/icons/file-icon.png') }}" class="theme-dark-show" alt=""/>                          
                                    </div>
                                    <!--end::Image-->
            
                                    <!--begin::Title-->
                                    <div class="fs-5 fw-bold mb-2">{{ Str::limit($doc_bl->document,20) }}</div>
                                    <!--end::Title-->
                                </a>
                                @endif
                                <!--end::Name-->
            
                                <!--begin::Description-->
                                <div class="fs-7 fw-semibold text-dark-400">BL &nbsp;
                                    @if ($doc_bl)
                                    <a href="{{ route('document.delete',$doc_bl->id) }}"><button class="btn btn-sm btn-light-danger w-25">Delete</button></a>
                                    @endif
                                </div>
                                @if(!$doc_bl)
                                <!--<label class="form-label">BL</label>-->
                                <input type="file" name="bl" class="form-control mb-2 mb-md-0" placeholder="" />
                                @endif
                                <!--end::Description-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                    </div>

                    <div class="col-md-4">
                        <!--begin::Card-->
                        <div class="card h-100">
                            <!--begin::Card body-->
                            <div class="card-body d-flex justify-content-center text-center flex-column p-1">
                                <!--begin::Name-->
                                @if ($doc_shipping_do)
                                <a href="{{ asset('documents/'.$doc_shipping_do->type.'/'.$doc_shipping_do->document) }}" target="_blank" class="text-gray-800 text-hover-primary d-flex flex-column">
                                    <!--begin::Image-->
                                    <div class="symbol symbol-60px mb-5">
                                        <img src="{{ asset('assets/media/icons/file-icon.png') }}" class="theme-light-show" alt=""/>
                                            <img src="{{ asset('assets/media/icons/file-icon.png') }}" class="theme-dark-show" alt=""/>                          
                                    </div>
                                    <!--end::Image-->
            
                                    <!--begin::Title-->
                                    <div class="fs-5 fw-bold mb-2">{{ Str::limit($doc_shipping_do->document,20) }}</div>
                                    <!--end::Title-->
                                </a>
                                @endif
                                <!--end::Name-->
            
                                <!--begin::Description-->
                                <div class="fs-7 fw-semibold text-dark-400">Shipping d/o &nbsp;
                                    @if ($doc_shipping_do)
                                    <a href="{{ route('document.delete',$doc_shipping_do->id) }}"><button class="btn btn-sm btn-light-danger w-25">Delete</button></a>
                                    @endif
                                </div>
                                @if(!$doc_shipping_do)
                                <!--<label class="form-label">Shipping d/o</label>-->
                                <input type="file" name="shipping_do" class="form-control mb-2 mb-md-0" placeholder="" />
                                @endif
                                <!--end::Description-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
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
</x-default-layout>
