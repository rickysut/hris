<?php

declare(strict_types=1);

namespace MoonShine\Http\Controllers;

use function back;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;

use MoonShine\Http\Requests\ProfileFormRequest;

class ProfileController extends BaseController
{
    public function store(ProfileFormRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $resultData = [
            config('moonshine.auth.fields.username', 'email') => $data['username'],
            config('moonshine.auth.fields.name', 'name') => $data['name'],
            config('moonshine.auth.fields.email', 'email') => $data['email'],
        ];

        if (isset($data['password']) && $data['password'] !== '') {
            $resultData[config('moonshine.auth.fields.password', 'password')] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        if ($request->hasFile('avatar')) {
            $resultData[config('moonshine.auth.fields.avatar', 'avatar')] = $request->file('avatar')
                ->store('moonshine_users', 'public');
        } else {
            $resultData[config('moonshine.auth.fields.avatar', 'avatar')] = $request->get('hidden_avatar');
        }

        $request->user()->update($resultData);

        return back();
    }
}
