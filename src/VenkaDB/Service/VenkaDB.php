<?php

namespace VenkaDB\Service;

use VenkaDB\Document\ModelInterface;
use VenkaDB\Document\DocumentInterface;
use VenkaDB\ODM\Adapter\AdapterInterface;
use VenkaDB\TransactionQueue;

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
 * @package VenkaDB\Service
 * @author Christoph, René Pardon <christoph@renepardon.de>
 * @copyright 2014 by Christoph, René Pardon
 * @license http://www.gnu.org/licenses/lgpl-3.0.txt
 * @version 1.0
 * @link https://github.com/renepardon/VenkaDB
 */
class VenkaDB extends TransactionQueue
{
    /**
     * @var AdapterInterface
     */
    protected $adapter;

    /**
     * @var TransactionQueue
     */
    protected $queue;

    /**
     * Service options.
     *
     * @var array
     */
    protected $options = array();

    /**
     * Initialize service with some options.
     *
     * @param array $options
     * @param AdapterInterface $adapter
     * @param TransactionQueue $queue
     */
    public function __construct(array $options, AdapterInterface $adapter = null, TransactionQueue $queue = null)
    {
        $this->options = $options;
        $this->setAdapter($adapter);
        $this->setQueue($queue);
    }

    /**
     * Sets $adapter.
     *
     * @param AdapterInterface $adapter
     *
     * @return VenkaDB
     */
    public function setAdapter(AdapterInterface $adapter = null)
    {
        $this->adapter = $adapter;

        return $this;
    }

    /**
     * Gets $adapter.
     *
     * @return AdapterInterface
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    /**
     * Sets $queue.
     *
     * @param TransactionQueue $queue
     *
     * @return VenkaDB
     */
    public function setQueue(TransactionQueue $queue = null)
    {
        $this->queue = $queue;

        return $this;
    }

    /**
     * Gets $queue.
     *
     * @return TransactionQueue
     */
    public function getQueue()
    {
        return $this->queue;
    }

    /**
     * Call requested method $name on current adapter.
     *
     * @param string $name
     * @param array $arguments
     *
     * @return mixed Returns false on error or the return value of called
     *                       method.
     */
    public function __call($name, $arguments)
    {
        array_unshift($arguments, $this);

        return call_user_func_array(
            array($this->adapter, $name),
            $arguments
        );
    }

    /**
     * Update/Insert provided Model to storage.
     *
     * @param ModelInterface $model
     *
     * @return VenkaDB
     */
    public function persist(ModelInterface $model)
    {
        $command = array(
            'cmd' => (null === $model->getId() ? 'insert' : 'update'),
            'data' => $model->toArray(),
        );
        $this->queue->addCommand($command);

        return $this;
    }

    /**
     * Deletes the provided model from storage.
     *
     * @param ModelInterface $model
     *
     * @return VenkaDB
     * @throws \Exception
     */
    public function remove(ModelInterface $model)
    {
        if (null !== $model->getId() && $model->getId() > 0) {
            $command = array(
                'cmd' => 'delete',
                'data' => $model->toArray()
            );
            $this->queue->addCommand($command);

            return $this;
        }

        throw new \Exception('Data is not available. Deletion not possible.');
    }

    /**
     * Executes all commands from $queue and delete the queue afterwards if all
     * transactions went successful.
     *
     * @return VenkaDB
     */
    public function flush()
    {
        $this->queue->rewind();

        while ($this->queue->next()) {
            $this->getAdapter()->execute($this->queue->current());
        }

        // @todo only purge if all transactions went successfully!!
        $this->queue->purge();

        return $this;
    }
}
