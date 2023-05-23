<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Subdept;

use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;
use MoonShine\Fields\Text;

class SubdeptResource extends Resource
{
	public static string $model = Subdept::class;

    public function title(): string
    {
        return trans('moonshine::ui.resource.subdepartment');
    }

    public function subTitle(): string
    {
        return trans('moonshine::ui.subtitle.subdepartment');
    }

    public static bool $withPolicy = true;

    public static array $activeActions = ['show'];


	public function fields(): array
	{
		return [
		    // ID::make()->sortable(),
            Text::make('Departemen', 'NAMADEPT', fn($item) => $item->NAMADEPT)->sortable(),
            Text::make('Nama', 'NAMASUB', fn($item) => $item->NAMASUB)->sortable(),
        ];
	}

	public function rules(Model $item): array
	{
	    return [];
    }

    public function search(): array
    {
        return ['NAMADEPT', 'NAMASUB'];
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
