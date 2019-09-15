<?php

namespace App\Filters;

use App\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class UserFilter extends AbstractFilter{

    protected $filters = [
        'email' => EmailFilter::class,
        'status' => StatusFilter::class,
        'first_name' => FirstNameFilter::class,
        'last_name' => LastNameFilter::class
    ];
}