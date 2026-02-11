<x-default-layout>
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
                                <a href="#" class="text-gray-800 text-hover-primary fs-2 fw-bold me-3"><img src="{{ asset('assets/media/icons/sales-view.png') }}" height="40" alt=""> Requested Sales</a>
                            </div>
                            <!--end::Status-->
    
                            <!--begin::Description-->
                            <!--end::Description-->
                        </div>
                        <!--end::Details-->
    
                        <!--begin::Actions-->
                        <div class="d-flex mb-4">
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
                                    <div class="fs-4 fw-bold">{{ $sale->buyer->name }}</div>
                                </div>
                                <!--end::Number-->
    
                                <!--begin::Label-->
                                <div class="fw-semibold fs-6 text-gray-400">Buyer Name</div>
                                <!--end::Label-->
                            </div>
                            <!--end::Stat-->
    
                            <!--begin::Stat-->
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <!--begin::Number-->
                                <div class="d-flex align-items-center">
                                        <div class="fs-4 fw-bold counted" data-kt-countup="true" data-kt-countup-value="75" data-kt-initialized="1">{{ $sale->product->name }}</div>
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
                                    <div class="fs-4 fw-bold counted" data-kt-countup="true" data-kt-countup-value="15000" data-kt-countup-prefix="$" data-kt-initialized="1">{{ $sale->quantity }} Ton</div>
                                </div>
                                <!--end::Number-->                                
    
                                <!--begin::Label-->
                                <div class="fw-semibold fs-6 text-gray-400">Quantity</div>
                                <!--end::Label-->
                            </div>
                            <!--end::Stat-->
                            <div></div>

                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <!--begin::Number-->
                                <div class="d-flex align-items-center">
                                    <div class="fs-4 fw-bold counted" data-kt-countup="true" data-kt-countup-value="15000" data-kt-countup-prefix="$" data-kt-initialized="1">{{ $sale->vehicle_number }}</div>
                                </div>
                                <!--end::Number-->                                
    
                                <!--begin::Label-->
                                <div class="fw-semibold fs-6 text-gray-400">Vehicle Number</div>
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




    <!--begin::Repeater-->
    <div class="card mt-3">

        <div class="card-header pt-7">
            <!--begin::Title-->
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold text-gray-800"><img src="{{ asset('assets/media/icons/lifting.png') }}" height="40" alt=""> Add Liftings</span>
            </h3>
            <!--end::Title-->

        </div>

        <div class="card-body">
            <form class="pt-1" method="POST" action="{{ route('lifting.store') }}">
                @csrf    
			    <!--begin::Form group-->
			    <div class="form-group">
			       
                    <div class="border-1 rounded-3 my-5 border-secondary border p-3" data-repeater-item>
                        <div class="form-group row gy-3	">
                            <div class="col-md-9">
                                <label for="vessel_id" class="form-label">BL</label>
                                @if ($sale->lifting_bls == '[]')
                                <select name="bl_id[]" multiple class="bl_id form-select" style="width:auto">
                                    <option></option>
                                    @foreach($bls as $key => $bl)
                                        <option value="{{ $bl->id }}">{{ $bl->inventory->vessel->name }} #{{ $bl->index_number }}</option>
                                    @endforeach
                                </select>
                                @else
                                    <select name="" multiple class="bls form-select" disabled style="width:auto">
                                        <option></option>
                                        @foreach($sale->lifting_bls as $key => $bls)
                                            @php
                                                $bl = App\Models\InventoryBL::where('id',$bls->bl_id)->first();
                                            @endphp
                                            <option value="{{ $bl->id }}" disabled selected>{{ $bl->inventory->vessel->name }} #{{ $bl->index_number }}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>

                            <input type="hidden" name="sale_id" value="{{ $sale->id }}">
                            <div class="col-md-3 text-end">
                                &nbsp;
                            </div>
                            
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                        <!--begin::Table head-->
                                        <thead>
                                            <tr class="fw-bold text-muted">
                                                <th class="min-w-200px">BL</th>
                                                <th class="min-w-150px">Quantity (Ton)</th>
                                            </tr>
                                        </thead>
                                        <!--end::Table head-->
                        
                                        <!--begin::Table body-->
                                        
                                        @if ($sale->lifting_bls == '[]')
                                        <tbody class="bl-quantities">
                                            
                                        </tbody>
                                        @else           
                                            <tbody>
                                                @foreach ($sale->lifting_bls as $bls)
                                                    @php
                                                        $bl = App\Models\InventoryBL::where('id',$bls->bl_id)->first();
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $bl->inventory->vessel->name }} #{{ $bl->index_number }}</td>
                                                        <td><input type="number" disabled class="form-control w-25" value="{{ $bls->quantity }}"></td>
                                                    </tr>   
                                                @endforeach
                                            </tbody>
                                        @endif
                                        <!--end::Table body-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                            </div>

                        </div>
                    </div>
                        
			    </div>
			    <!--end::Form group-->

			    <!--begin::Form group-->
			    <!--end::Form group-->

            <button type="submit" class="btn btn-primary btn-sm text-center mt-4">Update</button>
        </form>
			<!--end::Repeater-->
        </div>
    </div>

{!! theme()->addVendor('formrepeater') !!}
@push('scripts')
<script>
	$('#kt_docs_repeater_basic').repeater({
    initEmpty: false,

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


<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $(".bl_id").select2({
                multiple: true,
                placeholder: "-- Select BL --",
            });
        $(".bls").select2({
            multiple: true,
            placeholder: "-- Select BL --",
        });
    });
    </script>
    <script>
        $(document).on("change",".bl_id", function () {
            var value = $("option:selected:last",this).text();
            var tr = '' + 
                '<tr>' + 
                '     <td>' + value + '</td>' + 
                '     <td><input name="bl_quantity[]" type="number" class="form-control w-25"></td>' + 
                '</tr>' + 
                '';
            $('.bl-quantities').append(tr);
        });
    </script>
@endpush

</x-default-layout>