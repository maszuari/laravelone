<?php
namespace App\Filters;

class LastNameFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('lastname', $value);
    }
}