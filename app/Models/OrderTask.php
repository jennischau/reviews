<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTask extends Model
{
    use HasFactory;
    protected $table='order_tasks';
    protected $fillable=[
        'id',
        'report',
        'image',
        'reported_at',
        'order_id',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
