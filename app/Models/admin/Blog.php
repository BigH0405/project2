<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = "blogs";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $attributes = [

    ];

    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";
}
