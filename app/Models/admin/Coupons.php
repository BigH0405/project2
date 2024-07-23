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

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
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

}
