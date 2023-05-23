<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Alasan;

use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;
use MoonShine\Fields\Number;
use MoonShine\Fields\Text;


class AlasanResource extends Resource
{
	public static string $model = Alasan::class;

    public function title(): string
    {
        return trans('moonshine::ui.resource.alasan');
    }


    public function subTitle(): string
    {
        return trans('moonshine::ui.subtitle.alasan');
    }

    public static bool $withPolicy = true;

    public static array $activeActions = ['show'];

	public function fields(): array
	{
		return [
		    // ID::make()->sortable(),
            Text::make('Kode', 'kdAlasan', fn($item) => $item->kdAlasan)->sortable(),
            Text::make('Keterangan', 'Keterangan', fn($item) => $item->Keterangan)->sortable(),
            Number::make('Potong Cuti', 'potcuti', fn($item) => $item->potcuti),

        ];
	}

	public function rules(Model $item): array
	{
	    return [];
    }

    public function search(): array
    {
        return ['kdAlasan','Keterangan'];
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
