<?php

namespace Aldente;

/**
 * A FIFO collection of ordered values.
 */
final class Queue implements Api\Queue
{
    /**
     *
     * @var array of elements
     */
    private $elements = array();

    /**
     *
     * @param iterable $values
     */
    public function __construct($values = array())
    {
        $this->enqueueAll($values);
    }

    // Queue operations

    /**
     * Enqueues value(s) at the back of the Queue
     *
     * @param mixed $value
     * @param mixed ..
     *
     * @return Queue
     */
    public function enqueue($value/*[, $value[, ..]]*/)
    {
        array_unshift($this->elements, $value);

        return $this;
    }

    /**
     * Enqueues a collection of values on the top of the Queue
     *
     * @param iterable $values
     *
     * @return Queue
     */
    public function enqueueAll($values)
    {
        foreach ($values as $value) {
            $this->enqueue($value);
        }

        return $this;
    }

    /**
     * Dequeues one or several values from the beginning of the Queue
     *
     * When called without argument, returns a single value, else returns an array.
     * If there is not anough elements in the queue, all the elements are returned
     * without raising any error.
     *
     * @param int $quantity
     *
     * @return mixed
     */
    public function dequeue($quantity = 1)
    {
        if (!func_num_args()) {
            return array_pop($this->elements);
        }

        return array_splice($this->elements, max(0, count($this->elements) - $quantity), $quantity, []);
    }

    /**
     *
     * @return boolean
     */
    public function isEmpty()
    {
        return 0 == count($this->elements);
    }

    // Utilities

    /**
     * Returns an array of each value in this collection.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->elements;
    }

    /**
     * Empties the set of any value
     *
     * @return Stack
     */
    public function clear()
    {
        $this->elements = [];

        return $this;
    }

    // Countable implementation

    /**
     *
     * @return int
     */
    public function count()
    {
        return count($this->elements);
    }

    // IteratorAggregate implementation

    /**
     *
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->elements);
    }
}
