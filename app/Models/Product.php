<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $appends = ['favorite'];

    protected $fillable = [
        'name',
        'status',
        'price',
        'sale_price',
        'image',
        'category_id',
        'description'
    ];

    public function cat()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function getFavoriteAttribute()
    {
        $favorite = Favorite::where(['product_id' => $this->id, 'customer_id' => auth('cus')->id()])->first();
        return $favorite ? true : false;
    }
}
