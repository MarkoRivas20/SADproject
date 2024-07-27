@extends('adminlte::page')

@section('title', 'SAD - Créditos')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Documentos</h1>
        @can('authenticate.document.create')
            
        <a class="btn btn-secondary btn-sm mr-4" href="{{route('authenticate.document.create')}}">Añadir documento</a>
        @endcan
        
    </div>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    @livewire('auth.documents-index')

@stop
