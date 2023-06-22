<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\SetupPayroll;

use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;
use MoonShine\Fields\Number;
use MoonShine\Fields\Text;

class SetupPayrollResource extends Resource
{
	public static string $model = SetupPayroll::class;

	public static string $title = 'SetupPayrolls';

	public string $titleField = 'name';

    public static string $orderField = 'id';

    public static string $orderType = 'ASC';

    public function title(): string
    {
        return trans('moonshine::ui.resource.setuppayroll');
    }

    public function subTitle(): string
    {
        return trans('moonshine::ui.subtitle.setuppayroll');
    }

    public static bool $withPolicy = true;

    public static array $activeActions = ['show','create','edit','delete'];

    // protected string $itemsView = 'vendor.moonshine.crud.shared.table_karyawan';

    // protected string $formView = 'vendor.moonshine.crud.shared.form_karyawan';
    // protected string $detailView = 'crud.detail-card-karyawan';

    public static int $itemsPerPage = 10; // Number of items per page

    // public static array $with = ['attendance'];




	public function fields(): array
	{
		return [
		    ID::make()->hideOnIndex()->sortable(),
            Text::make('Name', 'name',  fn($item) => $item->name)->sortable(),
            Number::make('Tunj. Masa Kerja', 't_masakerja',fn($item) => $item->t_masakerja),
            Number::make('Tunj. Uang Makan', 't_uangmakan',fn($item) => $item->t_uangmakan),
            Number::make('Tunj. Jabatan', 'tjtt',fn($item) => $item->tjtt),
            Number::make('Tunj. Bensin', 't_bensin',fn($item) => $item->t_bensin),
            Number::make('Tunj. Team', 't_team',fn($item) => $item->t_team),
            Number::make('Pot. BPJS Kesehatan', 'bpjs_kes',fn($item) => $item->bpjs_kes),
            Number::make('Pot. BPJS Tenaga kerja', 'bpjs_naker',fn($item) => $item->bpjs_naker),
            Number::make('Pot. Lain-Lain', 'pot_lain',fn($item) => $item->pot_lain),

        ];
	}

	public function rules(Model $item): array
	{
	    return [];
    }

    public function search(): array
    {
        return ['id'];
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
