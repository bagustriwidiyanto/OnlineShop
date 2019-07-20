<script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Product</title>
</head>
<body id='body' onload='coba()' onafterprint="after()">
    <h1 align='center'>Sells Report</h1>
    <table style='border-collapse:collapse' width='100%' align='center' border='2'>
        <tr>
            <th><center>User ID</th>
            <th><center>Product ID</th>
            <th><center>Product Name</th>
            <th><center>Product Price</th>
            <th><center>Amount</th>
            <th><center>Diskon</th>
            <th><center>Total</th>
        </tr>
        @foreach($model as $models)
    <tr>
        <td>{{$models->users_id}}</td>
        <td>{{$models->products_id}}</td>
        <td>{{$models->products_name}}</td>
        <td>{{$models->products_price}}</td>
        <td>{{$models->amount}}</td>
        <td>{{$models->discount}}</td>
        <td>{{$models->total}}</td>
    </tr>
    @endforeach
    </table>
</body>
</html>
<script>
    function coba(){
        $('body').show("slow");
        print();
    }
    function after(){
        $('body').hide();
        window.location.replace('/history');
    }
</script>
