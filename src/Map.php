<?php

namespace Aldente;

/**
 *
 * @see Api\Map
 */
final class Map implements Api\Map
{
    /**
     *
     * @var array
     */
    private $elements = [];

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

    // Api\Map implementation

    /**
     * Adds a new value corresponding to the $key.
     *
     * If the $key already exists, its $value will be overwritten.
     *
     * @param scalar $key
     * @param mixed $value
     *
     * @return Map
     */
    public function insert($key, $value)
    {
        $this->elements[$key] = $value;

        return $this;
    }

    /**
     * Searches for a $key and return its value if its exists, or $default if not
     *
     * @param scalar $key
     */
    public function lookup($key, $default = null)
    {
        return isset($this->elements[$key]) ? $this->elements[$key] : $default;
    }

    /**
     * Removes the $key and its corresponding value from the Map
     *
     * @param scalar $key
     *
     * @return Map
     */
    public function delete($key)
    {
        unset($this->elements[$key]);

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

    // Collection pipeline

    /**
     * Maps all values in the Map with the callback
     *
     * @param callable $callback
     *
     * @return Map
     */
    public function map($callback)
    {
        $this->elements = array_map($callback, $this->elements);

        return $this;
    }

    /**
     * Keep each value from this Map that passes the given test
     *
     * @param callable $callback
     *
     * @return Map
     */
    public function select($callback)
    {
        $this->elements = array_filter($this->elements, $callback);

        return $this;
    }

    /**
     * Aggregates every value in this Map with the result collected up to
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
