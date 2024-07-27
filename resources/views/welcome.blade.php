<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SAD - Cuajone</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <script src="https://cdn.tailwindcss.com"></script>
        <style>
        
        </style>
    </head>
    <body>

        <div class="lg:grid lg:grid-cols-3">
            <div class="lg:mx-3">
                <x-authentication-card>
                    <x-slot name="logo">
                        <span class="text-4xl font-semibold">Bienvenido</span>
                    </x-slot>

                    <x-validation-errors class="mb-4" />
            
                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ session('status') }}
                        </div>
                    @endif
            
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
            
                        <div>
                            <x-label for="email" value="{{ __('Email') }}" />
                            <x-input id="email" class="block mt-1 w-full h-9 border focus:border-blue-500 focus:ring-blue-500" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        </div>
            
                        <div class="mt-4">
                            <x-label for="password" value="{{ __('Password') }}" />
                            <x-input id="password" class="block mt-1 w-full h-9 border focus:border-blue-500 focus:ring-blue-500"  type="password" name="password" required autocomplete="current-password" />
                        </div>
            
                        <div class="block mt-4">
                            <label for="remember_me" class="flex items-center">
                                <x-checkbox id="remember_me" name="remember" />
                                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                            </label>
                        </div>
            
                        <div class="flex items-center justify-end mt-4">
                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif
            
                            <x-button class="ms-4">
                                {{ __('Log in') }}
                            </x-button>
                        </div>
                    </form>
                </x-authentication-card>
            </div>
            <div class="hidden lg:flex lg:col-span-2 h-screen  items-center" style="background-image: url('/storage/images/fondo2.png'); 
            background-position: center center; 
            background-repeat: no-repeat; 
            background-size: cover; 
            background-color: #464646; ">

                <img src="{{url('/storage/images/logo2.png')}}" class="m-auto opacity-50 h-20"  alt="">
            </div>

        </div>
        
    </body>
</html>
