<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Multiplication;

use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;
use MoonShine\Fields\Text;
use MoonShine\Fields\Number;
use Illuminate\Database\Eloquent\Builder;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Grid;
use MoonShine\ItemActions\ItemAction;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Divider;

class MultiplicationResource extends Resource
{
	public static string $model = Multiplication::class;

    public string $titleField = 'code';

    public static string $orderField = 'id';

    public static string $orderType = 'ASC';

    public function title(): string
    {
        return trans('moonshine::ui.resource.multiplication');
    }

    public function subTitle(): string
    {
        return trans('moonshine::ui.subtitle.multiplication');
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
            Text::make('Keterangan', 'name', fn($item) => $item->name)->sortable(),
            Column::make([
                Grid::make([
                    Column::make([
                        Number::make('Jam1', 'h1', fn($item) => $item->h1),
                    ])->columnSpan(2),
                    Column::make([
                        Number::make('Jam2', 'h2', fn($item) => $item->h2),
                    ])->columnSpan(2),
                    Column::make([
                        Number::make('Jam3', 'h3', fn($item) => $item->h3),
                    ])->columnSpan(2),
                    Column::make([
                        Number::make('Jam4', 'h4', fn($item) => $item->h4),
                    ])->columnSpan(2),
                    Column::make([
                        Number::make('Jam5', 'h5', fn($item) => $item->h5),
                    ])->columnSpan(2),
                    Column::make([
                        Number::make('Jam6', 'h6', fn($item) => $item->h6),
                    ])->columnSpan(2),
                ]),
                Grid::make([
                    Column::make([
                        Number::make('Jam7', 'h7', fn($item) => $item->h7),
                    ])->columnSpan(2),
                    Column::make([
                        Number::make('Jam8', 'h8', fn($item) => $item->h8),
                    ])->columnSpan(2),
                    Column::make([
                        Number::make('Jam9', 'h9', fn($item) => $item->h9),
                    ])->columnSpan(2),
                    Column::make([
                        Number::make('Jam10', 'h10', fn($item) => $item->h10),
                    ])->columnSpan(2),
                    Column::make([
                        Number::make('Jam11', 'h11', fn($item) => $item->h11),
                    ])->columnSpan(2),
                    Column::make([
                        Number::make('Jam12', 'h12', fn($item) => $item->h12),
                    ])->columnSpan(2),
                ]),
                Grid::make([
                    Column::make([
                        Number::make('Jam13', 'h13', fn($item) => $item->h13),
                    ])->columnSpan(2),
                    Column::make([
                        Number::make('Jam14', 'h14', fn($item) => $item->h14),
                    ])->columnSpan(2),
                    Column::make([
                        Number::make('Jam15', 'h15', fn($item) => $item->h15),
                    ])->columnSpan(2),
                    Column::make([
                        Number::make('Jam16', 'h16', fn($item) => $item->h16),
                    ])->columnSpan(2),
                ]),

            ])->columnSpan(12),

        ];
	}

	public function rules(Model $item): array
	{
	    return [];
    }

    public function search(): array
    {
        return ['code', 'name' ];
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
