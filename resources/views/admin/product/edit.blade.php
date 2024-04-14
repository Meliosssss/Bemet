@extends('master.admin')
@section('title' , 'Edit a product')
@section('main')
<div class="row">
    <div class="col-md-12">
        <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="form-group">
                <label for="">Product category</label>
                <select name="category_id" class="form-control" value="{{ $product->category_id }}">
                    <option value="">Choose category</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Product name</label>
                <input type="text" name="name" class="form-control" value="{{ $product->name }}"
                    placeholder="Input field">
            </div>
            <div class="form-group">
                <label for="">Product price</label>
                <input type="text" name="price" class="form-control" value="{{ $product->price }}"
                    placeholder="Input field">
            </div>
            <div class="form-group">
                <label for="">Product sale price</label>
                <input type="text" name="sale_price" class="form-control" value="{{ $product->sale_price }}"
                    placeholder="Input field">
            </div>
            <div class="form-group">
                <label for="">Product status</label>
                <div class="radio">
                    <label>
                        <input type="radio" name="status" value="1" {{ $product->status == 1 ? 'checked' : '' }} />
                        Publish
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="status" value="0" {{ $product->status == 0 ? 'checked' : '' }} />
                        Hidden
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="">Product description</label>
                <textarea name="description" class="form-control"
                    placeholder="Product content">{{ $product->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="">Product image</label>
                <input type="file" name="img" class="form-control" placeholder="Input field" onchange="showImage(this)">
                <img src="uploads/product/{{ $product->image }}" width="400" id="show_img">
            </div>
            <div class="form-group">
                <label for="">Product other image</label>
                <input type="file" name="other_img[]" class="form-control" multiple multiple
                    onchange="showOtherImage(this)">
                <hr>
                <div class=" row">
                    @foreach($product->images as $img)
                    <div class="col-md-3" style="position: relative">
                        <a href="" class="thumbnail">
                            <img src="uploads/product/{{ $img->image }}" alt="" width="100%">
                            <a onclick="return confirm('Are you sure want to delete it?')"
                                href="{{ route('product.destroyImage', $img->id) }}"
                                style="position: absolute; top: 5px; right: 20px" class="btn btn-danger"><i
                                    class="fa fa-trash"></i></a>
                        </a>
                    </div>
                    @endforeach
                </div>
                <div class="row" id="show_other_img">

                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i></button>
        </form>
    </div>
</div>
@stop()

@section('css')
<link rel="stylesheet" href="admin_assets/plugins/summernote/summernote.min.css">
@stop

@section('js')
<script src="admin_assets/plugins/summernote/summernote.min.js"></script>
<script>
$('.description').summernote({
    height: 250
})

function showImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#show_img').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function showOtherImage(input) {
    var _html = '';
    if (input.files && input.files.length) {
        for (let i = 0; i < input.files.length; i++) {
            var file = input.files[i];
            var reader = new FileReader();
            reader.onload = function(e) {
                _html += `
                    <div class="thumbnail col-md-4">
                        <img src="${e.target.result}" alt="">
                    </div>
                    `;
                $('#show_other_img').html(_html);
            }
            reader.readAsDataURL(file);
        }
    }
}
</script>
@stop