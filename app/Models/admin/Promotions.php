<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\Products;


class Promotions extends Model
{
    use HasFactory;

    use HasFactory;
    protected $table = "promotions";

    protected $primaryKey = "id";

    public $timestamps = true;

    protected $attributes = [

    ];

    const CREATED_AT = 'create_at';
    const UPDATED_AT = 'update_at';

    protected $fillable = [
        'name',
        'discount',
        'quantity',
        'start_day',
        'end_day',
        'status',
        'create_at',
        'update_at'
    ];

    public function postAdd($data){
        return Promotions::create($data);
     }

     public static function postEdit($id, $data){
        return Promotions::where('id', $id)->update($data);
     }

     public function products() {
        return $this->hasMany(Products::class, 'price_sale');
    }

    
}
