<x-default-layout>
	<!--begin::Table widget 14-->
<div class="card card-flush h-md-100">
	<!--begin::Header-->
	<div class="card-header pt-7">
		<!--begin::Title-->
		<h3 class="card-title align-items-start flex-column">
			<span class="card-label fw-bold text-gray-800">Add New Role</span>
		</h3>
		<!--end::Title-->
	</div>
	<!--end::Header-->
@if (count($errors) > 0)
<div class="alert alert-danger">
  <strong>Whoops!</strong> There were some problems with your input.<br><br>
  <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
  </ul>
</div>
@endif
	<!--begin::Body-->
	<div class="card-body pt-6">
		<form class="pt-1" method="POST" action="{{ route('roles.store') }}">
			@csrf
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-8">
							<input type="text" class="form-control form-control-lg mb-4" placeholder="Name" name="name" value="" />
						</div>
                        
                        <div class="col-md-8">
                            <label for="" class="form-label fw-bold">Permissions :</label><br>
                        @foreach($permission as $value)
                            <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                            {{ $value->name }}</label>
                            <br/>
                        @endforeach
                        </div>

					</div>
				</div>
				<div class="text-end">
					<button type="submit" class="btn btn-light fw-bold btn-primary me-2">Add</button>
				</div>
			</div>
		</form>
	</div>
	<!--end: Card Body-->
</div>
<!--end::Table widget 14-->
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
  $(document).ready(function() {
      $(".roles").select2({
              multiple: true,
          });
  });
  </script>

@endpush
</x-default-layout>