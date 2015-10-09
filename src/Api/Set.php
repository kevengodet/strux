<?php

namespace Abstractable;

/**
 * A collection of unique values.
 *
 *   - unstable (input order is not retained)
 *   - unsorted
 *   - not associative
 */
interface Set extends \Countable, \Iterator
{
    // Set operations

    /**
     *
     * @param mixed $value
     *
     * @return boolean
     */
    public function has($value);

    /**
     *
     * @param mixed $value
     * @param mixed ..
     *
     * @return Set
     */
    public function add($value);

    /**
     *
     * @param mixed $value
     * @param mixed ..
     *
     * @return Set
     */
    public function remove($value);

    /**
     *
     * @return boolean
     */
    public function isEmpty();

    /**
     * Removes a random value from the set and returns it
     *
     * @return mixed
     */
    public function pick();

    // Algebra of sets

    /**
     * Returns the set of values including all values from both of these sets.
     *
     * @param Set|Iterator|array $set
     *
     * @return Set
     */
    public function union($set);

    /**
     * Returns the set of values that are in both of these sets.
     *
     * @param Set|Iterator|array $set
     *
     * @return Set
     */
    public function intersection($set);

    /**
     * Returns the set of values that are in this set, excluding the values that
     * are also in the other set.
     *
     * @param Set|Iterator|array $set
     *
     * @return Set
     */
    public function difference($set);

    /**
     * Returns the set of values that are only in one of these sets.
     *
     * @param Set|Iterator|array $set
     *
     * @return Set
     */
    public function symmetricDifference($set);

    /**
     * Returns the set of values that are only in one of these sets.
     *
     * @param Set|Iterator|array $set
     *
     * @return Set
     */
    public function equals($set);

    // Collection pipeline

    /**
     * Returns an array of the respective return values of a callback for each
     * entry in this collection.
     *
     * @param callable $callback
     *
     * @return Set
     */
    public function map($callback);

    /**
     * Returns an array with each value from this collection that passes the
     * given test.
     *
     * @param callable $callback
     *
     * @return Set
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
