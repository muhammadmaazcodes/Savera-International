<x-default-layout>
  <style>
    .clickable-row {
      cursor: pointer;
    }
  </style>
  <div class="d-flex flex-column flex-column-fluid">
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

        <div id="kt_app_toolbar_container" class="">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    View Lifting
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
                      View Lifting </li>
                </ul>
            </div>
        </div>
    </div>
    <!--end::Toolbar-->
  </div>

  <div class="card card-flush h-md-100 mb-4 border  border-dark">
    <!--begin::Body-->
    <div class="card-body pb-0 pt-6">
      <div class="row">
          <div class="col-md-12">
              <div class="row">
                 <div class="col-md-2">
                    <p class="fw-bold fs-5 mb-0">Buyer</p>
                    <p class="fs-5">{{ $sale->buyer->name }}</p>
                  </div>

                  <div class="col-md-2">
                      <p class="fw-bold fs-5 mb-0">Product </p>
                      <p class="fs-5">{{ $sale->product->code }}</p>
                  </div>

                  <div class="col-md-2">
                    <p class="fw-bold fs-5 mb-0">Terminal </p>
                    <p class="fs-5">{{ $sale->terminal->code }}</p>
                  </div>

                  <div class="col-md-2">
                    <p class="fw-bold fs-5 mb-0">Vessel </p>
                    <p class="fs-5">{{ $sale->inventory->vessel->name ?? '--' }}</p>
                  </div>

                  <div class="col-md-2">
                    <p class="fw-bold fs-5 mb-0">Quantity </p>
                    <p class="fs-5">{{ number_format($sale->quantity,3) }}</p>
                  </div>

                  <div class="col-md-2">
                    <p class="fw-bold fs-5 mb-0">Gate Pass </p>
                    <p class="fs-5">{{ $sale->gate_pass }}</p>
                  </div>

              </div>
          </div>

      
      </div>

    </div>
    <!--end: Card Body-->
  </div>


      <div class="row">

          <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                <h3>Contracts</h3>
                <table class="table table-bordered table-hover border-dark">
                  <thead class="bg-secondary fw-bold">
                      <tr>
                          <th>Contract#</th>
                          <th>Allocated Qty</th>
                          <th>Contract Status</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach ($sale->sales_contracts as $contract)
                        <tr class="clickable-row" data-href="{{ url('local-contracts/view-contract/'.$contract->contract->id) }}">
                          <td>{{ $contract->contract->code ?? '--' }}</td>
                          <td>{{ $contract->quantity }}</td>
                          <td>{{ $contract->contract->lifting_status() ?? '--' }}</td>
                        </tr>  
                    @endforeach
                  </tbody>
              </table>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                <h3>BLs</h3>
                <table class="table table-bordered table-hover border-dark">
                  <thead class="bg-secondary fw-bold">
                      <tr>
                          <th>BL#</th>
                          <th>Index No.</th>
                          <th>Allocated Qty</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach ($sale->lifting_bls as $lifting_bl)
                        <tr class="clickable-row" data-href="{{ route('bl.view',$lifting_bl->bl_id) }}">
                          <td>{{ $lifting_bl->bl->bl_number }}</td>
                          <td>{{ $lifting_bl->bl->index_number }}</td>
                          <td>{{ $lifting_bl->quantity }}</td>
                        </tr>  
                    @endforeach
                  </tbody>
              </table>
              </div>
            </div>
          </div>

      </div>

@push('scripts')
    <script>
      $(document).ready(function($) {
        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });
      });
    </script>
@endpush
</x-default-layout>
