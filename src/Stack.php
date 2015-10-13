<?php

namespace Aldente;

/**
 * A FILO collection of ordered values.
 *
 * @see Api\Stack
 */
final class Stack implements Api\Stack
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
        $this->pushAll($values);
    }

    // Stack operations

    /**
     * Pushes value(s) on the top of the Stack
     *
     * @param mixed $value
     * @param mixed ..
     *
     * @return Stack
     */
    public function push($value/*[, $value[, ..]]*/)
    {
        $this->elements[] = $value;

        return $this;
    }

    /**
     * Pushes a collection of values on the top of the Stack
     *
     * @param Traversable $values
     *
     * @return Stack
     */
    public function pushAll($values)
    {
        if (!is_array($values) and !$values instanceof \Traversable) {
            throw new \InvalidArgumentException('You can only use Traversable values in pushAll().');
        }

        foreach ($values as $value) {
            $this->push($value);
        }

        return $this;
    }

    /**
     * Pops one or several values from the top of the Stack
     *
     * When called without argument, returns a single value, else returns an array
     * If there is not anough elements in the Stack, all the elements are returned
     * without raising any error.
     *
     * @param int $quantity
     *
     * @return mixed
     */
    public function pop($quantity = 1)
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
