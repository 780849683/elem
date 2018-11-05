<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    public function addres(){
        return $this->hasMany(Addres::class,"member_id");
    }

    public function cart(){
        return $this->hasOne(Cart::class,"member_id");
}
     public function orders(){
        return $this->hasMany(Order::class,"member_id");
     }

    public $timestamps = false;
    protected $fillable=['username','password','tel','remember_token'];
}
