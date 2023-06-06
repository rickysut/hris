<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Branch;

use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Actions\FiltersAction;
use MoonShine\Models\MoonshineUser;
use Illuminate\Database\Eloquent\Builder;
use MoonShine\ItemActions\ItemAction;

class BranchResource extends Resource
{
	public static string $model = Branch::class;
    public string $titleField = 'name';

    public function title(): string
    {
        return trans('moonshine::ui.resource.branch');
    }

    public function subTitle(): string
    {
        return trans('moonshine::ui.subtitle.branch');
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
            Text::make( trans('moonshine::branch.name'), 'name', fn($item) => $item->name)->sortable(),
            Text::make( trans('moonshine::branch.address'), 'address', fn($item) => $item->address)->sortable(),


        ];
	}

	public function rules(Model $item): array
	{
	    return [

        ];
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
