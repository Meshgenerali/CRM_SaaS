<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class BusinessPlusScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $businessId = session('businessId');

        $builder->where(function ($query) use ($businessId) {
            $query->where('business_id', $businessId)
                ->orWhereNull('business_id');
        });
    }
}
