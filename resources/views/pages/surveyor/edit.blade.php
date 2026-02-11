<x-default-layout>
	<!--begin::Table widget 14-->
<div class="card card-flush h-md-100">
	<!--begin::Header-->
	<div class="card-header pt-7">
		<!--begin::Title-->
		<h3 class="card-title align-items-start flex-column">
			<span class="card-label fw-bold text-gray-800">Surveyor</span>
		</h3>
		<!--end::Title-->
	</div>
	<!--end::Header-->
	<!--begin::Body-->
	<div class="card-body pt-6">
		<form class="pt-1" method="POST" action="/surveyor/{{ $surveyor->id }}">
			@csrf
			@method('PUT')
			<div class="row">
				<div class="col-md-9">
					<div class="row">
						<div class="col-md-6">
							<input type="text" class="form-control form-control-lg mb-4" placeholder="Company Name" name="title" value="{{ $surveyor->title }}" />
						</div>
						<div class="col-md-6">
							<input type="text" class="form-control form-control-lg mb-4" placeholder="Name" name="name" value="{{ $surveyor->name }}" />
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-4">
							<input type="text" class="form-control form-control-lg mb-4" placeholder="Address" name="address" value="{{ $surveyor->address }}" />
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control form-control-lg mb-4" placeholder="City" name="city" value="{{ $surveyor->city }}" required />
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control form-control-lg mb-4" placeholder="Country" name="country" value="{{ $surveyor->country }}" />
						</div>
						<div class="col-md-6">
							<input type="text" class="form-control form-control-lg mb-4" placeholder="Phone" name="phone" value="{{ $surveyor->phone }}" />
						</div>
						<div class="col-md-6">
							<input type="email" class="form-control form-control-lg mb-4" placeholder="Email" name="email" value="{{ $surveyor->email }}" />
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