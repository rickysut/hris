<?php

namespace App\Policies;

use MoonShine\Models\MoonshineUser;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Multiplication;

class MultiplicationPolicy
{
    use HandlesAuthorization;

    public function viewAny(MoonshineUser $user)
    {
        return true;
    }

    public function view(MoonshineUser $user, Multiplication $model)
    {
        return true;
    }

    public function create(MoonshineUser $user)
    {
        return true;
    }

    public function update(MoonshineUser $user, Multiplication $model)
    {
        return true;
    }

    public function delete(MoonshineUser $user, Multiplication $model)
    {
        return true;
    }

    public function massDelete(MoonshineUser $user)
    {
        return true;
    }

    public function restore(MoonshineUser $user, Multiplication $model)
    {
        return true;
    }

    public function forceDelete(MoonshineUser $user, Multiplication $model)
    {
        return true;
    }
}
