<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticateable;


class MenuCate extends Authenticateable
{
    public function shop(){
        return $this->belongsTo(Shop::class,"shop_id");
    }

    public function menu(){
        return $this->hasMany(Menu::class,"cate_id");
    }

    public $timestamps = false;
    protected $fillable=["name","num","shop_id","desc","is_select"];
}
