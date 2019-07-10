<section class="head-text">
  <div class="container text-margin">
    <h1 class="mb-0 site-logo"><a href="{{route('index')}}" class="text-black mb-0">Halmahera Prima Energi<span class="text-primary">.</span> </a></h1>
  </div>
</section>
<nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
  <ul class='cart'>
    <li class='carts'>
      <a href="{{route('detail.cart')}}" title='Cart' id='trigger-click' class='cartz'>
        <i class="fa fa-cart-plus" aria-hidden="true"></i>
        <i class="fa fa-cart-plus" aria-hidden="true"></i>
      </a>
    </li>
  </ul>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto w-100 justify-content-end">
      <li class="nav-item">
        <a class='nav-link' href="{{route('index')}}">Home</a>
      </li>
      <li class="nav-item">
        <a class='nav-link' href="{{route('home.user')}}">User</a>
      </li>
      <li class="nav-item">
        <a class='nav-link' href="{{route('history.index')}}">Buy History</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Category
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{route('home.category','Plastik')}}">Plastik</a>
          <a class="dropdown-item" href="{{route('home.category','Kertas')}}">Kertas</a>
          <a class="dropdown-item" href="{{route('home.category','Mika')}}">Mika</a>
          <a class="dropdown-item" href="{{route('home.category','Gelas')}}">Gelas</a>
          <a class="dropdown-item" href="{{route('home.category','Sendok')}}">Sendok</a>
        </div>
      </li>
      @if($user == 'Admin')
      <li><a class='nav-item nav-link' href="{{route('product.index')}}">Produk</a></li>
      @endif
      @if($check)
      <li><a class='nav-item nav-link' href="{{route('detail.logout')}}">Logout</a></li>
      @else
      <li><a class='nav-item nav-link' href="{{ route('login') }}"> Login </a></li>
      @endif
    </ul>
  </div>
</nav>
<style>
.navbar{
  -webkit-box-shadow: 0 8px 6px -6px #999;
  -webkit-box-color: 0 8px 6px -6px #999;
  -moz-box-shadow: 0 8px 6px -6px #999;
  box-shadow: 0 8px 6px -6px #999;
}
.nav-item{
  margin:5px;
}
.dropdown-item{
  transition:0.5s;
}
.dropdown-item:hover{
  background-color:#3a3a3a;
  color:white;
}
.head-text{
  padding:20px;
}
.cart{
  display:flex;
}
.cart .carts{
  position:relative;
  list-style:none;
  width:60px;
  height:60px;
  background:#353942;
  margin-top:-10px;
  margin-bottom:-22px;
  border: 4px solid #fff;
  box-sizing:border-box;
  border-radius: 50%;
  transition:0.5s;
  overflow:hidden;
  margin-left:4px;
  margin-right:4px;
}
.cart .carts .cartz .fa{
  position:absolute;
  top:50%;
  left:50%;
  transform: translate(-50%,-50%);
  font-size:30px;
  color: #fff;
  transition:0.5s;
}
.cart .carts:hover{
  background: #fff;
}
.cart .carts .cartz .fa:nth-child(1){
  left: -50%;
  opacity:0;
}
.cart .carts:hover .cartz .fa:nth-child(1){
  left:50%;
  opacity:1;
  color:#353942;
}
.cart .carts:hover .cartz .fa:nth-child(2){
  left:150%;
  opacity:0;
}
</style>
