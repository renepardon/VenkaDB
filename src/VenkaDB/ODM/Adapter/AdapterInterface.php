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
interface AdapterInterface
{
    /**
     * Connect current adapter to its corresponding database.
     *
     * @return AdapterInterface
     */
    public function connect();

    /**
     * Disconnect adapter from database(s).
     *
     * @return AdapterInterface
     */
    public function disconnect();

    /**
     * Gets last error.
     *
     * @return mixed
     */
    public function getLastError();

    /**
     * Gets last previous error.
     *
     * @return mixed
     */
    public function getPreviousError();

    /**
     * Load all elements.
     *
     * @return mixed
     */
    public function fetchAll();

    /**
     * Load an element by its id.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function fetchById($id);

    /**
     * Load one or more elements for column by provided key.
     *
     * @param string $column
     * @param int|string $key
     *
     * @return mixed
     */
    public function fetchBy($column, $key);
}