<?php

namespace App\Models\clients;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewClients extends Model
{
    use HasFactory;

    protected $table = 'reviews';

    protected $primaryKey = "id";

    protected $fillable = [
        'product_id',
        'user_id',
        'messege',
        'created_at',
        'updated_at'
    ];

    public function Products(){
        return $this->belongsTo(Products::class,'product_id');
    }

    public function User(){
        return $this->belongsTo(Users::class, 'user_id');
    }
}
