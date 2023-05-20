<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Branch;

use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Actions\FiltersAction;
use MoonShine\Models\MoonshineUser;

class BranchResource extends Resource
{
	public static string $model = Branch::class;

	public static string $title = 'Branch';

    public static bool $withPolicy = true;

    public static array $activeActions = ['create', 'show', 'edit', 'delete']; 

	public function fields(): array
	{
		return [
		    // ID::make()->sortable(),
            Text::make('Name', 'branch_name', fn($item) => $item->branch_name)->sortable(),
            Text::make('Address', 'branch_address', fn($item) => $item->branch_address)->sortable(),
            
 
        ];
	}

	public function rules(Model $item): array
	{
	    return [
            
        ];
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
