<x-default-layout>
	<!--begin::Table widget 14-->
<div class="card card-flush h-md-100 mb-4">
	<!--begin::Header-->
	<div class="card-header pt-7">
		<!--begin::Title-->
		<h3 class="card-title align-items-start flex-column">
			<span class="card-label fw-bold text-gray-800">Edit Inventory</span>
		</h3>
		<!--end::Title-->
	</div>
	<!--end::Header-->
	<!--begin::Body-->
	<div class="card-body pt-6">
		<form class="pt-1" method="POST" action="/inventories/{{ $inventory->id }}">
			@csrf
			@method('PUT')
			<div class="row justify-content-center">
				<div class="col-md-4">
					<label for="company_id" class="form-label">Seller</label>
					<select class="form-select form-select-lg mb-4" name="company_id">
						@foreach($sellers as $seller)
							<option value="{{ $seller->id }}" {{ ($seller->id == $inventory->seller_id) ? 'selected' : '' }}>{{ $seller->name }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-md-4">
					<label for="product_id" class="form-label">Product</label>
					<select class="form-select form-select-lg mb-4" name="product_id">
						@foreach($products as $product)
							<option value="{{ $product->id }}" {{ ($product->id == $inventory->product_id) ? 'selected' : '' }}>{{ $product->name }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-md-4">
					<label for="vessel_id" class="form-label">Vessel</label>
					<select class="form-select form-select-lg mb-4" name="vessel_id">
						@foreach($vessels as $vessel)
							<option value="{{ $vessel->id }}" {{ ($vessel->id == $inventory->vessel_id) ? 'selected' : '' }}>{{ $vessel->name }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-md-4">
					<label for="vessel_id" class="form-label">Buyer</label>
					<select class="form-select form-select-lg mb-4" name="buyer_id">
						@foreach($buyers as $buyer)
							<option value="{{ $buyer->id }}" {{ ($buyer->id == $inventory->buyer_id) ? 'selected' : '' }}>{{ $buyer->name }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-md-4">
					<label for="terminal_id" class="form-label">Terminal</label>
					<select class="form-select form-select-lg mb-4" name="terminal_id">
						@foreach($terminals as $terminal)
							<option value="{{ $terminal->id }}" {{ ($terminal->id == $inventory->terminal_id) ? 'selected' : '' }}>{{ $terminal->name }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-md-4">
					<label for="clearing_agent" class="form-label">Clearing Agent</label>
					<select class="form-select form-select-lg mb-4" name="clearing_agent_id">
						@foreach($clearing_agents as $clearing_agent)
							<option value="{{ $clearing_agent->id }}" {{ ($clearing_agent->id == $inventory->clearing_agent_id) ? 'selected' : '' }}>{{ $clearing_agent->name }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-md-4">
					<label for="voyage_number" class="form-label">Voyage Number</label>
					<input type="text" class="form-control form-control-lg border-dark" placeholder="Voyage Number" name="voyage_number" value="{{ $inventory->voyage_number }}" required />
				</div>
			</div>
			<!--begin::Repeater-->
			<div id="kt_docs_repeater_basic">
			    <!--begin::Form group-->
			    <div class="form-group">
			        <div class="my-5" data-repeater-list="inventory_bls">
			            <div class="border-1 rounded-3 my-5 border-secondary border p-3" data-repeater-item>
			                <div class="form-group row gy-3	">
			                    <div class="col-md-6">
			                        <label class="form-label">BL Number:</label>
			                        <input type="text" name="bl_number" class="form-control mb-2 mb-md-0" placeholder="BL Number" required />
			                    </div>
			                    <div class="col-md-6 text-end">
			                        <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8">
			                            <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
			                            Delete
			                        </a>
			                    </div>
			                    <div class="col-md-6">
			                        <label class="form-label">BL Quantity:</label>
			                        <input type="number" name="bl_quantity" class="form-control mb-2 mb-md-0" placeholder="Enter BL Quantity" step=".0001" required />
			                    </div>
			                    <div class="col-md-6">
			                        <label class="form-label">Landed Quantity</label>
			                        <input type="number" name="landed_quantity" class="form-control mb-2 mb-md-0" placeholder="Enter Landed Quantity" step=".0001" required />
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
			<div class="col-md-12 text-end">
				<button type="submit" class="btn btn-sm btn-light fw-bold btn-primary me-2" data-kt-search-element="advanced-options-form-cancel">Update</button>
			</div>
			<!--begin::Input group-->
		</form>


	</div>
	<!--end: Card Body-->
</div>
<!--end::Table widget 14-->
<div class="card card-flush h-md-100">
	<div class="card-header pt-7">
		<!--begin::Title-->
		<h3 class="card-title align-items-start flex-column">
			<span class="card-label fw-bold text-gray-800">BLs</span>
		</h3>
		<!--end::Title-->
	</div>
	<div class="card-body pt-6">
		@foreach($inventory->bls as $bl)
		<form class="pt-1" method="POST" action="{{ route('inventory.bls.update', $bl->id) }}">
			@csrf
			@method('PUT')
		<div class="form-group">
        <div class="my-5">
          <div class="border-1 rounded-3 my-5 border-secondary border p-3" data-repeater-item>
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
				<div class="col-md-4">
					<label for="index_number" class="form-label">Index Number</label>
					<input type="text" class="form-control form-control-lg border-dark" placeholder="Index Number" name="index_number" required />
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
{!! theme()->addVendor('formrepeater') !!}
@push('scripts')
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
@endpush
</x-default-layout>