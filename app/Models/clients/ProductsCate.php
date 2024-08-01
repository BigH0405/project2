<?php

namespace App\Models\clients;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\clients\Products;
class ProductsCate extends Model
{
    use HasFactory;

    protected $table = "product_category";

    protected $primaryKey = "id";

    public $timestamps = true;

    protected $attributes = [

    ];

    protected $fillable = [
        'name'
    ];

     public function products() {
        return $this->hasMany(Products::class, 'product_category');
    }
}
