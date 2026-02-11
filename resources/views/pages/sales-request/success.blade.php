<x-default-layout>
    <style>
    input[type='text'],
    input[type='date'],
    input[type='number'],
    textarea,
    select {
        background:#f5f8fa !important
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

            <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
          
                <!--begin::Toolbar container-->
                <div id="kt_app_toolbar_container" class="">
          
                    <!--begin::Page title-->
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                        <!--begin::Title-->
                        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                            Completed Sales
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
                                Completed Sales </li>
                            <!--end::Item-->
          
                        </ul>
                        <!--end::Breadcrumb-->
                    </div>
                    <!--end::Page title-->
          
                </div>
                <!--end::Toolbar container-->
            </div>

        </div>
        <div class="col-md-6">
            <div class="text-end mt-5">
                <a href="{{ url('sales-request/export?status=2') }}" id="export-table" class="btn btn-secondary border border-dark btn-sm">Export <i class="fa fa-download"></i></a>
            </div>
        </div>

    </div>

    
  
          <div class="row">
            
    <div class="col-lg-12">

        <div class="row mb-2 justify-content-end">
              <div class="col-md-4">
                <div class="card">
                    <div class="card-body py-3 px-3">
                        <label class="form-label">Lifting Date</label>
                        <input type="date" id="lifting_date" class="form-control">
                    </div>
                </div>
              </div>
        </div>

                {{-- All BLs --}}
        <div class="card card-flush mt-5 h-md-100">
            <div class="card-body px-4 pt-4">

                <div class="row">
                    <div class="col-md">
                      <select class="form-select" id="buyer">
                        <option disabled selected>-- Buyer --</option>
                        <option value="">All</option>
                        @foreach ($buyers as $buyer)
                            <option value="{{ $buyer->name }}">{{ $buyer->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md">
                      <input type="text" id="vehicle" class="form-control" placeholder="Vehicle #">
                    </div>
                    <div class="col-md">
                      <select class="form-select" id="product">
                        <option disabled selected>-- Product --</option>  
                        <option value="">All</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->code }}">{{ $product->code }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md">
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
                            <th>V</th>
                            <th>Veh#</th>
                            <th>P</th>
                            <th>R. Qty</th>
                            <th>Lifting Date</th>
                            <th>View</th>
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
                    ajax: "{{ url('sales-request/success') }}",
                    columns: [
                        {data: 'buyer_name', name: 'buyer_name'},
                        {data: 'vessel_name', name: 'vessel_name'},
                        {data: 'vehicle_number', name: 'vehicle_number'},
                        {data: 'product_name', name: 'product_name'},
                        {data: 'quantity', name: 'quantity'},
                        {data: 'lifting_date', name: 'lifting_date'},
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
                table.column(3).search(value).draw();
            });
  
            $('#buyer').on('change', function() {
                var value = $(this).find(':selected').val();
                table.column(0).search(value).draw();
            });
  
            $('#vessel').on('change', function() {
                var value = $(this).find(':selected').val();
                table.column(1).search(value).draw();
            });
  
            $('#vehicle').on('keyup', function() {
                var value = $(this).val();
                table.column(2).search(value).draw();
            });

            $('#lifting_date').on('change', function() {
                var value = $(this).val();
                table.column(5).search(value).draw();
            });
            

  
            return table;
        }
  
        $(document).ready(function() {
            BlDataTable();
        });
  
    
    </script>
  
  @endpush
  </x-default-layout>