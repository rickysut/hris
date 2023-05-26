<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Holiday;
use Illuminate\Database\Eloquent\Builder;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;
use MoonShine\Fields\BelongsTo;
use MoonShine\Fields\Text;
use MoonShine\Fields\Date;
use MoonShine\Filters\TextFilter;

class HolidayResource extends Resource
{
	public static string $model = Holiday::class;

    public string $titleField = 'TGLLIBUR';

    public function title(): string
    {
        return trans('moonshine::ui.resource.holiday');
    }

    public function subTitle(): string
    {
        return trans('moonshine::ui.subtitle.holiday');
    }

    public static array $with = ['kode'];
    public static bool $withPolicy = true;
    public static string $orderField = 'TGLLIBUR';
    public static string $orderType = 'ASC';

    public static array $activeActions = ['show'];

	public function fields(): array
	{
		return [
            Date::make('Tanggal', 'TGLLIBUR', fn($item) => $item->TGLLIBUR)->format('d-m-Y')->sortable(),
            Text::make('Keterangan', 'KETERANGAN', fn($item) => $item->KETERANGAN)->sortable(),
            BelongsTo::make('Kode Lembur', 'kode', 'NAMALEMBUR')
            ->valuesQuery(fn(Builder $query) => $query->where('KDLEMBUR', 'KDLEMBUR'))
        ];
	}

	public function rules(Model $item): array
	{
	    return [];
    }

    public function search(): array
    {
        return ['KETERANGAN'];
    }

    public function filters(): array
    {
        return [
            TextFilter::make('Keterangan')
                ->customQuery(fn(Builder $query, $value) => $query->where('KETERANGAN', 'LIKE', "%".$value."%")),
        ];
    }

    public function actions(): array
    {
        return [
            FiltersAction::make(trans('moonshine::ui.filters')),
        ];
    }
}
