<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Department;

use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;
use MoonShine\Fields\Text;
use Illuminate\Database\Eloquent\Builder;
use MoonShine\ItemActions\ItemAction;

class DepartmentResource extends Resource
{
	public static string $model = Department::class;
    public string $titleField = 'name';

    public function title(): string
    {
        return trans('moonshine::ui.resource.department');
    }

    public function subTitle(): string
    {
        return trans('moonshine::ui.subtitle.department');
    }

    public static bool $withPolicy = true;


    public static array $activeActions = ['show', 'edit', 'delete', 'create'];

    public function query(): Builder
    {
        return parent::query()
            ->withTrashed();
    }

    public function trStyles(Model $item, int $index): string
    {
        if(!empty($item->deleted_at)) {
            return 'background: #ffa1b8;';
        }

        return parent::trStyles($item, $index);
    }

	public function fields(): array
	{
		return [
		    Text::make(trans('moonshine::ui.resource.department'), 'name', fn($item) => $item->name)->sortable(),
        ];
	}

	public function rules(Model $item): array
	{
	    return [];
    }

    public function search(): array
    {
        return ['name'];
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
