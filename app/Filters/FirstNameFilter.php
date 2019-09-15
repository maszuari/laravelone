<?php
namespace App\Filters;

class FirstNameFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('first_name', $value);
    }
}