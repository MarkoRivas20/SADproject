@extends('adminlte::page')

@section('title', 'SAD - Socios')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Socios</h1>
        <a class="btn btn-secondary btn-sm mr-4" href="{{route('authenticate.partner.create')}}">Añadir socio</a>
        
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
