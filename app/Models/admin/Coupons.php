<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupons extends Model
{
    use HasFactory;

    protected $table="coupons";
    protected $primaryKey = "id";

    public $timestamps = true;

    protected $attributes = [];
    protected $fillable = [
        'code',
        'discount',
        'user_id',
        'quantily',
        'start_day',
        'end_day',
        'created_at',
        'updated_at'
    ];
    public function postAdd($data)
    {
        return Coupons::create($data);
    }
    public static function postEdit($id, $data){
        return Coupons::where('id', $id)->update($data);
     }
}
