<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $appends = ['total_price'];

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'customer_id',
        'token',
        'status',
    ];

    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }

    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }

    public function getTotalPriceAttribute()
    {
        $t = 0;

        foreach ($this->details as $item) {
            $t += $item->price * $item->quantity;
        }
        return $t;
    }
}
