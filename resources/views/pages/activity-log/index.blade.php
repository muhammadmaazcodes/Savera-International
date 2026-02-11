<x-default-layout>

      <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
        <div id="kt_app_toolbar_container" class="">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Activity Logs</h1>
                
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="/" class="text-muted text-hover-primary">Dashboard </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>

                    <li class="breadcrumb-item text-muted">Activity Logs</li>
                </ul>
                
            </div>
        </div>
    </div>

    <div class="card card-flush h-md-100">
      <div class="card-header pt-7">
        
        <h3 class="card-title align-items-start flex-column">
          <span class="card-label fw-bold text-gray-800">All Logs</span>
        </h3>
        
      </div>
      
      <div class="card-body pt-6">
        <div class="row">
          <div class="col-md-3">
            <label class="form-label">Modules</label>
            <select id="module" class="form-select">
              <option selected disabled>-- Select --</option>
              @foreach ($allModels as $model)
              <option value="{{ $model }}">{{ $model }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-3">
            <label class="form-label">Users</label>
            <select id="users" class="form-select">
              <option selected disabled>-- Select --</option>
              @foreach ($users as $user)
              <option value="{{ $user->name }}">{{ $user->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="table-responsive">
          
          <table id="data-table-simple" class="table table-row-bordered gy-5">
              <thead>
                  <tr class="fw-semibold fs-6 text-muted">
                      <th>Log Name</th>
                      <th>Description</th>
                      <th>Subject</th>
                      <th>User Name</th>
                  </tr>
              </thead>
              <tbody>
                @foreach ($logs as $log)
                    <tr>
                      <td>{{ ucfirst(str_replace('_',' ',$log->log_name)) }}</td>
                      <td>{{ $log->description }}</td>
                      <td>{{ $log->subject_type }}</td>
                      <td>{{ $log->username  }}</td>
                    </tr>
                @endforeach
              </tbody>
          </table>
        </div>
        
      </div>
      
    </div>

  @push('scripts')
  <script>
    $(document).ready(function() {
      var table = $('#data-table-simple').DataTable();
  
      $('#module').on('change', function() {
        table.column(2).search(this.value).draw();
      });

      $('#users').on('change', function() {
        table.column(3).search(this.value).draw();
      });
  
  });
  </script>
  @endpush
</x-default-layout>
