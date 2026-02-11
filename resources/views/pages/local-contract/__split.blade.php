<x-default-layout>
	<!--begin::Table widget 14-->
<div class="card card-flush h-md-100">
	<!--begin::Header-->
	<div class="card-header pt-7">
		<!--begin::Title-->
		<h3 class="card-title align-items-start flex-column">
			<span class="card-label fw-bold text-gray-800">Split Local Contract</span>
		</h3>
		<!--end::Title-->
		<h3 class="card-title align-items-end flex-column">
			<span class="card-label fw-bold fs-6 text-gray-800" id="contract_code">#{{ $contract->code }}</span>
		</h3>

	</div>
	<!--end::Header-->
	<!--begin::Body-->

	{{-- Begin Tabs --}}
			<div class="card-body pt-6">
				<form class="pt-1" id="contract-form" method="POST" action="/local-contracts/split/{{ $contract->id }}">
					@csrf
					<div class="row justify-content-start">
						<div class="col-md-3">
							<label for="" class="form-label">Transaction Type</label>
							<select class="form-select form-select-lg mb-4" name="type" id="transaction_type">
								<option value="">-- Select Tran. Type --</option>
								<option value="normal">Normal</option>
								<option value="barter">Barter</option>
								<option value="temp">Temporary</option>
							</select>
						</div>
					</div>
					<div class="row">

						<div class="col-md">
							<label for="voyage_number" class="form-label">Contract Date <span class="text-danger">*</span></label>
							<input type="date" class="form-control form-control-lg" placeholder="" name="date" required />
						</div>
		
						<div class="col-md">
							<label for="voyage_number" class="form-label">Lifting Date <span class="text-danger">*</span></label>
							<input type="date" class="form-control form-control-lg" placeholder="" name="lifting_date" required />
						</div>
						<div class="col-md">
							<label for="product" class="form-label">Product <span class="text-danger">*</span></label>
							<select class="form-select form-select-lg mb-4" id="product_id" name="product_id" required>
								<option>-- Select Product --</option>        
								@foreach ($products as $product)
								<option value="{{ $product->id }}" data-code={{ $product->code }}>{{ $product->code }}</option>
								@endforeach
							</select>
						</div>
						<div class="col-md">
							<label for="product_id" class="form-label">Buyer <span class="text-danger">*</span></label>
							<select class="form-select form-select-lg mb-4" name="buyer_id" required>
								<option>-- Select Buyers  --</option>    
								@foreach ($buyers as $buyer)
								<option value="{{ $buyer->id }}">{{ $buyer->name }}</option>
								@endforeach
							</select>
						</div>

					</div>

					<div class="row">
						<div class="col-md-2 mt-3">
							<label for="voyage_number" class="form-label">Contract Qty. <span class="text-danger">*</span></label>
							<input type="number" class="form-control form-control-lg" step="0.0001" placeholder="Qty." id="quantity" name="quantity" required />
						</div>
						<div class="col-md-2 mt-3">
							<label for="voyage_number" class="form-label">Selling Price <span class="text-danger">*</span></label>
							<div class="input-group" id="selling_price">
								<span class="input-group-text" id="basic-addon1">PKR</span>
								<input type="number" class="form-control form-control-lg" placeholder="" name="selling_price" required />
							</div>
						</div>
						<div class="col-md-2 mt-3">
							<label for="vessel_id" class="form-label">Payment Terms <span class="text-danger">*</span></label>
							<select class="form-select form-select-lg mb-4" id="payment_term" name="payment_term" required>
								<option>-- Select Payment Term --</option>
								@foreach ($payments as $payment)
								<option value="{{ $payment->id }}">{{ $payment->name }}</option>
								@endforeach
							</select>
						</div>

						<div class="col-md-4 mt-3">
							<label for="" class="form-label">Remarks</label>
							<textarea name="remarks" class="form-control" cols="30" rows="2"></textarea>
						</div>
					</div>
					
					<div class="text-center mt-15">
							<button type="submit" class="btn btn-lg btn-light fw-bold btn-primary me-2 contract-submit" data-kt-search-element="advanced-options-form-cancel">Submit</button>
					</div>
				</form>
			</div>

	
	<!--end: Card Body-->
</div>
<!--end::Table widget 14-->

@push('scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
		
	<script>
			function hide_normal() {
					$('#rate').parent().show();
					$('#selling_price').parent().show();
					$('#final_price').parent().show();
					$('#provisional_price').parent().show();
					$('#fx_rate').parent().show();
					$('#payment_term').parent().show();
					$('#return_product').parent().hide();
					$('#return_date').parent().hide();
			}

			function hide_temp() { 
					$('#rate').parent().hide();
					$('#selling_price').parent().hide();
					$('#final_price').parent().hide();
					$('#provisional_price').parent().hide();
					$('#fx_rate').parent().hide();
					$('#payment_term').parent().hide();
					$('#return_product').parent().hide();
					$('#return_date').parent().show();
			}

			function hide_barter() { 
					$('#rate').parent().hide();
					$('#selling_price').parent().hide();
					$('#final_price').parent().hide();
					$('#provisional_price').parent().hide();
					$('#fx_rate').parent().hide();
					$('#payment_term').parent().hide();
					$('#return_product').parent().show();
					$('#return_date').parent().show();
			}
			 

			$(document).on("change","#transaction_type", function () {
				var transaction_type = $(this).find(':selected').val();
				if (transaction_type == 'normal') {
						hide_normal();
				}
				else if(transaction_type == 'temp') {
					hide_temp();
				}
				else if(transaction_type == 'barter') {
					hide_barter();
				}
			});
	</script>
	<script>
		$(document).ready(function () {
				
				let currentDate = new Date();

				let year = currentDate.getFullYear();
				let month = currentDate.getMonth() + 1;
				let day = currentDate.getDate();

				month = month < 10 ? '0' + month : month;
				day = day < 10 ? '0' + day : day;

				let formattedDate = `${year}-${month}-${day}`;
				$('input[name="date"]').attr('min',formattedDate);
		});

		$(document).on("change","input[name='date']", function () {
				let currentDate = new Date($(this).val());

				let year = currentDate.getFullYear();
				let month = currentDate.getMonth() + 1;
				let day = currentDate.getDate();

				month = month < 10 ? '0' + month : month;
				day = day < 10 ? '0' + day : day;

				let formattedDate = `${year}-${month}-${day}`;
				$('input[name="lifting_date"]').attr('min',formattedDate);
		});
	</script>
  <script>
    $(document).on("keyup","#quantity", function () {
          var balance_qty = "{{ $contract->allocations->sum('quantity') }}";
          if ($(this).val() < balance_qty) {
            swal("Entered Quantity is less than balance quantity","","warning");
            $(this).val('')
          }
    });
  </script>
@endpush
</x-default-layout>