<x-default-layout>
	<!--begin::Table widget 14-->
<div class="card card-flush h-md-100">
	<!--begin::Header-->
	<div class="card-header pt-7">
		<!--begin::Title-->
		<h3 class="card-title align-items-start flex-column">
			<span class="card-label fw-bold text-gray-800">Add New Buyer/Sellers</span>
		</h3>
		<!--end::Title-->
	</div>
	<!--end::Header-->
	<!--begin::Body-->
	<div class="card-body pt-6">
		<form class="pt-1" method="POST" action="/companies">
			@csrf
			<div class="row justify-content-center">
				<div class="col-md-4">
					<input type="text" class="form-control form-control-lg border-dark" placeholder="Buyer/Sellers Name" name="name" />
				</div>
				<div class="col-md-4">
					<input type="text" class="form-control form-control-lg border-dark" placeholder="Buyer/Sellers Code" name="code" />
				</div>
				<div class="col-md-2">
					<span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
						<input class="form-check-input" type="radio" name="local" value="1">&nbsp;&nbsp;
						<label for="" class="form-label">Local</label>
					</span>
				</div>
				<div class="col-md-2">
						<span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
									<input class="form-check-input" type="radio" name="international" value="1">&nbsp;&nbsp;
									<label for="" class="form-label">International</label>
						</span>
			</div>
			</div>
			<!--begin::Repeater-->
			<div id="kt_docs_repeater_basic">
			    <!--begin::Form group-->
			    <div class="form-group">
			        <div class="my-5" data-repeater-list="company_addresses">
			            <div class="border-1 rounded-3 my-5 border-secondary border p-3" data-repeater-item>
			                <div class="form-group row gy-3	">
			                    <div class="col-md-6">
			                        <label class="form-label">Title:</label>
			                        <input type="text" name="title" class="form-control mb-2 mb-md-0" placeholder="Enter Title for future reference" />
			                    </div>
			                    <div class="col-md-6 text-end">
			                        <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8">
			                            <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
			                            Delete
			                        </a>
			                    </div>
			                    <div class="col-md-6">
			                        <label class="form-label">Address:</label>
			                        <input type="text" name="address" class="form-control mb-2 mb-md-0" placeholder="Enter Address" />
			                    </div>
			                    <div class="col-md-6">
			                        <label class="form-label">Address 2:</label>
			                        <input type="text" name="address2" class="form-control mb-2 mb-md-0" placeholder="Enter Address(Second Line)" />
			                    </div>
			                    <div class="col-md-6">
			                        <label class="form-label">City:</label>
			                        <input type="text" name="city" class="form-control mb-2 mb-md-0" placeholder="Enter City" />
			                    </div>
			                    <div class="col-md-6">
			                        <label class="form-label">Country:</label>
			                        <input type="text" name="country" class="form-control mb-2 mb-md-0" placeholder="Enter Country" />
			                    </div>
			                    <div class="col-md-4">
			                        <label class="form-label">Phone:</label>
			                        <input type="text" name="phone" class="form-control mb-2 mb-md-0" placeholder="Enter phone number" />
			                    </div>
			                    <div class="col-md-4">
			                        <label class="form-label">Fax:</label>
			                        <input type="text" name="fax" class="form-control mb-2 mb-md-0" placeholder="Enter fax number" />
			                    </div>
			                    <div class="col-md-4">
			                        <label class="form-label">Email:</label>
			                        <input type="email" name="email" class="form-control mb-2 mb-md-0" placeholder="Enter email " />
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
			            Add Another Address
			        </a>
			    </div>
			    <!--end::Form group-->
			</div>
			<!--end::Repeater-->
			<div class="text-center">
					<button type="submit" class="btn btn-lg btn-light fw-bold btn-primary me-2" data-kt-search-element="advanced-options-form-cancel">Add</button>
			</div>
		</form>
	</div>
	<!--end: Card Body-->
</div>
<!--end::Table widget 14-->
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
@endpush
</x-default-layout>