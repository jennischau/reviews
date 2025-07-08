<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;

class Deposite extends Model
{
    use HasFactory;
    protected $table='deposites';
    protected $fillable=[
        'id',
        'transaction_code',
        'balance_before',
        'amount',
        'balance_after',
        'paid_at',
        'status',
        'user_id',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function generateTransactionCode(): string
    {
        $date = now()->format('dmY'); // ngày-tháng-năm: 08072024
        $random = strtoupper(\Illuminate\Support\Str::random(6)); // ví dụ: ABC123
        return 'DEP' . $date . '-' . $random;
    }
}
