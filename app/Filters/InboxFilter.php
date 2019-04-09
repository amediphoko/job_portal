<?php

/**
 * class InboxFilter.php
 */

 namespace App\Filters;

 use App\Filters\AbstractFilter;
 use Illuminate\Database\Eloquent\Builder;

 class InboxFilter extends AbstractFilter
 {
     protected $filters = [
         'status' => StatusFilter::class,
     ];
 }