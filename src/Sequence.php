<?php

namespace Aldente;

/**
 * An ordered 0-indexed sequence/list of values.
 *
 * @see Api\Sequence
 */
final class Sequence implements Api\Sequence
{
    /**
     *
     * @var array
     */
    private $elements = [];

    /**
     *
     * @param Api\Sequence|Iterator|array $values
     */
    public function __construct($values = array())
    {
        foreach ($values as $value) {
            $this->append($value);
        }
    }

    // Api\Sequence implementation

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
    public function prepend($value/*[, $value2]*/)
    {
        foreach (func_get_args() as $v) {
            array_unshift($this->elements, $v);
        }

        return $this;
    }

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
    public function append($value/*[, $value2]*/)
    {
        foreach (func_get_args() as $v) {
            array_push($this->elements, $v);
        }

        return $this;
    }

    /**
     * Extends the Sequence by appending another Sequence
     *
     *
     * @param Sequence $sequence
     *
     * @return Sequence
     */
    public function extend(Sequence $sequence)
    {
        $this->elements = array_merge($this->elements, $sequence->toArray());

        return $this;
    }

    /**
     * Inserts an element $value at the given $position
     *
     * @param mixed $value
     * @param int $position
     *
     * @return Sequence
     */
    public function insert($value, $position)
    {
        if (!is_int($position)) {
            throw new \InvalidArgumentException('Sequence $position must be an int.');
        }

        if ($position < 0) {
            throw new \OutOfBoundsException('Sequence position starts at 0.');
        }

        if ($position >= count($this->elements)) {
            throw new \OutOfBoundsException(sprintf('Sequence max position is %d, %d given.', count($this->elements) - 1, $position));
        }

        array_splice($this->elements, $position, 0, [$value]);

        return $this;
    }

    /**
     * Deletes an element at the given $position
     *
     * @param int $position
     *
     * @return Sequence
     */
    public function delete($position)
    {
        if (!is_int($position)) {
            throw new \InvalidArgumentException('Sequence $position must be an int.');
        }

        if ($position < 0) {
            throw new \OutOfBoundsException('Sequence position starts at 0.');
        }

        if ($position >= count($this->elements)) {
            throw new \OutOfBoundsException(sprintf('Sequence max position is %d, %d given.', count($this->elements) - 1, $position));
        }

        array_splice($this->elements, $position, 1, []);

        return $this;
    }

    /**
     * Deletes the element at the given $position and returns it
     *
     * @param int $position
     *
     * @return mixed
     */
    public function remove($position)
    {
        if (!is_int($position)) {
            throw new \InvalidArgumentException('Sequence $position must be an int.');
        }

        if ($position < 0) {
            throw new \OutOfBoundsException('Sequence position starts at 0.');
        }

        if ($position >= count($this->elements)) {
            throw new \OutOfBoundsException(sprintf('Sequence max position is %d, %d given.', count($this->elements) - 1, $position));
        }

        $removed = array_splice($this->elements, $position, 1, []);

        return $removed;
    }

    /**
     * Searches for an element $value and returns its position, or false if it
     * was not found
     *
     * @param mixed $value
     *
     * @return int|false
     */
    public function position($value)
    {
        return array_search($value, $this->elements, true);
    }

    /**
     * Sorts the Sequence
     *
     * @param callable $callback
     *
     * @return Sequence
     */
    public function sort($callback)
    {
        usort($this->elements, $callback);

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
        $this->elements = array_map($callback, $this->elements);

        return $this;
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
        $this->elements = array_filter($this->elements, $callback);

        return $this;
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
