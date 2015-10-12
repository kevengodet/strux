<?php

namespace Aldente\Api;

/**
 * An ordered 0-indexed sequence/list of values.
 *
 *   - stable (input order is retained)
 *   - not unique
 *   - not associative
 */
interface Sequence extends \Countable, \IteratorAggregate
{
    // Sequence operations

    /**
     * Prepends element(s) to the Sequence.
     *
     * The first argument will become the first element of the Sequence, the second
     * will be second, ...
     *
     * @param mixed $value List, array, value
     * @param mixed ...
     *
     * @return Sequence
     */
    public function prepend($value/*[, $value2]*/);

    /**
     * Appends element(s) to the Sequence
     *
     * The last argument will become the last element element of the Sequence, the
     *
     *
     * @param mixed $value
     * @param mixed ...
     *
     * @return Sequence
     */
    public function append($value/*[, $value2]*/);

    /**
     * Extends the Sequence by appending another Sequence
     *
     *
     * @param Sequence $sequence
     *
     * @return Sequence
     */
    public function extend(Sequence $sequence);

    /**
     * Inserts an element $value at the given $position
     *
     * @param mixed $value
     * @param int $position
     *
     * @return Sequence
     */
    public function insert($value, $position);

    /**
     * Deletes an element at the given $position
     *
     * @param int $position
     *
     * @return Sequence
     */
    public function delete($position);

    /**
     * Deletes the element at the given $position and returns it
     *
     * @param int $position
     *
     * @return mixed
     */
    public function remove($position);

    /**
     * Searches for an element $value and returns its position, or null if it
     * was not found
     *
     * @param mixed $value
     *
     * @return int|null
     */
    public function position($value);

    /**
     * Sorts the Sequence
     *
     * @param callable $callback
     *
     * @return Sequence
     */
    public function sort($callback);

    /**
     *
     * @return boolean
     */
    public function isEmpty();

    // Collection pipeline

    /**
     * Returns an array of the respective return values of a callback for each
     * entry in this collection.
     *
     * @param callable $callback
     *
     * @return Liste
     */
    public function map($callback);

    /**
     * Returns an array with each value from this collection that passes the
     * given test.
     *
     * @param callable $callback
     *
     * @return Liste
     */
    public function filter($callback);

    /**
     * Aggregates every value in this collection with the result collected up to
     * that index.
     *
     * @param callable $callback
     * @param mixed $basis
     *
     * @return mixed
     */
    public function reduce($callback, $basis);

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
