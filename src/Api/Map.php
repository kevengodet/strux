<?php

namespace Aldente\Api;

/**
 * A collection of associative values with unique keys.
 *
 *   - unstable (input order is not retained)
 *   - unsorted
 *   - associative
 *   - unique keys
 */
interface Map extends \Countable, \IteratorAggregate
{
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
    public function insert($key, $value);

    /**
     * Searches for a $key and return its value if its exists, or $default if not
     *
     * @param scalar $key
     */
    public function lookup($key, $default = null);

    /**
     * Removes the $key and its corresponding value from the Map
     *
     * @param scalar $key
     *
     * @return Map
     */
    public function delete($key);

    /**
     *
     * @return boolean
     */
    public function isEmpty();

    // Collection pipeline

    /**
     * Maps all values in the Set with the callback
     *
     * @param callable $callback
     *
     * @return Set
     */
    public function map($callback);

    /**
     * Keep each value from this collection that passes the given test
     *
     * @param callable $callback
     *
     * @return Set
     */
    public function select($callback);

    /**
     * Aggregates every value in this collection with the result collected up to
     * that index.
     *
     * @param callable $callback
     * @param mixed $basis
     *
     * @return mixed
     */
    public function reduce($callback, $basis = null);

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
     * @return Set
     */
    public function clear();
}
