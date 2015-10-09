<?php

namespace Aldente;

use Aldente\Exception\AlreadyInSetException;
use Aldente\Api\Set as SetInterface;

/**
 *
 * @see SetInterface
 */
class Set implements SetInterface
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
}
