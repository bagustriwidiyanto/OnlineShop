@extends('layouts.app')
<title>Home</title>
@section('content')
    <div class="site-section" style='margin-top:-30px;' id="products-section">
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-md-12 text-center">
            <h3 class="section-sub-title">produk dengan penjualan terbanyak</h3>
            <h2 class="section-title mb-3">Produk Populer</h2>
          </div>
        </div>
        <div class="row">
        <table width='100%' id='table_data'>
          @foreach($product as $products)
          <div class="col-lg-4 col-md-6 mb-5">
            <div class="product-item">
              <figure>
                <img src="/images/<?php echo $products->photo ?>" height='250px'/>
              </figure>
              <div class="px-4">
                <h3><a class='modal-show' href="{{route('home.show',$products->id)}}" title='Detail {{$products->name}}'>{{$products->name}}</a></h3>
                <p class="mb-4">Rp. {{$products->price}}</p>
                <div>
                  <a href="{{route('detail.show',$products->id)}}" title='Insert amount of {{$products->name}}' class="btn btn-black mr-1 rounded-0 modal-show">Cart</a>
                  <a href="{{route('home.show',$products->id)}}" title='Detail {{$products->name}}' class="btn btn-show btn-black btn-outline-black ml-1 rounded-0">View</a>
                </div>
              </div>
            </div>
          </div>
          @endforeach
          </table>
        </div>
        <div class='col-md-12'>
        {{$product->links()}}
        </div>
      </div>
    </div>
@endsection
  </body>
</html>