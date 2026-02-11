<x-default-layout>
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

      <!--begin::Toolbar container-->
      <div id="kt_app_toolbar_container" class="">

          <!--begin::Page title-->
          <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
              <!--begin::Title-->
              <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                  View Inventory
              </h1>
              <!--end::Title-->


              <!--begin::Breadcrumb-->
              <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                  <!--begin::Item-->
                  <li class="breadcrumb-item text-muted">
                      <a href="/" class="text-muted text-hover-primary">
                          Dashboard </a>
                  </li>
                  <!--end::Item-->
                  <!--begin::Item-->
                  <li class="breadcrumb-item">
                      <span class="bullet bg-gray-400 w-5px h-2px"></span>
                  </li>
                  <!--end::Item-->

                  <!--begin::Item-->
                  <li class="breadcrumb-item text-muted">
                      View Inventory </li>
                  <!--end::Item-->

              </ul>
              <!--end::Breadcrumb-->
          </div>
          <!--end::Page title-->

      </div>
      <!--end::Toolbar container-->
  </div>
  <!--end::Toolbar-->

<!--begin::Table widget 14-->
<div class="card card-flush h-md-100">
    <!--begin::Body-->
    <div class="card-body pt-6">
            <div class="row">

                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3">
                            <p class="fw-bold fs-4 mb-0">Inventory Type :</p>
                            <p class="fs-5">{{ $inventory->type }}</p>
                        </div>

                        <div class="col-md-3">
                          <p class="fw-bold fs-4 mb-0">Transaction Type :</p>
                          <p class="fs-5">{{ $inventory->transaction_type }}</p>
                        </div>

                        <div class="col-md-3">
                          <p class="fw-bold fs-4 mb-0">Seller :</p>
                          <p class="fs-5">{{ $inventory->seller->name ?? 'N/A' }}</p>
                        </div>

                        <div class="col-md-3">
                          <p class="fw-bold fs-4 mb-0">Buyer :</p>
                          <p class="fs-5">{{ $inventory->buyer->name ?? 'N/A' }}</p>
                        </div>

                        <div class="col-md-3">
                          <p class="fw-bold fs-4 mb-0">Vessel :</p>
                          <p class="fs-5">{{ $inventory->vessel->name ?? 'N/A' }}</p>
                        </div>

                        @if ($inventory->type == 'Import')
                        <div class="col-md-3">
                          <p class="fw-bold fs-4 mb-0">Voyage Number :</p>
                          <p class="fs-5">{{ $inventory->voyage_number ?? 'N/A' }}</p>
                        </div>

                        <div class="col-md-3">
                          <p class="fw-bold fs-4 mb-0">IGM Date :</p>
                          <p class="fs-5">{{ $inventory->igm_date ?? 'N/A' }}</p>
                        </div>

                        <div class="col-md-3">
                          <p class="fw-bold fs-4 mb-0">Arrival Date :</p>
                          <p class="fs-5">{{ $inventory->arrival_date ?? 'N/A' }}</p>
                        </div>
                        @endif

                        <div class="col-md-3">
                          <p class="fw-bold fs-4 mb-0">Clearing Agent :</p>
                          <p class="fs-5">{{ $inventory->clearing_agent->name ?? 'N/A' }}</p>
                        </div>

                        <div class="col-md-3">
                          <p class="fw-bold fs-4 mb-0">Surveyor :</p>
                          <p class="fs-5">{{ $inventory->surveyor->name ?? 'N/A' }}</p>
                        </div>

                        <div class="col-md-3">
                          <p class="fw-bold fs-4 mb-0">Active for Contract ? :</p>
                          <p class="fs-5">{{ $inventory->active_contract == 1 ? 'Yes' : 'No'  }}</p>
                        </div>

                        <div class="col-md-3">
                          <p class="fw-bold fs-4 mb-0">Contract Date :</p>
                          <p class="fs-5">{{ $inventory->contract_date ?? 'N/A' }}</p>
                        </div>

                        <div class="col-md-3">
                          <p class="fw-bold fs-4 mb-0">Remarks :</p>
                          <p class="fs-5">{{ $inventory->remarks ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6 my-3">
                          <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#Attachments">{{ $documents_count }} Files Attached</button>
                        </div>

                    </div>
                </div>

            {{-- Start Attachment Modal --}}
            <div class="modal fade modal-lg" id="Attachments" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                  <div class="modal-content">
                    <div class="modal-header bg-primary pt-5 pb-5">
                      <h5 class="modal-title text-white fs-2" id="exampleModalLabel">Attachments</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
              
                        <div class="row justify-content-center align-items-center">

                          <div class="row">
                  
                            <div class="col-md-4">
                                <!--begin::Card-->
                                <div class="card h-100 ">
                                    <!--begin::Card body-->
                                    @if ($doc_summary)
                                    <a href="{{ route('document.delete',$doc_summary->id) }}"><button class="btn btn-sm btn-light-danger mx-5 mt-3 mt-md-8">Delete</button></a>
                                    @endif
                                    <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                        <!--begin::Name-->
                                        @if ($doc_summary)
                                        <a href="{{ asset('documents/'.$doc_summary->type.'/'.$doc_summary->document) }}" target="_blank" class="text-gray-800 text-hover-primary d-flex flex-column">
                                            <!--begin::Image-->
                                            <div class="symbol symbol-60px mb-5">
                                                <img src="{{ asset('assets/media/icons/file-icon.png') }}" class="theme-light-show" alt=""/>
                                                    <img src="{{ asset('assets/media/icons/file-icon.png') }}" class="theme-dark-show" alt=""/>                          
                                            </div>
                                            <!--end::Image-->
        
                                            <!--begin::Title-->
                                            <div class="fs-5 fw-bold mb-2">{{ Str::limit($doc_summary->document,20) }}</div>
                                            <!--end::Title-->
                                        </a>
                                        @endif
                                        <!--end::Name-->
        
                                        <!--begin::Description-->
                                        <div class="fs-7 fw-semibold text-dark-400">Summary</div>
                                        @if(!$doc_summary)
                                        <form action="{{ route('add.inventory.document') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="file"  accept="application/pdf, image/png, image/jpg, image/jpeg" name="file" class="form-control" required>
                                        <input type="hidden" name="file_type" value="summary">
                                        <input type="hidden" name="inventory_id" value="{{ $inventory->id }}">
                                        <button type="submit" class="btn btn-primary btn-sm mt-3">Add</button>
                                    </form>
                                        @endif
                                        <!--end::Description-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card-->
                            </div>
                            <!--end::Col-->
                            
                            <div class="col-md-4">
                                <!--begin::Card-->
                                <div class="card h-100 ">
                                    <!--begin::Card body-->
                                    @if ($doc_pro_data)
                                    <a href="{{ route('document.delete',$doc_pro_data->id) }}"><button class="btn btn-sm btn-light-danger mx-5 mt-3 mt-md-8">Delete</button></a>
                                    @endif
                                    <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                        <!--begin::Name-->
                                        @if ($doc_pro_data)
                                        <a href="{{ asset('documents/'.$doc_pro_data->type.'/'.$doc_pro_data->document) }}" target="_blank" class="text-gray-800 text-hover-primary d-flex flex-column">
                                            <!--begin::Image-->
                                            <div class="symbol symbol-60px mb-5">
                                                <img src="{{ asset('assets/media/icons/file-icon.png') }}" class="theme-light-show" alt=""/>
                                                    <img src="{{ asset('assets/media/icons/file-icon.png') }}" class="theme-dark-show" alt=""/>                          
                                            </div>
                                            <!--end::Image-->
        
                                            <!--begin::Title-->
                                            <div class="fs-5 fw-bold mb-2">{{ Str::limit($doc_pro_data->document,20) }}</div>
                                            <!--end::Title-->
                                        </a>
                                        @endif
                                        <!--end::Name-->
        
                                        <!--begin::Description-->
                                        <div class="fs-7 fw-semibold text-dark-400">Pro Data</div>
                                        @if(!$doc_pro_data)
                                        <form action="{{ route('add.inventory.document') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="file"  accept="application/pdf, image/png, image/jpg, image/jpeg" name="file" class="form-control" required>
                                            <input type="hidden" name="file_type" value="pro_data">
                                            <input type="hidden" name="inventory_id" value="{{ $inventory->id }}">
                                            <button type="submit" class="btn btn-primary btn-sm w-100 mt-3">Add</button>
                                        </form>
                                        @endif
                                        <!--end::Description-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card-->
                            </div>
                            <!--end::Col-->
        
        
                            <div class="col-md-4">
                                <!--begin::Card-->
                                <div class="card h-100 ">
                                    <!--begin::Card body-->
                                    @if ($doc_survey_report)
                                    <a href="{{ route('document.delete',$doc_survey_report->id) }}"><button class="btn btn-sm btn-light-danger mx-5 mt-3 mt-md-8">Delete</button></a>
                                    @endif
                                    <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                        <!--begin::Name-->
                                        @if ($doc_survey_report)
                                        <a href="{{ asset('documents/'.$doc_survey_report->type.'/'.$doc_survey_report->document) }}" target="_blank" class="text-gray-800 text-hover-primary d-flex flex-column">
                                            <!--begin::Image-->
                                            <div class="symbol symbol-60px mb-5">
                                                <img src="{{ asset('assets/media/icons/file-icon.png') }}" class="theme-light-show" alt=""/>
                                                    <img src="{{ asset('assets/media/icons/file-icon.png') }}" class="theme-dark-show" alt=""/>                          
                                            </div>
                                            <!--end::Image-->
        
                                            <!--begin::Title-->
                                            <div class="fs-5 fw-bold mb-2">{{ Str::limit($doc_survey_report->document,20) }}</div>
                                            <!--end::Title-->
                                        </a>
                                        @endif
                                        <!--end::Name-->
        
                                        <!--begin::Description-->
                                        <div class="fs-7 fw-semibold text-dark-400">Survey Report</div>
                                        @if(!$doc_survey_report)
                                        <form action="{{ route('add.inventory.document') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="file"  accept="application/pdf, image/png, image/jpg, image/jpeg" name="file" class="form-control" required>
                                            <input type="hidden" name="file_type" value="survey_report">
                                            <input type="hidden" name="inventory_id" value="{{ $inventory->id }}">
                                            <button type="submit" class="btn btn-primary btn-sm w-100 mt-3">Add</button>
                                        </form>
                                        @endif
                                        <!--end::Description-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card-->
                            </div>
                            <!--end::Col-->
                        </div>
              
                        </div>
              
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" id="add-close-btn" data-bs-dismiss="modal">Close</button>
                    </div>
                  
                  </div>
                </div>
              </div>
            {{-- End Attachmemt Modal --}}
            </div>

          </div>
          <!--end: Card Body-->
      </div>
      <!--end::Table widget 14-->

      <!--begin::Table widget 14-->
  <div class="card card-flush mt-5 h-md-100">
      <!--begin::Body-->
      <div class="card-body pt-6">
          <div class="row">
              <div class="col-lg-6">


          </div>

          <div class="col-lg-6 pt-4 border-secondary border-start border-3">
              {{--  --}}
          </div>


      </div>

      </div>
      <!--end: Card Body-->
  </div>
  <!--end::Table widget 14-->
  {!! theme()->addVendor('formrepeater') !!}


  <div id="mydiv"></div>

    
  @push('scripts')
  <script type="text/babel">
    const { useState } = React;

    function Hello() {
        const [formData, setFormData] = useState({
            product: '',
            terminal: '',
            date: '',
            bl_number: '',
            index_number: '',
            bl_quantity: '',
            landed_quantity: '',
            terminal_quantity: '',
            shortage: '',
            shortage_percentage: '',
            provisional_price: '',
            status: '',
            shortage_percentage: '',
        });

  const [tableData, setTableData] = useState([]);

  const handleSubmit = (e) => {
    e.preventDefault();


    setTableData([...tableData, formData]);

    setFormData({
            product: '',
            terminal: '',
            date: '',
            bl_number: '',
            index_number: '',
            bl_quantity: '',
            landed_quantity: '',
            terminal_quantity: '',
            shortage: '',
            shortage_percentage: '',
            provisional_price: '',
            status: '',
            shortage_percentage: '',
    });
  };

    return (
      
      <div className="row">
        <div className="col-6">


    <form onSubmit={handleSubmit}>
        <div className="row">
            <div className="col-6 mb-3">
              <label htmlFor="name" className="form-label">Product</label>
              <select onChange={(e) => setFormData({ ...formData, product: e.target.value })} className="form-select">
                <option selected value="">-- Select --</option>
                @foreach($products as $product)
                <option>{{ $product->name }}</option>
                @endforeach
                </select>
            </div>
            <div className="col-6 mb-3">
            <label htmlFor="name" className="form-label">Terminal</label>
              <select onChange={(e) => setFormData({ ...formData, terminal: e.target.value })} className="form-select">
                <option selected value="">-- Select --</option>
                @foreach($terminals as $terminal)
                <option>{{ $terminal->name }}</option>
                @endforeach
              </select>
        </div>

        <div className="col-6 mb-3">
            <label htmlFor="name" className="form-label">Date</label>
              <input type="date" value={formData.date} name="date" className='form-control' onChange={(e) => setFormData({ ...formData, date: e.target.value })} />
        </div>

        <div className="col-6 mb-3">
            <label htmlFor="name" className="form-label">BL Number</label>
              <input type="text" value={formData.bl_number} name="bl_number" className='form-control' onChange={(e) => setFormData({ ...formData, bl_number: e.target.value })} />
        </div>

        <div className="col-6 mb-3">
            <label htmlFor="name" className="form-label">Index Number</label>
              <input type="text" value={formData.index_number} name="index_number" className='form-control' onChange={(e) => setFormData({ ...formData, index_number: e.target.value })} />
        </div>

        <div className="col-6 mb-3">
            <label htmlFor="name" className="form-label">BL Quantity</label>
              <input type="number" value={formData.bl_quantity} name="bl_quantity" className='form-control' onChange={(e) => setFormData({ ...formData, bl_quantity: e.target.value })} />
        </div>
        
        <div className="col-6 mb-3">
            <label htmlFor="name" className="form-label">Landed Quantity</label>
              <input type="number" value={formData.landed_quantity} name="landed_quantity" className='form-control' onChange={(e) => setFormData({ ...formData, landed_quantity: e.target.value })} />
        </div>

        <div className="col-6 mb-3">
            <label htmlFor="name" className="form-label">Terminal Quantity</label>
              <input type="number" value={formData.terminal_quantity} name="terminal_quantity" className='form-control' onChange={(e) => setFormData({ ...formData, terminal_quantity: e.target.value })} />
        </div>

        <div className="col-6 mb-3">
            <label htmlFor="name" className="form-label">Provisional Price</label>
              <input type="number" value={formData.provisional_price} name="provisional_price" className='form-control' onChange={(e) => setFormData({ ...formData, provisional_price: e.target.value })} />
        </div>

        <div className="col-6 mb-3">
            <label htmlFor="name" className="form-label">Status</label>
            <input type="checkbox" value="1" name="status" />
        </div>

    </div>

            <button type="submit" className="btn btn-primary btn-sm">Add</button>
          </form>


        </div>

        <div className="col-6">
          <table className="table">
            <thead>
              <tr>
                <th>Product</th>
                <th>Bl Number</th>
              </tr>
            </thead>
            <tbody>
              {tableData.map((entry, index) => (
                <tr key={index}>
                  <td>{entry.product}</td>
                  <td>{entry.bl_number}</td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>
  )
    }
    
    const container = document.getElementById('mydiv');
    const root = ReactDOM.createRoot(container);
    root.render(<Hello />)
  </script>

<script src="https://malsup.github.io/jquery.form.js"></script> 
<script>
  $('#kt_docs_repeater_basic').repeater({
      initEmpty: true,

      defaultValues: {
          'text-input': 'foo'
      },

      show: function() {
          $(this).slideDown();
      },

      hide: function(deleteElement) {
          $(this).slideUp(deleteElement);
      }
  });
  </script>
  <script>
      $(document).on("click",".bl-attachment", function () {
          var targetModal = $(this).parent().next();
          targetModal.modal('toggle');
      });
    </script>

    <script>
      $(document).on("change",'.bls-doc', function () {
          
          var doc_com = $(this).parents('.row').find('.doc-com').val();
          var doc_bl = $(this).parents('.row').find('.doc-bl').val();
          var doc_ship = $(this).parents('.row').find('.doc-ship').val();
          
          var count = 0;
  
          if (doc_com !== '') {
          count++;
          }
          
          if (doc_bl !== '') {
          count++;
          }
          
          if (doc_ship !== '') {
          count++;
          }
          
          $(this).parents('.row').find('.bl-attachment').text(count + ' File Attached');

      });
    </script>

    <script>
        $(document).on("keyup",".input_bl_quantity", function () {
            var bl_quantity = $(this).val();
            var landed_quantity = $(this).closest('.row').find('.input_landed_quantity').val();
            var shortage = bl_quantity - landed_quantity;
            var shortage_percentage = landed_quantity * 100 / bl_quantity;
            $(this).closest('.row').find('.shortage-input').val(shortage);
            $(this).closest('.row').find('.shortage-input-percentage').val(parseFloat(shortage_percentage).toFixed(2));
        });

        $(document).on("keyup",".input_landed_quantity", function () {
            var landed_quantity = $(this).val();
            var bl_quantity = $(this).closest('.row').find('.input_bl_quantity').val();
            var shortage = bl_quantity - landed_quantity;
            var shortage_percentage = landed_quantity * 100 / bl_quantity;
            $(this).closest('.row').find('.shortage-input').val(shortage);
            $(this).closest('.row').find('.shortage-input-percentage').val(parseFloat(shortage_percentage).toFixed(2));                
        });
    </script>

    <script>
        $(document).on("change","#transaction_type", function () {
            
            var transaction_type = $(this).val();
            
            if (transaction_type == 'Normal') {
                var option = '<option disabled selected>-- Select --</option>' +
                            '<option value="Local">Local</option>' +
                            '<option value="Import">Import</option>';
                $('#inv-type').html(option);
            }
            if (transaction_type == 'Temporary' || transaction_type == 'Barter') {
                var option = '<option value="Local">Local</option>';
                $('#inv-type').html(option);
            }
        });
    </script>

    <script>
        $(document).on("change","#inv-type", function () {
            var value = $(this).val();

            if (value == 'Local') {
                $('#voyage').hide();
                $('#igm-date').hide();
                $('#arrival-date').hide();
            }
            else {
                $('#voyage').show();
                $('#igm-date').show();
                $('#arrival-date').show();
            }
        });
    </script>

    <script>
      $(document).on("keyup",".input_terminal_quantity", function () {
          var landed_quantity = $(this).closest('form').find('.landed-qty').find('input').val();
          setTimeout(() => {
              var terminal_qty = $(this).val();
              if (terminal_qty != landed_quantity) {
                  swal({
                      title: "Landed Quantity and Terminal Quantity are not same, do you want to commingle ?",
                      text: "",
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
                      })
                      .then((willDelete) => {
                      if (willDelete) {
                          $('.commingle-terminal-col').show();
                      } else {
                          $('.commingle-terminal-col').hide();
                          $(this).val(landed_quantity);
                      }
                  });
              }
              else {
                  $(this).parents('.row').find('.commingle-terminal-col').hide();
              }
          }, 1500);
      });
    </script>

  <script>
      function BlDataTable() {
                      var table = $("#bl-table").DataTable({
                          processing: true,
                          serverSide: true,
                          info: false,
                          paging: true,
                          destroy: true,
                          ajax: "{{ route('inventories.show',$inventory->id) }}",
                          columns: [
                              {data: null, "defaultContent": "" },
                              {data: 'product_name', name: 'product_name'},
                              {data: 'bl_number', name: 'bl_number'},
                              {data: 'bl_quantity', name: 'bl_quantity'},
                              {data: 'action', name: 'action', orderable: false, searchable: false},
                          ],
                          
                          columnDefs: [{
                              targets: 1,
                              searchable: true,
                              visible: false
                          }]
      
                  });

          $('#product_id').on('change', function() {
              var value = $(this).find(':selected').attr('data-val');
              table.column(1).search(value).draw();

              if (value == 'RBD PALM OIL') {
                  $('#rdb_palm_oil').removeClass('btn-light').addClass('btn-primary');      
                  $('#rdb_palm_olein').removeClass('btn-primary').addClass('btn-light');      
              }
              else if(value == 'RBD PALM OLEIN') {
                  $('#rdb_palm_olein').removeClass('btn-light').addClass('btn-primary');
                  $('#rdb_palm_oil').removeClass('btn-primary').addClass('btn-light');
              }
      });

          $('#rdb_palm_oil').on('click', function() {
              table.column(1).search('RBD PALM OIL').draw();
              $(this).removeClass('btn-light').addClass('btn-primary');
              $('#rdb_palm_olein').removeClass('btn-primary').addClass('btn-light');
              $("#product_id option:contains(RBD PALM OIL)").prop("selected", true);
          });

          $('#rdb_palm_olein').on('click', function() {
              table.column(1).search('RBD PALM OLEIN').draw();
              $(this).removeClass('btn-light').addClass('btn-primary');
              $('#rdb_palm_oil').removeClass('btn-primary').addClass('btn-light');
              $("#product_id option:contains(RBD PALM OLEIN)").prop("selected", true);
          });

          return table;
      }

      $(document).ready(function() {
          BlDataTable();
      });

  
      $(document).on('click','#check-submit-btn', function () {
          var product_id = $('#product_id').val();
          var terminal_id = $('#terminal_id').val();
          var landed_qty = $('.input_landed_quantity').val();
          
          var terminal_qty = 0;
          $(this).closest('form').find('.all-terminal-qty').each(function (i, j) {
              terminal_qty += parseInt($(this).val());
          });
          if (terminal_qty == landed_qty) {
              $("#bls-form").ajaxSubmit(
                  {
                      url: "{{ route('inventory.bls.add',$inventory->id) }}",
                      type: 'post',
                      success:    function(response) { 
                          
                          swal("BL Added Successfully!", "", "success");
                          $('#bls-form')[0].reset();
                          $('#product_id option[value='+product_id+']').attr('selected','selected');
                          $('#terminal_id option[value='+terminal_id+']').attr('selected','selected');
                          BlDataTable();
                      },
                      error:    function() {
                          swal("Error Occured!", "", "warning");
                       }
                  }
                  );
          }
          else {
              swal("Please make sure that Terminal Quantity should be equal to landed quantity!", "", "warning");
          }
      });
  </script>

  <script>
      $(document).on("click",".edit-bl", function () {
          
          var url = $(this).attr('data-info');
          var action = $(this).attr('data-route');

          $.ajax({
              type: "GET",
              url: url,
              success: function (data) {
                  $('#edit-bl-form').attr('action',action);
                  $('#edit-bl-form').removeClass('d-none');
                  $('#bls-form').addClass('d-none');

                  // Assign Values
                  $('#edit-bl-form').find('#product_id option[value='+data.product_id+']').attr('selected','selected');
                  $('#edit-bl-form').find('#terminal_id option[value='+data.terminal_id+']').attr('selected','selected');
                  $('#edit-bl-form').find('input[name="date"]').val(data.date);
                  $('#edit-bl-form').find('input[name="bl_number"]').val(data.bl_number);
                  $('#edit-bl-form').find('input[name="index_number"]').val(data.index_number);
                  $('#edit-bl-form').find('input[name="bl_quantity"]').val(data.bl_quantity);
                  $('#edit-bl-form').find('input[name="landed_quantity"]').val(data.landed_quantity);
                  $('#edit-bl-form').find('input[name="terminal_quantity"]').val(data.terminal_quantity);
                  $('#edit-bl-form').find('input[name="provisional_price"]').val(data.provisional_price);
                  $('#edit-bl-form').find('#edit-submit-btn').text('Update')
                  $('#edit-bl-form').find('input[name="landed_quantity"]').trigger('keyup');
                  if (data.status == 1) {
                      $('#edit-bl-form').find('input[name="status"]').prop('checked',true);
                  }
                  else {
                      $('#edit-bl-form').find('input[name="status"]').prop('checked',false);
                  }
              }
          });
      });
  </script>

  <script>
      $(document).on("click","#edit-submit-btn", function () {
          
          var url = $(this).closest('form').attr('action');
          var formData = $(this).closest('form').serialize();
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
              }
          });
          $.ajax({
              type: "PUT",
              url: url,
              data: formData,
              success: function (response) {
                  swal("BL Updated Successfully!", "", "success");
                      $('#edit-bl-form')[0].reset();
                      BlDataTable();

                      $('#edit-bl-form').attr('action',"");
                      $('#edit-bl-form').addClass('d-none');
                      $('#bls-form').removeClass('d-none');
              },
              error:  function() {
                  swal("Error Occured!", "", "warning");
              }
          });
      });
  </script>

  <script>
      $(document).on("click","#delete-bl", function () {
          var url = $(this).attr('data-route');

          swal({
              title: "Are you sure you want to delete ?",
              text: "",
              icon: "warning",
              buttons: true,
              dangerMode: true,
              })
              .then((willDelete) => {
              if (willDelete) {
                  $.ajax({
                      type: "DELETE",
                      url: url,
                      data: {
                          _token : "{{ csrf_token() }}"
                      },
                      success: function (response) {
                          swal("BL Deleted Successfully !","","success");
                          BlDataTable();  
                      },
                      error : function () {
                          swal("Error Occured!", "", "warning");
                      }
                  });
                  
              } else {
                  swal("Your Record is Safe","","success");
              }
          });
      });
  </script>
  @endpush
  </x-default-layout>