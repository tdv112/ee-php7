<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'id','code','name','slug','phone_area','phone','facebook','gmail','zalo','twitter','location','address','post_title','post_content','post_type','post_media','customer_code','status','created_at','updated_at'
    ];
}
