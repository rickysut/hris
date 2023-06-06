<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use MoonShine\Models\MoonshineUser;
use App\Models\Department;

class DepartmentPolicy
{
    use HandlesAuthorization;

    public function viewAny(MoonshineUser $user)
    {
        return true;
    }

    public function view(MoonshineUser $user, Department $model)
    {
        return true;
    }

    public function create(MoonshineUser $user)
    {
        return true;
    }

    public function update(MoonshineUser $user, Department $model)
    {
        return true;
    }

    public function delete(MoonshineUser $user, Department $model)
    {
        return true;
    }

    public function massDelete(MoonshineUser $user)
    {
        return true;
    }

    public function restore(MoonshineUser $user, Department $model)
    {
        return true;
    }

    public function forceDelete(MoonshineUser $user, Department $model)
    {
        return true;
    }
}
