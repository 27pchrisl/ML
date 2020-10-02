<?php

namespace Rubix\ML\Kernels\Distance;

use Stringable;

interface Distance extends Stringable
{
    /**
     * Return the data types that this kernel is compatible with.
     *
     * @return list<\Rubix\ML\DataType>
     */
    public function compatibility() : array;

    /**
     * Compute the distance between two vectors.
     *
     * @param list<string|int|float> $a
     * @param list<string|int|float> $b
     * @return float
     */
    public function compute(array $a, array $b) : float;
}
