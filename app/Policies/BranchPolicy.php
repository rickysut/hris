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
        return view('moonshine::components.form.index');
    }
 
    public function view(MoonshineUser $user, Branch $model)
    {
        return view('moonshine::components.form.index');
    }
 
    public function create(MoonshineUser $user)
    {
        return view('moonshine::components.form.index');
    }
 
    public function update(MoonshineUser $user, Branch $model)
    {
        return true;
    }
 
    public function delete(MoonshineUser $user, Branch $model)
    {
        return true;
    }
 
    public function massDelete(MoonshineUser $user)
    {
        return true;
    }
 
    public function restore(MoonshineUser $user, Branch $model)
    {
        return true;
    }
 
    public function forceDelete(MoonshineUser $user, Branch $model)
    {
        return true;
    }
}