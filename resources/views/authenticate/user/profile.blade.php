@extends('adminlte::page')

@section('title', 'SAD - Perfil')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Perfil</h1>
    </div>
@stop

@section('content')
<div class="mb-4">
    
                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                    <div class="mt-10 sm:mt-0">
                        @livewire('profile.update-password-form')
                    </div>
    
                    <x-section-border />
                @endif
    
                @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                    <div class="mt-10 sm:mt-0">
                        @livewire('profile.two-factor-authentication-form')
                    </div>
    
                    <x-section-border />
                @endif
    
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.logout-other-browser-sessions-form')
                </div>

</div>

@stop
@section('js')
    
    <script src="https://cdn.tailwindcss.com"></script>
@stop

