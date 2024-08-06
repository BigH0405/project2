<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oder extends Model
{
    use HasFactory;

    protected $table = "orders_detail";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $attributes =[

    ];

    protected $fillable = [
        'bill_id',
        'product_id',
        'price',
        'quanlity',
        'created_at',
        'updated_at',
    ];
    public function postAdd($data){
        return Oder::create($data);
    }
    public function postEdit($id,$data){
        return Oder::where('id',$id)->update($data);    
    }
    public function bill(){
        return $this->belongsTo(Bill::class,'bill_id');
    }

    public function product(){
        return $this->belongsTo(Products::class,'bill_id');
    }

}
