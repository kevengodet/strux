<?php

namespace Aldente\Api;

/**
 * An unordered collection of values.
 *
 *   - unstable (input order is not retained)
 *   - not unique
 *   - not associative
 */
interface Bag extends \Countable, \IteratorAggregate
{
    // Bag operations

    /**
     *
     * @param mixed $value
     *
     * @return int
     */
    public function multiplicity($value);

    /**
     * Returns the Set of unique members that represent all members in the bag
     *
     * @return Set
     */
    public function toSet();

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
    public function pick($quantity = 1);

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
