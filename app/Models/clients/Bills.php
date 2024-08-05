<?php

namespace App\Models\clients;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bills extends Model
{
    use HasFactory;
    protected $table = "bills";

    
    protected $fillable = [
        'code',
        'name',
        'email',
        'price',
        'address',
        'user_id',
        'phone',
        'messege',
        'subtotal',
        'shipping',
        'total',
    ];
    public function user(){
        return $this->belongsTo(Users::class,'user_id');
    }
    public function chiTietDonHang(){
        return $this->hasMany(orders_detail::class,'bill_id');
    }
}
