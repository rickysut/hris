<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Subdept;
use Illuminate\Database\Eloquent\Builder;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;
use MoonShine\Fields\BelongsTo;
use MoonShine\Fields\Text;
use MoonShine\Filters\BelongsToFilter;
use MoonShine\Filters\TextFilter;
use MoonShine\ItemActions\ItemAction;

class SubdeptResource extends Resource
{
	public static string $model = Subdept::class;

    public string $titleField = 'name';

    public function title(): string
    {
        return trans('moonshine::ui.resource.subdepartment');
    }

    public function subTitle(): string
    {
        return trans('moonshine::ui.subtitle.subdepartment');
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
		    // ID::make()->sortable(),
            BelongsTo::make(trans('moonshine::subdepartment.dept'), 'department', 'name')
            ->sortable()
            ->searchable()
            ->valuesQuery(fn(Builder $query) => $query->where('deleted_at', '=', null)),

            Text::make(trans('moonshine::subdepartment.name'), 'name', fn($item) => $item->name)->sortable(),
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
        return [
            BelongsToFilter::make(trans('moonshine::subdepartment.dept'), 'department', 'name')
            ->searchable()
            ->valuesQuery(fn(Builder $query) => $query->where('deleted_at', '=', null)),
            TextFilter::make(trans('moonshine::subdepartment.name'))
                ->customQuery(fn(Builder $query, $value) => $query->where('name', 'LIKE', "%".$value."%")),


        ];
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
