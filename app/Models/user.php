<?php

namespace App\Models;

use App\Http\Controllers\Shop\ShopController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class user extends Authenticatable
{
    public function shops(){
        return $this->hasMany(shop::class,"user_id");
    }
    protected $hidden = [
        'password', 'remember_token',
    ];
    public $timestamps = false;
    protected $fillable=["name","email","password","status","shop_id","remember_token"];
}
