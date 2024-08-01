<?php

namespace App\Models\clients;

use App\Models\admin\BlogCategory;
use App\Models\admin\Comments;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    use HasFactory;
    protected $table="blogs";
    public function User() {
        return $this->belongsTo(Users::class, 'user_id');
    }
    public function BlogCate() {
        return $this->belongsTo(BlogCategory::class, 'blog_id');
    }
    public function messege($id) {
        return $this->hasMany(Comments::class,'blog_id');
    }
}
