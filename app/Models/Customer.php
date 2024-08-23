<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model

{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone', 'street', 'house_number', 'suburb', 'state', 'pincod',    
    ];

    public function lists()
    
    {
        return $this->hasMany(ListModel::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
