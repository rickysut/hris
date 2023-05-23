<?php

declare(strict_types=1);

namespace MoonShine\Resources;

use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Filters\TextFilter;
use MoonShine\Models\MoonshineUserRole;
use MoonShine\FormComponents\ChangeLogFormComponent;
use MoonShine\FormComponents\PermissionFormComponent;
use MoonShine\Models\MoonshineUser;
use MoonShine\Traits\Resource\WithUserPermissions;

class MoonShineUserRoleResource extends Resource
{
    use WithUserPermissions;

    public static string $model = MoonshineUserRole::class;

    public string $titleField = 'name';

    protected static bool $system = true;

    protected bool $createInModal = true;

    protected bool $editInModal = false;

    public function title(): string
    {
        return trans('moonshine::ui.resource.role');
    }

    public function fields(): array
    {
        return [
            Block::make(trans('moonshine::ui.resource.main_information'), [
                ID::make()
                    ->sortable()
                    ->showOnExport(),

                Text::make(trans('moonshine::ui.resource.role_name'), 'name')
                    ->required()
                    ->showOnExport(),
            ]),
        ];
    }

    public function rules($item): array
    {
        return [
            'name' => ['required', 'min:5'],
        ];
    }

    public function search(): array
    {
        return ['id', 'name'];
    }

    public function filters(): array
    {
        return [
            TextFilter::make(trans('moonshine::ui.resource.role_name'), 'name'),
        ];
    }

    public function actions(): array
    {
        return [];
    }


    public function components(): array
    {
        return [
            PermissionFormComponent::make('Permissions')
                // ->canSee(fn ($user) => $user->moonshine_user_role_id === MoonshineUserRole::DEFAULT_ROLE_ID),
                ->canSee(fn ($user) => auth()->user()->moonshine_user_role_id === MoonshineUserRole::DEFAULT_ROLE_ID),

            ChangeLogFormComponent::make('Change log')
                // ->canSee(fn ($user) => $user->moonshine_user_role_id === MoonshineUserRole::DEFAULT_ROLE_ID),
                ->canSee(fn ($user) => auth()->user()->moonshine_user_role_id === MoonshineUserRole::DEFAULT_ROLE_ID),
        ];
    }
}
