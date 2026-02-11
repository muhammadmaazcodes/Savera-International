<x-default-layout>
  <div id="kt_app_toolbar_container" class="my-5 container-xxl d-flex flex-stack ">
    <!--begin::Page title-->
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
       <!--begin::Title-->
       <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
          Configurations
       </h1>
       <!--end::Title-->
       <!--begin::Breadcrumb-->
       <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
          <!--begin::Item-->
          <li class="breadcrumb-item text-muted">
             <a href="/" class="text-muted text-hover-primary">
             Dashboard</a>
          </li>
          <!--end::Item-->
          <!--begin::Item-->
          <li class="breadcrumb-item">
             <span class="bullet bg-gray-500 w-5px h-2px"></span>
          </li>
          <!--end::Item-->
          <!--begin::Item-->
          <li class="breadcrumb-item text-muted">
            <a href="/cost-calculator" class="text-muted text-hover-primary">
            Cost Calculator</a>
         </li>
         <!--end::Item-->
         <!--begin::Item-->
         <li class="breadcrumb-item">
          <span class="bullet bg-gray-500 w-5px h-2px"></span>
       </li>
       <!--end::Item-->
         <!--begin::Item-->
         <li class="breadcrumb-item text-muted">
          Configurations
       </li>
       <!--end::Item-->
       </ul>
       <!--end::Breadcrumb-->
    </div>
    <!--end::Page title-->
    <!--begin::Actions-->
  <div class="d-flex align-items-center gap-2 gap-lg-3">
    <!--begin::Filter menu-->
    <div class="m-0">
       <!--begin::Menu toggle-->
       <a href="/cost-calculator" class="btn btn-sm btn-flex btn-secondary fw-bold">               
       Back to Cost Calculator
       </a>
       <!--end::Menu toggle-->        
    </div>
    <!--end::Filter menu-->
    <!--begin::Secondary button-->
    <!--end::Secondary button-->
 </div>
 <!--end::Actions-->
  </div>


	<!--begin::Table widget 14-->
<div class="card card-flush h-md-100">
	<!--begin::Body-->
	<div class="card-body pt-6">
    <form action="{{ url('/options/update') }}" method="post">
      @csrf
      @method('PUT')	
			<div class="row">
        <div class="col-md-4 mb-3">
          <label for="" class="form-label">M.M.Charges</label>
          <div class="input-group mb-3">
              <span class="input-group-text">USD/PMT</span>
              <input type="text" class="form-control form-control-sm float" value="{{ $values['cc_mm_charges'] }}" placeholder="M.M.Charges XX.XX" name="cc_mm_charges" />
            </div>
				</div>

        <div class="col-md-4 mb-3">
          <label for="" class="form-label">Collector of Customs (PALM OLEIN)</label>          
            <div class="input-group mb-3">
              <span class="input-group-text">PKR/MT</span>
              <input type="text" class="form-control form-control-sm float" placeholder="Collector of Customs XXXX.XX" value="{{ $values['collector_of_customs_palm_oil'] }}" name="collector_of_customs" />
            </div>
				</div>

        <div class="col-md-4 mb-3">
          <label for="" class="form-label">Collector of Customs (RBD-PALM OIL)</label>          
            <div class="input-group mb-3">
              <span class="input-group-text">PKR/MT</span>
              <input type="text" class="form-control form-control-sm float" placeholder="Collector of Customs XXXX.XX" value="{{ $values['collector_of_customs_rbd_olein'] }}" name="collector_of_customs" />
            </div>
				</div>

        <div class="col-md-4 mb-3">
          <label for="" class="form-label">COC PQA</label>
            <div class="input-group mb-3">
              <input type="text" class="form-control form-control-sm float" placeholder="COC PQA XX.XX" value="{{ $values['coc_pqa'] }}" name="coc_pqa" />
              <span class="input-group-text">%</span>
            </div>
				</div>

        <div class="col-md-4 mb-3">
          <label for="" class="form-label">PQA / MT</label>
            <div class="input-group mb-3">
              <span class="input-group-text">PKR PMT</span>
              <input type="text" class="form-control form-control-sm float" placeholder="PQA / MT XX.XX" value="{{ $values['cc_pqa'] }}" name="cc_pqa" />
            </div>
				</div>

        <div class="col-md-4 mb-3">
          <label for="" class="form-label">E&T (PQA)</label>
            <div class="input-group mb-3">
              <input type="text" class="form-control form-control-sm float" placeholder="E&T (PQA) X.XX" value="{{ $values['cc_e_and_t'] }}" name="cc_e_and_t" />
              <span class="input-group-text">%</span>
            </div>
				</div>

        <div class="col-md-4 mb-3">
          <label for="" class="form-label">Per Vessel Charges</label>
            <div class="input-group mb-3">
              <input type="text" class="form-control form-control-sm num" placeholder="Per Vessel Charges" value="{{ $values['cc_per_vessel_charges'] }}" name="cc_per_vessel_charges" />
            </div>
				</div>

        <div class="col-md-4 mb-3">
          <label for="" class="form-label">Marking</label>
              <div class="input-group mb-3">
                <input type="text" class="form-control form-control-sm float" placeholder="Marking X.XX%" value="{{ $values['cc_marking'] }}" name="cc_marking" />
                <span class="input-group-text">%</span>
              </div>
				</div>

        <div class="col-md-4 mb-3">
          <label for="" class="form-label">Storage/Handling/C.Agent</label>
            <div class="input-group mb-3">
              <input type="text" class="form-control form-control-sm num" placeholder="XXXXX.XX" value="{{ $values['cc_handling'] }}" name="cc_handling" />
            </div>
				</div>

        <div class="col-md-4 mb-3">
          <label for="" class="form-label">Insurance Charges</label>
            <div class="input-group mb-3">
              <input type="text" class="form-control form-control-sm float" placeholder="X.XX%" value="{{ $values['cc_insurance_charges'] }}" name="cc_insurance_charges" />
              <span class="input-group-text">%</span>
            </div>
				</div>

        <div class="col-md-4 mb-3">
          <label for="" class="form-label">WITHHOLDING</label>
            <div class="input-group mb-3">
              <input type="text" class="form-control form-control-sm num" placeholder="WITHHOLDING XX%" value="{{ $values['cc_withholding'] }}" name="cc_withholding" />
              <span class="input-group-text">%</span>
            </div>
				</div>
        
        <div class="col-12 text-center">
          <button type="submit" class="btn btn-primary btn-sm">Update</button>
        </div>

      </div>
    </form>
			<!--begin::Input group-->
	</div>
	<!--end: Card Body-->
</div>
<!--end::Table widget 14-->
@push('scripts')
  @if (Session::has('error'))
    <script>
        swal("{{ Session::get('error') }}","","warning")
    </script>
  @elseif(Session::has('success'))
  <script>
      swal("{{ Session::get('success') }}","","success")
  </script>
  @endif
  <script>
      $(document).on('keyup','.float', function() {
        setTimeout(() => {
            var inputValue = $(this).val();
          if (inputValue != '') {
              
              if (!isNaN(parseFloat(inputValue)) && parseFloat(inputValue) % 1 !== 0) {
                $(this).removeClass('border-danger');
              }
              else {
                $(this).addClass('border-danger');
                alert('Invalid input! Please enter a valid float.');
                $(this).val('');
              }
              
              
          }
        }, 2000);
      });
  </script>

<script>
  $(document).on('keyup','.num', function() {
    setTimeout(() => {
        var inputValue = $(this).val();
      if (inputValue != '') {
          
          if (!$.isNumeric(inputValue)) {
              $(this).addClass('border-danger');
              alert('Invalid input! Please enter a valid number.');
              $(this).val('');
          }
          else {
            $(this).removeClass('border-danger');
          }
          
          
      }
    }, 2000);
  });
</script>
@endpush
</x-default-layout>