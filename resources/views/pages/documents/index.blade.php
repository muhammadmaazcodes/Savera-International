<x-default-layout>
<div class="row">
	<p class="h3 bg-white p-3 rounded">Documents</p>
	@foreach ($documents as $document)
		<div class="col-md-2 mb-3">
			<div class="card">
				<div class="card-body">
					<i style="font-size: 2.5rem;" class="fas fa-file-pdf fa-2xl"></i>
					<a href="{{ asset('documents/'.$document->document) }}">{{ Str::limit($document->document,5) }}</a>
				</div>
			</div>
		</div>
	@endforeach
</div>
</x-default-layout>