<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\Favorite;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $topBanner = Banner::getBanner()->first();
        $gallerys = Banner::getBanner('gallery')->get();

        $news_products = Product::orderBy('created_at', 'DESC')->limit(2)->get();
        $sale_products = Product::orderBy('created_at', 'DESC')->where('sale_price', '>', 0)->limit(3)->get();
        $feature_products = Product::inRandomOrder()->limit(4)->get();

        return view('home.index', compact('topBanner', 'gallerys', 'news_products', 'sale_products', 'feature_products'));
    }

    public function about()
    {
        return view('home.about');
    }

    public function category(Category $cat)
    {
        $products = $cat->products()->paginate(9);
        $news_products = Product::orderBy('created_at', 'DESC')->limit(3)->get();
        return view('home.category', compact('cat', 'products', 'news_products'));
    }

    public function product(Product $product)
    {
        $news_products = Product::where('category_id', $product->category_id)->orderBy('created_at', 'DESC')->limit(5)->get();
        return view('home.product', compact('product', 'news_products'));
    }

    public function favorite($product_id)
    {
        $user_id = auth('cus')->id();
        $data = [
            'customer_id' => $user_id,
            'product_id' => $product_id,
        ];
        $favorite = Favorite::where(['product_id' => $product_id, 'customer_id' => auth('cus')->id()])->first();
        if ($favorite) {
            $favorite->delete();
            return redirect()->back()->with('success', 'Remove from favorite successfully.');
        } else {
            Favorite::create($data);
            return redirect()->back()->with('success', 'Add to favorite successfully.');
        }
    }
}
