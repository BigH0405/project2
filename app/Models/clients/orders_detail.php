<?php

namespace App\Models\clients;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders_detail extends Model
{
    use HasFactory;
    protected $table="orders_detail";

    protected $fillable=[
        'bill_id',
        'product_id',
        'price',
        'quanlity',
        'created_at',
        'updated_at',
    ];
    public function donHang(){
        return $this->belongTo(Bills::class,'bill_id');
    }
    public function sanPham(){
        return $this->belongsTo(Products::class,'product_id');
    }
}
