<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'person';
    protected $fillable = ['id','name','last_name','number_document','phone','avatar','fileImage','type',
        'subscription','status','created_at','updated_at'];

    public function scopeSearch($query, $type, $search){
        if(($type) && ($search))
        {
            return $query->where($type,'LIKE','%'.$search.'%');
        }
    }

    public function Client(){
        return $this->hasOne('App\Models\Client');
    }

    public function User(){
        return $this->hasOne('App\User');
    }
}
