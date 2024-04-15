@extends('master.admin')
@section('title' , 'Product List')
@section('main')
<form action="" method="POST" class="form-inline" role="form">
    <div class="form-group">
        <label class="sr-only" for="">label</label>
        <input type="" class="form-control" id="" placeholder="Input field">
    </div>
    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
    <a href="{{ route('product.create') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i></a>
</form>


<table class="table table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Product Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Image</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $model)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $model->name }}</td>
            <td>{{ $model->category_id }}</td>
            <td>{{ $model->price }} <span class="label label-success">{{ $model->sale_price }}</span></td>
            <td>
                <img src="uploads/product/{{ $model->image }}" width="50">
            </td>
            <td>{{ $model->status == 0 ? 'Hidden' : 'Public' }}</td>
            <td class="text-right">
                <form action="{{ route('product.destroy', $model->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <a href="{{ route('product.edit', $model->id) }}" class=" btn btn-primary"><i class="fa fa-edit"></i></a>
                    <button class="btn btn-danger" onclick="return confirm('Are you sure want to delete it?')"><i class="fa fa-trash"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@stop()