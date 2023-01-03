<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payment';
    protected $fillable = [
        'paymentMethodName'
    ];

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }
}
