<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticateable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticateable
{
    protected $fillable=['name','password','email'];

    use HasRoles;
    protected $guard_name = 'admin';//使用任何你想要的守卫

}
