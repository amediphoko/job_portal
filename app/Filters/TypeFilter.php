<?php

/**
 * TypeFilter.php
 * 
 * Responsible for filtering the data based on the type.
 */

namespace App\Filters;

class TypeFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('type', $value);
    }
}