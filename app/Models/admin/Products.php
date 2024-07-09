<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = "products";

    protected $primaryKey = "id";

    public $timestamps = true;

    protected $attributes = [
        
    ];

    const CREATED_AT = 'create_at';
    const UPDATED_AT = 'update_at';
}
