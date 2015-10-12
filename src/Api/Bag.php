<?php

namespace Aldente\Api;

/**
 * An unordered collection of values.
 *
 *   - unstable (input order is not retained)
 *   - not unique
 *   - not associative
 */
interface Bag extends Set
{
    /**
     *
     * @param mixed $value
     *
     * @return int
     */
    public function cardinality($value);

    /**
     * Returns the Set of unique members that represent all members in the bag
     *
     * @return Set
     */
    public function uniqueSet();
}
