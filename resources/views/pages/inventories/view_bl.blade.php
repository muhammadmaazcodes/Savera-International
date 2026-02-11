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
                    View BL
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
                      View BL </li>
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
                    <p class="fw-bold fs-5 mb-0">BL#</p>
                    <p class="fs-5">{{ $bl->bl_number }}</p>
                  </div>

                  <div class="col-md-2">
                      <p class="fw-bold fs-5 mb-0">Product </p>
                      <p class="fs-5">{{ $bl->product->code }}</p>
                  </div>

                  <div class="col-md-2">
                    <p class="fw-bold fs-5 mb-0">Terminal </p>
                    <p class="fs-5">{{ $bl->terminal->code ?? '--' }}</p>
                  </div>

                  <div class="col-md-2">
                    <p class="fw-bold fs-5 mb-0">Vessel </p>
                    <p class="fs-5">{{ $bl->inventory->vessel->name ?? '--' }}</p>
                  </div>

                  <div class="col-md-2">
                    <p class="fw-bold fs-5 mb-0">BL Quantity </p>
                    <p class="fs-5">{{ $bl->bl_quantity }}</p>
                  </div>

                  <div class="col-md-2">
                    <p class="fw-bold fs-5 mb-0">Landed Quantity </p>
                    <p class="fs-5">{{ number_format($bl->landed_quantity,3) }}</p>
                  </div>

                  <div class="col-md-2">
                    <p class="fw-bold fs-5 mb-0">Terminal Quantity </p>
                    <p class="fs-5">{{ number_format($bl->terminal_quantity,3) }}</p>
                  </div>

                  <div class="col-md-2">
                    <p class="fw-bold fs-5 mb-0">Index Number </p>
                    <p class="fs-5">{{ $bl->index_number }}</p>
                  </div>

                  <div class="col-md-2">
                    <p class="fw-bold fs-5 mb-0">Serial Number </p>
                    <p class="fs-5">{{ $bl->serial_number }}</p>
                  </div>

                  <div class="col-md-2">
                    <p class="fw-bold fs-5 mb-0">Provisional Price </p>
                    <p class="fs-5">{{ $bl->provisional_price }}</p>
                  </div>

                  <div class="col-md-2">
                    <p class="fw-bold fs-5 mb-0">Date </p>
                    <p class="fs-5">{{ $bl->date }}</p>
                  </div>

                  <div class="col-md-2">
                    <p class="fw-bold fs-5 mb-0">Unlifted Qty. </p>
                    <p class="fs-5">{{ number_format($bl->unlifted_qty(),3) }}</p>
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
                    @if (count($bl->contracts) > 0)
                      @foreach ($bl->contracts as $contract)
                          <tr class="clickable-row" data-href="{{ url('local-contracts/view-contract/'.$contract->contract->id) }}">
                            <td>{{ $contract->contract->code }}</td>
                            <td>{{ $contract->quantity }}</td>
                            <td>{{ $contract->contract->lifting_status() }}</td>
                          </tr>
                      @endforeach
                    @else
                        <tr>
                          <td>No Record Found!</td>
                          <td>--</td>
                          <td>--</td>
                        </tr>
                    @endif
                  </tbody>
              </table>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                <h3>Liftings</h3>
                <table class="table table-bordered table-hover border-dark">
                  <thead class="bg-secondary fw-bold">
                      <tr>
                          <th>Buyer</th>
                          <th>Product</th>
                          <th>Lifted Qty</th>
                      </tr>
                  </thead>
                  <tbody>
                    @if (count($bl->liftings) > 0)
                    @foreach ($bl->liftings as $lifting)
                        <tr>
                          <td>{{ $lifting->lifting->buyer->name ?? '--' }}</td>
                          <td>{{ $lifting->lifting->product->name ?? '--' }}</td>
                          <td>{{ number_format($lifting->quantity,3) }}</td>
                        </tr>
                    @endforeach
                  @else
                      <tr>
                        <td>No Record Found!</td>
                        <td>--</td>
                        <td>--</td>
                      </tr>
                  @endif
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
