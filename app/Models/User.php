<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    public function shop(){
        return $this->hasMany(Shop::class,"user_id");
    }

    protected $hidden = [
        'password', 'remember_token',
    ];
    public $timestamps = false;
    protected $fillable=["name","email","password","status","shop_id","remember_token"];
}
