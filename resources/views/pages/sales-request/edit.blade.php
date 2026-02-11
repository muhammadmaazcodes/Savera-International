<x-default-layout>
    <style>
    input[type='text'],
    input[type='date'],
    input[type='number'],
    textarea,
    select {
        background:#f5f8fa !important;
    }
    .form-check-input {
        border-color: #000;
        width: 1.3em;
        height: 1.3em;
    }
    .table-responsive {
        overflow-x: visible;
    }
</style>
<div class="row">
    <div class="col-md-6">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
    
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="">
    
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        Sales Request
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
                            Sales Request </li>
                        <!--end::Item-->
    
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
    </div>

    <div class="col-md-6">
        <div class="text-end mt-5">
            <a href="{{ url('sales-request') }}" class="btn btn-primary btn-sm">Add New</a>
            <a href="{{ url('sales-request/export?status=0') }}" id="export-table" class="btn btn-secondary border border-dark btn-sm">Export <i class="fa fa-download"></i></a>
        </div>
    </div>
</div>


          <div class="row">
            
            <div class="col-lg-4">
                <!--begin::Table widget 14-->
        <div class="card card-flush mt-5 h-md-100">
            <!--begin::Body-->
            <div class="card-body px-3 pt-3">

                <form class="pt-1" method="POST" action="{{ route('sales.update',$sale->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                <!--begin::Repeater-->
                <div>
                    <!--begin::Form group-->
                    <div class="form-group">
                        <div class="mb-5">
                            <div class="rounded-3 p-3">
                                <div class="form-group row gy-3">

                                    <div class="col-md-12">
                                        <label class="form-label">Buyer</label>
                                        <select class="form-select form-select-sm mb-1" name="buyer_id" id="create_buyer_id" required>
                                            <option>-- Select Buyer --</option>
                                            @foreach($buyers as $buyer)
                                                <option value="{{ $buyer->id }}" {{ ($sale->buyer_id) ==  $buyer->id ? 'selected' : ''}}>{{ $buyer->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Product</label>
                                        <select class="form-select form-select-sm mb-1" id="create_product_id" name="product_id" required>
                                            <option value="">-- Select Product --</option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}" {{ ($sale->product_id) ==  $product->id ? 'selected' : ''}}>{{ $product->code }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="vessel_id" class="form-label">Vessels</label>
                                        <select class="form-select form-select-sm mb-1" name="inventory_id" required>
                                            <option>-- Select Vessel --</option>
                                            @foreach($vessels as $vessel)
                                                <option value="{{ $vessel->id }}" {{ ($sale->inventory_id) ==  $vessel->id ? 'selected' : ''}}>{{ $vessel->vessel->name }} ({{ $vessel->vessel->voyage_number ?? 'LOCAL' }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="terminal_id" class="form-label">Terminal</label>
                                        <select class="form-select form-select-sm mb-1" name="terminal_id" required>
                                            <option>-- Select Terminal --</option>
                                            @foreach($terminals as $terminal)
                                                <option value="{{ $terminal->id }}" {{ ($sale->terminal_id) ==  $terminal->id ? 'selected' : ''}}>{{ $terminal->code }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="" class="form-label">Vehicle Number</label>
                                        <input type="text" name="vehicle_number" class="form-control form-control-sm" value="{{ $sale->vehicle_number }}" required placeholder="Enter Vehicle Number">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="" class="form-label">Quantity</label>
                                        <input type="number" name="quantity" class="form-control form-control-sm" value="{{ $sale->quantity }}" required placeholder="Enter Quantity">
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Form group-->

                </div>
                <!--end::Repeater-->
                <div class="text-center">
                    <button type="submit" class="btn btn-lg btn-light fw-bold btn-primary me-2">Update</button>
                </div>
                </form>

            </div>
            <!--end: Card Body-->
        </div>
     <!--end::Table widget 14-->
            </div>

    <div class="col-lg-8">
                {{-- All BLs --}}
        <div class="card card-flush mt-5 h-md-100">
            <div class="card-body px-4 pt-4">

                <div class="row">
                    <div class="col-md-3">
                      <select class="form-select" id="buyer">
                        <option disabled selected>-- Buyer --</option>
                        <option value="">All</option>
                        @foreach ($buyers as $buyer)
                            <option value="{{ $buyer->name }}">{{ $buyer->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-3">
                      <input type="text" id="vehicle" class="form-control" placeholder="Vehicle #">
                    </div>
                    <div class="col-md-3">
                      <select class="form-select" id="product">
                        <option disabled selected>-- Product --</option>  
                        <option value="">All</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->code }}">{{ $product->code }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" id="vessel">
                            <option disabled selected>-- Vessel --</option>
                            <option value="">All</option>
                            @foreach($vessels as $vessel)
                                <option value="{{ $vessel->vessel->name }}">{{ $vessel->vessel->name }}</option>
                            @endforeach
                        </select>
                    </div>
                  </div>

                <table class="table align-middle table-bordered table-hover mt-5" id="bl-table">
                    <thead class="bg-secondary fw-bold">
                        <tr>
                            <th>Buyer</th>
                            <th>Product</th>
                            <th>Vessel</th>
                            <th>Terminal</th>
                            <th>Vehicle</th>
                            <th>R. Qty</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="bls-tbody">
                        
                    </tbody>
                </table>
            </div>
        </div>
        {{-- End BLs --}}
            </div>

          </div>

    <!-- Modal -->
<div class="modal fade" id="WhatsappMessage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Whatsapp Message</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
          <p id="full-contract-msg">
           <span>K-2901</span> <br>
           <span>TTD-735</span> <br> 
           <span>C-2319</span> <br> 
           <span id="sale-vehicle">ABC-678</span> <br>
           <span> QTY : <span id="sale-qty"></span> <span id="sale-p-t"></span> </span>  <br>
           <span id="sale-vessel">MT Ocean Pioneer ||</span> <br>
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  {{-- Buyer Dashboard --}}
    <!-- Modal -->
    @foreach ($buyers as $buyer)
        <div class="modal fade" id="BuyerDashboard-{{ $buyer->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Buyer Dashboard</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <table class="table table-bordered table-hover border-dark">
                        <thead class="bg-secondary fw-bold">
                            <tr>
                                <th>Buyer</th>
                                <th>Contract#</th>
                                <th>Product</th>
                                <th>C. Qty.</th>
                                <th>B. C. Qty.</th>
                                <th>Contract Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($buyer->contracts as $contract)
                                <tr>
                                    <td>{{ $buyer->name }}</td>
                                    <td>{{ $contract->code }}</td>
                                    <td>{{ $contract->product->code }}</td>
                                    <td>{{ number_format($contract->quantity,3) }}</td>
                                    <td>{{ number_format($contract->balance_qty(),3) }}</td>
                                    <td>{{ $contract->lifting_status() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
            </div>
        </div>
    @endforeach


  {!! theme()->addVendor('formrepeater') !!}
  @push('scripts')
  <script src="https://malsup.github.io/jquery.form.js"></script> 
  <script>
    $('#kt_docs_repeater_basic').repeater({
        initEmpty: false,

        defaultValues: {
            'text-input': 'foo'
        },

        show: function() {
            $(this).slideDown();
        },

        hide: function(deleteElement) {
            $(this).slideUp(deleteElement);
        }
    });
    </script>

    <script>
        function BlDataTable() {
                var table = $("#bl-table").DataTable({
                    processing: true,
                    serverSide: true,
                    info: false,
                    paging: false,
                    destroy: true,
                    sorting: false,
                    ajax: "{{ url('sales-request') }}",
                    columns: [
                        {data: 'buyer_name', name: 'buyer_name'},
                        {data: 'product_name', name: 'product_name'},
                        {data: 'vessel_name', name: 'vessel_name'},
                        {data: 'terminal_name', name: 'terminal_name'},
                        {data: 'vehicle_number', name: 'vehicle_number'},
                        {data: 'quantity', name: 'quantity'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ],
                            
                columnDefs: [{
                    targets: 1,
                    searchable: true,
                    visible: true
                }]
        
                    });

            $('#product').on('change', function() {
                var value = $(this).find(':selected').val();
                table.column(1).search(value).draw();
            });

            $('#buyer').on('change', function() {
                var value = $(this).find(':selected').val();
                table.column(0).search(value).draw();
            });

            $('#vessel').on('change', function() {
                var value = $(this).find(':selected').val();
                table.column(2).search(value).draw();
            });

            $('#vehicle').on('keyup', function() {
                var value = $(this).val();
                table.column(4).search(value).draw();
            });

            return table;
        }

        $(document).ready(function() {
            BlDataTable();
            setTimeout(() => {
              $('.sale-{{ $sale->id }}').closest("tr").addClass('bg-secondary');
          }, 2000);
        });

    
        $(document).on('click','#check-submit-btn', function () {
            
                $("#bls-form").ajaxSubmit(
                    {
                        url: "{{ url('sales-request/store') }}",
                        type: 'post',
                        success: function(response) {
                            var msg = response.whatsapp_msg;
                            if (response.error) {
                                swal(response.error, "", "warning");
                            }
                            else {
                                swal("Sale Requested Successfully!", "", "success");
                                $('#sale-vehicle').text(msg.vehicle);
                                $('#sale-vessel').text(msg.vessel);
                                $('#sale-qty').text(msg.quantity);
                                $('#sale-p-t').text(msg.product);
                                setTimeout(() => {
                                    $('#WhatsappMessage').modal('toggle');
                                }, 1000);
                            }
                            $('#bls-form')[0].reset();
                            $('#kt_docs_repeater_basic').find('[data-repeater-delete]').click();
                            BlDataTable();
                        },
                        error: function(xhr, textStatus, error) {
                            var error_msg = JSON.parse(xhr.responseText);
                            if (error_msg.error) {
                                swal(""+ error_msg.error +"", "", "warning");
                            }
                            else {
                                swal("Error Occured!", "", "warning");
                            }
                         }
                    }
                );
        });
    </script>

    <script>
        $(document).on("click",".edit-bl", function () {
            
            var url = $(this).attr('data-info');
            var action = $(this).attr('data-route');

            $.ajax({
                type: "GET",
                url: url,
                success: function (data) {
                    $('#edit-bl-form').attr('action',action);
                    $('#edit-bl-form').removeClass('d-none');
                    $('#bls-form').addClass('d-none');

                    // Assign Values
                    $('#edit-bl-form').find('#buyer_id option[value='+data.buyer_id+']').attr('selected','selected');
                    $('#edit-bl-form').find('#inventory_id option[value='+data.inventory_id+']').attr('selected','selected');
                    $('#edit-bl-form').find('#product_id option[value='+data.product_id+']').attr('selected','selected');
                    $('#edit-bl-form').find('#terminal_id option[value='+data.terminal_id+']').attr('selected','selected');
                    $('#edit-bl-form').find('input[name="quantity"]').val(data.quantity);
                    $('#edit-bl-form').find('input[name="vehicle_number"]').val(data.vehicle_number);
                    $('#edit-bl-form').find('#edit-submit-btn').text('Update');
                }
            });
        });
    </script>

    <script>
        $(document).on("click","#edit-submit-btn", function () {
            
            var url = $(this).closest('form').attr('action');
            var formData = $(this).closest('form').serialize();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                success: function (response) {
                    swal("Requested Sale Updated!", "", "success");
                        $('#edit-bl-form')[0].reset();
                        BlDataTable();

                        $('#edit-bl-form').attr('action',"");
                        $('#edit-bl-form').addClass('d-none');
                        $('#bls-form').removeClass('d-none');
                },
                error:  function() {
                    swal("Error Occured!", "", "warning");
                }
            });
        });
    </script>

    <script>
        $(document).on("change","#create_product_id", function () {
            var product_id = $(this).val();
            var buyer_id = $("#create_buyer_id").val();

            if (product_id != "" && buyer_id != "") {
                $.ajax({
                    type: "GET",
                    url: "{{ url('sales-request/check-qty') }}",
                    data: {
                        product_id: product_id,
                        buyer_id: buyer_id
                    },
                    success: function (response) {
                        if (response.message) {
                            swal(response.message,"","warning");
                            $('#contract_qty').val('not-exist');
                        }
                        else {
                            $('#contract_qty').val(response.quantity);
                        }
                    }
                });
            }
        });
    </script>
    <script>
        $(document).on("keyup",".create-quantity", function () {
            var contract_qty = $('#contract_qty').val();
            
            var value = 0;
            $('.create-quantity').each(function (i, element) {
                    value += parseInt($(element).val());
            });
            
            if (contract_qty != 'not-exist') {
                if (value > contract_qty) {
                    $(this).addClass('border border-danger');
                    setTimeout(() => {
                        $(this).val('')
                    }, 1000);
                    swal("Quantity exceed!","", "warning");
                }
                else {
                    $(this).removeClass('border border-danger');
                }
            }
            else {
                swal("Contract not found!","", "warning");
                $(this).val('')
            }
        });
    </script>

    <script>
        $(document).on("click","#add-new", function () {
            $('#edit-bl-form')[0].reset();

            $('#edit-bl-form').addClass('d-none');
            $('#bls-form').removeClass('d-none');
        });
    </script>
  @endpush
</x-default-layout>