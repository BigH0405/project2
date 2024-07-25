<?php

namespace App\Models\admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    use HasFactory;

    protected $table="groups";
    protected $primaryKey = "id";

    public $timestamps = true;

    protected $attributes = [];

    protected $fillable = [
        'name',
        'permissions',
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
     
    public function User(){
        return $this->hasMany(User::class, 'group_id');
    }
}
