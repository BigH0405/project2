<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\Oder;
class Bill extends Model
{
    use HasFactory;

    protected $table = "bills";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $attributes =[

    ];

    protected $fillable = [
        'code',
        'user_id',
        'name',
        'email',
        'phone',
        'price',
        'address',
        'messege',
        'created_at',
        'updated_at',
    ];
    public function postAdd($data){
        return Bill::create($data);
    }
    public function postEdit($id,$data){
        return Bill::where('id',$id)->update($data);    
    }

    public function orderDetails()
    {
        return $this->hasMany(Oder::class, 'bill_id', 'id');
    }
}
