<?php

namespace Aldente;

/**
 *
 * @see Api\Set
 */
final class Set implements Api\Set
{
    /**
     *
     * @var array of elements
     */
    private $elements = array();

    /**
     *
     * @param Api\Set|Iterator|array $values
     */
    public function __construct($values = array())
    {
        foreach ($values as $value) {
            $this->add($value);
        }
    }

    // Api\Set implementation

    /**
     *
     * @param scalar $value
     *
     * @return Set
     */
    public function add($value)
    {
        if ($this->has($value)) {
            return $this;
        }

        $this->elements[] = $value;

        return $this;
    }

    /**
     *
     * @param scalar $value
     *
     * @return boolean
     */
    public function has($value)
    {
        return in_array($value, $this->elements);
    }

    /**
     *
     * @param scalar $value
     *
     * @return Set
     */
    public function remove($value)
    {
        if ($this->has($value)) {
            unset($this->elements[array_search($value, $this->elements)]);
        }

        return $this;
    }

    /**
     *
     * @return boolean
     */
    public function isEmpty()
    {
        return 0 == count($this->elements);
    }

    /**
     * Removes random value(s) from the set and returns it
     *
     * Returns a single value if called without argument, or an array else.
     *
     * @param int $quantity How many elements to pick
     *
     * @return mixed
     *
     * @throws \InvalidArgumentException
     * @throws \OutOfBoundsException
     */
    public function pick($quantity = 1)
    {
        if (!is_int($quantity)) {
            throw new \InvalidArgumentException('You can only pick a natural number of values.');
        }

        if ($quantity < 1) {
            throw new \OutOfBoundsException('You can only pick a strictly positive number of values.');
        }

        $values = [];
        foreach (array_rand($this->elements, $quantity) as $key) {
            $values[] = $this->elements[$key];
            unset($this->elements[$key]);
        }

        return func_num_args() ? $values: reset($values);
    }

    /**
     * Returns the set of values including all values from both of these sets.
     *
     * @param Api\Set|Iterator|array $set
     *
     * @return Api\Set
     */
    public function union($set)
    {
        $unionSet = new Set($this);

        foreach ($set as $value) {
            $unionSet->add($value);
        }

        return $unionSet;
    }

    /**
     * Returns the set of values that are in both of these sets.
     *
     * @param Api\Set|Iterator|array $set
     *
     * @return Api\Set
     */
    public function intersection($set)
    {
        $intersectionSet = new Set();

        foreach ($set as $value) {
            if ($this->has($value)) {
                $intersectionSet->add($value);
            }
        }

        return $intersectionSet;
    }

    /**
     * Returns the set of values that are in this set, excluding the values that
     * are also in the other set.
     *
     * @param Api\Set|Iterator|array $set
     *
     * @return Api\Set
     */
    public function difference($set)
    {
        $differenceSet = new Set();

        foreach ($this as $value) {
            if ($set->has($value)) {
                $differenceSet->add($value);
            }
        }

        return $differenceSet;
    }

    /**
     * Returns the set of values that are only in one of these sets.
     *
     * @param Api\Set|Iterator|array $set
     *
     * @return Api\Set
     */
    public function symmetricDifference($set)
    {
        return $this->union($set)->
                      difference($this->intersection($set));
    }

    /**
     * Returns the set of values that are only in one of these sets.
     *
     * @param Api\Set|Iterator|array $set
     *
     * @return Api\Set
     */
    public function equals($set)
    {
        return 0 == $this->symmetricDifference($set);
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

    // Collection pipeline

    /**
     * Maps all values in the Set with the callback
     *
     * @param callable $callback
     *
     * @return Set
     */
    public function map($callback)
    {
        return new Set(array_map($callback, $this->elements));
    }

    /**
     * Keep each value from this collection that passes the given test
     *
     * @param callable $callback
     *
     * @return Set
     */
    public function select($callback)
    {
        return new Set(array_filter($this->elements, $callback));
    }

    /**
     * Aggregates every value in this collection with the result collected up to
     * that index.
     *
     * @param callable $callback
     * @param mixed $basis
     *
     * @return mixed
     */
    public function reduce($callback, $basis = null)
    {
        return array_reduce($this->elements, $callback, $basis);
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
     * Empties the Set of any value
     *
     * @return Set
     */
    public function clear()
    {
        $this->elements = [];
    }
}
