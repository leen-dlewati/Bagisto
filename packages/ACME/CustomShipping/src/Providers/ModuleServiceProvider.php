<?php

namespace ACME\CustomShipping\Providers;

use Konekt\Concord\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \ACME\CustomShipping\Models\Product::class
    ];
}