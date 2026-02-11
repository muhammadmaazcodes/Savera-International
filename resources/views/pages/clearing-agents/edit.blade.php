<x-default-layout>
	<!--begin::Table widget 14-->
<div class="card card-flush h-md-100 mb-4">
	<!--begin::Header-->
	<div class="card-header pt-7">
		<!--begin::Title-->
		<h3 class="card-title align-items-start flex-column">
			<span class="card-label fw-bold text-gray-800">Edit Agent</span>
		</h3>
		<!--end::Title-->
	</div>
	<!--end::Header-->
	<!--begin::Body-->
	<div class="card-body pt-6">
		<form class="pt-1" method="POST" action="/clearing-agents/{{ $clearing_agent->id }}">
			@csrf
			@method('PUT')
			<div class="row">
				<div class="col-md-9">
					<div class="row">
						<div class="col-md-6">
							<input type="text" class="form-control form-control-lg mb-4" placeholder="Company Name" name="title" value="{{ $clearing_agent->title }}" />
						</div>
						<div class="col-md-6">
							<input type="text" class="form-control form-control-lg mb-4" placeholder="Name" name="name" value="{{ $clearing_agent->name }}" />
						</div>
						<div class="col-md-6">
							<input type="text" class="form-control form-control-lg mb-4" placeholder="Contact Person" name="contact_person" value="{{ $clearing_agent->contact_person }}" />
						</div>
						<div class="col-md-6">
							<input type="text" class="form-control form-control-lg mb-4" placeholder="Code" name="code" value="{{ $clearing_agent->code }}" />
						</div>

					</div>
					<hr>
					<div class="row">
						<div class="col-md-4">
							<input type="text" class="form-control form-control-lg mb-4" placeholder="Address" name="address" value="{{ $clearing_agent->address }}" />
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control form-control-lg mb-4" placeholder="City" name="city" value="{{ $clearing_agent->city }}" required />
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control form-control-lg mb-4" placeholder="Country" name="country" value="{{ $clearing_agent->country }}" />
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control form-control-lg mb-4" placeholder="Contact #" name="phone" value="{{ $clearing_agent->phone }}" />
						</div>
						<div class="col-md-4">
							<input type="email" class="form-control form-control-lg mb-4" placeholder="Email" name="email" value="{{ $clearing_agent->email }}" />
						</div>
						<div class="col-md-4">
							<input type="number" class="form-control form-control-lg mb-4" placeholder="Contact Person #" name="contact_number" value="{{ old('contact_number') }}" />
						</div>
					</div>
				</div>
			<div class="col-md-12 text-end">
				<button type="submit" class="btn btn-sm btn-light fw-bold btn-primary me-2" data-kt-search-element="advanced-options-form-cancel">Update</button>
			</div>
			</div>
			<!--begin::Input group-->
		</form>
	</div>
	<!--end: Card Body-->
</div>
<!--end::Table widget 14-->
</x-default-layout>