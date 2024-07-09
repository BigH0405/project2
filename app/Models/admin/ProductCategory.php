<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    protected $table = "product_category";

    protected $primaryKey = "id";

    public $timestamps = true;

    protected $attributes = [

    ];

    const CREATED_AT = 'create_at';
    const UPDATED_AT = 'update_at';

    protected $fillable = [
        'name'
    ];

    public function postAdd($data){
        return ProductCategory::create($data);
     }

     public static function postEdit($id, $data){
        return ProductCategory::where('id', $id)->update($data);
     }
}
