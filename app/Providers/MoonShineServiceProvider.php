<?php

namespace App\Providers;

use App\MoonShine\Resources\BranchResource;
use Illuminate\Support\ServiceProvider;
use MoonShine\MoonShine;
use MoonShine\Menu\MenuGroup;
use MoonShine\Menu\MenuItem;
use MoonShine\Resources\MoonShineUserResource;
use MoonShine\Resources\MoonShineUserRoleResource;
use MoonShine\Models\MoonshineUserRole;


class MoonShineServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        app(MoonShine::class)->menu([
            MenuGroup::make('moonshine::ui.resource.system', [
                MenuItem::make('moonshine::ui.resource.admins_title', new MoonShineUserResource())
                    ->translatable()
                    ->icon('users'),
                MenuItem::make('moonshine::ui.resource.role_title', new MoonShineUserRoleResource())
                    ->translatable()
                    ->icon('bookmark'),
                
            ])
            ->translatable()
            ->canSee(fn ($user) => auth()->user()->moonshine_user_role_id === MoonshineUserRole::DEFAULT_ROLE_ID),
            
            
            
            MenuItem::make('Company', new CompanyResource())
                        ->translatable()
                        ->icon('heroicons.outline.building-office'),
            
            MenuItem::make('Branch', new BranchResource())
                        ->translatable()
                        ->icon('heroicons.outline.building-library'),
            
            // MenuItem::make('Branch', new BranchResource())
            //             ->translatable()
            //             ->icon('heroicons.outline.building-library'),
            
        ]);
    }
}
