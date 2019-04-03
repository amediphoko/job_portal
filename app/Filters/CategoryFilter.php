<?php

/**
 * CategoryFilter.php
 * 
 * Responsible for filtering the data based on the category.
 */

namespace App\Filters;

class CategoryFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('category', $value);
    }
}