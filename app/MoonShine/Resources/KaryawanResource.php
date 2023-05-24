<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Karyawan;
use Illuminate\Database\Eloquent\Builder;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;
use MoonShine\Fields\Checkbox;
use MoonShine\Fields\Number;
use MoonShine\Fields\SwitchBoolean;
use MoonShine\Fields\Text;
use MoonShine\Filters\TextFilter;
use MoonShine\Filters\DateFilter;
use MoonShine\Filters\DateRangeFilter;
use MoonShine\Metrics\ValueMetric;

class KaryawanResource extends Resource
{
	public static string $model = Karyawan::class;

	// public static string $title = 'Karyawan';
    public string $titleField = 'PIN';

    public function title(): string
    {
        return trans('moonshine::ui.resource.employee');
    }

    public function subTitle(): string
    {
        return trans('moonshine::ui.subtitle.employee');
    }

    public static bool $withPolicy = true;
    public static string $orderField = 'PIN';
    public static string $orderType = 'ASC';

    public static array $activeActions = ['show'];

    // public function metrics(): array
    // {
    //     return [
    //         ValueMetric::make('Total Karyawan')
    //             ->value(Karyawan::where('ISAKTIF', '1')->count())
    //     ];
    // }

	public function fields(): array
	{
		return [
		    Text::make('PIN', 'PIN', fn($item) => $item->PIN)->sortable(),
		    Text::make('NIK', 'NIK', fn($item) => $item->NIK)->sortable(),
		    Text::make('Nama', 'NAMA', fn($item) => $item->NAMA)->sortable(),
		    Text::make('Departemen', 'DEPARTEMEN', fn($item) => $item->DEPARTEMEN)->sortable(),
		    Text::make('Sub-Dep', 'SUB', fn($item) => $item->SUB)->sortable(),
		    Text::make('Jabatan', 'Jabatan', fn($item) => $item->Jabatan),
		    Text::make('Kode Cabang', 'KDCABANG', fn($item) => $item->KDCABANG),
            // Number::make('Aktif', 'ISAKTIF', fn($item) => $item->ISAKTIF),
            // SwitchBoolean::make('Aktif', 'ISAKTIF')
            // ->onValue(1) // Active value of a form element
            // ->offValue(0) // Inactive value of a form element
            // ->autoUpdate(false),
            Checkbox::make('Aktif', 'ISAKTIF')
        ];
	}

	public function rules(Model $item): array
	{
	    return [];
    }

    public function search(): array
    {
        return ['PIN', 'NIK', 'NAMA'];
    }

    public function filters(): array
    {
        return [
            TextFilter::make('PIN', 'PIN'),
            TextFilter::make('NIK', 'NIK'),
            TextFilter::make('Nama')
                ->customQuery(fn(Builder $query, $value) => $query->where('NAMA', 'LIKE', "%".$value."%")),
            // DateFilter::make('Tgl. Bergabung', 'alokasiawal'),
            // DateRangeFilter::make('Tgl. Bergabung','alokasiawal')
            //     ->format('YmdHis'),

        ];
    }

    public function actions(): array
    {
        return [
            FiltersAction::make(trans('moonshine::ui.filters')),
        ];
    }
}
