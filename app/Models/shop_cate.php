<?php

namespace App\Models;

use App\Http\Controllers\Shop\ShopController;
use Illuminate\Database\Eloquent\Model;

class shop_cate extends Model
{
    public function shop(){
        return $this->hasMany(shop::class,"cate_id");
    }

    public $timestamps = false;
    protected $fillable=["name","img","status","remember_token"];

}
