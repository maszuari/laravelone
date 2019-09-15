<?php
namespace App\Filters;

class LastNameFilter
{
    public function filter($builder, $value)
    {
        return $builder->where('last_name', $value);
    }
}