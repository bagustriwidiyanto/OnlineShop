@extends('layouts.app')
<title>User</title>
@section('content')
    <div class="site-section" style='margin-top:60px;' id="histories-section">
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-md-6 text-center">
            <h3 class="section-sub-title"> Change Account Data </h3>
            <h2 class="section-title mb-3">User</h2>
          </div>
        </div>
        <div class="panel-body">
        <table id='datatable' width='100%' class='table table-hover'>
          <thead>
            <th> No </th>
            <th> Name </th>
            <th> Phone </th>
            <th> Address </th>
            <th> Action </th>
          </thead>
          <tbody>
          </tbody>
        </table>
        </div>
      </div>
    </div>
@endsection
  </body>
</html>
@push('scripts')
  <script>
    $('#datatable').DataTable({
      responsive:true,
      processing:true,
      serverSide:true,
      ajax:'{{route("table-user")}}',
      columns: [
        {data: 'DT_RowIndex',name: 'id'},
        {data: 'name',name: 'name'},
        {data: 'phone',name: 'phone'},
        {data: 'address',name: 'address'},
        {data: 'action',name: 'action'}
      ]
    });
  </script>
@endpush