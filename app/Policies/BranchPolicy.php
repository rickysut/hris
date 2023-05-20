<?php

namespace App\Policies;
 
use Illuminate\Auth\Access\HandlesAuthorization;
use MoonShine\Models\MoonshineUser;
use App\Models\Branch;

class BranchPolicy
{
    use HandlesAuthorization;
 
    public function viewAny(MoonshineUser $user)
    {
        //
    }
 
    public function view(MoonshineUser $user, Post $model)
    {
        //
    }
 
    public function create(MoonshineUser $user)
    {
        //
    }
 
    public function update(MoonshineUser $user, Post $model)
    {
        //
    }
 
    public function delete(MoonshineUser $user, Post $model)
    {
        //
    }
 
    public function massDelete(MoonshineUser $user)
    {
        //
    }
 
    public function restore(MoonshineUser $user, Post $model)
    {
        //
    }
 
    public function forceDelete(MoonshineUser $user, Post $model)
    {
        //
    }
}