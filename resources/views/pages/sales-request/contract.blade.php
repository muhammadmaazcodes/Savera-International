<x-default-layout>

    <!--begin::Repeater-->
    <div class="card mt-3">

        <div class="card-header pt-7">
            <!--begin::Title-->
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold text-gray-800"><img src="{{ asset('assets/media/icons/contract.png') }}" height="40" alt=""> Add Contracts</span>
            </h3>
            <!--end::Title-->

        </div>

        <div class="card-body">
            <form class="pt-1" method="POST" action="{{ route('sales.contract.store') }}">
                @csrf    
			    <!--begin::Form group-->
			    <div class="form-group">
			       
                    <div class="border-1 rounded-3 my-5 border-secondary border p-3" data-repeater-item>
                        <div class="form-group row gy-3	">
                            <div class="col-md-9">
                                <label for="vessel_id" class="form-label">Contracts</label>
                                @if ($sale->sales_contracts == '[]')
                                <select name="contract_id[]" multiple class="contract_id form-select" style="width:auto">
                                    <option disabled></option>
                                    @foreach($contracts as $key => $contract)
                                        <option data-inventory="{{ $contract->inventory_id }}" value="{{ $contract->id }}">#{{ $contract->code }}</option>
                                    @endforeach
                                </select>
                                @else
                                    <select name="" multiple class="contract_id form-select" disabled style="width:auto">
                                        <option></option>
                                        @foreach($sale->sales_contracts as $key => $contracts)
                                            @php
                                                $contract = App\Models\LocalContract::where('id',$contracts->contract_id)->first();
                                            @endphp
                                            <option value="{{ $contract->id }}" disabled selected>#{{ $contract->code }}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>

                            <input type="hidden" name="sale_id" value="{{ $sale->id }}">
                            <div class="col-md-3 text-end">
                                &nbsp;
                            </div>
                            
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                        <!--begin::Table head-->
                                        <thead>
                                            <tr class="fw-bold text-muted">
                                                <th class="min-w-200px">Contract</th>
                                                <th class="min-w-150px">Quantity (Ton)</th>
                                            </tr>
                                        </thead>
                                        <!--end::Table head-->
                        
                                        <!--begin::Table body-->
                                        
                                        @if ($sale->sales_contracts == '[]')
                                        <tbody class="bl-quantities">
                                            
                                        </tbody>
                                        @else           
                                            <tbody>
                                                @foreach ($sale->sales_contracts as $contracts)
                                                    @php
                                                        $contract = App\Models\LocalContract::where('id',$contracts->contract_id)->first();
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $contract->code }}</td>
                                                        <td><input type="number" disabled class="form-control w-25" value="{{ $contracts->quantity }}"></td>
                                                    </tr>   
                                                @endforeach
                                            </tbody>
                                        @endif
                                        <!--end::Table body-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                            </div>

                        </div>
                    </div>
                        
			    </div>
			    <!--end::Form group-->

			    <!--begin::Form group-->
			    <!--end::Form group-->
                @if ($sale->sales_contracts == '[]')
                <button type="submit" class="btn btn-primary btn-sm text-center mt-4">Update</button>
            @endif
        </form>
			<!--end::Repeater-->
        </div>
    </div>

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

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $(".contract_id").select2({
                multiple: true,
                placeholder: "-- Select Contract --",
            });
        $(".contracts").select2({
            multiple: true,
            placeholder: "-- Select Contract --",
        });
    });
    </script>
    <script>
        $(document).on("change",".contract_id", function () {
            var value = $("option:selected:last",this).text();
            var inventory_id = $("option:selected:last",this).attr('data-inventory');
            var tr = '' +
                '<tr>' + 
                '     <td>' + value + '</td>' +
                '     <td><input name="contract_quantity[]" type="number" data-inventory="'+ inventory_id +'" class="form-control w-25 contract_qty" required></td>' + 
                '</tr>' + 
                '';
            $('.bl-quantities').append(tr);
        });
    </script>

<script>
    $(document).on("blur",".contract_qty",function(){

    var inventory_id = $(this).attr('data-inventory');
    var quantity = $(this).val();
        
    $.ajax({
       type:'GET',
       url:"{{ route('check.quantity') }}",
       data:{
            inventory_id:inventory_id,
             quantity:quantity
        },
       success:function(data){
          if(data < quantity)
          {
            swal({
                title: "Your given quantity is not avaible in the contract !",
                text: "Please decrease the quantity!",
                icon: "warning",
                button: "Ok!",
                });
          }
          else {
            //    
          }
       }
    });

});
</script>
@endpush
</x-default-layout>