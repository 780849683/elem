<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticateable;

class ShopCate extends Authenticateable
{
    public function shops(){
       return $this->hasMany(Shop::class,"cate_id");
    }

    public $timestamps = false;
    protected $fillable=["name","img","status","remember_token"];
}
