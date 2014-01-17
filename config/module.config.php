<?php

namespace VenkaDB;

use VenkaDB\Service\Factory\MongoDB;
use Zend\ServiceManager\ServiceLocatorInterface;

return array(
    'venkadb' => array(

        /**
         * Should the adapter connect immediately (true) or on first read/write
         * attempt (false)?
         *
         * @var string
         */
        'connectOnCreation' => false,

        /**
         * This array contains adapter configurations.
         * Each key is the same as the corresponding adapter.
         *
         * @var array
         */
        'adapters' => array(

            /**
             * @example mongodb://db1.example.net,db2.example.net:2500/?replicaSet=test
             */
            'MongoDB' => array(
                /**
                 * Username used for database connection.
                 *
                 * @var string
                 */
                'username' => '',

                /**
                 * Password used for database connection.
                 *
                 * @var string
                 */
                'password' => '',

                /**
                 * List of hosts with corresponding Port.
                 *
                 * @example host1:port,host2:port
                 * @var array
                 */
                'hosts' => array(
                    'localhost:27017',
                ),

                /**
                 * Name of the database to use.
                 *
                 * @var string
                 */
                'database' => '',

                /**
                 * Additional connection options for our MongoDB connection.
                 *
                 * @var array
                 */
                'options' => array(

                ),
            ),

        ),
    ),

    'service_manager' => array(
        'factories' => array(
            'VenkaDB\MongoDB' => function(ServiceLocatorInterface $sm) {
                    $factory = new MongoDB();

                    return $factory->createService($sm);
                },
        ),
    ),
);
