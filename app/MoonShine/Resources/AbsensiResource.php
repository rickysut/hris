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

class AbsensiResource extends Resource
{
	public static string $model = Absensi::class;

	// public static string $title = 'Karyawan';
    public string $titleField = 'PIN';

    public function title(): string
    {
        return trans('moonshine::ui.resource.attendance');
    }

    public function subTitle(): string
    {
        return trans('moonshine::ui.subtitle.attendance');
    }

    public static bool $withPolicy = true;
    public static string $orderField = 'PIN';
    public static string $orderType = 'ASC';

    public static array $activeActions = ['show'];

	public function fields(): array
	{
		return [
            Text::make('Pin', 'PIN', fn($item) => $item->PIN)->sortable(),
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
            TextFilter::make('PIN', 'PIN'),
            DateFilter::make('Tanggal', 'tanggal')
        ];
    }

    public function actions(): array
    {
        return [
            FiltersAction::make(trans('moonshine::ui.filters')),
        ];
    }
}
