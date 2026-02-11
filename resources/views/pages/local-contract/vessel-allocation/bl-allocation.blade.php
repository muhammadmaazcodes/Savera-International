<x-default-layout>
  <style>
    tr {
      cursor: pointer;
    }
  </style>

  <div class="row">
      
    <div class="col-lg-6">

      <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

        <div id="kt_app_toolbar_container" class="">
      
              <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    BL Allocation
                </h1>
      
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="/" class="text-muted text-hover-primary">
                            Dashboard </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>

                    <li class="breadcrumb-item text-muted">
                        BL Allocation </li>
      
                </ul>
              </div>

        </div>
      </div>

    </div>

    <div class="col-lg-6">
        <div class="text-end mt-5">
          <a href="{{ url('local-contracts/vessel-allocation') }}" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left"></i> Back to vessel Allocation</a>
        </div>
    </div>

  </div>


  <!--begin::Table widget 14-->
<div class="card card-flush h-md-100 mb-3">
  <!--begin::Body-->
  <div class="card-body pb-4 pt-6">
          <div class="row">

              <div class="col-md-12">
                  <div class="row justify-content-end" id="contract-details">
                     <div class="col-md">
                        <p class="mb-0 h5">Selected Vessel </p>
                        <p>{{ $vessel_allocation->inventory->vessel->name }}</p>
                      </div>
                      <div class="col-md">
                        <p class="mb-0 h5">Contract Product </p>
                        <p>{{ $vessel_allocation->contract->product->code ?? 'N/A' }}</p>
                      </div>

                      <div class="col-md">
                        <p class="mb-0 h5">Vessel Allocation Qty </p>
                        <p>{{ number_format($vessel_allocation->quantity,3) }}</p>
                      </div>

                      <div class="col-md">
                        <p class="mb-0 h5">BL Allocated Qty</p>
                        <p>{{ number_format($vessel_allocation->bls_allocation->sum('quantity'),3) }}</p>
                      </div>

                      <div class="col-md">
                        <p class="mb-0 h5">Contract#</p>
                        <p>{{ $vessel_allocation->contract->code }}</p>
                      </div>

                  </div>
              </div>

          
          </div>

        </div>
        <!--end: Card Body-->
    </div>
    <!--end::Table widget 14-->

  <div class="row justify-content-center">
    
    <div class="col-md-12">
      <table class="table align-middle table-bordered table-hover mt-5 border border-dark">
        <thead class="bg-secondary fw-bold d-none">
            <tr>
              <th style="width:5%"></th>
              <th style="width:15%">BL#</th>
              <th style="width:10%">Prov. Price</th>
              <th style="width:10%">Bl Qty</th>
              <th style="width:10%">Landed Qty</th>
              <th style="width:10%">Sold Qty</th>
              <th style="width:10%">Unsold Qty</th>
              <th style="width:10%">BL Status</th>
              <th style="width:10%">Inp. Qty</th>
            </tr>
          </thead>
      </table>
      @foreach ($bls as $key => $value)
        <div class="table-responsive">
          <table class="table align-middle table-bordered table-hover mt-5 border border-dark all-table">
              <thead class="bg-secondary fw-bold">
                  <tr>
                      <th style="width:5%"></th>
                      <th style="width:15%">BL#</th>
                      <th style="width:10%">Prov. Price</th>
                      <th style="width:10%">Bl Qty</th>
                      <th style="width:10%">Landed Qty</th>
                      <th style="width:10%">Sold Qty</th>
                      <th style="width:10%">Unsold Qty</th>
                      <th style="width:10%">BL Status</th>
                      <th style="width:10%">Inp. Qty</th>
                  </tr>
              </thead>
              <tbody id="bls-tbody">
                    @foreach ($bls[$key] as $bl)
                    <tr data-bl-number="{{ $bl->bl_number }}" data-bl-id="{{ $bl->id }}">
                        <td style="width:5%;text-align:center"><input type="checkbox" class="bl-checkbox"></td>
                        <td style="width:15%">{{ $bl->bl_number }}</td>
                        <td style="width:10%">{{ $bl->provisional_price }}</td>
                        <td style="width:10%">{{ number_format($bl->bl_quantity,3) }}</td>
                        <td style="width:10%">{{ number_format($bl->landed_quantity,3) }}</td>
                        <td style="width:10%">{{ number_format($bl->landed_quantity - $bl->unsold_qty(),3) }}</td>
                        <td class="unsold-qty" style="width:10%">{{ number_format($bl->unsold_qty(),3) ?? '0.000' }}</td>
                        <td style="width:10%">{{ $bl->bl_status }}</td>
                        <td style="width:10%"><span><input type="number" class="bl-inp_qty" max="{{ $bl->landed_quantity }}" data-bl-id="{{ $bl->id }}" style="width: 70px;" step="0.0001"></span></td>
                      </tr>
                    @endforeach
                  
              </tbody>
          </table>
        </div>
      @endforeach
    </div>

    
    <div class="col-md-8">
      <div class="text-center">
        <button type="button" id="allocate-bls-btn" class="btn btn-primary btn-sm"><i class="fa fa-spinner fa-spin" style="display: none"></i> Allocate BLs</button>
      </div>
      
      <h3 class="mb-0 text-center mt-4">BL Allocation Summary</h3>
        <div class="table-responsive">
          <table class="table align-middle table-row-bordered table-hover mt-5 border border-dark all-table">
              <thead class="bg-secondary fw-bold">
                  <tr>
                      <th style="padding-left: 10px;">Vessel</th>
                      <th>Terminal</th>
                      <th>Prov. Price</th>
                      <th>Sold Qty</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody id="bls-tbody">
                    @foreach ($bl_allocations as $bl)
                      <tr>
                        <td style="padding-left: 10px;">{{ $bl->bl->inventory->vessel->name ?? 'N/A' }}</td>
                        <td>{{ $bl->bl->terminal->code ?? 'N/A' }}</td>
                        <td>{{ $bl->bl->provisional_price }}</td>
                        <td>{{ number_format($bl->bl->landed_quantity - $bl->bl->unsold_qty(),3) }}</td>
                        <td><a data-route="{{ route('bl_allocation.delete',$bl->id) }}" href="javascript:void(0);" class="btn btn-sm btn-light-danger confirm-delete"><i class="fa fa-trash"></i></a></td>
                      </tr>
                    @endforeach
                  
              </tbody>
          </table>
        </div>
    </div>

  </div>

  @push('scripts')
      @if (Session::has('success'))
          <script>
            swal("{{ Session::get('success') }}", "", "success");
          </script>
      @elseif (Session::has('error'))
          <script>
            swal("{{ Session::get('error') }}", "", "warning");
          </script>
      @endif
      <script>
        $(document).ready(function () {
          console.clear = () => {}
          var table = $('.all-table').DataTable({
              info: false,
              paging : false,
              sorting:false
          });
        });
      </script>
      <script>
        $(document).on("click","tr", function () {
            var bl_number = $(this).attr('data-bl-number');
            $('#inp-bl_num').val(bl_number);

            var bl_id = $(this).attr('data-bl-id');
            $('input[name="bl_id"]').val(bl_id);
        });
      </script>
      <script>
        $(document).on("change","#check-all", function () {
          if ($(this).is(':checked')) {
            $('input[type="checkbox"]').prop('checked',true);
          }
          else {
            $('input[type="checkbox"]').prop('checked',false);
          }
        });
      </script>
      <script>
        $(document).on("click","#allocate-bls-btn", function () {
          
          var allocations = {};
          var status = true;
          $('.bl-checkbox').each(function (index, element) {
            if ($(element).is(':checked')) {
              var qty = $(element).closest("tr").find('.bl-inp_qty').val();
              var bl_id = $(element).closest("tr").attr('data-bl-id');
              if (qty <= 0 || qty == '') {
                status = false;
                $(element).closest("tr").find('.bl-inp_qty').addClass('border border-danger');
              }
              else if($(element).closest('tr').find('.unsold-qty').text() == 0){
                swal("BL with unsold quantity can't be selected!","","warning");
                $(element).closest("tr").find('.bl-inp_qty').addClass('border border-danger');
              }
              else {
                $(element).closest("tr").find('.bl-inp_qty').removeClass('border border-danger');
              }
              allocations[index] = {
                quantity: qty,
                bl_id: bl_id
              }
            }
          });

          if (status == true) {
            $('.fa-spinner').show();
            $.ajax({
              type: "POST",
              url: "{{ url('local-contracts/bl-allocation',$vessel_allocation->id) }}",
              data: {
                _token : "{{ csrf_token() }}",
                allocations: allocations
              },
              success: function (response) {
                if (response.success) {
                  swal(response.success,"","success")
                  $('.bl-inp_qty').val('');
                  $('input[type="checkbox"]').prop('checked',false);
                  $('.fa-spinner').hide();
                  location.reload();
                }
                else {
                  swal(response.error,"","warning")
                  $('.fa-spinner').hide();
                }
                
              }
            });
          }

        });
      </script>

    <script>
      $(document).on("click",".confirm-delete", function () {
        
        var url = $(this).attr('data-route');
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this record!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              window.location.href =url;
            } else {
              swal("Your record is safe!");
            }
          });
      });
    </script>
  @endpush
</x-default-layout>