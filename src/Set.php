<?php

namespace Aldente;

/**
 *
 * @see SetInterface
 */
class Set implements Api\Set
{
    /**
     *
     * @var array of elements
     */
    protected $elements = array();

    /**
     *
     * @param SetInterface|Iterator|array $values
     */
    public function __construct($values = array())
    {
        foreach ($values as $value) {
            $this->add($value);
        }
    }

    // SetInterface implementation

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
            unset($this->elements[array_search($value, $this->elements)]);;
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
     * Returns a single value if $quantity = 1, or an array if $quantity > 1
     *
     * @param int $quantity How many elements to pick
     *
     * @return int|array
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

        return $quantity == 1 ? reset($values) : $values;
    }

    /**
     * Returns the set of values including all values from both of these sets.
     *
     * @param SetInterface|Iterator|array $set
     *
     * @return SetInterface
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
     * @param SetInterface|Iterator|array $set
     *
     * @return SetInterface
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
     * @param SetInterface|Iterator|array $set
     *
     * @return SetInterface
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
     * @param SetInterface|Iterator|array $set
     *
     * @return SetInterface
     */
    public function symmetricDifference($set);

    /**
     * Returns the set of values that are only in one of these sets.
     *
     * @param SetInterface|Iterator|array $set
     *
     * @return SetInterface
     */
    public function equals($set);

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
