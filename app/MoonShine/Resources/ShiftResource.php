<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Shift;

use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;
use MoonShine\Fields\Date;
use MoonShine\Fields\Number;
use MoonShine\Fields\Text;

class ShiftResource extends Resource
{
	public static string $model = Shift::class;

    public function title(): string
    {
        return trans('moonshine::ui.resource.shift');
    }

    public function subTitle(): string
    {
        return trans('moonshine::ui.subtitle.shift');
    }

    public static bool $withPolicy = true;

    public static array $activeActions = ['show'];

	public function fields(): array
	{
		return [
		    // ID::make()->sortable(),
            Text::make('ID', 'IDShift', fn($item) => $item->IDShift)->sortable(),
            Text::make('Nama', 'NamaShift', fn($item) => $item->NamaShift)->sortable(),
            Date::make('Awal', 'Awal', fn($item) => $item->Awal)->withTime()->format('H:i'),
            Date::make('Akhir', 'Akhir', fn($item) => $item->Akhir)->withTime()->format('H:i'),
            Number::make('Break Lembur', 'BreakLembur', fn($item) => $item->BreakLembur),
            Date::make('Batas Break', 'BatasBreak', fn($item) => $item->BatasBreak)->withTime()->format('H:i'),
            Date::make('Break Out', 'BreakOut', fn($item) => $item->BreakOut)->withTime()->format('H:i'),
            Date::make('Break In', 'BreakIn', fn($item) => $item->BreakIn)->withTime()->format('H:i'),

        ];
	}

	public function rules(Model $item): array
	{
	    return [];
    }

    public function search(): array
    {
        return ['IDShift'];
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
