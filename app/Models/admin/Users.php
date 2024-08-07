<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\Groups;
use App\Models\admin\Blog;
use App\Models\admin\Comments;
use App\Models\admin\Reviews;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class Users extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;
    protected $table="users";
    protected $primaryKey = "id";

    public $timestamps = true;

    protected $attributes = [];

    protected $fillable = [
        'fullname',
        'email',
        'email_verified_at',
        'phone',
        'address',
        'role',
        'group_id',
        'password',
        'remember_token',
        'lastLogin',
        'created_at',
        'updated_at',
    ];

    public function postAdd($data)
    {
        return Users::create($data);
    }
    public static function postEdit($id, $data){
        return Users::where('id', $id)->update($data);
     }
     
    public function Group(){
        return $this->belongsTo(Groups::class, 'group_id');
    }

    public function blogs() {
        return $this->hasMany(Blog::class, 'user_id');
    }

    public function comment(){
        return $this->belongsTo(Comments::class, 'user_id');
    }

    public function review(){
        return $this->belongsTo(Reviews::class, 'user_id');
    }
    
}
