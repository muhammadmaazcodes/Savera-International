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

	</div>
	<!--end::Header-->

	<div class="card card-flush h-md-100 mb-2">
		<!--begin::Body-->
		<div class="card-body pb-0 pt-6">
			<div class="row">
					<div class="col-md-12">
							<div class="row">
								 <div class="col-md-4">
										<p class="fw-bold fs-5 mb-0">Contract Code</p>
										<p class="fs-5">#{{ $contract->code }}</p>
									</div>

									<div class="col-md-4">
										<p class="fw-bold fs-5 mb-0">Product </p>
										<p class="fs-5">{{ $contract->product->name ?? '--' }}</p>
									</div>

									<div class="col-md-4">
										<p class="fw-bold fs-5 mb-0">Balance Quantity </p>
										<p class="fs-5">{{ number_format($contract->balance_qty(),2) }}</p>
									</div>

							</div>
					</div>

			
			</div>

		</div>
		<!--end: Card Body-->
	</div>

	<!--begin::Body-->

	{{-- Begin Tabs --}}
			<div class="card-body pt-6">
				<form class="pt-1" id="contract-form" method="POST" action="/local-contracts/split/{{ $contract->id }}">
					@csrf
					
					 <!--begin::Repeater-->
					 <div id="kt_docs_repeater_basic">
						<!--begin::Form group-->
						<div class="form-group">
								<div class="mb-5" data-repeater-list="spit_contracts">
										
										<div class="rounded-3 p-3 border border-secondary mb-2" data-repeater-item>
												<div class="form-group row gy-3 justify-content-center">
													<div class="col">
														<input type="date" name="date" id="date" class="form-control form-control-sm">
													</div>
													<div class="col">
														<select name="product_id" id="product_id" class="form-control form-control-sm">
															<option value="">-Product-</option>
															@foreach ($products as $product)
																	<option value="{{ $product->id }}">{{ $product->code }}</option>
															@endforeach
														</select>
													</div>
													<div class="col">
														<input type="number" name="quantity" class="form-control form-control-sm" step="0.001" placeholder="Quantity">
													</div>
													<div class="col">
														<input type="text" name="remarks" class="form-control form-control-sm" placeholder="Remarks">
													</div>
												<div class="col">
													<a href="javascript:;" data-repeater-delete
															class="btn btn-sm btn-light-danger">
															<i class="fa fa-cancel"></i>
													</a>
											</div>
											<div class="col-12"><span class="vessel_show_details"></span></span></div>
												</div>
										</div>

								</div>
								

							<div class="mb-3">
								<a href="javascript:;" data-repeater-create class="btn btn-light-primary btn-sm">
										<i class="ki-duotone ki-plus fs-3"></i>
										Add
								</a>
							</div>

						</div>
						<!--end::Form group-->

				</div>
				<!--end::Repeater-->
					
					<div class="text-center mt-15">
							<button type="submit" class="btn btn-lg btn-light fw-bold btn-primary me-2 contract-submit" data-kt-search-element="advanced-options-form-cancel">Submit</button>
					</div>
				</form>
			</div>

	
	<!--end: Card Body-->
</div>
<!--end::Table widget 14-->
{!! theme()->addVendor('formrepeater') !!}
@push('scripts')

		@if (Session::has('error'))
				<script>
					swal("{{ Session::get('error') }}","","warning");
				</script>
		@endif
		<script>
			$('#kt_docs_repeater_basic').repeater({
					initEmpty: true,

					defaultValues: {
							'text-input': 'foo'
					},

					show: function() {
							$(this).slideDown();
					},

					hide: function(deleteElement) {
							$(this).slideUp(deleteElement);
					}
			});
		</script>
@endpush
</x-default-layout>