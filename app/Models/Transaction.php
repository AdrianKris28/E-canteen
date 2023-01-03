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
        'paymentMethodId',
        'flag',
        'orderType',
        'transactionDate'
    ];

    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function transactiondetail()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
