<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Company;

use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;
use MoonShine\Models\MoonshineUser;
use MoonShine\Fields\Text;

class CompanyResource extends Resource
{
	public static string $model = Company::class;
    public string $titleField = 'name';


    public function title(): string
    {
        return trans('moonshine::ui.resource.company');
    }

    public function subTitle(): string
    {
        return trans('moonshine::ui.subtitle.company');
    }

    public static bool $withPolicy = true;

    public static array $activeActions = ['show'];

	public function fields(): array
	{
		return [
		    // ID::make()->sortable(),
            Text::make('Perusahaan', 'Perusahaan', fn($item) => $item->Perusahaan)->sortable(),
            Text::make('Kode Area', 'kodearea', fn($item) => $item->kodearea)->sortable(),
            Text::make('Alamat', 'Alamat', fn($item) => $item->Alamat),
            Text::make('Telpon', 'Telpon', fn($item) => $item->Telpon),
            Text::make('Fax', 'Faksimili', fn($item) => $item->Faksimili),
        ];
	}

	public function rules(Model $item): array
	{
	    return [];
    }

    public function search(): array
    {
        return ['Perusahaan'];
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
