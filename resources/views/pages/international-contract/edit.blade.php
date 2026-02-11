<x-default-layout>
	@php
				$letter_of_credit = $contract->documents->where('type','letter_of_credit')->first();
				$shipping_instruction = $contract->documents->where('type','shipping_instruction')->first();
				$vessel_nomination = $contract->documents->where('type','vessel_nomination')->first();
				$bill_lading = $contract->documents->where('type','bill_lading')->first();
				$commercial_invoice = $contract->documents->where('type','commercial_invoice')->first();
				$certificate_of_origin_fta = $contract->documents->where('type','certificate_of_origin_fta')->first();
				$shipment_tender = $contract->documents->where('type','shipment_tender')->first();
				$loadport_surveyor_report = $contract->documents->where('type','loadport_surveyor_report')->first();
				$beneficiary_certificate = $contract->documents->where('type','beneficiary_certificate')->first();
				$discharge_surveyor_report = $contract->documents->where('type','discharge_surveyor_report')->first();
				$health_certificate = $contract->documents->where('type','health_certificate')->first();
				$halal_certificate = $contract->documents->where('type','halal_certificate')->first();
				$letter_instruction = $contract->documents->where('type','letter_instruction')->first();
				$shipping_certificate = $contract->documents->where('type','shipping_certificate')->first();
				$shelf_life_certificate = $contract->documents->where('type','shelf_life_certificate')->first();
		@endphp
	<style>
		p span {
			cursor: pointer !important;
		}
		p.non-uploaded {
			cursor: pointer !important;
		}
		a {
			color: #181c32 !important;
		}
	</style>
	<!--begin::Table widget 14-->
	<div class="row">
		<div class="col-md-8">
			<div class="card card-flush h-md-100">
				<!--begin::Header-->
				<div class="card-header pt-7">
					<!--begin::Title-->
					<h3 class="card-title align-items-start flex-column">
						<span class="card-label fw-bold text-gray-800">Create New International Contract</span>
					</h3>
					<!--end::Title-->
				</div>
				<!--end::Header-->
				<!--begin::Body-->
				<div class="card-body pt-6">
					<form class="pt-1" method="POST" action="/international-contract/{{ $contract->id }}">
						@csrf
						@method('PUT')
						<div class="row justify-content-center">
							<div class="col-md-4">
								<label for="company_id" class="form-label">Businesses</label>
								<select class="form-select form-select-lg mb-4" name="business_id" required>
									<option>-- Select Business --</option>
									@foreach($businesses as $business)
										<option value="{{ $business->id }}" {{ ($contract->business_id) == $business->id ? 'selected' : '' }}>{{ $business->name }}</option>
									@endforeach
								</select>
							</div>
							<div class="col-md-4">
								<label for="company_id" class="form-label">Seller</label>
								<select class="form-select form-select-lg mb-4" name="seller_id" required>
									<option>-- Select Seller --</option>
									@foreach($companies as $seller)
										<option value="{{ $seller->id }}" {{ ($contract->seller_id) == $seller->id ? 'selected' : '' }}>{{ $seller->name }}</option>
									@endforeach
								</select>
							</div>
							<div class="col-md-4">
								<label for="vessel_id" class="form-label">Buyer</label>
								<select class="form-select form-select-lg mb-4" name="buyer_id" required>
									<option>-- Select Buyer --</option>
									@foreach($companies as $buyer)
										<option value="{{ $buyer->id }}" {{ ($contract->buyer_id) == $buyer->id ? 'selected' : '' }}>{{ $buyer->name }}</option>
									@endforeach
								</select>
							</div>
							<div class="col-md-4">
								<label for="product_id" class="form-label">Product</label>
								<select class="form-select form-select-lg mb-4" name="product_id" required>
									<option>-- Select Product --</option>
									@foreach($products as $product)
										<option value="{{ $product->id }}" {{ ($contract->product_id) == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
									@endforeach
								</select>
							</div>
							<div class="col-md-4">
								<label for="product_id" class="form-label">Quantity</label>
								<input type="number" name="quantity" placeholder="Enter Quantity" value="{{ $contract->quantity }}" class="form-control" required>
							</div>
						</div>
						
						<div class="text-center">
								<button type="submit" class="btn btn-lg btn-light fw-bold btn-primary me-2" data-kt-search-element="advanced-options-form-cancel">Update</button>
						</div>
					</form>
				</div>
				<!--end: Card Body-->
			</div>
		</div>

		<div class="col-md-4">
			<div class="card">
				<div class="card-header pt-7">
					<!--begin::Title-->
					<h2 class="card-title align-items-start flex-column">
						<span class="card-label fw-bold text-gray-800">Recieved Documents</span>
					</h2>
					<!--end::Title-->
				</div>
				
				<div class="card-body">
					@if ($letter_of_credit) <a target="_blank" href="{{ url('documents/international-contract/'.$letter_of_credit->type.'/'.$letter_of_credit->document) }}"> @endif
						<p data-type="letter_of_credit" class="fw-bold {{ ($letter_of_credit) ? '' : 'non-uploaded' }}">LETTER OF CREDIT
							<span data-type="letter_of_credit" class="ms-2 text-{{ ($letter_of_credit) ? 'success' : 'danger non-uploaded' }}">{!! ($letter_of_credit) ? '&#10004;' : '&#x2716;' !!}</span>
						</p>
					@if ($letter_of_credit) </a> @endif
					
					@if ($shipping_instruction) <a target="_blank" href="{{ url('documents/international-contract/'.$shipping_instruction->type.'/'.$shipping_instruction->document) }}"> @endif
					<p data-type="shipping_instruction" class="fw-bold {{ ($shipping_instruction) ? '' : 'non-uploaded' }}">SHIPPING INSTRUCTION
						<span data-type="shipping_instruction" class="ms-2 text-{{ ($shipping_instruction) ? 'success' : 'danger non-uploaded' }}">{!! ($shipping_instruction) ? '&#10004;' : '&#x2716;' !!}</span>
					</p>
					@if ($shipping_instruction) </a> @endif

					@if ($vessel_nomination) <a target="_blank" href="{{ url('documents/international-contract/'.$vessel_nomination->type.'/'.$vessel_nomination->document) }}"> @endif
					<p data-type="vessel_nomination" class="fw-bold {{ ($vessel_nomination) ? '' : 'non-uploaded' }}">VESSEL NOMINATION
						<span data-type="vessel_nomination" class="ms-2 text-{{ ($vessel_nomination) ? 'success' : 'danger non-uploaded' }}">{!! ($vessel_nomination) ? '&#10004;' : '&#x2716;' !!}</span>
					</p>
					@if ($vessel_nomination) </a> @endif
					
					@if ($bill_lading) <a target="_blank" href="{{ url('documents/international-contract/'.$bill_lading->type.'/'.$bill_lading->document) }}"> @endif
					<p data-type="bill_lading" class="fw-bold {{ ($bill_lading) ? '' : 'non-uploaded' }}">BILL LADING
						<span data-type="bill_lading" class="ms-2 text-{{ ($bill_lading) ? 'success' : 'danger non-uploaded' }}">{!! ($bill_lading) ? '&#10004;' : '&#x2716;' !!}</span>
					</p>
					@if ($bill_lading) </a> @endif

					@if ($commercial_invoice) <a target="_blank" href="{{ url('documents/international-contract/'.$commercial_invoice->type.'/'.$commercial_invoice->document) }}"> @endif
					<p data-type="commercial_invoice" class="fw-bold {{ ($commercial_invoice) ? '' : 'non-uploaded' }}">COMMERCIAL INVOICE
						<span data-type="commercial_invoice" class="ms-2 text-{{ ($commercial_invoice) ? 'success' : 'danger non-uploaded' }}">{!! ($commercial_invoice) ? '&#10004;' : '&#x2716;' !!}</span>
					</p>
					@if ($commercial_invoice) </a> @endif
					
					@if ($certificate_of_origin_fta) <a target="_blank" href="{{ url('documents/international-contract/'.$certificate_of_origin_fta->type.'/'.$certificate_of_origin_fta->document) }}"> @endif
					<p data-type="certificate_of_origin_fta" class="fw-bold {{ ($certificate_of_origin_fta) ? '' : 'non-uploaded' }}">CERTIFICATE OF ORIGIN/FTA
						<span data-type="certificate_of_origin_fta" class="ms-2 text-{{ ($certificate_of_origin_fta) ? 'success' : 'danger non-uploaded' }}">{!! ($certificate_of_origin_fta) ? '&#10004;' : '&#x2716;' !!}</span>
					</p>
					@if ($certificate_of_origin_fta) </a> @endif

					@if ($shipment_tender) <a target="_blank" href="{{ url('documents/international-contract/'.$shipment_tender->type.'/'.$shipment_tender->document) }}"> @endif
					<p data-type="shipment_tender" class="fw-bold {{ ($shipment_tender) ? '' : 'non-uploaded' }}">SHIPMENT TENDER
						<span data-type="shipment_tender" class="ms-2 text-{{ ($shipment_tender) ? 'success' : 'danger non-uploaded' }}">{!! ($shipment_tender) ? '&#10004;' : '&#x2716;' !!}</span>
					</p>
					@if ($shipment_tender) </a> @endif
					
					@if ($loadport_surveyor_report) <a target="_blank" href="{{ url('documents/international-contract/'.$loadport_surveyor_report->type.'/'.$loadport_surveyor_report->document) }}"> @endif
					<p data-type="loadport_surveyor_report" class="fw-bold {{ ($loadport_surveyor_report) ? '' : 'non-uploaded' }}">LOADPORT SURVEYOR REPORT
						<span data-type="loadport_surveyor_report" class="ms-2 text-{{ ($loadport_surveyor_report) ? 'success' : 'danger non-uploaded' }}">{!! ($loadport_surveyor_report) ? '&#10004;' : '&#x2716;' !!}</span>
					</p>
					@if ($shipment_tender) </a> @endif

					@if ($beneficiary_certificate) <a target="_blank" href="{{ url('documents/international-contract/'.$beneficiary_certificate->type.'/'.$beneficiary_certificate->document) }}"> @endif
					<p data-type="beneficiary_certificate" class="fw-bold {{ ($beneficiary_certificate) ? '' : 'non-uploaded' }}">BENEFICIARY CERTIFICATE
						<span data-type="beneficiary_certificate" class="ms-2 text-{{ ($beneficiary_certificate) ? 'success' : 'danger non-uploaded' }}">{!! ($beneficiary_certificate) ? '&#10004;' : '&#x2716;' !!}</span>
					</p>
					@if ($beneficiary_certificate) </a> @endif
					
					@if ($discharge_surveyor_report) <a target="_blank" href="{{ url('documents/international-contract/'.$discharge_surveyor_report->type.'/'.$discharge_surveyor_report->document) }}"> @endif
					<p data-type="discharge_surveyor_report" class="fw-bold {{ ($discharge_surveyor_report) ? '' : 'non-uploaded' }}">DISCHARGE SURVEYOR REPORT
						<span data-type="discharge_surveyor_report" class="ms-2 text-{{ ($discharge_surveyor_report) ? 'success' : 'danger non-uploaded' }}">{!! ($discharge_surveyor_report) ? '&#10004;' : '&#x2716;' !!}</span>
					</p>
					@if ($discharge_surveyor_report) </a> @endif
					
					@if ($health_certificate) <a target="_blank" href="{{ url('documents/international-contract/'.$health_certificate->type.'/'.$health_certificate->document) }}"> @endif
					<p data-type="health_certificate" class="fw-bold {{ ($health_certificate) ? '' : 'non-uploaded' }}">HEALTH CERTIFICATE
						<span data-type="health_certificate" class="ms-2 text-{{ ($health_certificate) ? 'success' : 'danger non-uploaded' }}">{!! ($health_certificate) ? '&#10004;' : '&#x2716;' !!}</span>
					</p>
					@if ($health_certificate) </a> @endif
					
					@if ($halal_certificate) <a target="_blank" href="{{ url('documents/international-contract/'.$halal_certificate->type.'/'.$halal_certificate->document) }}"> @endif
					<p data-type="halal_certificate" class="fw-bold {{ ($halal_certificate) ? '' : 'non-uploaded' }}">HALAL CERTIFICATE
						<span data-type="halal_certificate" class="ms-2 text-{{ ($halal_certificate) ? 'success' : 'danger non-uploaded' }}">{!! ($halal_certificate) ? '&#10004;' : '&#x2716;' !!}</span>
					</p>
					@if ($halal_certificate) </a> @endif
					
					@if ($letter_instruction) <a target="_blank" href="{{ url('documents/international-contract/'.$letter_instruction->type.'/'.$letter_instruction->document) }}"> @endif
					<p data-type="letter_instruction" class="fw-bold {{ ($letter_instruction) ? '' : 'non-uploaded' }}">LETTER INSTRUCTION
						<span data-type="letter_instruction" class="ms-2 text-{{ ($letter_instruction) ? 'success' : 'danger non-uploaded' }}">{!! ($letter_instruction) ? '&#10004;' : '&#x2716;' !!}</span>
					</p>
					@if ($letter_instruction) </a> @endif
					
					@if ($shipping_certificate) <a target="_blank" href="{{ url('documents/international-contract/'.$shipping_certificate->type.'/'.$shipping_certificate->document) }}"> @endif
					<p data-type="shipping_certificate" class="fw-bold {{ ($shipping_certificate) ? '' : 'non-uploaded' }}">SHIPPING CERTIFICATE
						<span data-type="shipping_certificate" class="ms-2 text-{{ ($shipping_certificate) ? 'success' : 'danger non-uploaded' }}">{!! ($shipping_certificate) ? '&#10004;' : '&#x2716;' !!}</span>
					</p>
					@if ($shipping_certificate) </a> @endif
					
					@if ($shelf_life_certificate) <a target="_blank" href="{{ url('documents/international-contract/'.$shelf_life_certificate->type.'/'.$shelf_life_certificate->document) }}"> @endif
					<p data-type="shelf_life_certificate" class="fw-bold {{ ($shelf_life_certificate) ? '' : 'non-uploaded' }}">SHELF LIFE CERTIFICATE
						<span data-type="shelf_life_certificate" class="ms-2 text-{{ ($shelf_life_certificate) ? 'success' : 'danger non-uploaded' }}">{!! ($shelf_life_certificate) ? '&#10004;' : '&#x2716;' !!}</span>
					</p>
					@if ($shelf_life_certificate) </a> @endif

				</div>
			</div>
		</div>

	</div>

{{-- Start Modal --}}
<button type="button" class="btn btn-primary d-none doc-modal-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
  Inventory
</button>
<div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form id="doc-upload" action="{{ url('/international-contract/doc-upload') }}" method="POST" enctype="multipart/form-data">
				@csrf
				@method('POST')
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel2">Upload Document</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div>
          <input type="file" class="form-control" name="file">
          <input type="hidden" class="form-control" name="type" value="">
          <input type="hidden" class="form-control" name="contract_id" value="{{ $contract->id }}">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
        <button onclick="$('#doc-upload').submit();" type="button" class="btn btn-primary submit-doc">Submit</button>
      </div>
    </form>
    </div>
  </div>
</div>
{{-- End Modal --}}

<!--end::Table widget 14-->
{!! theme()->addVendor('formrepeater') !!}
@push('scripts')
	<script>
		$(document).on("click",".non-uploaded", function () {
				var type = $(this).attr('data-type');
				
				$('input[name=type]').val(type);
				$('.doc-modal-btn').trigger('click');
		
			});
	</script>
@endpush
</x-default-layout>