<x-default-layout>
	<!--begin::Table widget 14-->
  <div class="row">
    <div class="col-lg-9">
      <div class="card card-flush h-md-100">
        <!--begin::Header-->
        <div class="card-header pt-7">
          <!--begin::Title-->
          <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold text-gray-800">Mail Box</span>
          </h3>
          <!--end::Title-->
        </div>
        <!--end::Header-->
        <!--begin::Body-->
              <div class="card-body pt-6">
                  <!--begin::Table container-->
                  <div class="table-responsive">
                    <!--begin::Table-->
                    <table id="" class="table table-row-bordered gy-5">
                        <thead>
                            <tr class="fw-semibold fs-6 text-muted">
                                <th>From</th>
                                <th>Subject</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($messages as $key => $message)
                            @php
                                $assigned_con = \App\Models\MailContract::where('mail_id',$message->getUid())->first();
                                $assigned_inv = \App\Models\MailInventory::where('mail_id',$message->getUid())->first();
                            @endphp
                            <tr>
                                <td>{{ $message->getFrom()[0]->mail }}</td>
                                <td>{{ $message->getSubject() }}</td>
                                <td>{{ $message->date }}</td>
                                <td>
                                  <div class="d-flex">
                                    <a href="{{ route('mail.show',$message->getUid()) }}" class="btn btn-primary btn-sm mx-1">Show</a>
                                    <button {{ ($assigned_con || $assigned_inv) ? 'disabled' : '' }} type="button" class="btn btn-primary btn-sm assign-to-btn" data-id="{{ $message->getUid() }}">Assign To</button>
                                  </div>
                                </td>
                            </tr>
                          @endforeach
                    </table>
                  </div>
                  <!--end::Table-->

              </div>

      </div>
  </div>
  <div class="col-lg-3">
    <div class="card">
      <h4 class="m-3">Attachments</h4>
      @foreach ($messages as $message)
        @foreach ($message->getAttachments() as $attachment)
      <div class="card-body d-flex justify-content-center text-center flex-column p-3">
        <div class="border border-dark">
        <span class="text-start"><strong>From :</strong> maazshahid050@gmail.com</span>  
          <div class="symbol symbol-60px mb-5">
                <img src="{{ asset('assets/media/icons/file-icon.png') }}" class="theme-light-show" alt=""/>
                    <img src="{{ asset('assets/media/icons/file-icon.png') }}" class="theme-dark-show" alt=""/>                          
            </div>
            <div class="fs-5 mb-2">
              {{ Str::limit($attachment->getName(),20) }}
            </div>
          </div>
    </div>
      @endforeach
    @endforeach
    
  </div>
    
  </div>

</div>
	<!--end: Card Body-->
</div>
<!--end::Table widget 14-->

{{-- Mail Assign To Modal --}}
<!-- Contract Modal -->
<button type="button" class="btn btn-primary d-none contract-modal-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Contract
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
    <form action="javascript:void(0)">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Assign Contract to this</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div>
            <label class="form-label">Local Contracts</label>
            <select name="contract_id" id="" class="form-control" required>
                <option>-- Select --</option>
                @foreach ($contracts as $contract)
                    <option value="{{ $contract->id }}">{{ $contract->code }}</option>
                @endforeach
            </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary submit-contract">Submit</button>
      </div>
    </form>
    </div>
  </div>
</div>


<!-- Inventory Modal -->
<button type="button" class="btn btn-primary d-none inventory-modal-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
  Inventory
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="javascript:void(0)">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel2">Assign Contract to this</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div>
          <label class="form-label">Inventories</label>
          <select name="inventory_id" id="" class="form-control" required>
              <option>-- Select --</option>
              @foreach ($inventories as $inventory)
                  <option value="{{ $inventory->id }}">{{ $inventory->vessel->name }}</option>
              @endforeach
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary submit-inventory">Submit</button>
      </div>
    </form>
    </div>
  </div>
</div>
{{-- End Mail Assign to Modal --}}


@push('scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
      $(document).on("click",".assign-to-btn", function () {
        var mail_id = $(this).attr('data-id');

        swal("To whom you want to assign this mail ?", {
        buttons: {
          catch: {
            text: "Inventory",
            value: "catch",
          },
          contract: true,
        },
      })
      .then((value) => {
        switch (value) {
      
          case "contract":
            $('.contract-modal-btn').trigger('click');
            $('select[name="contract_id"]').attr('data-id',mail_id);
            break;
      
          case "catch":
            $('select[name="inventory_id"]').attr('data-id',mail_id);
            $('.inventory-modal-btn').trigger('click');
            break;
      
        }
      });

});
    </script>
    <script>
      $(document).on("click",".submit-contract", function () {
        var contract_id = $('select[name="contract_id"]').val();
        var mail_id = $('select[name="contract_id"]').attr('data-id');
        var btn = $(`button.assign-to-btn[data-id=${mail_id}]`).prop('disabled',true);
        
        $.ajax({
           type:'GET',
           url:"{{ route('mail.assign_to') }}",
           data:{
            contract_id:contract_id,
            mail_id:mail_id
          },
           success:function(data){
              $('.close').trigger('click');
           }
        });


    });
    </script>

<script>
  $(document).on("click",".submit-inventory", function () {
    var inventory_id = $('select[name="inventory_id"]').val();
    var mail_id = $('select[name="inventory_id"]').attr('data-id');
    var btn = $(`button.assign-to-btn[data-id=${mail_id}]`).prop('disabled',true);
    
    $.ajax({
       type:'GET',
       url:"{{ route('mail.assign_to') }}",
       data:{
        inventory_id:inventory_id,
        mail_id:mail_id
      },
       success:function(data){
          $('.close').trigger('click');
       }
    });


});
</script>
@endpush
</x-default-layout>