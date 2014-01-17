<?php

namespace VenkaDB\ODM\Adapter;

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
abstract class AdapterAbstract implements AdapterInterface
{
    /**
     * Flag to check if current adapter is connected to the database.
     *
     * @var bool
     */
    protected $connected = false;

    /**
     * The current connection to our database.
     *
     * @var null|Resource
     */
    protected $connection = null;

    /**
     * Contains the current DB.
     *
     * @var \MongoDB|...
     */
    protected $db = null;

    /**
     * Some adapter specific options.
     *
     * @var array
     */
    protected $options = array();

    /**
     * Initialize the adapter with some options if needed.
     *
     * @param array $options
     */
    public function __construct(array $options = array())
    {
        $this->options = $options;
    }

    /**
     * Gets last error.
     *
     * @return array|mixed|null
     */
    public function getLastError()
    {
        if (true === $this->connected) {
            return $this->db->lastError();
        }

        return null;
    }

    /**
     * Gets last previous error.
     *
     * @return array|mixed|null
     */
    public function getPreviousError()
    {
        if (true === $this->connected) {
            return $this->db->prevError();
        }

        return null;
    }

    final public function __toString()
    {
        // TODO: Implement __toString() method.
    }
}