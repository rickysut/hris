<?php

namespace App\Policies;

use MoonshineUser;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Absensi;

class AbsensiPolicy
{
    use HandlesAuthorization;

    public function viewAny(MoonshineUser $user)
    {
        return true;
    }

    public function view(MoonshineUser $user, Absensi $model)
    {
        return true;
    }

    public function create(MoonshineUser $user)
    {
        return true;
    }

    public function update(MoonshineUser $user, Absensi $model)
    {
        return true;
    }

    public function delete(MoonshineUser $user, Absensi $model)
    {
        return true;
    }

    public function massDelete(MoonshineUser $user)
    {
        return true;
    }

    public function restore(MoonshineUser $user, Absensi $model)
    {
        return true;
    }

    public function forceDelete(MoonshineUser $user, Absensi $model)
    {
        return true;
    }
}
