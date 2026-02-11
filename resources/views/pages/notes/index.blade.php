<x-default-layout>
	<!--begin::Table widget 14-->
<div class="card card-flush h-md-100">
	<!--begin::Header-->
	<div class="card-header pt-7">
		<!--begin::Title-->
		<h3 class="card-title align-items-start flex-column">
			<span class="card-label fw-bold text-gray-800">Notes</span>
		</h3>
		<!--end::Title-->
		<!--begin::Toolbar-->
		<div class="card-toolbar">
			<a href="/notes/create" class="btn btn-sm btn-secondary">Add New</a>
		</div>
		<!--end::Toolbar-->
	</div>
	<!--end::Header-->
	<!--begin::Body-->
	<div class="card-body pt-6">
		<!--begin::Table container-->
		<div class="table-responsive">
			<!--begin::Table-->
			<table id="data-table-simple" class="table table-row-bordered gy-5">
			    <thead>
			        <tr class="fw-semibold fs-6 text-muted">
			            <th>Title</th>
			            <th>Description</th>
                        <th>Status</th>
			            <th>Edit</th>
			        </tr>
			    </thead>
			    <tbody>
			    	@foreach($notes as $note)
			        <tr>
			            <td>{{ $note->title }}</td>
			            <td>{{ Str::limit($note->description,40) }}</td>
                        <td>
                            <div class="form-check form-check-solid form-check-custom form-switch">
                                <input class="form-check-input w-45px h-30px status" id="status" data-route="{{ route('notes.status-update',$note->id) }}" name="status" {{ ($note->status) == 1 ? 'checked' : '' }} type="checkbox" value="{{ $note->status }}" id="googleswitch">
                            </div>
                        </td>
			            <td><a href="/notes/{{ $note->id }}/edit" class="btn btn-sm btn-primary align-self-center">Edit</a></td>
			        </tr>
			        @endforeach
			</table>
		</div>
		<!--end::Table-->
	</div>
	<!--end: Card Body-->
</div>
<!--end::Table widget 14-->
@push('scripts')
    <script>
        $(document).on("click",".status",function(){
            var route = $(this).attr('data-route');
            var status = $(this).val();
        $('.status').attr('checked',false);
        $(this).attr('checked',true);

        $.ajax({
            type:'GET',
            url: route,
            data:{
                status:status,
            },
            success:function(data){
                // alert(data.success);
            }
        });
});
    </script>
@endpush
</x-default-layout>