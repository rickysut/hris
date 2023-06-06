<?php

namespace App\Policies;

use MoonShine\Models\MoonshineUser;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Subdept;

class SubdeptPolicy
{
    use HandlesAuthorization;

    public function viewAny(MoonshineUser $user)
    {
        return true;
    }

    public function view(MoonshineUser $user, Subdept $model)
    {
        return true;
    }

    public function create(MoonshineUser $user)
    {
        return true;
    }

    public function update(MoonshineUser $user, Subdept $model)
    {
        return true;
    }

    public function delete(MoonshineUser $user, Subdept $model)
    {
        return true;
    }

    public function massDelete(MoonshineUser $user)
    {
        return true;
    }

    public function restore(MoonshineUser $user, Subdept $model)
    {
        return true;
    }

    public function forceDelete(MoonshineUser $user, Subdept $model)
    {
        return true;
    }
}
