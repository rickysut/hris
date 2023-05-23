<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Department;

use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;
use MoonShine\Fields\Text;

class DepartmentResource extends Resource
{
	public static string $model = Department::class;

	public static string $title = 'Department';

    public static bool $withPolicy = true;

    public static array $activeActions = ['show'];

	public function fields(): array
	{
		return [
		    Text::make('Department', 'NamaDept', fn($item) => $item->NamaDept)->sortable(),
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
