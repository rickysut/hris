<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Alasan;

use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;
use MoonShine\Fields\Number;
use MoonShine\Fields\Text;
use Illuminate\Database\Eloquent\Builder;
use MoonShine\Fields\Checkbox;
use MoonShine\Fields\SwitchBoolean;
use MoonShine\ItemActions\ItemAction;


class AlasanResource extends Resource
{
	public static string $model = Alasan::class;

    public string $titleField = 'code';

    public function title(): string
    {
        return trans('moonshine::ui.resource.alasan');
    }


    public function subTitle(): string
    {
        return trans('moonshine::ui.subtitle.alasan');
    }

    public static bool $withPolicy = true;

    public static array $activeActions = ['show','create','edit','delete'];

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
            Text::make('Kode', 'code', fn($item) => $item->code)->sortable(),
            Text::make('Keterangan', 'description', fn($item) => $item->description)->sortable(),
            Checkbox::make('Potong Cuti', 'cut_leave')->showOnIndex()->hideOnForm(),
            SwitchBoolean::make('Potong Cuti', 'cut_leave', fn($item) => $item->cut_leave)->hideOnIndex()->hideOnDetail(),

        ];
	}

	public function rules(Model $item): array
	{
	    return [];
    }

    public function search(): array
    {
        return ['code','description'];
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
