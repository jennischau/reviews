<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table='transactions';
    protected $fillable=[
        'id',
        'transaction_code',
        'balance_before',
        'amount',
        'balance_after',
        'description',
        'user_id',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
