<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Jabatan;

use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;
use MoonShine\Fields\Text;

class JabatanResource extends Resource
{
	public static string $model = Jabatan::class;

    public function title(): string
    {
        return trans('moonshine::ui.resource.jabatan');
    }

    public function subTitle(): string
    {
        return trans('moonshine::ui.subtitle.jabatan');
    }

    public static bool $withPolicy = true;

    public static array $activeActions = ['show'];

	public function fields(): array
	{
		return [
		    // ID::make()->sortable(),

            Text::make('Jabatan', 'Jabatan', fn($item) => $item->Jabatan)->sortable(),
        ];
	}

	public function rules(Model $item): array
	{
	    return [];
    }

    public function search(): array
    {
        return ['jabatan'];
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
