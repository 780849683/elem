<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopCate extends Model
{
    public function shops(){
       return $this->hasMany(Shop::class,"cate_id");
    }

    public $timestamps = false;
    protected $fillable=["name","img","status","remember_token"];
}
