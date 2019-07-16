<!DOCTYPE html>
<html lang="en">
<head>
    <title>Product</title>
</head>
<body>
    <h1 align='center'>Products Report</h1>
    <table style='border-collapse:collapse' width='100%' align='center' border='2'>
        <tr>
            <th><center>Name</th>
            <th><center>Category</th>
            <th><center>Price</th>
            <th><center>Stock</th>
            <th><center>Sold</th>
            <th><center>Discount</th>
            <th><center>Code</th>
        </tr>
        @foreach($all as $datas){
        <tr>
            <td>{{$datas->name}}</td>
            <td>{{$datas->category}}</td>
            <td>{{$datas->price}}</td>
            <td>{{$datas->stock}}</td>
            <td>{{$datas->sold}}</td>
            <td>{{$datas->discount}}</td>
            <td>{{$datas->code}}</td>
        }
        </tr>
        @endforeach
    </table>
</body>
</html>