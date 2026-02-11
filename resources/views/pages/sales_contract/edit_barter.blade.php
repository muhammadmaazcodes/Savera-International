<x-default-layout>
	<!--begin::Table widget 14-->
<div class="card card-flush h-md-100">
	<!--begin::Header-->
	<div class="card-header pt-7">
		<!--begin::Title-->
		<h3 class="card-title align-items-start flex-column">
			<span class="card-label fw-bold text-gray-800">Edit Barter Contract</span>
		</h3>
		<!--end::Title-->
	</div>
	<!--end::Header-->
	<!--begin::Body-->

	{{-- Begin Tabs --}}
	
		{{-- FIRST TAB --}}
		
			<div class="card-body pt-6">
				<form class="pt-1" id="contract-form" method="POST" action="/local-contract/{{ $contract->id }}">
					@csrf
          @method('PUT')
					<div class="row justify-content-center">
		
						<div class="col-md-4">
							<label for="voyage_number" class="form-label">Contract Date</label>
							<input type="date" class="form-control form-control-lg border-dark" placeholder="" value="{{ $contract->date }}" name="date" required />
						</div>
		
						<div class="col-md-4">
							<label for="voyage_number" class="form-label">Lifting Date</label>
							<input type="date" class="form-control form-control-lg border-dark" placeholder="" value="{{ $contract->lifting_date }}" name="lifting_date" required />
						</div>

            <div class="col-md-4">
							<label for="voyage_number" class="form-label">Return Date</label>
							<input type="date" class="form-control form-control-lg border-dark" placeholder="" value="{{ $contract->return_date }}" name="return_date" required />
						</div>    

						<div class="col-md-4 mt-3">
							<label for="company_id" class="form-label">Business</label>
							<select class="form-select form-select-lg mb-4" name="bussiness_id" required>
								<option>-- Select Business --</option>
								@foreach ($businesses as $business)
									<option value="{{ $business->id }}" {{ ($contract->bussiness_id) == $business->id ? 'selected' : '' }}>{{ $business->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="col-md-4 mt-3">
							<label for="product_id" class="form-label">Buyer</label>
							<select class="form-select form-select-lg mb-4" name="buyer_id" required>
								<option>-- Select Buyers  --</option>    
								@foreach ($buyers as $buyer)
								<option value="{{ $buyer->id }}" {{ ($contract->buyer_id) == $buyer->id ? 'selected' : '' }}>{{ $buyer->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="col-md-4 mt-3">
							<label for="vessel_id" class="form-label">Vessels</label>
							<select class="form-select form-select-lg mb-4" id="inventory_id" name="inventory_id" required>
								<option>-- Select Vessels --</option>        
								@foreach ($inventories as $inventory)
								<option value="{{ $inventory->id }}" {{ ($contract->inventory_id) == $inventory->id ? 'selected' : '' }}>{{ $inventory->vessel->name }}</option>
								@endforeach
							</select>
						</div>
						
						<br>
						&nbsp;
						<hr>
						<br>
						<div class="col-md-4 mt-3">
							<label for="voyage_number" class="form-label">Quantity</label>
							<input type="number" class="form-control form-control-lg border-dark" placeholder="Quantity" id="quantity" value="{{ $contract->quantity }}" name="quantity" required />
						</div>
                        <input type="hidden" name="type" value="barter">
            <div class="col-md-4 mt-3">
							<label for="" class="form-label">Return Product</label>
							<select class="form-select form-select-lg mb-4" name="return_product" required>
								<option>-- Select Return Product --</option>
								@foreach ($products as $product)
									<option value="{{ $product->id }}" {{ ($contract->return_product) == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
								@endforeach
							</select>
						</div>
		
					</div>
					
					<div class="text-center mt-4">
							<button type="submit" class="btn btn-lg btn-light fw-bold btn-primary me-2 contract-submit" data-kt-search-element="advanced-options-form-cancel">Update</button>
					</div>
				</form>
			</div>

		
		

	  
	  {{-- End Tabs --}}

	
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

        var inventory_id = $("#inventory_id").val();
        var quantity = $("#quantity").val();
			
        $.ajax({
           type:'GET',
           url:"{{ route('check.quantity') }}",
           data:{
				inventory_id:inventory_id,
			 	quantity:quantity
			},
           success:function(data){
              if(data < quantity)
			  {
				$('#quantity').removeClass('border-dark').addClass('border-danger').attr('max',data);
                    swal({
                    title: "Your given quantity is not avaible in the contract !",
                    text: "Please decrease the quantity!",
                    icon: "warning",
                    button: "Ok!",
                    });

			  }
			  else {
				$('#quantity').removeClass('border-danger').addClass('border-dark');
			  }
           }
        });
  
    });
</script>

<script>
    // var selectedValuesTest = ["WY","AL", "NY"];
    $(document).ready(function() {
        $("#vessel_split").select2({
                multiple: true,
                placeholder: "-- Select Vessels --",
            });
            // $('#inventory_bl').select2('val', selectedValuesTest);
    });
    </script>
