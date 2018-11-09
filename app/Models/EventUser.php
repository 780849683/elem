<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventUser extends Model
{
    public $fillable=["created_at","updated_at","event_id","user_id"];
}
