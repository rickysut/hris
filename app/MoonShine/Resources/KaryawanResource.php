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
use MoonShine\Decorations\Button;
use MoonShine\Fields\NoInput;
use Illuminate\Support\Facades\Log;
use MoonShine\Fields\BelongsTo;
use MoonShine\Fields\Date;
use App\Models\Jabatan;
use MoonShine\Fields\BelongsToMany;
use MoonShine\Fields\HasMany;
use MoonShine\ItemActions\ItemAction;



class KaryawanResource extends Resource
{
	public static string $model = Karyawan::class;

	public string $titleField = 'name';

    public static string $orderField = 'name';

    public static string $orderType = 'ASC';

    public function title(): string
    {
        return trans('moonshine::ui.resource.employee');
    }

    public function subTitle(): string
    {
        return trans('moonshine::ui.subtitle.employee');
    }

    public static bool $withPolicy = true;

    public static array $activeActions = ['show','create','edit','delete'];

    protected string $itemsView = 'vendor.moonshine.crud.shared.table_karyawan';

    // protected string $formView = 'vendor.moonshine.crud.shared.form_karyawan';
    protected string $detailView = 'crud.detail-card-karyawan';


    // public static array $with = ['attendance'];

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

        $url = '/resource/absensi-resource/';
		return [

            // NoInput::make('Attendance')->link($url, blank: false),
		    Text::make('Pin', 'pin', fn($item) => $item->pin)
                ->sortable(),

		    Text::make('Nama', 'name', fn($item) => $item->name)->sortable(),
		    Date::make('Masuk tgl', 'start_date', fn($item) => $item->start_date)->format('d/m/Y')->sortable(),
            Date::make('Berhenti tgl', 'end_date', fn($item) => $item->end_date)->format('d/m/Y')->sortable(),
            SwitchBoolean::make('Aktif', 'active')
                ->onValue(1)
                ->offValue(0)
                ->autoUpdate(false),
            BelongsTo::make('Company', 'company', 'name')->hideOnDetail()->sortable()->searchable(),
            BelongsTo::make('Branch', 'branch', 'name' )->hideOnDetail()->sortable()->searchable(),
            BelongsTo::make('Department', 'department', 'name' )->hideOnDetail()->sortable()->searchable(),
            BelongsTo::make('Sub-Department', 'subdept', 'name' )->hideOnDetail()->sortable()->searchable(),
            BelongsTo::make('Position', 'position', 'name' )->hideOnDetail()->sortable()->searchable(),
            BelongsTo::make('Shift', 'shift', 'name' )->hideOnDetail()->sortable()->searchable(),
            // HasMany::make('Attendance', 'attendance', 'masuk')
        ];
	}

	public function rules(Model $item): array
	{
	    return [];
    }

    public function search(): array
    {
        return ['pin',  'name'];
    }

    public function filters(): array
    {
        return [

            TextFilter::make('PIN', 'pin'),
            TextFilter::make('Nama')
                ->customQuery(fn(Builder $query, $value) => $query->where('name', 'LIKE', "%".$value."%")),


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

    public function components(): array
    {
        return [

        ];
    }
}
