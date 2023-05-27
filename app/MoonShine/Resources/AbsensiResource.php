<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Absensi;

use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;
use MoonShine\Fields\Checkbox;
use MoonShine\Fields\Date;
use MoonShine\Fields\Number;
use MoonShine\Filters\DateFilter;
use MoonShine\Filters\TextFilter;
use MoonShine\Fields\Text;
use MoonShine\Fields\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use MoonShine\Filters\BelongsToFilter;
use MoonShine\FormComponents\PermissionFormComponent;
use MoonShine\Models\MoonshineUser;
use MoonShine\Models\MoonshineUserRole;
use Carbon\Carbon;
use MoonShine\QueryTags\QueryTag;
use Illuminate\Support\Facades\Log;
use App\Models\Scopes\CurrentMonthScopes;
use MoonShine\Filters\DateRangeFilter;

class AbsensiResource extends Resource
{
	public static string $model = Absensi::class;


    public string $titleField = 'PIN';

    public function title(): string
    {
        return trans('moonshine::ui.resource.attendance');
    }

    public function subTitle(): string
    {
        return trans('moonshine::ui.subtitle.attendance');
    }

    public static array $with = ['karyawan'];
    public static bool $withPolicy = true;
    public static string $orderField = 'PIN';
    public static string $orderType = 'ASC';

    public static array $activeActions = ['show'];

    public function query(): Builder
    {
        $currentDate = Carbon::now();
        $endDateOfMonth = $currentDate->endOfMonth();
        $EndDate = $endDateOfMonth->format('Y-m-d');


        $dateOf26thLastMonth = $currentDate->subMonthNoOverflow()->setDay(26);
        $StartDate = $dateOf26thLastMonth->format('Y-m-d');
        return parent::query()
            ->whereBetween('tanggal', [$StartDate, $EndDate])->orderBy('tanggal');
    }

    // public function queryTags(): array
    // {
    //     $currentDate = Carbon::now();
    //     $endDateOfMonth = $currentDate->endOfMonth();
    //     $EndDate = $endDateOfMonth->format('Y-m-d');


    //     $dateOf26thLastMonth = $currentDate->subMonthNoOverflow()->setDay(26);
    //     $StartDate = $dateOf26thLastMonth->format('Y-m-d');
    //     //Log::info([$StartDate, $EndDate]);

    //     return [
    //         QueryTag::make(
    //             trans('moonshine::ui.query.attendance_thismonth'), // Tag Title
    //             fn() => Absensi::query()->whereBetween('tanggal', [$StartDate, $EndDate]) // Query builder
    //         )->icon('bookmark'),


    //     ];
    // }

	public function fields(): array
	{
		return [
            // Text::make('Pin', 'PIN', fn($item) => $item->PIN)->sortable(),
            BelongsTo::make('Karyawan', 'karyawan', 'NAMA')
                ->valuesQuery(fn(Builder $query) => $query->where('PIN', 'PIN'))->sortable(),
            Date::make('Tanggal', 'tanggal', fn($item) => $item->tanggal)->format('d-m-Y')->sortable(),
            Date::make('Masuk', 'masuk', fn($item) => $item->masuk)->withTime()->format('H:i')->sortable(),
            Date::make('Pulang', 'pulang', fn($item) => $item->pulang)->withTime()->format('H:i')->sortable(),
            Number::make('Jam Efektif', 'jamefektif', fn($item) => $item->jamefektif)->sortable(),
            Checkbox::make('Terlambat', 'Terlambat'),

        ];
	}

	public function rules(Model $item): array
	{
	    return [];
    }

    public function search(): array
    {
        return ['PIN'];
    }

    public function filters(): array
    {
        return [
            BelongsToFilter::make('Karyawan',  resource: 'NAMA'),
            DateRangeFilter::make('Tanggal', 'tanggal')
        ];
    }

    public function actions(): array
    {
        return [
            FiltersAction::make(trans('moonshine::ui.filters')),
        ];
    }


}
