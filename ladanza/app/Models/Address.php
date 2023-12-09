<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address';
    protected $fillable = ['id','person_id','zone','district','street_avenue1','street_avenue2',
                        'description','status','created_at','updated_at'];

}
