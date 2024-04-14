@extends('master.admin')
@section('title' , 'Category List')
@section('main')
<form action="" method="POST" class="form-inline" role="form">
    <div class="form-group">
        <label class="sr-only" for="">label</label>
        <input type="email" class="form-control" id="" placeholder="Input field">
    </div>
    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
    <a href="{{ route('category.create') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i></a>
</form>


<table class="table table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Category Name</th>
            <th>Category Status</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>Category 1</td>
            <td>Active</td>
            <td class="text-right">
                <a href="" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                <a href="" class="btn btn-danger"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
    </tbody>
</table>

@stop()