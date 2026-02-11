<x-default-layout>
	<!--begin::Table widget 14-->
<div class="card card-flush h-md-100">
	<!--begin::Header-->
	<div class="card-header pt-7">
		<!--begin::Title-->
		<h3 class="card-title align-items-start flex-column">
			<span class="card-label fw-bold text-gray-800">Edit Local Contract</span>
		</h3>
		<!--end::Title-->
		<h3 class="card-title align-items-end flex-column">
			<span class="card-label fw-bold text-gray-800" id="contract_code"></span>
		</h3>

	</div>
	<!--end::Header-->
	<!--begin::Body-->

			<div class="card-body pt-6">
				<form class="pt-1" id="contract-form" method="POST" action="/local-contract/{{ $contract->id }}">
					@csrf
          @method('PUT')
            <input type="hidden" name="type" value="normal">
					<div class="row">
						<div class="col-md">
							<label for="company_id" class="form-label">Business</label>
							<select class="form-select form-select-lg mb-4" name="bussiness_id" id="bussiness_id">
								<option>-- Select Business --</option>
								@foreach ($businesses as $business)
									<option value="{{ $business->id }}" {{ ($contract->bussiness_id) == $business->id ? 'selected' : '' }} data-code="{{ $business->code }}">{{ $business->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="col-md">
							<label for="voyage_number" class="form-label">Contract Date</label>
							<input type="date" class="form-control form-control-lg border-dark" placeholder="FX Rate" value="{{ $contract->date }}" name="date" />
						</div>
		
						<div class="col-md">
							<label for="voyage_number" class="form-label">Lifting Date</label>
							<input type="date" class="form-control form-control-lg border-dark" placeholder="" value="{{ $contract->lifting_date }}" name="lifting_date" />
						</div>
						<div class="col-md">
							<label for="product" class="form-label">Product</label>
							<select class="form-select form-select-lg mb-4" id="product_id" name="product_id">
								<option>-- Select Product --</option>        
								@foreach ($products as $product)
								<option value="{{ $product->id }}" {{ ($contract->product_id) == $product->id ? 'selected' : '' }} data-code={{ $product->code }}>{{ $product->code }}</option>
								@endforeach
							</select>
						</div>
						<div class="col-md">
							<label for="product_id" class="form-label">Buyer</label>
							<select class="form-select form-select-lg mb-4" name="buyer_id">
								<option>-- Select Buyers  --</option>    
								@foreach ($buyers as $buyer)
								<option value="{{ $buyer->id }}" {{ ($contract->buyer_id) == $buyer->id ? 'selected' : '' }}>{{ $buyer->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="col-md">
							<label for="vessel_id" class="form-label">Payment Terms</label>
							<select class="form-select form-select-lg mb-4" id="payment_term" name="payment_term">
								<option>-- Select Payment Term --</option>        
								@foreach ($payments as $payment)
								<option value="{{ $payment->id }}" {{ ($contract->payment_term) == $payment->id ? 'selected' : '' }}>{{ $payment->name }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-md mt-3">
							<label for="rate" class="form-label">Rate (Per Maund)</label>
							<div class="input-group">
                <span class="input-group-text" id="basic-addon1">PKR</span>
								<input type="number" class="form-control form-control-lg border-dark" placeholder="Rate (Per Maund)" value="{{ $contract->rate }}" name="rate"  />
							</div>
						</div>
		
						<div class="col-md mt-3">
							<label for="selling_price" class="form-label">Selling Price (Per Maund)</label>
							<div class="input-group">
                				<span class="input-group-text" id="basic-addon1">PKR</span>
								<input type="number" class="form-control form-control-lg border-dark" placeholder="Selling Price" value="{{ $contract->selling_price }}" name="selling_price" />
							</div>
						</div>
		
						<div class="col-md mt-3">
							<label for="provisional_price" class="form-label">Provisional Price</label>
							<div class="input-group">
								<span class="input-group-text" id="basic-addon1">USD</span>
								<input type="number" class="form-control form-control-lg border-dark" placeholder="Provisional Price" value="{{ $contract->provisional_price }}" name="provisional_price" />
							</div>
						</div>
		
						<div class="col-md mt-3">
							<label for="final_price" class="form-label">Final Price</label>
							<div class="input-group">
                				<span class="input-group-text" id="basic-addon1">USD</span>
								<input type="number" class="form-control form-control-lg border-dark" placeholder="Final Price" value="{{ $contract->final_price }}" name="final_price" />
							</div>
						</div>
		
						<div class="col-md mt-3">
							<label for="fx_rate" class="form-label">FX Rate</label>
							<div class="input-group">
                				<span class="input-group-text" id="basic-addon1">PKR</span>
								<input type="number" class="form-control form-control-lg border-dark" placeholder="FX Rate" value="{{ $contract->fx_rate }}" name="fx_rate" />
							</div>
						</div>
					</div>
					<hr class="mt-10 mb-10">
					
					<div class="row main-row">
						<div class="col-md-2 mt-3">
							<label for="inventory_id" class="form-label">Vessels</label>
							<select class="form-select form-select-lg mb-4" id="inventory_id" name="inventory_id">
								<option>-- Select Vessels --</option>        
								@foreach ($inventories as $inventory)
								<option value="{{ $inventory->id }}" {{ ($contract->inventory_id) == $inventory->id ? 'selected' : '' }} data-seller="{{ $inventory->seller->name }}" data-unsoldqty="{{ $inventory->unsold_qty() }}" data-voyage="{{ $inventory->voyage_number }}" data-product_code={{ $inventory->product->code ?? '' }}>{{ $inventory->vessel->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="col-md-2 mt-3">
							<label for="int_seller" class="form-label">Int. Seller</label>
							<input type="text" class="form-control" id="int_seller" readonly>
						</div>
						
						<div class="col-md-2 mt-3">
							<label for="unsold_qty" class="form-label">Unsold Quantity</label>
							<input type="text" class="form-control" id="unsold_qty" readonly>
						</div>
						<div class="col-md-2 mt-3">
							<label for="quantity" class="form-label">Quantity</label>
							<input type="number" class="form-control form-control-lg border-dark" placeholder="Quantity" id="quantity" value="{{ $contract->quantity }}" name="quantity" required />
						</div>
		
						
					</div>
					
					<div class="text-center mt-15">
							<button type="submit" class="btn btn-lg btn-light fw-bold btn-primary me-2 contract-submit" data-kt-search-element="advanced-options-form-cancel">Update</button>
					</div>
				</form>
			</div>

	
	<!--end: Card Body-->
</div>
<!--end::Table widget 14-->

</x-default-layout>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script type="text/javascript">

	$(document).on("blur","#quantity",function(){

		var unsold_qty = $("#inventory_id").find(':selected').data('unsoldqty');
		var quantity = $("#quantity").val();
		var vessel_options = $('#inventory_id').html();

			if(parseFloat(unsold_qty) < parseFloat(quantity))
		  {
			$('#quantity').removeClass('border-dark').addClass('border-danger').attr('max',unsold_qty);
			swal({
				title: "Do you want to split the contract?",
				text: "The quantity you want is not available in the vessel!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
				})
				.then((willDelete) => {
				if (willDelete) {
					// $('#profile-tab').trigger('click');
					var qty_re = parseFloat(quantity) - parseFloat(unsold_qty);
					var row = '' + 
		'		<div class="row">' + 
		'			<div class="col-md-2 mt-3">' + 
		'					<label for="vessel_id" class="form-label">Vessels</label>' + 
		'					<select class="form-select form-select-lg mb-4 inventory_id" name="inventory_id">' + 
							vessel_options +
		'					</select>' + 
		'						</div>' + 
		'			<div class="col-md-2 mt-3">' + 
		'						<label for="int_seller" class="form-label">Int. Seller</label>' + 
		'						<input type="text" class="form-control int_seller" readonly>' + 
		'			</div>' + 
		'			<div class="col-md-2 mt-3">' + 
		'					<label for="unsold_qty" class="form-label">Unsold Quantity</label>' + 
		'					<input type="text" class="form-control unsold_qty" readonly>' + 
		'			</div>' + 
		'			<div class="col-md-2 mt-3">' + 
		'					<label for="voyage_number" class="form-label">Quantity</label>' + 
		'					<input type="number" class="form-control form-control-lg border-dark quantity" value='+ qty_re +' placeholder="Quantity" name="quantity" required />' + 
		'			</div>' + 
		'</div>' + 
		'';
			$(row).insertAfter('.main-row');

				} else {
					swal("Ok! Try to decrease the quantity.");
				}
				});

		  }
		  else {
			$('#quantity').removeClass('border-danger').addClass('border-dark');
		  }

  
    });

    //generate contract code
    $('#inventory_id, #bussiness_id').on('change', function() {

    	var currentTime = new Date();
	    var current_month = (currentTime.getMonth() + 1).toString().padStart(2, '0');
	    var current_year = currentTime.getYear().toString().substr(-2);
		var business_code = $('#bussiness_id').find(':selected').data('code') + '-' + current_year;
		var product_code = $('#inventory_id').find(':selected').data('product_code');
		var voyage =  $('#inventory_id').find(':selected').data('voyage');

	    var contract_code = business_code + '/' + current_month + '/' + product_code + '/' + voyage + '/---';

		$('#contract_code').text(contract_code);

	    console.log(contract_code)

    });

    $('#inventory_id').on('change', function(e) {
    	var int_seller = $(this).find(':selected').data('seller');
    	var unsold_qty = $(this).find(':selected').data('unsoldqty');
    	$('#int_seller').val(int_seller);
    	$('#unsold_qty').val(unsold_qty);
    });

		$(document).on('change','.inventory_id', function(e) {
			
			var int_seller = $(this).find(':selected').data('seller');
    	var unsold_qty = $(this).find(':selected').data('unsoldqty');

			var int_sel = $(this).closest('.row').find('input.int_seller');
			int_sel.val(int_seller);

			var uns_qty = $(this).closest('.row').find('input.unsold_qty');
			uns_qty.val(unsold_qty);

			$('.quantity:last').blur();
			
    });

// New Row Qty Check
	$(document).on("blur",".quantity",function(){

		var unsold_qty =	$(this).closest('.row').find('input.unsold_qty').val();
		var quantity = $(this).val();
		var vessel_options = $('#inventory_id').first().html();

	if(parseFloat(unsold_qty) < parseFloat(quantity))
	{
	$(this).removeClass('border-dark').addClass('border-danger').attr('max',unsold_qty);
	swal({
		title: "Do you want to split the contract?",
		text: "The quantity you want is not available in the vessel!",
		icon: "warning",
		buttons: true,
		dangerMode: true,
		})
		.then((willDelete) => {
		if (willDelete) {
			// $('#profile-tab').trigger('click');
			var qty_re = parseFloat(quantity) - parseFloat(unsold_qty);
			var row = '' + 
'		<div class="row">' + 
'			<div class="col-md-2 mt-3">' + 
'					<label for="vessel_id" class="form-label">Vessels</label>' + 
'					<select class="form-select form-select-lg mb-4 inventory_id" name="inventory_id">' + 
					vessel_options +
'					</select>' + 
'						</div>' + 
'			<div class="col-md-2 mt-3">' + 
'						<label for="int_seller" class="form-label">Int. Seller</label>' + 
'						<input type="text" class="form-control int_seller" readonly>' + 
'			</div>' + 
'			<div class="col-md-2 mt-3">' + 
'					<label for="unsold_qty" class="form-label">Unsold Quantity</label>' + 
'					<input type="text" class="form-control unsold_qty" readonly>' + 
'			</div>' + 
'			<div class="col-md-2 mt-3">' + 
'					<label for="voyage_number" class="form-label">Quantity</label>' + 
'					<input type="number" class="form-control form-control-lg border-dark quantity" value='+ qty_re +' placeholder="Quantity" name="quantity" required />' + 
'			</div>' + 
'</div>' + 
'';
	$(row).insertAfter($(this).closest('.row'));

		} else {
			swal("Ok! Try to decrease the quantity.");
		}
		});

	}
	else {
	$(this).removeClass('border-danger').addClass('border-dark');
	}


});
</script>


<script>
    // var selectedValuesTest = ["WY","AL", "NY"];
    $(document).ready(function() {
      $('#inventory_id').trigger('change');
        $("#vessel_split").select2({
                multiple: true,
                placeholder: "-- Select Vessels --",
            });
            // $('#inventory_bl').select2('val', selectedValuesTest);
    });
    </script>
