<x-default-layout>
  <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

    <div id="kt_app_toolbar_container">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
            <h1
                class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                Payment View-Customer
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
                  View-Customer </li>
            </ul>
        </div>
    </div>
</div>

  <div class="card">

        <div class="card-header border-0 pt-6">
          <ul class="nav nav-pills mb-2">
            <li class="nav-item">
              <a class="nav-link" href="/custom-payments/posting-date">Posting Date</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/custom-payments/vessel">Vessel</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/custom-payments/customer">Customer</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/custom-payments/transaction">All Trans.</a>
            </li>
          </ul>
      <div class="card-toolbar">
        <p>
          <strong>Total:</strong> 250
        </p>
        <p class="mx-4">
          <strong>Verified:</strong> 100
        </p>
        <p>
          <strong>Unverified:</strong> 150
        </p>
      </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            
          <!--begin::Table-->
            <table class="table align-middle table-row-bordered table-hover fs-6 gy-5"
            id="kt_datatable_example">
            <thead>
                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                    <th class="w-10px pe-2" hidden>
                        <div
                            class="form-check form-check-sm form-check-custom form-check-solid me-3">
                            <input class="form-check-input" type="checkbox"
                                data-kt-check="true"
                                data-kt-check-target="#kt_customers_table .form-check-input"
                                value="1" />
                        </div>
                    </th>
                    <th class="min-w-125px">Customer</th>
                    <th class="min-w-125px">Verfied <small>Transaction</small></th>
                    <th class="min-w-125px">Unverfied <small>Transaction</small></th>
                    <th class="min-w-125px">Verfied <small>Amount</small></th>
                    <th class="min-w-125px">Unverfied <small>Amount</small></th>
                </tr>
            </thead>
            <tbody class="fw-semibold text-gray-600">
              @foreach ($payments as $customer => $payment)
                <tr>
                  <td>{{ $customer }}</td>
                  <td>{{ $payment->where('status','Verified')->count() }}</td>
                  <td>{{ $payment->where('status','Unverified')->count() }}</td>
                  <td>{{ number_format($payment->where('status','Verified')->sum('amount'),2) }}</td>
                  <td>{{ number_format($payment->where('status','Unverified')->sum('amount'),2) }}</td>
                </tr>
              @endforeach
            </tbody>
            <!--end::Table body-->
        </table>
        <!--end::Table-->

        </div>

    </div>
  </div>

</x-default-layout>