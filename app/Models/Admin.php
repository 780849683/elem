<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticateable;

class Admin extends Authenticateable
{
    protected $fillable=['name','password'];

}
