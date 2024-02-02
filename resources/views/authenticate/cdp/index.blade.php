@extends('adminlte::page')

@section('title', 'SAD - CDP')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>CDPs</h1>
        @can('authenticate.cdp.create')
            
        <a class="btn btn-secondary btn-sm mr-4" href="{{route('authenticate.cdp.create')}}">Añadir CDP</a>
        @endcan
        
    </div>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    @livewire('auth.cdps-index')

@stop
