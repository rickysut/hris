<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Absensi;

use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;

class AbsensiResource extends Resource
{
	public static string $model = Absensi::class;

	// public static string $title = 'Karyawan';
    public string $titleField = 'PIN';

    public function title(): string
    {
        return trans('moonshine::ui.resource.absensi');
    }

    public function subTitle(): string
    {
        return trans('moonshine::ui.subtitle.absensi');
    }

    public static bool $withPolicy = true;
    public static string $orderField = 'PIN';
    public static string $orderType = 'ASC';

    public static array $activeActions = ['show'];

	public function fields(): array
	{
		return [
		    // ID::make()->sortable(),
        ];
	}

	public function rules(Model $item): array
	{
	    return [];
    }

    public function search(): array
    {
        return ['id'];
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
