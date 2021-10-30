<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Csv extends Model
{
    //
    protected $fillable = ['name','reserved_date','checkin_date','total_price'];
}
