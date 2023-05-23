<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Branch;

use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Actions\FiltersAction;
use MoonShine\Models\MoonshineUser;

class BranchResource extends Resource
{
	public static string $model = Branch::class;

    public function title(): string
    {
        return trans('moonshine::ui.resource.branch');
    }

    public function subTitle(): string
    {
        return trans('moonshine::ui.subtitle.branch');
    }

    public static bool $withPolicy = true;

    public static array $activeActions = ['show'];

	public function fields(): array
	{
		return [
		    // ID::make()->sortable(),
            Text::make('Kode', 'KDCABANG', fn($item) => $item->KDCABANG)->sortable(),
            Text::make('Alamat', 'ALAMAT', fn($item) => $item->ALAMAT)->sortable(),


        ];
	}

	public function rules(Model $item): array
	{
	    return [

        ];
    }

    public function search(): array
    {
        return ['KDCABANG'];
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
