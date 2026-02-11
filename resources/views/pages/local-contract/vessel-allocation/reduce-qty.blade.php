<x-default-layout>
  <style>
    tr {
      cursor: pointer;
    }
  </style>
  <!--begin::Toolbar-->
  <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

      <!--begin::Toolbar container-->
      <div id="kt_app_toolbar_container" class="">

          <!--begin::Page title-->
          <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
              <!--begin::Title-->
              <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                  Reduce Qty- Local Contract
              </h1>
              <!--end::Title-->


              <!--begin::Breadcrumb-->
              <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                  <!--begin::Item-->
                  <li class="breadcrumb-item text-muted">
                      <a href="/" class="text-muted text-hover-primary">
                          Dashboard </a>
                  </li>
                  <!--end::Item-->
                  <!--begin::Item-->
                  <li class="breadcrumb-item">
                      <span class="bullet bg-gray-400 w-5px h-2px"></span>
                  </li>
                  <!--end::Item-->

                  <!--begin::Item-->
                  <li class="breadcrumb-item text-muted">
                      Reduce Qty </li>
                  <!--end::Item-->

              </ul>
              <!--end::Breadcrumb-->
          </div>
          <!--end::Page title-->

      </div>
      <!--end::Toolbar container-->
  </div>
  <!--end::Toolbar-->

<!--begin::Table widget 14-->
<div class="card card-flush h-md-100 mb-3">
  <!--begin::Body-->
  <div class="card-body pb-4 pt-6">
          <div class="row">

              <div class="col-md-12">
                  <div class="row" id="contract-details">
                     <div class="col">
                        <p class="mb-0 h5">Contract Code </p>
                        <p id="contract-bussiness">{{ $contract->code }}</p>
                      </div>
                      <div class="col">
                        <p class="mb-0 h5">Contract Date </p>
                        <p id="contract-date">{{ $contract->date }}</p>
                      </div>

                      <div class="col">
                        <p class="mb-0 h5">Product</p>
                        <p id="contract-product">{{ $contract->product->code }}</p>
                      </div>

                      <div class="col">
                        <p class="mb-0 h5">Cont. Qty</p>
                        <p id="contract-qty">{{ $contract->quantity }}</p>
                      </div>

                  </div>
              </div>

          
          </div>

        </div>
        <!--end: Card Body-->
    </div>
    <!--end::Table widget 14-->

    @if ($qty < $contract->balance_qty())
    <div class="alert alert-danger" role="alert">
      Manage BL Quantity into Reduced Contract Qty <strong>{{ number_format($qty,3) }}</strong>
    </div>
    @endif

    <div class="row justify-content-center">
          
      <div class="col-md-8">

        <form action="{{ route('update.reduce-qty',[$contract->id,$qty]) }}" id="form" method="POST">
          @csrf
          @method('POST')

          <div class="card">
            <div class="card-body">
              <table class="table table-borderless">
                  @foreach ($contract->allocations as $vessel_allocation)
                  <thead>
                    <tr>
                      <th>{{ $vessel_allocation->inventory->vessel->name }}</th>
                      <th><input type="number" form="form" data-id="{{ $vessel_allocation->id }}" min="{{ $vessel_allocation->bls_allocation->sum('quantity') }}" max="{{ $vessel_allocation->inventory->unsold_qty_by_pd($vessel_allocation->contract->product_id) + $vessel_allocation->quantity }}" name="vessel_qty[{{ $vessel_allocation->id }}]" class="form-control form-control-sm vessel-qty" value="{{ $vessel_allocation->quantity }}" step="0.001">
                    </tr>
                    <tr>
                    <th style="width:65%">BL#</th>
                    <th style="width:35%">Quantity</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($vessel_allocation->bls_allocation as $bl_allocation)
                    <tr>
                      <td>
                        {{ $bl_allocation->bl->bl_number }}
                      </td>
                      <td>
                        <input type="number" form="form" max="{{ $bl_allocation->bl->unsold_qty() + $bl_allocation->quantity }}" data-vessel="{{ $bl_allocation->vessel_allocation_id }}" data-qty="{{ $bl_allocation->quantity }}" name="bl_allocations[{{ $bl_allocation->id }}]" name="quantity" class="form-control form-control-sm bls-qty" value="{{ $bl_allocation->quantity }}" step="0.001">
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                @endforeach
                  <tfoot>
                    <th class="text-end fw-bold">Total:</th>
                    <th class="text-end"><span id="vessal-total">{{ $contract->allocations->sum('quantity') }}</span></th>
                    <th></th>
                  </tfoot>
                </table>
            </div>
          </div>

          <div class="text-center mt-3">
              <button type="button" id="submit-btn" class="btn btn-primary btn-sm">Save</button>
          </div>

        </form>

      </div>

        </div>

{!! theme()->addVendor('formrepeater') !!}
@push('scripts')
  @if (Session::has('error'))
  <script>
    swal("{{ Session::get('error') }}","","warning");
  </script>
  @endif
  <script>
    $(document).ready(function () {
      var table = $('#bl-table').DataTable({
        info: false,
        paging : true,
        pageLength: 10
      });

      $('#buyer').on('change', function() {
          table.column(2).search(this.value).draw();
      });

      $('#product').on('change', function() {
          table.column(1).search(this.value).draw();
      });

      $('#contract_num').on('keyup', function() {
          table.column(0).search(this.value).draw();
      });

    });
    </script>
    <script>
      $(document).on("blur",".bls-qty",function () { 

          if (this.PreviousValue != $(this).val()) {
            var current_value = $(this).val();
            var value = this.PreviousValue;
            var vessel_id = $(this).attr('data-vessel');
            var vessel_qty = $('input.vessel-qty[data-id="'+vessel_id+'"]').val();
  
              var vessel_allocation_qty = parseFloat(current_value) - parseFloat(value);
              $('input.vessel-qty[data-id="'+vessel_id+'"]').val(parseFloat(vessel_qty) + vessel_allocation_qty);

              var total_qty = 0;
              $('.vessel-qty').each(function (index, element) {
                  total_qty += parseFloat($(element).val());
              });
              $('#vessal-total').text(total_qty);
          }

      });
      
      $(document).on("focus",".bls-qty", function () {
          this.PreviousValue = $(this).val();
      });
    </script>
    <script>
      $(document).on("click","#submit-btn", function () {
          var status = true;
          var reduce_qty = "{{ $qty }}";
          var total_qty = 0;
          $('.vessel-qty').each(function (index, element) {
              total_qty += parseFloat($(element).val());
              var vessel_val = $(element).val();
              var id = $(element).attr('data-id');
              var vessel_min = 0;
              $('input.bls-qty[data-vessel="'+id+'"]').each(function (i, newelement) { 
                vessel_min += parseFloat($(newelement).val());
               });
              var vessel_max = $(element).attr('max');
              
              if (parseFloat(vessel_val) < vessel_min || parseFloat(vessel_val) > vessel_max) {
                $(element).addClass('border border-danger');
                status = false;
              }

          });

          $('.bls-qty').each(function (index, element) {
              var bl_val = $(element).val();
              var bl_max = $(element).attr('max');
              
              if (parseFloat(bl_val) > bl_max) {
                $(element).addClass('border border-danger');
                status = false;
              }
          });
          
          if (total_qty > reduce_qty) {
            status = false;
            swal("Quantity is still not reduce!","","warning");
          }
          else if (status == false) {
            swal("Quantity Error Occured!","","warning");
          }
          else {
            $('#form').trigger('submit');
          }
      });
    </script>
    @endpush
</x-default-layout>