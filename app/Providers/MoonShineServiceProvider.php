<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use MoonShine\MoonShine;
use MoonShine\Menu\MenuGroup;
use MoonShine\Menu\MenuItem;
// use MoonShine\Resources\MoonShineUserResource;
use MoonShine\Resources\MoonShineUserRoleResource;
use MoonShine\Models\MoonshineUserRole;
use App\MoonShine\Resources\BranchResource;
use App\MoonShine\Resources\CompanyResource;
use App\MoonShine\Resources\DepartmentResource;
use App\MoonShine\Resources\SubdeptResource;
use App\MoonShine\Resources\JabatanResource;
use App\MoonShine\Resources\ShiftResource;
use App\MoonShine\Resources\AlasanResource;
use App\MoonShine\Resources\HolidayResource;
use App\MoonShine\Resources\MultiplicationResource;
use App\MoonShine\Resources\KaryawanResource;
use App\MoonShine\Resources\AbsensiResource;
use App\MoonShine\Resources\MoonShineUserResource;

class MoonShineServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        app(MoonShine::class)->menu([

            MenuGroup::make('moonshine::ui.resource.settings', [
                MenuItem::make('moonshine::ui.resource.company', new CompanyResource())
                            ->translatable()
                            ->icon('heroicons.outline.building-office'),

                MenuItem::make('moonshine::ui.resource.branch', new BranchResource())
                            ->translatable()
                            ->icon('heroicons.outline.building-library'),

                MenuItem::make('moonshine::ui.resource.department', new DepartmentResource())
                            ->translatable()
                            ->icon('heroicons.outline.briefcase'),

                MenuItem::make('moonshine::ui.resource.subdepartment', new SubdeptResource())
                            ->translatable()
                            ->icon('heroicons.outline.chevron-double-right'),

                MenuItem::make('moonshine::ui.resource.jabatan', new JabatanResource())
                            ->translatable()
                            ->icon('heroicons.outline.hashtag'),

                MenuItem::make('moonshine::ui.resource.shift', new ShiftResource())
                            ->translatable()
                            ->icon('heroicons.arrows-right-left'),

                MenuItem::make('moonshine::ui.resource.alasan', new AlasanResource())
                            ->translatable()
                            ->icon('heroicons.outline.pencil-square'),

                MenuItem::make('moonshine::ui.resource.multiplication', new MultiplicationResource())
                            ->translatable()
                            ->icon('heroicons.outline.variable'),

                MenuItem::make('moonshine::ui.resource.holiday', new HolidayResource())
                            ->translatable()
                            ->icon('heroicons.outline.calendar'),


            ])
            ->icon('heroicons.outline.cog-6-tooth')
            ->translatable(),

            MenuItem::make('moonshine::ui.resource.employee', new KaryawanResource())
                    ->translatable()
                    ->icon('heroicons.outline.users'),

            MenuItem::make('moonshine::ui.resource.attendance', new AbsensiResource())
                    ->translatable()
                    ->icon('heroicons.calendar-days'),


            MenuItem::make('moonshine::ui.resource.admins_title', new MoonShineUserResource())
                    ->translatable()
                    ->icon('users')
                    ->canSee(fn ($user) => auth()->user()->moonshine_user_role_id === MoonshineUserRole::DEFAULT_ROLE_ID),



        ]);
    }
}
