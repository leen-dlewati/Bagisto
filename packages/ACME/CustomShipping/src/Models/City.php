<?php

namespace ACME\CustomShipping\Models;

use Illuminate\Database\Eloquent\Model;
use ACME\CustomShipping\Contracts\City as CityContract;

class City extends Model implements CityContract
{
    protected $fillable = [
        'name','country_id'
    ];
}