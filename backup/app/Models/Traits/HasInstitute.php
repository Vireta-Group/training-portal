<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasInstitute
{
    protected static function bootHasInstitute()
    {
        static::addGlobalScope('institute', function (Builder $builder) {
            if (auth()->check()) {
                $table = $builder->getModel()->getTable();
                $builder->where($table.'.institute_id', auth()->user()->institute_id);
            }
        });
    }
}
