<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $fillable = [
        'sellerId',
        'name',
        'description',
        'price',
        'stock',
        'image'
    ];

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function transactiondetail()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
