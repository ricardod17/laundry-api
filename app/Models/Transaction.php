<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table="transaction";
    protected $primaryKey="id";
    protected $fillable = [
        'customerid','productid','categoryid','total_item','price','status_transaction',
    ];

    public function category(){
        return $this->belongsToMany(Category::class,'category_transaction','category_id','product_id','transaction_id'); 
    }
}
