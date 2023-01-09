<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmountChangeLog extends Model
{
    use HasFactory;

    protected $table = "amount_change_logs";
    protected $fillable = [
        'article_number',
        'old_amount',
        'new_amount',
        'modified_with',
        'product_id'

    ];

    // public function products() {
    //     return $this->belongsTo(ProductController::class);
    // }
}
