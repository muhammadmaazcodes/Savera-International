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

	{{-- Begin Tabs --}}
			<div class="card-body pt-6">
				<form class="pt-1" id="contract-form" method="POST" action="/local-contract/{{ $contract->id }}">
					@csrf
					@method('PUT')
					<div class="row">
						<div class="row justify-content-start">
							<div class="col-md-3">
								<label for="" class="form-label">Transaction Type</label>
								<select class="form-select form-select-lg mb-4" name="type" disabled id="transaction_type">
									<option>-- Select Tran. Type --</option>
									<option {{ $contract->type == 'normal' ? 'selected' : '' }} value="normal">Normal</option>
									<option {{ $contract->type == 'barter' ? 'selected' : '' }} value="barter">Barter</option>
									<option {{ $contract->type == 'temp' ? 'selected' : '' }} value="temp">Temporary</option>
								</select>
							</div>
						</div>
						<div class="col-md">
							<label for="company_id" class="form-label">Business <span class="text-danger">*</span></label>
							<select class="form-select form-select-lg mb-4" name="bussiness_id" id="bussiness_id" required>
								<option value="">-- Select Business --</option>
								@foreach ($businesses as $business)
									<option {{ $contract->bussiness_id == $business->id ? 'selected' : '' }} value="{{ $business->id }}" data-code="{{ $business->code }}">{{ $business->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="col-md">
							<label for="voyage_number" class="form-label">Contract Date <span class="text-danger">*</span></label>
							<input type="date" class="form-control form-control-lg" placeholder="" name="date" value="{{ $contract->date }}" required />
						</div>
		
						<div class="col-md">
							<label for="voyage_number" class="form-label">Lifting Date <span class="text-danger">*</span></label>
							<input type="date" class="form-control form-control-lg" placeholder="" name="lifting_date" value="{{ $contract->lifting_date }}" required />
						</div>
						<div class="col-md">
							<label for="product" class="form-label">Product</label>
							<select class="form-select form-select-lg mb-4" disabled>
								<option value="">-- Select Product --</option>        
								@foreach ($products as $product)
								<option {{ $contract->product_id == $product->id ? 'selected' : '' }} value="{{ $product->id }}" data-code={{ $product->code }}>{{ $product->code }}</option>
								@endforeach
							</select>
						</div>
						<input type="hidden" name="product_id" value="{{ $contract->product_id }}">
						<div class="col-md">
							<label for="product_id" class="form-label">Buyer <span class="text-danger">*</span></label>
							<select class="form-select form-select-lg mb-4" name="buyer_id" required>
								<option value="">-- Select Buyers  --</option>    
								@foreach ($buyers as $buyer)
								<option {{ $contract->buyer_id == $buyer->id ? 'selected' : '' }} value="{{ $buyer->id }}">{{ $buyer->name }}</option>
								@endforeach
							</select>
						</div>

					</div>

					<div class="row">
						<div class="col-md-2 mt-3">
							<label for="voyage_number" class="form-label">Contract Qty.</label>
							<input type="number" disabled name="quantity" class="form-control form-control-lg" value="{{ $contract->quantity }}" step="0.0001" placeholder="Qty." />
						</div>
						<div class="col-md-2 mt-3">
							<label for="voyage_number" class="form-label">Selling Price <span class="text-danger">*</span></label>
							<div class="input-group" id="selling_price">
								<span class="input-group-text" id="basic-addon1">PKR</span>
								<input type="number" class="form-control form-control-lg" placeholder="" value="{{ $contract->selling_price }}" name="selling_price" required />
							</div>
						</div>
						<div class="col-md-2 mt-3">
							<label for="vessel_id" class="form-label">Payment Terms <span class="text-danger">*</span></label>
							<select class="form-select form-select-lg mb-4" id="payment_term" name="payment_term" required>
								<option value="">-- Select Payment Term --</option>
								@foreach ($payments as $payment)
								<option {{ $contract->payment_term == $payment->id ? 'selected' : '' }} value="{{ $payment->id }}">{{ $payment->name }}</option>
								@endforeach
							</select>
						</div>

						<div class="col-md-4 mt-3">
							<label class="form-label">Remarks</label>
							<textarea name="remarks" class="form-control" cols="30" rows="2">{{ $contract->remarks }}</textarea>
						</div>
						<input type="hidden" id="redirection" name="redirection" value="">
					</div>
					
					<div class="text-center mt-15">
							<button type="submit" id="cont-upt-btn" class="btn btn-lg btn-light fw-bold btn-primary me-2 contract-submit" data-kt-search-element="advanced-options-form-cancel">Update</button>
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

@if (Session::has('contract-success'))
<script>
	$(document).ready(function () {
		$.ajax({
			type: "GET",
			url: "{{ route('get.contract',Session::get('contract-success')) }}",
			success: function (data) {
				$('#new-contract-date').text(data.date);
				$('#new-contract-number').text(data.code);
				$('#new-contract-product').text(data.product + ' ' + data.quantity + ' ' + data.selling_price);
				$('#new-contract-payment').text(data.payment_terms);
				$('#new-contract-buyer').text('Buyer : ' + data.buyer);
				$('#new-contract-lifting').text('Lifting : ' + data.lifting_date);
				$('#new-contract-business').text('Seller Option : ' +  data.bussiness);
			}
		});
		$('#WhatsappMessage').modal('toggle');

		var message = $('#full-contract-msg').html();
		var contract_id = "{{ Session::get('contract-success') }}";
		$.ajax({
			type: "POST",
			url: "{{ route('save.message') }}",
			data: {
				_token: "{{ csrf_token() }}",
				contract_id: contract_id,
				message: message
			},
			success: function (response) {
			}
		});

	});
</script>
@endif
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
		$(document).ready(function () {
				var quantity = $('#quantity').val(); 

				$('#quantity').on("keyup", function() {
					if($(this).val() > quantity) {
						swal({
							title: "Do you want to allocate vessel?",
							text: "",
							icon: "warning",
							buttons: true,
							dangerMode: true,
						})
						.then((willDelete) => {
							if (willDelete) {
								swal({
									title: "Ok!",
									icon: "success",
								});
								$('#redirection').val('vessel-allocation');
								$('#cont-upt-btn').trigger('click');
							} else {
								swal({
									title : "Ok! Updating contract quantity...",
									timer: 2000,
									buttons: false,
								});
								$('#cont-upt-btn').trigger('click');
							}
						});
					}
					else if($(this).val() < quantity) {
						setTimeout(() => {
								var balance_qty = "{{ $contract->allocations->sum('quantity') }}";
								if ($(this).val() < balance_qty) {
									swal("Entered Quantity is less than balance quantity","","warning");
									$('#quantity').val(quantity);
								}
								else {
									swal({
									title: "Do you want to allocate vessel?",
									text: "",
									icon: "warning",
									buttons: true,
									dangerMode: true,
								})
								.then((willDelete) => {
									if (willDelete) {
										swal({
											title: "Ok!",
											icon: "success",
										});
										$('#redirection').val('vessel-allocation');
										$('#cont-upt-btn').trigger('click');
									} else {
										swal({
											title : "Ok! Updating contract quantity...",
											timer: 2000,
											buttons: false,
										});
										$('#cont-upt-btn').trigger('click');
									}
								});
		
								}
							}, 1500);



					}
				});

				$('#product_id').on("change", function () {
					swal({
							title: "Do you want to allocate vessel?",
							text: "",
							icon: "warning",
							buttons: true,
							dangerMode: true,
						})
						.then((willDelete) => {
							if (willDelete) {
								swal({
									title: "Ok!",
									icon: "success",
								});
								$('#redirection').val('vessel-allocation');
								$('#cont-upt-btn').trigger('click');
							} else {
								$('#cont-upt-btn').trigger('click');
							}
						});
				});

		});
	</script>
@endpush
</x-default-layout>



