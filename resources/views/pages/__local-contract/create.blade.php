<x-default-layout>
	<!--begin::Table widget 14-->
<div class="card card-flush h-md-100">
	<!--begin::Header-->
	<div class="card-header pt-7">
		<!--begin::Title-->
		<h3 class="card-title align-items-start flex-column">
			<span class="card-label fw-bold text-gray-800">Add Local Contract</span>
		</h3>
		<!--end::Title-->
	</div>
	<!--end::Header-->
	<!--begin::Body-->
	<div class="card-body pt-6">
		<form class="pt-1" id="contract-form" method="POST" action="/local-contract">
			@csrf
			<div class="row justify-content-center">
				<div class="col-md-4">
					<label for="company_id" class="form-label">Business</label>
					<select class="form-select form-select-lg mb-4" name="business_id">
                        <option>-- Select Business --</option>
                        @foreach ($businesses as $business)
						    <option value="{{ $business->id }}">{{ $business->name }}</option>
                        @endforeach
					</select>
				</div>
				<div class="col-md-4">
					<label for="product_id" class="form-label">Buyer</label>
					<select class="form-select form-select-lg mb-4" name="buyer_id">
                        <option>-- Select Buyers  --</option>    
						@foreach ($buyers as $buyer)
                        <option value="{{ $buyer->id }}">{{ $buyer->name }}</option>
                        @endforeach
					</select>
				</div>
				<div class="col-md-4">
					<label for="vessel_id" class="form-label">Product</label>
					<select class="form-select form-select-lg mb-4" id="product_id" name="product_id">
                        <option>-- Select Products --</option>        
						@foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
					</select>
				</div>
                <span class="spinner-border text-primary d-none" role="status">
                    <span class="visually-hidden">Loading...</span>
                </span>
				<div class="col-md-4 mt-4 inventory-bl" style="display: none;">
                    <label for="" class="form-label">InventoryBL</label>
                    <select id="inventory_bl" name="inventory_bl[]" style="width:400px">
                        
                    </select>
                    
				</div>
				<div class="col-md-4" hidden>
					<label for="voyage_number" class="form-label">&nbsp;</label>
					<input type="number" class="form-control form-control-lg border-dark" placeholder="Quantity" name="quantity" required />
				</div>
			</div>
			
			<div class="text-center mt-4">
					<button type="submit" class="btn btn-lg btn-light fw-bold btn-primary me-2 contract-submit" data-kt-search-element="advanced-options-form-cancel">Next</button>
			</div>
		</form>
	</div>
	<!--end: Card Body-->
</div>
<!--end::Table widget 14-->

</x-default-layout>

    <script>
        $(document).on("click",".contract-submit", function () {
            $('#contract-form').submit();
        });
    </script>

    <script>
       $(document).on('change','#product_id', function () {
                
                var product_id = $(this).val();
                $('#inventory_bl').html('');
                $('.spinner-border').removeClass('d-none');
                $.ajax({
                    url: "{{route('fetch.inventory')}}",
                    type: "GET",
                    data: {
                        product_id: product_id,
                    },
                    success: function (result) {

                        $('#inventory_bl').html('<option value="">-- Select InventoryBL --</option>');
                        
                        $('.inventory-bl').show();
                        $('input.select2-search__field').attr('placeholder','-- Select BL --');
                        $('.spinner-border').addClass('d-none');
                        $('#inventory_bl').prop('disabled', false);
                        $.each(result, function (key, value) {
                            $("#inventory_bl").append('<option value="' + value
                                .id + '">#' + value.bl_number + '     Quantity : ' + value.bl_qty + '  Vessel Name : '+ value.vessel + '</option>');
                        });

                    },
                    error: function () {
                        $('.inventory-bl').show();
                        $('.spinner-border').addClass('d-none');
                        $('#inventory_bl').prop('disabled', true);
                        $('input.select2-search__field').attr('placeholder','No Inventory BL Available');
                    }

                });
            });
    </script>

<script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    // var selectedValuesTest = ["WY","AL", "NY"];
    $(document).ready(function() {
        $("#inventory_bl").select2({
                multiple: true,
                placeholder: "-- Select BL --",
            });
            // $('#inventory_bl').select2('val', selectedValuesTest);
    });
    </script>