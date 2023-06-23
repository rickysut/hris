<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\PayrollEmployee;

use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;
use MoonShine\Fields\BelongsTo;
use MoonShine\Fields\NoInput;
use MoonShine\Fields\Number;
use MoonShine\Fields\Select;
use MoonShine\Fields\Text;
use App\MoonShine\Resources\KaryawanResource;

class PayrollEmployeeResource extends Resource
{
	public static string $model = PayrollEmployee::class;

	public static string $title = 'Employee Payroll';

	public string $titleField = 'name';

    public static string $orderField = 'id';

    public static string $orderType = 'ASC';

    public function title(): string
    {
        return trans('moonshine::ui.resource.payemployee');
    }

    public function subTitle(): string
    {
        return trans('moonshine::ui.subtitle.payemployee');
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
        $resourceItem = ($this->getItem()->employee_id ?? 0);
        $url = '/resource/karyawan-resource/' . $resourceItem;

        $setupId = ($this->getItem()->setup_payroll_id ?? 0);
        $url2 = '/resource/setup-payroll-resource/' . $setupId;
		return [
		    ID::make()->sortable()->hideOnIndex(),
            BelongsTo::make('Nama', 'employee', 'name')->sortable()->searchable(),
            NoInput::make('',  'name', 'name')->link($url, blank: false)->hideOnCreate()->hideOnUpdate(),
            BelongsTo::make('Template', 'setup', 'name')->sortable()->searchable(),
            NoInput::make('',  'name', 'name')->link($url2, blank: false)->hideOnCreate()->hideOnUpdate(),
            Number::make('Gaji Pokok', 'gaji_pokok', fn($item) => $item->gaji_pokok),
            Text::make('Bank', 'bank', fn($item) => $item->bank),
            Text::make('No. Rekening', 'rekening', fn($item) => $item->rekening),
            Text::make('Atas Nama Rek.', 'account_name', fn($item) => $item->account_name),
            Select::make('Cara Bayar', 'cara_bayar')
                ->options([
                    '1' => 'Transfer',
                    '2' => 'Cash'
                ]),
            Select::make('Periode', 'duration')
                ->options([
                    '1' => 'Bulanan',
                    '2' => 'Mingguan',
                ])
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
