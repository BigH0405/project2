<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = "products";

    protected $primaryKey = "id";

    public $timestamps = true;

    protected $attributes = [];

    const CREATED_AT = 'create_at';
    const UPDATED_AT = 'update_at';
    protected $fillable = [
        'name',
        'price',
        'price_sale',
        'product_category',
        'quantity',
        'short_description',
        'description',
        'create_at',
        'update_at'
    ];
    public function postAdd($data)
    {
        return Products::create($data);
    }
    public static function postEdit($id, $data){
        return Products::where('id', $id)->update($data);
     }
     

}
