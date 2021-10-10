<?php

namespace ACME\CustomShipping\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Product\Models\Product as ProductBaseModel; 
use ACME\CustomShipping\Contracts\Product as ProductContract;

class Product extends ProductBaseModel implements ProductContract
{
    protected $fillable = ['delivered_cities_ids','def_shipping_cost'];
}