<table class="table table-hover">
    <tr>    
        <th>Name</th>
        <th>Category</th>
        <th>Price</th>
        <th>Stock</th>
        <th>Sold</th>
        <th>Diskon</th>
        <th>Kode</th>
        <th>Photo</th>
    </tr>
    <tr>
        <td>{{$model->name}}</td>
        <td>{{$model->category}}</td>
        <td>{{$model->price}}</td>
        <td>{{$model->stock}}</td>
        <td>{{$model->sold}}</td>
        <td>{{$model->discount}}</td>
        <td>{{$model->code}}</td>
        <td><img width='20px' src='/images/{{$model->photo}}'></td>
    </tr>
</table>