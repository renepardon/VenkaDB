<?php

namespace VenkaDB\Service\Factory;

use VenkaDB\ODM\Adapter\MongoDB as MongoDBAdapter;
use VenkaDB\TransactionQueue;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * ODM Library for different NoSQL databases.
 *
 * PHP version 5
 *
 * LICENSE: LGPL-3.0
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package VenkaDB\Service\Factory
 * @author Christoph, René Pardon <christoph@renepardon.de>
 * @copyright 2014 by Christoph, René Pardon
 * @license http://www.gnu.org/licenses/lgpl-3.0.txt
 * @version 1.0
 * @link https://github.com/renepardon/VenkaDB
 */
class MongoDB implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');
        $options = $config['venkadb'];
        $adapter = new MongoDBAdapter($options['adapters']['MongoDB']);
        $queue = new TransactionQueue();
        $service = new VenkaDB($options, $adapter, $queue);

        if (true === $options['connectOnCreation']) {
            $service->connect();
        }

        return $service;
    }
}
