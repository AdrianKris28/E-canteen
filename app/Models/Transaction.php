<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transaction';
    protected $fillable = [
        'buyerId',
        'paymentMethod',
        'flag',
        'orderType',
        'tableNumber',
        'transactionDate'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function transactiondetail()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
