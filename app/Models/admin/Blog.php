<?php

namespace App\Models\admin;

use App\Models\admin\Users;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = "blogs";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $attributes = [];

    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";
    protected $fillable = [
        'title',
        'image',
        'views',
        'user_id',
        'blog_id',
        'short_description',
        'description',
        'created_at',
        'updated_at'
    ];
    public function postAdd($data)
    {
        return Blog::create($data);
    }

    public static function postEdit($id,$data){
        return Blog::where('id',$id)->update($data);
    }

    public function User() {
        return $this->belongsTo(Users::class, 'user_id');
    }

}
