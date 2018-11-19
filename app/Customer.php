<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    protected $fillable = ['id','code','name','email','password','phone','address','location','google_id','facebook_id','avatar','remember_token','created_at','updated_at'];
}
