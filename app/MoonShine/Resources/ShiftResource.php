<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Shift;

use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;
use MoonShine\Fields\Date;
use MoonShine\Fields\Number;
use MoonShine\Fields\Text;
use Illuminate\Database\Eloquent\Builder;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Flex;
use MoonShine\Decorations\Grid;
use MoonShine\Fields\Checkbox;
use MoonShine\ItemActions\ItemAction;

class ShiftResource extends Resource
{
	public static string $model = Shift::class;

    public string $titleField = 'code';

    public static string $orderField = 'id';
    public static string $orderType = 'ASC';

    public function title(): string
    {
        return trans('moonshine::ui.resource.shift');
    }

    public function subTitle(): string
    {
        return trans('moonshine::ui.subtitle.shift');
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
            Column::make([
                Block::make('Umum',[
                    Column::make([
                        Grid::make([
                            Column::make([
                                Text::make('Code', 'code', fn($item) => $item->code)->sortable(),
                            ])->columnSpan(6),
                            Column::make([
                                Text::make('Nama', 'name', fn($item) => $item->name)->sortable(),
                            ])->columnSpan(6),
                        ]),

                        Grid::make([
                            Column::make([
                                Date::make('Masuk', 'start', fn($item) => $item->start)->withTime()->format('H:i')
                                ->hideOnForm()->showOnIndex(),
                                Text::make('Masuk', 'start', fn($item) => $item->start)->mask('99:99')->hideOnIndex()->hideOnDetail(),
                            ])->columnSpan(6),
                            Column::make([
                                Date::make('Pulang', 'stop', fn($item) => $item->stop)->withTime()->format('H:i')
                                ->hideOnForm()->showOnIndex(),
                                Text::make('Pulang', 'stop', fn($item) => $item->stop)->mask('99:99')->hideOnIndex()->hideOnDetail(),
                            ])->columnSpan(6),
                        ]),
                    ]),
                ]),
                Block::make('Absen saat istirahat',[
                    Checkbox::make('Absen istrahat', 'use_break', fn($item) => $item->use_break),

                    Grid::make([
                        Column::make([
                            Date::make('Start Istirahat', 'breakstart', fn($item) => $item->breakstart)->withTime()->format('H:i')
                        ->hideOnForm(),
                        Text::make('Start Istirahat', 'breakstart', fn($item) => $item->breakstart)->mask('99:99')->hideOnIndex()->hideOnDetail(),
                        ])->columnSpan(6),
                        Column::make([
                            Date::make('Selesai Istirahat', 'breakstop', fn($item) => $item->breakstop)->withTime()->format('H:i')
                        ->hideOnForm(),
                        Text::make('Selesai Istirahat', 'breakstop', fn($item) => $item->breakstop)->mask('99:99')->hideOnIndex()->hideOnDetail(),
                        ])->columnSpan(6),
                    ]),


                ])
            ])->columnSpan(12),
        ];
	}

	public function rules(Model $item): array
	{
	    return  [
            'start' => ['required', 'date_format:H:i'],
            'stop'  => ['required', 'date_format:H:i'],
            'breakstart' => ['date_format:H:i'],
            'breakstop' => ['date_format:H:i'],
        ];
    }

    public function messages(): array
    {
        return [
            'start' => 'Invalid time value (HH:NN)',
        ];
    }

    public function search(): array
    {
        return ['code', 'name'];
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
