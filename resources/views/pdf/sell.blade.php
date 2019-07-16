<!DOCTYPE html>
<html lang="en">
<head>
    <title>Product</title>
</head>
<body>
    <h1 align='center'>Sells Report</h1>
    <table style='border-collapse:collapse' width='100%' align='center' border='2'>
        <tr>
            <th><center>User ID</th>
            <th><center>Product</th>
            <th><center>Price</th>
            <th><center>Amount</th>
            <th><center>Total</th>
            <th><center>Discount</th>
            <th><center>Status</th>
        </tr>
        @foreach($all as $datas){
        <tr>
            <td>{{$datas->users_id}}</td>
            <td>{{$datas->products_name}}</td>
            <td>{{$datas->products_price}}</td>
            <td>{{$datas->amount}}</td>
            <td>{{$datas->total}}</td>
            <td>{{$datas->discount}}</td>
            <td>{{$datas->status}}</td>
        }
        </tr>
        @endforeach
    </table>
</body>
</html>