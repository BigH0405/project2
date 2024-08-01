<?php

namespace App\Models\clients;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    use HasFactory;
    protected $table="contacts";
    
    protected $primaryKey = "id";
    protected $attributes = [];

    public $timestamps = true;
    const CREATED_AT = "created_at";

    protected $fillable = [
        'fullname',
        'email',
        'phone',
        'message',
        'created_at',
    ];
    public function postAdd($data){
        return Contacts::create($data);
    }
}
