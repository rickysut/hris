<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use App\Models\Absensi;
use Illuminate\Support\Carbon;

class CurrentMonthScopes implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $currentDate = Carbon::now();
        $endDateOfMonth = $currentDate->endOfMonth();
        $EndDate = $endDateOfMonth->format('Y-m-d');


        $dateOf26thLastMonth = $currentDate->subMonthNoOverflow()->setDay(26);
        $StartDate = $dateOf26thLastMonth->format('Y-m-d');

        Absensi::query()->whereBetween('tanggal', [$StartDate, $EndDate]);
    }
}
