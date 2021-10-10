<?php

namespace ACME\CustomShipping\Repositories;

use Webkul\Core\Eloquent\Repository;

class CustomShippingRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'ACME/CustomShipping/Contracts/CustomShipping';
    }
}