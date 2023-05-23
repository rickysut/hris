<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Multiplication;

use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;
use MoonShine\Fields\Text;
use MoonShine\Fields\Number;

class MultiplicationResource extends Resource
{
	public static string $model = Multiplication::class;

	public function title(): string
    {
        return trans('moonshine::ui.resource.multiplication');
    }

    public function subTitle(): string
    {
        return trans('moonshine::ui.subtitle.multiplication');
    }

    public static bool $withPolicy = true;

    public static array $activeActions = ['show'];


	public function fields(): array
	{
		return [
		    // ID::make()->sortable(),
            Text::make('Kode', 'KDLEMBUR', fn($item) => $item->KDLEMBUR)->sortable(),
            Text::make('Keterangan', 'NAMALEMBUR', fn($item) => $item->NAMALEMBUR)->sortable(),
            Number::make('Jam1', 'JAM1', fn($item) => $item->JAM1),
            Number::make('Jam2', 'JAM2', fn($item) => $item->JAM2),
            Number::make('Jam3', 'JAM3', fn($item) => $item->JAM3),
            Number::make('Jam4', 'JAM4', fn($item) => $item->JAM4),
            Number::make('Jam5', 'JAM5', fn($item) => $item->JAM5),
            Number::make('Jam6', 'JAM6', fn($item) => $item->JAM6),
            Number::make('Jam7', 'JAM7', fn($item) => $item->JAM7),
            Number::make('Jam8', 'JAM8', fn($item) => $item->JAM8),
            Number::make('Jam9', 'JAM9', fn($item) => $item->JAM9),
            Number::make('Jam10', 'JAM10', fn($item) => $item->JAM10),
            Number::make('Jam11', 'JAM11', fn($item) => $item->JAM11),
            Number::make('Jam12', 'JAM12', fn($item) => $item->JAM12),
            Number::make('Jam13', 'JAM13', fn($item) => $item->JAM13),
            Number::make('Jam14', 'JAM14', fn($item) => $item->JAM14),
            Number::make('Jam15', 'JAM15', fn($item) => $item->JAM15),
            Number::make('Jam16', 'JAM16', fn($item) => $item->JAM16),
        ];
	}

	public function rules(Model $item): array
	{
	    return [];
    }

    public function search(): array
    {
        return ['KDLEMBUR', 'NAMALEMBUR' ];
    }

    public function filters(): array
    {
        return [];
    }

    public function actions(): array
    {
        return [
            FiltersAction::make(trans('moonshine::ui.filters')),
        ];
    }
}
