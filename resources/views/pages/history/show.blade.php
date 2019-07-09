<table class="table table-hover">
    <tr>    
        <th>User ID</th>
        <th>Product ID</th>
        <th>Product Name</th>
        <th>Product Price</th>
        <th>Amount</th>
        <th>Diskon</th>
        <th>Total</th>
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
        <td>{{$models->receipt}}</td>
    </tr>
    @endforeach
</table>