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
use MoonShine\Filters\BelongsToFilter;
use MoonShine\FormComponents\PermissionFormComponent;
use MoonShine\Models\MoonshineUser;
use MoonShine\Models\MoonshineUserRole;
use Carbon\Carbon;
use MoonShine\QueryTags\QueryTag;
use Illuminate\Support\Facades\Log;
use App\Models\Scopes\CurrentMonthScopes;
use MoonShine\Filters\DateRangeFilter;
use MoonShine\ItemActions\ItemAction;
use Illuminate\Database\Eloquent\Builder;
use MoonShine\Fields\NoInput;

class AbsensiResource extends Resource
{
	public static string $model = Absensi::class;

    public string $titleField = 'name';

    public static string $orderField = 'tanggal';

    public static string $orderType = 'DESC';

    public function title(): string
    {
        return trans('moonshine::ui.resource.attendance');
    }

    public function subTitle(): string
    {
        return trans('moonshine::ui.subtitle.attendance');
    }

    public static bool $withPolicy = true;

    public static array $activeActions = ['show', 'create'];


    public function query(): Builder
    {
        // $currentDate = Carbon::now();
        // $endDateOfMonth = $currentDate->endOfMonth();
        // $EndDate = $endDateOfMonth->format('Y-m-d');


        // $dateOf26thLastMonth = $currentDate->subMonthNoOverflow()->setDay(26);
        // $StartDate = $dateOf26thLastMonth->format('Y-m-d');

        $currentDate = Carbon::now()->subMonth();
        $endDateOfMonth = $currentDate->endOfMonth();
        $EndDate = $endDateOfMonth->format('Y-m-d');
        $dateOf26thLastMonth = $currentDate->subMonthNoOverflow()->setDay(26);
        $StartDate = $dateOf26thLastMonth->format('Y-m-d');

        return parent::query()
            ->whereBetween('tanggal', [$StartDate, $EndDate]);
    }


	public function fields(): array
	{
		return [
            // Text::make('Pin', 'PIN', fn($item) => $item->PIN)->sortable(),
            BelongsTo::make('Karyawan', 'karyawan', 'name')->sortable(),
            Date::make('Tanggal', 'tanggal', fn($item) => $item->tanggal)->format('d-m-Y')->sortable(),
            Date::make('Masuk', 'masuk', fn($item) => $item->masuk)->withTime()->format('H:i')->sortable()->hideOnForm(),
            Text::make('Masuk', 'masuk')->mask('99:99')->hideOnIndex()->hideOnDetail(),
            Date::make('Pulang', 'pulang', fn($item) => $item->pulang)->withTime()->format('H:i')->sortable()->hideOnForm(),
            Text::make('Pulang', 'pulang')->mask('99:99')->hideOnIndex()->hideOnDetail(),
            NoInput::make('Total', 'total', fn($item) =>  date( "H:i", strtotime($item->pulang)- strtotime($item->masuk)) )->hideOnForm()  ,
            // Date::make('Keluar istirahat', 'breakout', fn($item) => $item->breakin)->withTime()->format('H:i')->sortable()->hideOnForm(),
            // Text::make('Keluar istirahat', 'breakout')->mask('99:99')->hideOnIndex(),
            // Date::make('Masuk istirahat', 'breakin', fn($item) => $item->breakout)->withTime()->format('H:i')->sortable()->hideOnForm(),
            // Text::make('Masuk istirahat', 'breakin')->mask('99:99')->hideOnIndex(),
        ];
	}

	public function rules(Model $item): array
	{
	    return [];
    }

    public function search(): array
    {
        return ['karyawan_id'];
    }

    public function filters(): array
    {
        return [
            BelongsToFilter::make('Karyawan',  resource: 'name')->searchable(),
            DateRangeFilter::make('Tanggal', 'tanggal')
        ];
    }

    public function actions(): array
    {
        return [
            FiltersAction::make(trans('moonshine::ui.filters')),
        ];
    }

    public function itemActions(): array
    {
        return [
            ItemAction::make('Restore', function (Model $item) {
                $item->restore();
            }, 'Retrieved')
            ->canSee(fn(Model $item) => $item->trashed()),

            ItemAction::make('Trash', function (Model $item) {
                $item->forceDelete();
            }, 'Move to trash')
            ->canSee(fn(Model $item) => $item->trashed())
        ];
    }

}
