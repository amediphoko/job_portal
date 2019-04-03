<?php

/**
 * NameFilter.php
 * 
 * Responsible for filtering the data based on the title.
 */

namespace App\Filters;

class NameFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('title', $value);
    }
}