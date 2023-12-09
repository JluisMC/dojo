<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = "client";
    protected $fillable = ['id','person_id','type_client','scholarship','discipline','start',
        'finish','status','created_at','updated_at'];

    public function Person(){
        return $this->belongsTo('App\Models\Person');
    }
}

