<x-default-layout>
	<!--begin::Table widget 14-->
<div class="card card-flush h-md-100">
	<!--begin::Header-->
	<div class="card-header pt-7">
		<!--begin::Title-->
		<h3 class="card-title align-items-start flex-column">
			<span class="card-label fw-bold text-gray-800">Subject : {{ $message->getSubject() }}</span>
		</h3> 
		<!--end::Title-->
	</div>
	<!--end::Header-->
	<!--begin::Body-->
	<div class="card-body pt-6">
			<div class="row">
				<div class="col-md-8">
					<p><strong>From : &nbsp;</strong>{{ $message->getFrom()[0]->mail }}</p>
				</div>
				<div class="col-md-8">
          <p><strong>Date : &nbsp;</strong>{{ $message->date }}</p>
        </div>
				<div class="col-md-8">
          <p><strong>Message :-</strong></p>
          {!! $message->getHTMLBody() !!}
			</div>
			@if ($message->getAttachments())
				<div class="col-md-8">
						<p><strong>Attachments :-</strong></p>
					@foreach ($message->getAttachments() as $attachment)
							<div class="mail-attachmemt border border-3 p-4 mb-2">
									<div class="d-flex">
										<i style="font-size: 2rem;" class="fas fa-file-pdf fa-2xl"></i>
										<p>{{ $attachment->getName() }}</p>
									</div>
							</div>
          @endforeach 
				</div>
			@endif
    </div>
			<!--begin::Input group-->
	</div>
	<!--end: Card Body-->
</div>
<!--end::Table widget 14-->
</x-default-layout>