<x-default-layout>
    <div class="card">
        <div class="card-header pt-7">
            <!--begin::Title-->
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold text-gray-800"><img src="{{ asset('assets/media/icons/sales-view.png') }}" height="40" alt=""> Inventory Lifting</span>
            </h3>
            <!--end::Title-->

        </div>
        <div class="card-body pt-6">
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table id="data-table-simple" class="table table-row-bordered gy-5">
                    <thead>
                        <tr class="fw-semibold fs-6 text-muted">
                            <th>Buyer</th>
                            <th>Vessel</th>
                            <th>Vehicle Number</th>
                            <th><img src="{{ asset('assets/media/icons/product.png') }}" height="20" alt="">  Product</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sales as $sale)
                            <tr>
                                <td><strong>{{ $sale->buyer->name }}</strong></td>
                                <td>{{ $sale->inventory->vessel->name }}</td>
                                <td>{{ $sale->vehicle_number }}</td>
                                <td>{{ $sale->product->name }}</td>
                                <td>{{ $sale->quantity }} (Ton)</td>
                                <td><span class="badge bg-{{ ($sale->status) == 2 ? 'success' : 'secondary' }}">{{ ($sale->status) == 2 ? 'Completed' : 'Processing' }}</span></td>
                                <td>
                                    <div class="d-flex">
                                            <a href="{{ route('sales.edit',$sale->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        @if ($sale->lifting_bls != '[]')
                                            &nbsp; <a href="{{ route('sales.contract',$sale->id) }}" class="btn btn-primary btn-sm">{{ ($sale->status) == 1 ? 'Add' : '' }} Contract</a>
                                        @endif
                                </div>
                                </td>
                            </tr>
                        @endforeach
                </table>
            </div>
            <!--end::Table-->
        </div>
    </div>
</x-default-layout>