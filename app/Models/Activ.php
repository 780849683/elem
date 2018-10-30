<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticateable;


class Activ extends Authenticateable
{
    public function shop(){
        return $this->belongsTo(Shop::class,"shop_id");
    }

    public $timestamps = false;
    protected $fillable=["title","shop_id","start_time","end_time","content"];
}
