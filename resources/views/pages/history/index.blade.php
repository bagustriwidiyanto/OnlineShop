@extends('layouts.app')
<title>History</title>
@section('content')
    <div class="site-section" style='margin-top:60px;' id="histories-section">
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-md-6 text-center">
            <h3 class="section-sub-title">All Purchase Histories </h3>
            <h2 class="section-title mb-3">History</h2>
          </div>
        </div>
        @if($user == 'Admin')
        <div class="panel-head" style='margin-bottom:10px;'>
          <a href='{{route("pdf-history")}}' class="btn btn-default" title='Report'>Report</a>
        </div>
      @endif
        <div class="panel-body">
        <input type="hidden" id='role' value='{{$user}}'>
        <table id='datatable' width='100%' class='table table-hover'>
          <thead>
            <th> No </th>
            <th> User ID </th>
            <th> User Name </th>
            <th> Total Price </th>
            <th> photo </th>
            <th> Status </th>
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
    var role = $('#role').val();
    if(role == 'Admin'){
    $('#datatable').DataTable({
      responsive:true,
      processing:true,
      serverSide:true,
      ajax:'{{route("table-history-admin")}}',
      columns: [
        {data: 'DT_RowIndex',name: 'id'},
        {data: 'users_id',name: 'users_id'},
        {data: 'users_name',name: 'users_name'},
        {data: 'total_price',name: 'total_price'},
        {data: 'photo',name: 'photo', render: function (data, type, full, meta) {
        return "<img src='/images/" + data + "' width='100px;'/>";
        }},
        {data: 'status',name: 'status'},
        {data: 'action',name: 'action'}
      ]
    });
    }
    else{
        $('#datatable').DataTable({
      responsive:true,
      processing:true,
      serverSide:true,
      ajax:'{{route("table-history")}}',
      columns: [
        {data: 'DT_RowIndex',name: 'id'},
        {data: 'users_id',name: 'users_id'},
        {data: 'users_name',name: 'users_name'},
        {data: 'total_price',name: 'total_price'},
        {data: 'photo',name: 'photo', render: function (data, type, full, meta) {
        return "<img src='/images/" + data + "' width='100px;'/>";
        }},
        {data: 'status',name: 'status'},
        {data: 'action',name: 'action'}
      ]
    });
    }
  </script>
@endpush