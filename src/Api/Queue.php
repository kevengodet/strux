<?php

namespace Aldente\Api;

/**
 * A FIFO collection of ordered values.
 *
 *   - stable
 *   - sorted
 *   - not associative
 */
interface Queue extends \Countable, \IteratorAggregate
{
    // Queue operations

    /**
     * Enqueues value(s) at the back of the Queue
     *
     * @param mixed $value
     * @param mixed ..
     *
     * @return Queue
     */
    public function enqueue($value/*[, $value[, ..]]*/);

    /**
     * Enqueues a collection of values on the top of the Queue
     *
     * @param iterable $values
     *
     * @return Queue
     */
    public function enqueueAll($values);

    /**
     * Dequeues one or several values from the beginning of the Queue
     *
     * When called without argument, returns a single value, else returns an array
     * If there is not anough elements in the queue, all the elements are returned
     * without raising any error.
     *
     * @param int $quantity
     *
     * @return mixed
     */
    public function dequeue($quantity = 1);

    /**
     *
     * @return boolean
     */
    public function isEmpty();

    // Utilities

    /**
     * Returns an array of each value in this collection.
     *
     * @return array
     */
    public function toArray();

    /**
     * Empties the set of any value
     *
     * @return Queue
     */
    public function clear();
}
