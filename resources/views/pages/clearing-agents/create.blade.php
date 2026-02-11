<x-default-layout>
	<!--begin::Table widget 14-->
<div class="card card-flush h-md-100">
	<!--begin::Header-->
	<div class="card-header pt-7">
		<!--begin::Title-->
		<h3 class="card-title align-items-start flex-column">
			<span class="card-label fw-bold text-gray-800">Add New Agent</span>
		</h3>
		<!--end::Title-->
	</div>
	<!--end::Header-->
	<!--begin::Body-->
	<div class="card-body pt-6">
		<form class="pt-1" method="POST" action="/clearing-agents">
			@csrf
			<div class="row">
				<div class="col-md-9">
					<div class="row">
						<div class="col-md-6">
							<input type="text" class="form-control form-control-lg mb-4" placeholder="Company Name" name="title" value="{{ old('title') }}" />
						</div>
						<div class="col-md-6">
							<input type="text" class="form-control form-control-lg mb-4" placeholder="Name" name="name" value="{{ old('name') }}" />
						</div>
						<div class="col-md-6">
							<input type="text" class="form-control form-control-lg mb-4" placeholder="Contact Person" name="contact_person" value="{{ old('contact_person') }}" />
						</div>
						<div class="col-md-6">
							<input type="text" class="form-control form-control-lg mb-4" placeholder="Code" name="code" value="{{ old('code') }}" />
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-4">
							<input type="text" class="form-control form-control-lg mb-4" placeholder="Address" name="address" value="{{ old('address') }}" />
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control form-control-lg mb-4" placeholder="City" name="city" value="{{ old('city') }}" />
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control form-control-lg mb-4" placeholder="Country" name="country" value="{{ old('country') }}" />
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control form-control-lg mb-4" placeholder="Contact #" name="phone" value="{{ old('phone') }}" />
						</div>
						<div class="col-md-4">
							<input type="email" class="form-control form-control-lg mb-4" placeholder="Email" name="email" value="{{ old('email') }}" />
						</div>
						<div class="col-md-4">
							<input type="number" class="form-control form-control-lg mb-4" placeholder="Contact Person #" name="contact_number" value="{{ old('contact_number') }}" />
						</div>
					</div>
				</div>
				<div class="text-end">
					<button type="submit" class="btn btn-lg btn-light fw-bold btn-primary me-2" data-kt-search-element="advanced-options-form-cancel">Add</button>
				</div>
			</div>
		</form>
	</div>
	<!--end: Card Body-->
</div>
<!--end::Table widget 14-->
</x-default-layout>