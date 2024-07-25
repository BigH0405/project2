<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\Blog;

class BlogCategory extends Model
{
    use HasFactory;
    protected $table = "blog_category";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $attributes =[

    ];

    protected $fillable = [
        'name',
        'short_description'
    ];
    public function postAdd($data){
        return BlogCategory::create($data);
    }
}
