<?php

/**
 * StatusFilter.php
 * 
 * Responsible for filtering the data based on the status.
 */

namespace App\Filters;

class StatusFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('status', $value);
    }
}