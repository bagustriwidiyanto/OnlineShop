@extends('layouts.app')
<title>Products</title>
@section('content')
@if($user == 'Admin')
    <div class="site-section" style='margin-top:60px;' id="products-section">
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-md-6 text-center">
            <h3 class="section-sub-title">List All Product</h3>
            <h2 class="section-title mb-3">Product</h2>
          </div>
        </div>
        <div class="panel-head" style='margin-bottom:10px;'>
          <a href='{{route("product.create")}}' class="btn btn-info modal-show" title='Add Product'>Add Product</a>
        </div>
        <div class="panel-body">
        <table id='datatable' width='100%' class='table table-hover'>
          <thead>
            <th> No </th>
            <th> Name </th>
            <th> Category </th>
            <th> Price</th>
            <th> Stock</th>
            <th> Sold</th>
            <th> Discount</th>
            <th> Code</th>
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
      ajax:'{{route("table-product")}}',
      columns: [
        {data: 'DT_RowIndex',name: 'id'},
        {data: 'name',name: 'name'},
        {data: 'category',name: 'category'},
        {data: 'price',name: 'price'},
        {data: 'stock',name: 'stock'},
        {data: 'sold',name: 'sold'},
        {data: 'discount',name: 'discount'},
        {data: 'code',name: 'code'},
        {data: 'action',name: 'action'}
      ]
    })
  </script>
@endpush
@else
<script>
window.location.replace('/');
</script>
@endif