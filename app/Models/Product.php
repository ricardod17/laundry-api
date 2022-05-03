<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table="product";
    protected $fillable = [
        'product_name','product_price'
    ];
}

public function product()
{
    return $this->belongsToMany(Transaction::class, 'category_transaction', 'category_id','product_id','transaction_id');
}