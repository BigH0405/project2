<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;
    
    protected $table="comments";
    protected $primaryKey = "id";

    public $timestamps = true;

    protected $attributes = [];
    public static function postEdit($id,$data){
        return Comments::where('id',$id)->update($data);
    }
    public function User() {
        return $this->belongsTo(Users::class, 'user_id');
    }
        public function Blog() {
        return $this->belongsTo(Blog::class, 'blog_id');
    }
}
