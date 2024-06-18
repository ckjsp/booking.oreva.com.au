<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListModel extends Model
{
    protected $table = 'lists'; // Specify the correct table name

    protected $fillable = [

        'name',
        'description',
        'contact_number',
        'contact_email',
        'product_name',
        'customer_id',
        
    ];

    public function products()

    {
        return $this->hasMany(Product::class, 'id', 'id');
    }
  
}
