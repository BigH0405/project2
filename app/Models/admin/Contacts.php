<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    use HasFactory;

    protected $table="contacts";
    protected $primaryKey = "id";

    public $timestamps = true;

    protected $attributes = [];
    protected $fillable = [
        'fullname',
        'email',
        'phone',
        'message',
        'user_id',
        'created_at',
        'updated_at'
    ];
    public static function postEdit($id, $data){
        return Contacts::where('id', $id)->update($data);
     }
}
