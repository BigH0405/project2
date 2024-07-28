<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    use HasFactory;
    protected $table="reviews";
    protected $primaryKey = "id";

    public $timestamps = true;

    protected $attributes = [];
    public function User() {
        return $this->belongsTo(Users::class, 'user_id');
    }
        public function Product() {
        return $this->belongsTo(Products::class, 'product_id');
    }
}
