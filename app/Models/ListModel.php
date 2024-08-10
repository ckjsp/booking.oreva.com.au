<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListModel extends Model

{
    protected $table = 'lists'; // Specify the correct table name

    protected $fillable = [

        'name',
        'suburb',
        'state',
        'pincod',
        'description',
        'contact_number',
        'contact_email',
        'builder_name',
        'status',
        'product_name',
        'customer_id',
        
    ];

    public function products()

    {
        return $this->hasMany(Product::class, 'id', 'id');
    }
    
    public function orders()

    {
        return $this->hasMany(Order::class, 'list_id');
    }
    
}
