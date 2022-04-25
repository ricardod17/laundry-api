<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table="transaction";
    protected $fillable = [
        'customerid','productid','total_item','price','status_transaction',
    ];
}
