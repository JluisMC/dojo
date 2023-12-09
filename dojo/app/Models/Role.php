<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = "role";
    protected $fillable = ['id','name','description','status','created_at','updated_at'];

    public function scopeSearch($query, $type, $search){
        if(($type) && ($search))
        {
            return $query->where($type,'LIKE','%'.$search.'%');
        }
    }

    public function User(){
        return $this->hasOne('App\User');
    }
}
