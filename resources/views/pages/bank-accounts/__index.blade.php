<x-default-layout>
	<!--begin::Table widget 14-->
<div class="card card-flush h-md-100">
	<!--begin::Header-->
	<div class="card-header pt-7">
		<!--begin::Title-->
		<h3 class="card-title align-items-start flex-column">
			<span class="card-label fw-bold text-gray-800">Bank Accounts</span>
		</h3>
		<!--end::Title-->
		<!--begin::Toolbar-->
		<div class="card-toolbar">
			<a href="/bank-accounts/create" class="btn btn-sm btn-secondary">Add New</a>
		</div>
		<!--end::Toolbar-->
	</div>
	<!--end::Header-->
	<!--begin::Body-->
	<div class="card-body pt-6">
		<!--begin::Table container-->
		<div class="table-responsive">
			<!--begin::Table-->
			<table id="data-table-simple" class="table table-row-bordered gy-5">
			    <thead>
			        <tr class="fw-semibold fs-6 text-muted">
			            <th>Name</th>
			            <th>Account Title</th>
			            <th>Account Number</th>
			            <th>Edit</th>
			        </tr>
			    </thead>
			    <tbody>
			    	@foreach($bank_accounts as $bank_account)
			        <tr>
			            <td>{{ $bank_account->name }}</td>
			            <td>{{ $bank_account->account_title }}</td>
			            <td>{{ $bank_account->account_number }}</td>
			            <td><a href="/bank-accounts/{{ $bank_account->id }}/edit" class="btn btn-sm btn-primary align-self-center">Edit</a></td>
			        </tr>
			        @endforeach
			</table>
		</div>
		<!--end::Table-->
	</div>
	<!--end: Card Body-->
</div>
<!--end::Table widget 14-->
</x-default-layout>