<x-default-layout>
    <!--begin::Table widget 14-->
<div class="card card-flush h-md-100">
	<!--begin::Header-->
    <div class="row p-4">
        <div class="col-md-4 w-25">
            <label for="" class="form-label">Business</label>
            <input value="{{ $contract->business->name }}" class="form-control" disabled>
        </div>
        <div class="col-md-4 w-25">
            <label for="" class="form-label">Product</label>
            <input value="{{ $contract->product->name }}" class="form-control" disabled>
        </div>
        <div class="col-md-4 w-25">
            <label for="" class="form-label">Buyer</label>
            <input value="{{ $contract->buyer->name }}" class="form-control" disabled>
        </div>
</div>
    
    <div class="card-header pt-7">
		<!--begin::Title-->
		<h3 class="card-title align-items-start flex-column">
			<span class="card-label fw-bold text-gray-800">Vessels</span>
		</h3>
		<!--end::Title-->
		<!--begin::Toolbar-->
		
		<!--end::Toolbar-->
	</div>
	<!--end::Header-->
	<!--begin::Body-->
	<div class="card-body pt-6">
		<!--begin::Table container-->
		<div class="table-responsive">
			<!--begin::Table-->
			<table id="" class="table table-row-bordered gy-5">
			    <thead>
			        <tr class="fw-semibold fs-6 text-muted">
			            <th>BL Number</th>
			            <th>BL Quantity</th>
			        </tr>
			    </thead>
			    <tbody>
                    @foreach ($bl_contract as $bl)
                    <tr>
                        <td>#{{ $bl->bl->bl_number }} ({{ $bl->quantity }} Ton)</td>
                        <td> <input class="quantity" type="number" min="0"  max="{{ $bl->quantity }}" value="0"> </td>
                    </tr>
                    @endforeach
                </tbody>
			</table>
            <hr>
                <strong>Total : <span class="total-quantity">0</span></strong>
                <br><button class="btn btn-primary mt-4" onclick="$('#quantity-update').submit();">Save</button>
		</div>
		<!--end::Table-->
	</div>
	<!--end: Card Body-->
    {{-- QUANTITY UPDATE --}}
        <form action="{{ route('contract-quantity.update',$contract->id) }}" id="quantity-update" method="get">
            @csrf
            <input type="hidden" name="quantity" class="input-total-quantity">
            <input type="hidden" name="contract_id" value="{{ $contract->id }}">
        </form>
        {{-- END UPDATE --}}

</div>
<!--end::Table widget 14-->
</x-default-layout>

<script>
    $(document).on("keyup",".quantity", function () {
            var total = 0;
            $('.quantity').each(function() {
                total += parseInt($(this).val());
            });
            console.log(total);
            $('.total-quantity').text(total);
            $('.input-total-quantity').val(total);
        
    });
</script>