<x-default-layout>
	<!--begin::Table widget 14-->
<div class="card card-flush h-md-100">
	<!--begin::Header-->
	<div class="card-header pt-7">
		<!--begin::Title-->
		<h3 class="card-title align-items-start flex-column">
			<span class="card-label fw-bold text-gray-800">Edit Note</span>
		</h3>
		<!--end::Title-->
	</div>
	<!--end::Header-->
	<!--begin::Body-->
	<div class="card-body pt-6">
		<form class="pt-1" method="POST" action="{{ route('notes.update',$note->id) }}">
			@csrf
            @method('PUT')
			<div class="row">
				<div class="col-md-12">
                    <label class="form-label" for="">Title</label>
					<input type="text" class="form-control form-control-sm form-control-solid" placeholder="Enter Title" name="title" value="{{ $note->title }}" />
				</div>
				<div class="col-md-12 mt-4">
                    <label class="form-label" for="">Description</label>
					<textarea name="description" class="form-control" id="" cols="30" rows="10">{{ $note->description }}</textarea>
				</div>
				<div class="col-md-4 mt-4">
					<button type="submit" class="btn btn-sm btn-light fw-bold btn-primary me-2" data-kt-search-element="advanced-options-form-cancel">Update</button>
				</div>
			</div>
			<!--begin::Input group-->
		</form>
	</div>
	<!--end: Card Body-->
</div>
<!--end::Table widget 14-->
</x-default-layout>