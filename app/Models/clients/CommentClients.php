<?php

namespace App\Models\clients;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentClients extends Model
{
    use HasFactory;

    protected $table="comments";
    protected $primaryKey = "id";

    public $timestamps = true;

    protected $attributes = [];
    public function User() {
        return $this->belongsTo(Users::class, 'user_id');
    }
        public function Blog() {
        return $this->belongsTo(Blogs::class, 'blog_id');
    }
}
