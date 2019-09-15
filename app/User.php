<?php

namespace App;

use App\Filters\UserFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class User extends Model
{
    protected $fillable = ['email','first_name','last_name','status'];

    public function scopeFilter(Builder $builder, $request)
    {
        return (new UserFilter($request))->filter($builder);
    }
}
