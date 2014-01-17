<?php

namespace VenkaDB\ODM\Adapter;

use VenkaDB\Architecture\DocumentInterface;

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
 * @package VenkaDB\ODM\Adapter
 * @author Christoph, René Pardon <christoph@renepardon.de>
 * @copyright 2014 by Christoph, René Pardon
 * @license http://www.gnu.org/licenses/lgpl-3.0.txt
 * @version 1.0
 * @link https://github.com/renepardon/VenkaDB
 */
class MongoDB extends AdapterAbstract implements DocumentInterface
{
    /**
     * Initialize Adapter with options and create a connection instance.
     *
     * @param array $options
     */
    public function __construct(array $options = array())
    {
        parent::__construct($options);

        $connectionOptions = sprintf('?%s', http_build_query($this->options['options']));
        $connectionString = sprintf('mongodb://%s/%s',
            implode(',', $this->options['hosts']),
            $connectionOptions
        );

        $this->connection = new \Mongo(
            $connectionString,
            $this->options['options']
        );
    }

    /**
     * Connect current adapter to its corresponding database.
     *
     * @return AdapterInterface
     */
    public function connect()
    {
        if (true === $this->connected) {
            return $this;
        }

        $this->connection->connect();
        $this->connected = $this->connection->connected;
        $this->db = $this->connected ?
            $this->connection->selectDB($this->options['database'])
            : null;

        return $this;
    }

    /**
     * Disconnect adapter from database(s).
     *
     * @return AdapterInterface
     */
    public function disconnect()
    {
        if (true === $this->connected && $this->connection->connected) {
            $this->connection->close();
        }

        $this->db = null;
        $this->connected = false;

        return $this;
    }

    /**
     * Load all elements.
     *
     * @return mixed
     */
    public function fetchAll()
    {
        // TODO: Implement fetchAll() method.
    }

    /**
     * Load an element by its id.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function fetchById($id)
    {
        // TODO: Implement fetchById() method.
    }

    /**
     * Load one or more elements for column by provided key.
     *
     * @param string $column
     * @param int|string $key
     *
     * @return mixed
     */
    public function fetchBy($column, $key)
    {
        // TODO: Implement fetchBy() method.
    }
}