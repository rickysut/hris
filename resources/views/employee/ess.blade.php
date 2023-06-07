@extends("moonshine::layouts.login")

@section('content')
    <div class="authentication" xmlns:x-slot="http://www.w3.org/1999/html">
        <div class="authentication-logo">
            <a href="/" rel="home">
                <img class="h-16"
                     src="{{ config('moonshine.logo') ?: asset('vendor/moonshine/logo.svg') }}"
                     alt="{{ config('moonshine.title') }}"
                >
            </a>
        </div>
        <div class="authentication-content">
            <div class="authentication-header">
                <h1 class="title">Self Service Portal</h1>
                <p class="description">
                    Silahkan Log in
                </p>
            </div>

            <x-moonshine::form
                class="authentication-form"
                action="{{ route('ess.login') }}"
                method="POST"
                :errors="false"
            >
                <div class="form-flex-col">
                    <x-moonshine::form.input-wrapper
                        name="nomor"
                        label="No. Hape/ Telepon"
                        required
                    >
                        <x-moonshine::form.input
                            id="nomor"
                            type="text"
                            name="nomor"
                            @class(['form-invalid' => $errors->has('nomor')])
                            placeholder="No. Hape / Telepon"
                            required
                            autofocus
                            value="{{ old('nomor') }}"
                            autocomplete="nomor"
                        />
                    </x-moonshine::form.input-wrapper>
                    
                </div>

                <x-slot:button type="submit" class="btn-lg w-full">
                    {{ trans('moonshine::ui.login.login') }}
                </x-slot:button>
            </x-moonshine::form>

            <p class="text-center text-2xs">
                {!! config('moonshine.auth.footer', '') !!}
            </p>

            <div class="authentication-footer">
                
            </div>
        </div>
    </div>
@endsection
