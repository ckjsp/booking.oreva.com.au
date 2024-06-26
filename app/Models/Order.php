<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model

{
    protected $fillable = [
        'product_id',
        'product_name',
        'product_code',
        'price',
        'quantity',
        'product_order_image',
        'customer_id',
        'list_id',
    ];

    // Define any necessary relationships here
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function list()
    {
        return $this->belongsTo(ListModel::class);
    }
}
