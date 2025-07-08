<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table='orders';
    protected $fillable=[
        'id',
        'code',
        'map_link',
        'action',
        'status',
        'note',
        'content',
        'image',
        'drive_link',
        'price',
        'time',
        'completed_at',
        'user_id',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }

}
