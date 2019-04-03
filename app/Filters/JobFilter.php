<?php

/**
 * class JobFilter.php
 */

 namespace App\Filters;

 use App\Filters\AbstractFilter;
 use Illuminate\Database\Eloquent\Builder;

 class JobFilter extends AbstractFilter
 {
     protected $filters = [
         'category' => CategoryFilter::class,
         'type' => TypeFilter::class,
         'title' => NameFilter::class,
     ];
 }