<x-default-layout>
    <div class="row">
      
      <div class="col-md-6">
          <!--begin::Toolbar-->
            <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
              
              <div id="kt_app_toolbar_container" class="">
                  <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                      <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                          Contract View
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
                            Contract View </li>
                      </ul>
                  </div>
              </div>
          </div>
          <!--end::Toolbar-->
      </div>
      <div class="col-md-6 text-end">
          <p class="mt-5 fs-4"><strong>Contract Code:</strong> {{ $contract->code }}</p>
      </div>
    
    </div>

      {{-- Start Content --}}

        <div class="card card-flush h-md-100 mb-4 border  border-dark">
          <!--begin::Body-->
          <div class="card-body pb-0 pt-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                       <div class="col-md-2">
                          <p class="fw-bold fs-5 mb-0">Businesses</p>
                          <p class="fs-5">{{ $contract->business->name }}</p>
                        </div>

                        <div class="col-md-2">
                            <p class="fw-bold fs-5 mb-0">Contract Date </p>
                            <p class="fs-5">{{ $contract->date }}</p>
                        </div>

                        <div class="col-md-2">
                          <p class="fw-bold fs-5 mb-0">Buyer </p>
                          <p class="fs-5">{{ $contract->buyer->name ?? '--' }}</p>
                        </div>

                        <div class="col-md-2">
                          <p class="fw-bold fs-5 mb-0">Product </p>
                          <p class="fs-5">{{ $contract->product->name ?? '--' }}</p>
                        </div>

                        <div class="col-md-2">
                          <p class="fw-bold fs-5 mb-0">Selling Price </p>
                          <p class="fs-5">{{ $contract->selling_price }}</p>
                        </div>

                        <div class="col-md-2">
                          <p class="fw-bold fs-5 mb-0">Contract Status </p>
                          <p class="fs-5">{{ $contract->contract_status }}</p>
                        </div>

                    </div>
                </div>

            
            </div>

          </div>
          <!--end: Card Body-->
        </div>

      <div class="row">
        
        <div class="col-lg-6">
          <div class="card card-flush h-md-100 mb-4 border border-dark">
            <div class="card-body pb-0 pt-6">
              <div class="row">
                  <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-4">
                            <p class="fw-bold fs-5 mb-0">Contract Qty.</p>
                            <p class="fs-5">{{ number_format($contract->quantity,3) }}</p>
                          </div>
                          <div class="col-md-4">
                              <p class="fw-bold fs-5 mb-0">Lifted Qty.</p>
                              <p class="fs-5">{{ number_format($contract->liftings->sum('quantity'),3) }}</p>
                          </div>
                          <div class="col-md-4">
                            <p class="fw-bold fs-5 mb-0">Unlifted Qty.</p>
                            <p class="fs-5">{{ number_format($contract->balance_qty(),3) }} </p>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
        </div>
        </div>
        
        <div class="col-lg-6">
          <div class="card card-flush h-md-100 mb-4 border  border-dark">
              <div class="card-body pb-0 pt-6">
                <div class="row">
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-4">
                            <p class="fw-bold fs-5 mb-0">Contract Amount</p>
                            <p class="fs-5">{{ number_format(($contract->selling_price * 1000 / 37.324) * $contract->quantity,2) }}</p>
                          </div>
                          <div class="col-md-4">
                              <p class="fw-bold fs-5 mb-0">Lifted Amount</p>
                              <p class="fs-5">{{ number_format(($contract->selling_price * 1000 / 37.324) * $contract->liftings->sum('quantity'),2) }}</p>
                          </div>
                          <div class="col-md-4">
                            <p class="fw-bold fs-5 mb-0">Unlifted Amount</p>
                            <p class="fs-5">{{ number_format(($contract->selling_price * 1000 / 37.324) * $contract->balance_qty(),2) }}</p>
                          </div>
                      </div>
                    </div>
                </div>
              </div>
          </div>
        </div>

      </div>


      <nav class="mt-5">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Contract</button>
          <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Vessel</button>
          <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Lifting</button>
          <button class="nav-link" id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Activity Logs</button>
        </div>
      </nav>
      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <!-- Start First Tab -->
            <div class="row">

              <div class="col-lg-6">
                <div class="card mt-3">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-12">
                          <div class="row">
                            <div class="col-md-4">
                                <p class="fw-bold fs-5 mb-0">Rate</p>
                                <p class="fs-5">{{ number_format($contract->rate,3) }} <small>(PKR)</small></p>
                              </div>
                              <div class="col-md-4">
                                  <p class="fw-bold fs-5 mb-0">FX Rate</p>
                                  <p class="fs-5">{{ number_format($contract->fx_rate,3) }} <small>(PKR)</small></p>
                              </div>
                              <div class="col-md-4">
                                <p class="fw-bold fs-5 mb-0">Final Price</p>
                                <p class="fs-5"><small>$</small> {{ number_format($contract->final_price,3) }}</p>
                              </div>
                              <div class="col-md-12">
                                <p class="fw-bold fs-5 mb-0 text-start">Payment Terms</p>
                                <p class="fs-5 text-start">{{ $contract->payment_terms->name ?? '--' }}</p>
                              </div>
                              <div class="col-md-12">
                                <p class="fw-bold fs-5 mb-0 text-start">Remarks</p>
                                <p class="fs-5 text-start">{{ $contract->remarks }}</p>
                              </div>
                          </div>
                      </div>
                  </div>
                  </div>
                </div>
              </div>
              
              <div class="col-lg-6">
                  <table class="table border border-dark mt-3">
                      <thead>
                        <tr class="border border-dark">
                          <th style="padding-left: 10px;">Date</th>
                          <th>Message</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($contract->messages as $message)
                        <tr class="border border-dark">
                          <td style="padding-left: 10px;">{{ $message->created_at->format('d-m-y') }}</td>
                          <td>
                            {!! $message->message !!}
                          </td>
                        </tr>  
                        @endforeach
                      </tbody>
                  </table>
              </div>
      
            </div>
            <!-- End First Tab -->
        </div>

        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
          <table class="table border border-dark mt-3">
            <thead>
              <tr class="border border-dark">
                <th style="padding-left: 10px;">Contract#</th>
                <th>Vessel</th>
                <th>Product</th>
                <th>Voyage</th>
                <th>Allocated Qty.</th>
                <th>Lifted Qty.</th>
                <th>Balance Qty.</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($contract->allocations as $allocation)
              <tr class="border border-dark">
                <td style="padding-left: 10px;">{{ $allocation->contract_number }}</td>
                <td>{{ $allocation->inventory->vessel->name ?? 'N/A' }}</td>
                <td>{{ $allocation->contract->product->name ?? 'N/A' }}</td>
                <td>{{ $allocation->inventory->voyage_number }}</td>
                <td>{{ $allocation->quantity }}</td>
                <td>{{ $allocation->lifted_qty() }}</td>
                <td>{{ $allocation->unlifted_qty() }}</td>
              </tr>  
              @endforeach
            </tbody>
        </table>
        </div>

        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">

          <table class="table border border-dark mt-3">
            <thead>
              <tr class="border border-dark">
                <th style="padding-left: 10px;">Vessel</th>
                <th>Product</th>
                <th>Terminal</th>
                <th>Vehicle</th>
                <th>Allocated Qty.</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($contract->liftings as $lifting)
              <tr class="border border-dark">
                <td style="padding-left: 10px;">{{ $lifting->sales->inventory->vessel->name ?? '--' }}</td>
                <td>{{ $lifting->sales->product->code }}</td>
                <td>{{ $lifting->sales->terminal->code }}</td>
                <td>{{ $lifting->sales->vehicle_number }}</td>
                <td>{{ $lifting->sales->quantity }}</td>
              </tr>  
              @endforeach
            </tbody>
        </table>

        </div>

        <div class="tab-pane fade" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">

          <table class="table border border-dark mt-3" id="ActivityTable">
            <thead>
              <tr class="border border-dark">
                <th style="padding-left: 10px;">Date</th>
                <th style="padding-left: 10px;">Timestamp</th>
                <th>Action</th>
                <th>User</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($activities as $log)
              <tr class="border border-dark">
                <td style="padding-left: 10px;">{{ $log->created_at->format('d-m-y') }}</td>
                <td style="padding-left: 10px;">{{ $log->created_at }}</td>
                <td>{{ $log->description }}</td>
                <td>{{ $log->username }}</td>
              </tr>
            @endforeach
            </tbody>
        </table>

        </div>

      </div>


      {{-- End Content --}}

@push('scripts')
    <script>
      $('#ActivityTable').DataTable();
    </script>
@endpush
</x-default-layout>
