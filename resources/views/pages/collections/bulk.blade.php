<x-default-layout>
<style>
.table-wrapper {
  width: 100% !important;
  overflow-x: auto !important;
}

.table {
  width: max-content !important;
  white-space: nowrap !important;
}

.table-wrapper::-webkit-scrollbar-track {
  background-color: #f1f1f1;
}

.table-wrapper::-webkit-scrollbar-thumb {
  background-color: #888;
  border-radius: 5px;
}

.table-wrapper::-webkit-scrollbar-thumb:hover {
  background-color: #555;
}
.form-control {
	appearance: auto;
	-webkit-appearance: auto;
}
.form-control:focus {
	border-color:#009ef7;
}
</style>
	<!--begin::Table widget 14-->
<div class="card card-flush h-md-100">
	<!--begin::Header-->
	<div class="card-header pt-7">
		<!--begin::Title-->
		<h3 class="card-title align-items-start flex-column">
			<span class="card-label fw-bold text-gray-800">Collections</span>
		</h3>
		<!--end::Title-->
		<!--begin::Toolbar-->
		<div class="card-toolbar">
			
		</div>
		<!--end::Toolbar-->
	</div>
	<!--end::Header-->
	<!--begin::Body-->
	<div class="card-body pt-6">
		<!--begin::Table container-->
	<form id="bulk-form" action="" method="post">
		@csrf
		<div class="table-wrapper table-responsive">
			<!--begin::Table-->
			<table id="" class="table table-row-bordered gy-5">
			    <thead>
			        <tr class="fw-semibold fs-6 text-muted">
			            <th>Date</th>
			            <th>Buyer</th>
			            <th>Voyage</th>
			            <th>Vessel</th>
			            <th>Payment</th>
			            <th>Branch</th>
			            <th>Bank Code</th>
			            <th>A/c Title</th>
			            <th>Amount</th>
			            <th>Cheque #</th>
			            <th>Slip #</th>
			            <th>Remarks</th>
			            <th>Status</th>
			        </tr>
			    </thead>
			    <tbody class="bulk-tbody">
						<tr>
							<td class="bg-secondary border border-dark">
								<input name="date[]" type="date" class="ms-2 form-control form-control-sm" value="@php echo date('Y-m-d'); @endphp">
							</td>
							<td class="bg-secondary border border-dark">
								<select class="form-control form-control-sm" required="" name="buyer_id[]">
									<option value="">Select</option>
									@foreach ($buyers as $buyer)
											<option value="{{ $buyer->id }}">{{ $buyer->name }}</option>
									@endforeach
								</select>
							</td>
							<td class="bg-secondary border border-dark"><input name="voyage[]" type="text" class="form-control form-control-sm"></td>
							<td class="bg-secondary border border-dark">
								<select class="form-control form-control-sm vessel-select" name="vessel_id[]">
									<option value="">Select</option>
									@foreach ($inventories as $inventory)
											<option value="{{ $inventory->id }}">{{ $inventory->vessel->name }}</option>
									@endforeach
								</select>
							</td>
							<td class="bg-secondary border border-dark">
								<select class="form-control form-control-sm payment-select" name="payment_mode[]">
									<option value="">Select</option>
									@foreach ($payment_modes as $payment_mode)
											<option value="{{ $payment_mode->id }}">{{ $payment_mode->name }}</option>
									@endforeach
								</select>
							</td>
							<td class="bg-secondary border border-dark"><input name="branch[]" type="text" class="form-control form-control-sm"></td>
							<td class="bg-secondary border border-dark"><input name="bank_code[]" type="text" class="form-control form-control-sm"></td>
							<td class="bg-secondary border border-dark"><input name="ac_title[]" type="text" class="form-control form-control-sm"></td>
							<td class="bg-secondary border border-dark"><input name="amount[]" type="number" class="form-control form-control-sm"></td>
							<td class="bg-secondary border border-dark"><input name="cheque_number[]" type="text" class="form-control form-control-sm"></td>
							<td class="bg-secondary border border-dark"><input name="slip_number[]" type="text" class="form-control form-control-sm"></td>
							<td class="bg-secondary border border-dark"><input name="remarks[]" type="text" class="form-control form-control-sm"></td>
							<td class="bg-secondary border border-dark">
								<select class="form-control form-control-sm me-4" name="status[]">
									<option value=""></option>
									<option value="unverified">Unverified</option>
									<option value="verified">Verified</option>
								</select>
							</td>
						
						</tr>
			</table>
			<a href="javascript:void(0)" class="btn btn-sm btn-secondary add-new">Add Another +</a>
		</div>
		<!--end::Table-->
		<div class="text-center mt-4">
			<button type="submit" class="btn btn-primary submit-btn">Submit</button>
			<span class="spinner-border loader text-primary d-none" role="status">
				<span class="visually-hidden">Loading...</span>
			</span>
		</div>

	</form>
	</div>
	<!--end: Card Body-->
</div>
<!--end::Table widget 14-->
<div class="d-none buyer-select">
	<option value="">Select</option>
			@foreach ($buyers as $buyer)
					<option value="{{ $buyer->id }}">{{ $buyer->name }}</option>
			@endforeach
</div>
<div class="d-none vessel-select">
	<option value="">Select</option>
		@foreach ($inventories as $inventory)
				<option value="{{ $inventory->id }}">{{ $inventory->vessel->name }}</option>
		@endforeach
</div>
<div class="d-none payment-select">
	<option value="">Select</option>
		@foreach ($payment_modes as $payment_mode)
				<option value="{{ $payment_mode->id }}">{{ $payment_mode->name }}</option>
		@endforeach
</div>
@push('scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
 
	$(document).on("submit","#bulk-form",function(e){
			
			e.preventDefault();

			var formData = $(this).serialize();
			$('.loader').removeClass('d-none');
			$('.submit-btn').addClass('d-none');

			$.ajax({
				 type:'POST',
				 url:"{{ route('collect.bulk.store') }}",
				 data:formData,

				 success:function(data){
					 $('.bulk-tbody').empty();
					$('.loader').addClass('d-none');
					$('.submit-btn').removeClass('d-none');
					swal("Collection added in Bulk","", "success");
				 }
			});

	});
</script>

		<script>
			$(document).on("click",".add-new", function () {
					
					var buyer = $('.buyer-select').html();
					var vessel = $('.vessel-select').html();
					var payment = $('.payment-select').html();
					var tr = '' + 
							'<tr>' + 
		'							<td class="bg-secondary border border-dark"><input name="date[]" type="date" class="ms-2 form-control form-control-sm" value="@php echo date('Y-m-d'); @endphp"></td>' + 
		'							<td class="bg-secondary border border-dark">' + 
		'								<select class="form-control form-control-sm buyer_id_select" required="" name="buyer_id[]">' +  
											buyer +
		'								</select>' + 
		'							</td>' + 
		'							<td class="bg-secondary border border-dark"><input name="voyage[]" type="text" class="form-control form-control-sm"></td>' + 
		'							<td class="bg-secondary border border-dark">' + 
		'								<select class="form-control form-control-sm" name="vessel_id[]">' + 
										 vessel +
		'								</select>' + 
		'							</td>' + 
		'							<td class="bg-secondary border border-dark">' + 
		'								<select class="form-control form-control-sm" name="payment_mode[]">' + 
										 payment +
		'								</select>' + 
		'							</td>' + 
		'							<td class="bg-secondary border border-dark"><input name="branch[]" type="text" class="form-control form-control-sm"></td>' + 
		'							<td class="bg-secondary border border-dark"><input name="bank_code[]" type="text" class="form-control form-control-sm"></td>' + 
		'							<td class="bg-secondary border border-dark"><input name="ac_title[]" type="text" class="form-control form-control-sm"></td>' + 
		'							<td class="bg-secondary border border-dark"><input name="amount[]" type="number" class="form-control form-control-sm"></td>' + 
		'							<td class="bg-secondary border border-dark"><input name="cheque_number[]" type="text" class="form-control form-control-sm"></td>' + 
		'							<td class="bg-secondary border border-dark"><input name="slip_number[]" type="text" class="form-control form-control-sm"></td>' + 
		'							<td class="bg-secondary border border-dark"><input name="remarks[]" type="text" class="form-control form-control-sm"></td>' + 
		'							<td class="bg-secondary border border-dark">' + 
		'								<select class="form-control form-control-sm me-4" name="status[]">' + 
		'									<option></option>' + 
		'									<option value="unverified">Unverified</option>' + 
		'									<option value="verified">Verified</option>' + 
		'								</select>' + 
		'							</td>' + 
		'						</tr>' + 
		'';
			$('.bulk-tbody').append(tr);
			$('.buyer_id_select').last().focus();
		});
		</script>
@endpush
</x-default-layout>