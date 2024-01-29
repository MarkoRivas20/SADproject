@extends('adminlte::page')

@section('title', 'SAD - Socios')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Socios</h1>
        @can('authenticate.partner.create')
        <a class="btn btn-secondary btn-sm mr-4" href="{{route('authenticate.partner.create')}}">Añadir socio</a>
        @endcan
        
    </div>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    @livewire('auth.partners-index')

@stop
