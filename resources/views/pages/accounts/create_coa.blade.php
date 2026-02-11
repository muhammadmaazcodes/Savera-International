<x-default-layout>
	<!--begin::Table widget 14-->
<div class="card card-flush h-md-100">
	<!--begin::Header-->
	<div class="card-header pt-7">
		<!--begin::Title-->
		<h3 class="card-title align-items-start flex-column">
			<span class="card-label fw-bold text-gray-800">Create Chart Of Account</span>
		</h3>
		<!--end::Title-->
	</div>
	<!--end::Header-->
	<!--begin::Body-->
	<div class="card-body pt-6">
		<form class="pt-1" method="POST" action="">
			@csrf
			<div class="row">
					<div class="col-md-3">
						<label class="form-label">ACode</label>
						<input type="text" name="acode" class="form-control">
					</div>
					<div class="col-md-3">
						<label class="form-label">AName</label>
						<input type="text" name="acode" class="form-control">
					</div>
					<div class="col-md-3">
						<label class="form-label">AOpening Balance</label>
						<input type="number" step="0.0001" name="aopening_balance" class="form-control">
					</div>
					<div class="col-md-3">
						<label class="form-label">Opening Date</label>
						<input type="date" name="opening_date" class="form-control">
					</div>
					<div class="col-md-3">
						<label class="form-label">System Account</label>
						<input type="number" name="system_account" class="form-control">
					</div>
					<div class="col-md-3">
						<label class="form-label">Branch Code</label>
						<input type="number" name="branch_code" class="form-control">
					</div>
					<div class="col-md-3">
						<label class="form-label">Users</label>
						<select name="user_id" class="form-select"></select>
					</div>
					<div class="col-md-3">
						<label class="form-label">ALevel</label>
						<input type="number" name="alevel" class="form-control">
					</div>
					<div class="col-md-3">
						<label class="form-label">Delete Status</label>
						<input type="number" name="del_status" class="form-control">
					</div>
					<div class="col-md-3">
						<label class="form-label">ContraCodeIsThere</label>
						<input type="number" name="contra_codeIs_there" class="form-control">
					</div>
					<div class="col-md-3">
						<label class="form-label">Contra Account Aode</label>
						<input type="text" name="contra_account_aode" class="form-control">
					</div>
					<div class="col-md-3">
						<label class="form-label">Account</label>
						<select name="account_id" class="form-select"></select>
					</div>
					<div class="col-md-3">
						<label class="form-label">Postable</label>
						<input type="number" name="postable" class="form-control">
					</div>
					
			</div>
			<!--begin::Input group-->
			<div class="row justify-content-center">
				<div class="col-md-4 text-center">
					<button class="btn mt-4 btn-sm btn-primary">Submit</button>
				</div>
			</div>

		</form>
	</div>
	<!--end: Card Body-->
</div>
<!--end::Table widget 14-->
</x-default-layout>