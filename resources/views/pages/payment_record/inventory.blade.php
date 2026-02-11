<x-default-layout>
	<!--begin::Table widget 14-->
<div class="card card-flush h-md-100">
	<!--begin::Header-->
	<div class="card-header pt-7">
		<!--begin::Title-->
		<h3 class="card-title align-items-start flex-column">
			<span class="card-label fw-bold text-gray-800">Add Inventory Payment</span>
		</h3>
		<!--end::Title-->
	</div>
	<!--end::Header-->
	<!--begin::Body-->
	<div class="card-body pt-6">
		<form class="pt-1" method="POST" action="{{ route('payment.inventory.store') }}">
			@csrf
      @method('POST')
			<div class="row">
				<div class="col-md-4">
          <label class="form-label" for="">Payment Amount</label>
					<input type="text" class="form-control form-control-sm form-control-solid" placeholder="$0.00" name="amount" />
				</div>
        <div class="col-md-4">
          <label class="form-label" for="">Date</label>
					<input type="date" class="form-control form-control-sm form-control-solid" placeholder="" name="date" />
				</div>
				<div class="col-md-4">
          <label class="form-label" for="">Vessels</label>
					<select name="inventory_id" id="type" class="form-select form-select-sm form-select-solid">
            <option>-- Select Vessel --</option>
						@foreach ($inventories as $inventory)
              <option value="{{ $inventory->id }}">{{ $inventory->vessel->name }}</option>
            @endforeach
					</select>
				</div>
				<div class="col-md-4 mt-5">
					<button type="submit" class="btn btn-sm btn-light fw-bold btn-primary me-2" data-kt-search-element="advanced-options-form-cancel">Submit</button>
				</div>
			</div>
			<!--begin::Input group-->
		</form>
	</div>
	<!--end: Card Body-->
</div>
<!--end::Table widget 14-->
</x-default-layout>