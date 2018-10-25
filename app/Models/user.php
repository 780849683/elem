<?php

namespace App\Models;

use App\Http\Controllers\Shop\ShopController;
use Illuminate\Database\Eloquent\Model;

class user extends Model
{
    public function shops(){
        return $this->hasMany(shop::class,"user_id");
    }

    public $timestamps = false;
    protected $fillable=["name","email","password","status","shop_id","remember_token"];
}
