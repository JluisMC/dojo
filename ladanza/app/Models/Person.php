<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = "persons";
    protected $fillable = ['id','type_person','name','last_name','number_document','extension','address_id','phone'
                            ,'avatar','file_image','status','created_at','updated_at']; 

    public function user(){
        return $this->hasOne('App\Models\User');
    }

    public function Address(){
        return $this->hasOne('App\Models\Address');
    }
}
