<?php

namespace App\Models\admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\ProductCategory;



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
    public function postAdd($data)
    {
        return Products::create($data);
    }
    public static function postEdit($id, $data){
        return Products::where('id', $id)->update($data);
     }
     
     public function productCate() {
        return $this->belongsTo(ProductCategory::class, 'product_category');
    }

}
