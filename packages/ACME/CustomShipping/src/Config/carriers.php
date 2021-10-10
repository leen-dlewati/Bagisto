<?php

return [
    'customshipping' => [
        'code'         => 'customshipping',
        'title'        => 'Custom Shipping',
        'description'  => 'Custom Shipping',
        'active'       => true,
        // 'default_rate' => '10',
        // 'type'         => 'per_unit',
        'class'        => 'ACME\CustomShipping\Carriers\CustomShipping',
    ],
];