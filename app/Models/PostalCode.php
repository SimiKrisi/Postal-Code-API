<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostalCode extends Model
{
    public $timestamps = false;
    protected $fillable = ['code']['name']['countyid'];
}
