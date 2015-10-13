<?php

namespace Aldente\Api;

/**
 * A FILO collection of ordered values.
 *
 *   - stable
 *   - sorted
 *   - not associative
 */
interface Stack extends \Countable, \IteratorAggregate
{
    // Stack operations

    /**
     * Pushes value(s) on the top of the Stack
     *
     * @param mixed $value
     * @param mixed ..
     *
     * @return Stack
     */
    public function push($value/*[, $value[, ..]]*/);

    /**
     * Pushes a collection of values on the top of the Stack
     *
     * @param iterable $values
     *
     * @return Stack
     */
    public function pushAll($values);

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
    public function pop($quantity = 1);

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
     * @return Stack
     */
    public function clear();
}
