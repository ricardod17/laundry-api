<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;
class Category extends Model
{
    use HasFactory;
    protected $table="category";
    protected $primaryKey="id";
    protected $fillable = [
        'category_name','category_status'
    ];

    // public function transaction(){
    //     return $this->belongsToMany('App\Transaction','transaction', 'categoryid','id'); 
    // }

    public function transaction()
    {
        return $this->belongsToMany(Transaction::class, 'category_transaction', 'category_id', 'transaction_id');
    }
}
