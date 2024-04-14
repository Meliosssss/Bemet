<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::orderBy('id', 'DESC')->paginate(10);
        return view('admin.product.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('id', 'ASC')->select('id', 'name')->get();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:products',
            'status' => 'required',
            'price' => 'required|numeric',
            'sale_price' => 'numeric|lte:price',
            'img' => 'required|file|mimes:jpg,jpeg,png,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|min:5',
            'other_img.*' => 'file|image',
        ], [
            'name.required' => 'Please enter product name',
            'name.max' => 'Product name must be at most 255 characters',
            'name.unique' => 'Product name already exists',
            'status.required' => 'Please select product status',
            'price.required' => 'Please enter product price',
            'price.numeric' => 'Product price must be a number',
            'sale_price.numeric' => 'Product sale price must be a number',
            'sale_price.lte' => 'Product sale price must be less than or equal to product price',
            'img.required' => 'Please select an image file',
            'img.file' => 'Please select an image file',
            'img.mimes' => 'Image file must be jpg, jpeg, png, gif',
            'img.max' => 'Image file must be less than 2MB',
            'category_id.required' => 'Please select product category',
            'category_id.exists' => 'Product category does not exist',
            'description.required' => 'Please enter product description',
            'description.min' => 'Product description must be at least 5 characters',
            'other_img.*.file' => 'Please select an image file',
        ]);

        $data = $request->only('name', 'status', 'price', 'sale_price', 'category_id', 'description');

        $image_name = $request->img->hashName();
        $request->img->move(public_path('uploads/product'), $image_name);
        $data['image'] = $image_name;

        if ($product = Product::create($data)) {
            if ($request->has('other_img')) {
                foreach ($request->other_img as $img) {
                    $other_name = $img->hashName();
                    $img->move(public_path('uploads/product'), $other_name);
                    $data['image'] = $image_name;
                    ProductImage::create([
                        'image' => $other_name,
                        'product_id' => $product->id
                    ]);
                }
            }
            return redirect()->route('product.index')->with('success', 'Product created successfully');
        }
        return redirect()->back()->with('error', 'Product created failed');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::orderBy('id', 'ASC')->select('id', 'name')->get();
        return view('admin.product.edit', compact('categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|min:5|max:255|unique:products,name,' . $product->id,
            'status' => 'required',
            'price' => 'required|numeric',
            'sale_price' => 'numeric|lte:price',
            'img' => 'file|mimes:jpg,jpeg,png,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|min:5'
        ], [
            'name.required' => 'Please enter product name',
            'name.min' => 'Product name must be at least 5 characters',
            'name.max' => 'Product name must be at most 255 characters',
            'name.unique' => 'Product name already exists',
            'status.required' => 'Please select product status',
            'price.required' => 'Please enter product price',
            'price.numeric' => 'Product price must be a number',
            'sale_price.numeric' => 'Product sale price must be a number',
            'sale_price.lte' => 'Product sale price must be less than or equal to product price',
            'img.file' => 'Please select an image file',
            'img.mimes' => 'Image file must be jpg, jpeg, png, gif',
            'img.max' => 'Image file must be less than 2MB',
            'category_id.required' => 'Please select product category',
            'category_id.exists' => 'Product category does not exist',
            'description.required' => 'Please enter product description',
            'description.min' => 'Product description must be at least 5 characters'
        ]);


        $data = $request->only('name', 'status', 'price', 'sale_price', 'category_id', 'description');
        if ($request->has('img')) {
            $img_name = $product->image;
            $image_path = public_path('uploads/product') . '/' . $img_name;
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            $image_name = $request->img->hashName();
            $request->img->move(public_path('uploads/product'), $image_name);
            $data['image'] = $image_name;
        }

        if ($product->update($data)) {
            if ($request->has('other_img')) {
                if ($product->images->count() > 0) {
                    foreach ($product->images as $img) {
                        $other_img = $img->image;
                        $other_path = public_path('uploads/product') . '/' . $other_img;
                        if (file_exists($other_path)) {
                            unlink($other_path);
                        }
                    }
                    ProductImage::where('product_id', $product->id)->delete();
                }
                foreach ($request->other_img as $img) {
                    $other_name = $img->hashName();
                    $img->move(public_path('uploads/product'), $other_name);
                    ProductImage::create([
                        'image' => $other_name,
                        'product_id' => $product->id
                    ]);
                }
            }
            return redirect()->route('product.index')->with('success', 'Product updated successfully');
        }
        return  redirect()->back()->with('error', 'Product updated failed');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $img_name = $product->image;
        if ($product->images->count() > 0) {
            foreach ($product->images as $img) {
                $other_img = $img->image;
                $other_path = public_path('uploads/product') . '/' . $other_img;
                if (file_exists($other_path)) {
                    unlink($other_path);
                }
            }
            ProductImage::where('product_id', $product->id)->delete();
            if ($product->delete()) {
                $image_path = public_path('uploads/product') . '/' . $img_name;
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
                return redirect()->route('product.index')->with('success', 'Product deleted successfully');
            }
        } else {
            if ($product->delete()) {
                $image_path = public_path('uploads/product') . '/' . $img_name;
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
                return redirect()->route('product.index')->with('success', 'Product deleted successfully');
            }
        }
        return back()->with('error', 'Product deleted failed');
    }

    public function destroyImage(ProductImage $image)
    {
        $img_name = $image->image;
        if ($image->delete()) {
            $image_path = public_path('uploads/product') . '/' . $img_name;
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            return redirect()->back()->with('success', 'Image deleted successfully');
        }
        return redirect()->back()->with('error', 'Image deleted failed');
    }
}
