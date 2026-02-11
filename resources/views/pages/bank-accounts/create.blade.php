<x-default-layout>
	<!--begin::Table widget 14-->
<div class="card card-flush h-md-100">
	<!--begin::Header-->
	<div class="card-header pt-7">
		<!--begin::Title-->
		<h3 class="card-title align-items-start flex-column">
			<span class="card-label fw-bold text-gray-800">Add New Bank Account</span>
		</h3>
		<!--end::Title-->
	</div>
	<!--end::Header-->
	<!--begin::Body-->
	<div class="card-body pt-6">
		<form class="pt-1" method="POST" action="/bank-accounts">
			@csrf
			<div class="row justify-content-center">
				<div class="col-md-4">
					<input type="text" class="form-control form-control-lg mb-4" placeholder="Enter Name for Future Reference" name="name" value="{{ old('name') }}" />
				</div>
				<div class="col-md-4">
					<input type="text" class="form-control form-control-lg mb-4" placeholder="Account Title" name="account_title" value="{{ old('account_title') }}" />
				</div>
				<div class="col-md-4">
					<input type="text" class="form-control form-control-lg mb-4" placeholder="Bank Name" name="bank_name" value="{{ old('bank_name') }}" />
				</div>
			</div>
			<hr>
			<div class="row justify-content-start">
				<div class="col-md-12 pb-4">
					<h6>Account Details</h6>
				</div>
				<div class="col-md-4">
					<input type="text" class="form-control form-control-lg mb-4" placeholder="Account Number" name="account_number" value="{{ old('account_number') }}" />
				</div>
				<div class="col-md-4">
					<input type="text" class="form-control form-control-lg mb-4" placeholder="IBAN" name="iban" value="{{ old('iban') }}" />
				</div>
				<div class="col-md-4">
					<input type="text" class="form-control form-control-lg mb-4" placeholder="SWIFT Code" name="swift" value="{{ old('swift') }}" />
				</div>
				<div class="col-md-4">
					<input type="text" class="form-control form-control-lg mb-4" placeholder="Branch Name" name="bank_branch_name" value="{{ old('bank_branch_name') }}" />
				</div>
				<div class="col-md-4">
					<input type="text" class="form-control form-control-lg mb-4" placeholder="Branch Code" name="bank_branch_code" value="{{ old('bank_branch_code') }}" />
				</div>
				<div class="col-md-4">
					<input type="text" class="form-control form-control-lg mb-4" placeholder="Branch Address" name="bank_branch_address" value="{{ old('bank_branch_address') }}" />
				</div>
				<div class="col-md-4">
					<input type="text" class="form-control form-control-lg mb-4" placeholder="Branch Zip" name="branch_zip" value="{{ old('branch_zip') }}" />
				</div>
			</div>
			<div class="text-center">
				<button type="submit" class="btn btn-lg btn-light fw-bold btn-primary me-2" data-kt-search-element="advanced-options-form-cancel">Add</button>
			</div>
		</form>
	</div>
	<!--end: Card Body-->
</div>
<!--end::Table widget 14-->
</x-default-layout>