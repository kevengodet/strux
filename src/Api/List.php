<?php

namespace Abstractable;

/**
 * An ordered collection of values.
 *
 *   - unstable (input order is not retained)
 *   - not unique
 *   - not associative
 */
interface Liste extends Bag
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
     * @return Liste
     */
    public function add($value);

    /**
     *
     * @param mixed $value
     * @param mixed ..
     *
     * @return Liste
     */
    public function remove($value);

    /**
     *
     * @return boolean
     */
    public function isEmpty();

    /**
     * Removes a random value and returns it
     *
     * @return mixed
     */
    public function pick();

    // Algebra of sets

    /**
     * Returns the set of values including all values from both of these sets.
     *
     * @param Liste|Iterator|array $set
     *
     * @return Liste
     */
    public function union($set);

    /**
     * Returns the set of values that are in both of these sets.
     *
     * @param Liste|Iterator|array $set
     *
     * @return Liste
     */
    public function intersection($set);

    /**
     * Returns the set of values that are in this set, excluding the values that
     * are also in the other set.
     *
     * @param Liste|Iterator|array $set
     *
     * @return Liste
     */
    public function difference($set);

    /**
     * Returns the set of values that are only in one of these sets.
     *
     * @param Liste|Iterator|array $set
     *
     * @return Liste
     */
    public function symmetricDifference($set);

    /**
     * Returns the set of values that are only in one of these sets.
     *
     * @param Liste|Iterator|array $set
     *
     * @return Liste
     */
    public function equals($set);

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
}
