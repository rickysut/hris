<?php

namespace App\Policies;

use MoonShine\Models\MoonshineUser;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Holiday;

class HolidayPolicy
{
    use HandlesAuthorization;

    public function viewAny(MoonshineUser $user)
    {
        return true;
    }

    public function view(MoonshineUser $user, Holiday $model)
    {
        return true;
    }

    public function create(MoonshineUser $user)
    {
        return true;
    }

    public function update(MoonshineUser $user, Holiday $model)
    {
        return true;
    }

    public function delete(MoonshineUser $user, Holiday $model)
    {
        return true;
    }

    public function massDelete(MoonshineUser $user)
    {
        return true;
    }

    public function restore(MoonshineUser $user, Holiday $model)
    {
        return true;
    }

    public function forceDelete(MoonshineUser $user, Holiday $model)
    {
        return true;
    }
}
