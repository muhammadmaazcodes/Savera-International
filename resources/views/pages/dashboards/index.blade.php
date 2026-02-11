<x-default-layout>
    {{--
    <!--begin::Row-->
    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
        <!--begin::Col-->
        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
            @include('partials/widgets/cards/_widget-20')

            @include('partials/widgets/cards/_widget-7')
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
            @include('partials/widgets/cards/_widget-17')

            @include('partials/widgets/lists/_widget-26')
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xxl-6">
            @include('pages/dashboards/_contracts')
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->

    <!--begin::Row-->
    <div class="row gx-5 gx-xl-10">
        <!--begin::Col-->
        <div class="col-xxl-6 mb-5 mb-xl-10">
            @include('partials/widgets/charts/_widget-8')
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xl-6 mb-5 mb-xl-10">
            @include('partials/widgets/tables/_widget-16')
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->

    <!--begin::Row-->
    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
        <!--begin::Col-->
        <div class="col-xxl-6">
            @include('partials/widgets/cards/_widget-18')
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xl-6">
            @include('partials/widgets/charts/_widget-36')
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->

    <!--begin::Row-->
    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
        <!--begin::Col-->
        <div class="col-xl-4">
            @include('partials/widgets/charts/_widget-35')
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xl-8">
            @include('partials/widgets/tables/_widget-14')
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->

    <!--begin::Row-->
    <div class="row gx-5 gx-xl-10">
        <!--begin::Col-->
        <div class="col-xl-4">
            @include('partials/widgets/charts/_widget-31')
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xl-8">
            @include('partials/widgets/charts/_widget-24')
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
    --}}
    @php
        $note = App\Models\Note::where('status',1)->first();
    @endphp
    @if ($note)
        
    <div class="card border-0 h-md-100" data-bs-theme="light" style="background: linear-gradient(112.14deg, #00D2FF 0%, #3A7BD5 100%)"> 
        <!--begin::Body-->
        <div class="card-body"> 
            <!--begin::Row-->
            <div class="row align-items-center h-100">
                <!--begin::Col-->
                <div class="col-9 ps-xl-13">
                    <!--begin::Title-->               
                    <div class="text-white mb-6 pt-6">
                        <span class="fs-4 fw-semibold me-2 d-block lh-1 pb-2 opacity-75">Notes</span>
    
                        <span class="fs-2qx fw-bold">{{ $note->title }}</span>
                    </div>
                    <!--end::Title-->
    
                    <!--begin::Text-->
                    <p class="fw-semibold text-white fs-6 mb-8 d-block">
                        {{ $note->description }}
                    </p>
                    <!--end::Text-->
    
                    <!--begin::Items-->               
                    <div class="d-flex align-items-center flex-wrap d-grid gap-2 mb-10 mb-xl-20">
                       
                    </div>
                    <!--end::Items-->
    
                </div>
                <!--end::Col--> 
    
                <!--begin::Col-->
                <div class="col-3 pt-10">
                    <!--begin::Illustration-->
                    <div class="bgi-no-repeat bgi-size-contain bgi-position-x-end h-225px" style="background-image:url('/metronic8/demo1/assets/media/svg/illustrations/easy/5.svg">                 
                    </div>
                    <!--end::Illustration-->
                </div>
                <!--end::Col--> 
            </div>
            <!--end::Row-->         
        </div>
        <!--end::Body-->
    </div>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    swal({
    title: "{{ $note->title }} !",
    button: "Ok!",
    });
</script>
@endif
</x-default-layout>
