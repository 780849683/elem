<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Addres extends Model
{
    public function member(){
        return $this->belongsTo(Member::class,"member_id");
    }

    public $timestamps = false;
    protected $fillable=['name','tel','provence','city','area','detail_address','member_id'];
}
