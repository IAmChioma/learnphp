<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements Authenticatable
{
    //protected $table = 'user2';  if the table name in the migration file is different
    use \Illuminate\Auth\Authenticatable;
    public function posts(){
       return  $this->hasMany('App\Post');
    }

    public  function likes(){
        return $this->hasMany('App\Like');
    }
}
