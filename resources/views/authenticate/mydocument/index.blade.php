@extends('adminlte::page')

@section('title', 'SAD - Créditos')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Mis Documentos</h1>
        @can('authenticate.mydocument.create')
            
        <a class="btn btn-secondary btn-sm mr-4" href="{{route('authenticate.mydocument.create')}}">Añadir documento</a>
        @endcan
        
    </div>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    @livewire('auth.my-documents-index')

@stop
