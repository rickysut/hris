<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Holiday;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;
use MoonShine\Fields\BelongsTo;
use MoonShine\Fields\Text;
use MoonShine\Fields\Date;
use MoonShine\Filters\TextFilter;
use Illuminate\Database\Eloquent\Builder;
use MoonShine\ItemActions\ItemAction;

class HolidayResource extends Resource
{
	public static string $model = Holiday::class;

    public string $titleField = 'event_date';

    public static string $orderField = 'event_date';

    public static string $orderType = 'DESC';

    public function title(): string
    {
        return trans('moonshine::ui.resource.holiday');
    }

    public function subTitle(): string
    {
        return trans('moonshine::ui.subtitle.holiday');
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
            Date::make('Tanggal', 'event_date', fn($item) => $item->event_date)->format('d-m-Y')->sortable(),
            Text::make('Keterangan', 'description', fn($item) => $item->description)->sortable(),
            BelongsTo::make('Kode Lembur', 'multiplication', 'name')->searchable(),
        ];
	}

	public function rules(Model $item): array
	{
	    return [];
    }

    public function search(): array
    {
        return ['description'];
    }

    public function filters(): array
    {
        return [
            TextFilter::make('Keterangan')
                ->customQuery(fn(Builder $query, $value) => $query->where('description', 'LIKE', "%".$value."%")),
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
