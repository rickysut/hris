<?php

namespace App\Policies;

use App\Models\Jabatan;
use MoonShine\Models\MoonshineUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class JabatanPolicy
{
    use HandlesAuthorization;

    public function viewAny(MoonshineUser $user)
    {
        return true;
    }

    public function view(MoonshineUser $user, Jabatan $model)
    {
        return true;
    }

    public function create(MoonshineUser $user)
    {
        return true;
    }

    public function update(MoonshineUser $user, Jabatan $model)
    {
        return true;
    }

    public function delete(MoonshineUser $user, Jabatan $model)
    {
        return true;
    }

    public function massDelete(MoonshineUser $user)
    {
        return true;
    }

    public function restore(MoonshineUser $user, Jabatan $model)
    {
        return true;
    }

    public function forceDelete(MoonshineUser $user, Jabatan $model)
    {
        return true;
    }
}
