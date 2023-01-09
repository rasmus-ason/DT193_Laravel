<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'article_number',
        'product_name',
        'product_description',
        'product_category',
        'amount_in_stock',
        'status'
    ];    
}
