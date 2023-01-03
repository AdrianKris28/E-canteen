<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    use HasFactory;
    protected $table = 'buyer';
    protected $fillable = [
        'userId'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
