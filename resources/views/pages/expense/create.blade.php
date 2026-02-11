<x-default-layout>
	<!--begin::Table widget 14-->
<div class="card card-flush h-md-100">
	<!--begin::Header-->
	<div class="card-header pt-7">
		<!--begin::Title-->
		<h3 class="card-title align-items-start flex-column">
			<span class="card-label fw-bold text-gray-800">Add Expenses</span>
		</h3>
		<!--end::Title-->
	</div>
	<!--end::Header-->
	<!--begin::Body-->
  
	<div class="card-body pt-6">
		<form class="pt-1" method="POST" action="/expense">
			@csrf
			<div class="row justify-content-center">
				<div class="col-md-4">
          <label for="" class="form-label">Date</label>
					<input type="date" class="form-control form-control-lg" name="date" value="" />
				</div>
        <div class="col-md-4">
          <label for="" class="form-label">Description</label>
					<input type="text" class="form-control form-control-lg" placeholder="Description" name="description" value="" />
				</div>
        <div class="col-md-4">
            <label for="" class="form-label">Amount</label>
            <input type="number" class="form-control form-control-lg" placeholder="$0.00" name="amount" value="" />
        </div>

			</div>
			
			<div class="text-center mt-3">
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
<script>
  $(document).on("click",".credit-btn", function () {
      $('.credit').removeClass('d-none');
      $('.debit').addClass('d-none');
  });

  $(document).on("click",".debit-btn", function () {
      $('.debit').removeClass('d-none');
      $('.credit').addClass('d-none');
  });
</script>
@endpush
</x-default-layout>