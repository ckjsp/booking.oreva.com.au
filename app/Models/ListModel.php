<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListModel extends Model
{
    use HasFactory;

    protected $table = 'lists'; // Explicitly specify the table name

    protected $fillable = [
        'name',
        'description',
        'contact_number',
        'contact_email',
        'product_name',
        'customer_id',
    ];
}
