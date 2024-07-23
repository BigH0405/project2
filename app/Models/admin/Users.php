<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;
    protected $table="users";
    protected $primaryKey = "id";

    public $timestamps = true;

    protected $attributes = [];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
