<?php

namespace App\Policies;
 
use Illuminate\Auth\Access\HandlesAuthorization;
use MoonShine\Models\MoonshineUser;
use App\Models\Company;

class CompanyPolicy
{
    use HandlesAuthorization;
 
    public function viewAny(MoonshineUser $user)
    {
        return true;
    }
 
    public function view(MoonshineUser $user, Company $model)
    {
        return true;
    }
 
    public function create(MoonshineUser $user)
    {
        return true;
    }
 
    public function update(MoonshineUser $user, Company $model)
    {
        return true;
    }
 
    public function delete(MoonshineUser $user, Company $model)
    {
        return true;
    }
 
    public function massDelete(MoonshineUser $user)
    {
        return true;
    }
 
    public function restore(MoonshineUser $user, Company $model)
    {
        return true;
    }
 
    public function forceDelete(MoonshineUser $user, Company $model)
    {
        return true;
    }
}