<?php

namespace VenkaDB;

return array(
    'venkadb' => array(
        /**
         * This array contains default configuration options for the VenkaDB
         */
        'defaults' => array(
        ),
    ),

    'service_manager' => array(
        'factories' => array(
            'venkadb' => 'VenkaDB\Service\Factory',
        ),
    ),
);
