<?php

namespace App\Models\clients;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\clients\ProductsCate;
class Products extends Model
{
    use HasFactory;

    protected $table = "products";

    protected $primaryKey = "id";

    public $timestamps = true;

    protected $attributes = [];

    protected $fillable = [
        'name',
        'price',
        'image',
        'product_category',
        'quanlity',
        'short_description',
        'description',
        'created_at',
        'updated_at'
    ];

     public function productCate() {
        return $this->belongsTo(ProductsCate::class, 'product_category');
    }
}
