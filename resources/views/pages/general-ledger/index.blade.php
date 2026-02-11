<x-default-layout>
	<!--begin::Table widget 14-->
<div class="card card-flush h-md-100">
	<!--begin::Header-->
	<div class="card-header pt-7">
		<!--begin::Title-->
		<h3 class="card-title align-items-start flex-column">
			<span class="card-label fw-bold text-gray-800">General Ledger</span>
		</h3>
		<!--end::Title-->
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
			            <th>Date</th>
			            <th>Reference</th>
			            <th>Account</th>
			            <th>Description</th>
			            <th>Debit</th>
			            <th>Credit</th>
			        </tr>
			    </thead>
			    <tbody>
			    	@foreach($general_ledgers as $ledger)
			        <tr>
			            <td>{{ $ledger->date }}</td>
			            <td>{{ $ledger->reference }}</td>
			            <td>{{ $ledger->account }}</td>
			            <td>{{ $ledger->description }}</td>
			            <td>{{ ($ledger->debit) == 0 ? '-' : $ledger->debit }}</td>
			            <td>{{ ($ledger->credit) == 0 ? '-' : $ledger->credit }}</td>
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