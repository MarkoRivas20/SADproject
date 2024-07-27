@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="grid grid-cols-4 gap-4">
        @can('authenticate.partner.index')
            <div class="rounded rounded-lg bg-blue-200 h-32">
                <div class="flex justify-between p-3">
                    <div>
                        <p class="font-semibold mb-1">SOCIOS</p>
                        <p class="text-xl">{{$Partners}}</p>
                    </div>
                    <div></div>
                </div>
                <hr class="bg-blue-300">
                <a class="mt-1 float-right pr-3 cursor-pointer" href="{{route('authenticate.partner.index')}}">
                    <span class="mr-1">Ver Socios</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        @endcan
        @can('authenticate.credit.index')
            <div class="rounded rounded-lg bg-yellow-200 h-32">
                <div class="flex justify-between p-3">
                    <div class="flex-row-reverse">
                        <p class="font-semibold mb-1">CREDITOS</p>
                        <p class="text-xl">{{$Credits}}</p>
                    </div>
                    <div></div>
                </div>
                <hr class="bg-yellow-300">
                <a class="mt-1 float-right pr-3 cursor-pointer" href="{{route('authenticate.credit.index')}}">
                    <span class="mr-1">Ver Creditos</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        @endcan
        @can('authenticate.cdp.index')
            <div class="rounded rounded-lg bg-pink-200 h-32">
                <div class="flex justify-between p-3">
                    <div class="flex-row-reverse">
                        <p class="font-semibold mb-1">PLAZOS FIJOS</p>
                        <p class="text-xl">{{$Cdps}}</p>
                    </div>
                    <div></div>
                </div>
                <hr class="bg-pink-300">
                <a class="mt-1 float-right pr-3 cursor-pointer" href="{{route('authenticate.cdp.index')}}">
                    <span class="mr-1">Ver Plazos Fijos</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        @endcan
        @can('authenticate.document.index')
            <div class="rounded rounded-lg bg-orange-200 h-32">
                <div class="flex justify-between p-3">
                    <div class="flex-row-reverse">
                        <p class="font-semibold mb-1">DOCUMENTOS</p>
                        <p class="text-xl">{{$Documents}}</p>
                    </div>
                    <div></div>
                </div>
                <hr class="bg-orange-300">
            </div>
        @endcan
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="https://cdn.tailwindcss.com"></script>
@stop