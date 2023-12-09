<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'Roles';
    protected $fillable = ['id','name','description','permissions','status','created_at','updated_at'];

    public function user(){
        return $this->belongsToMany('App\Models\User')->withTimestamps();
    }
}
