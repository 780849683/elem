<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public $fillable=["title","content","start_time","end_time","prize_time","num","is_prize"/*,"created_at","updated_at"*/];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function users(){
        return $this->belongsToMany(User::class,"event_users","event_id","user_id");
    }



}
