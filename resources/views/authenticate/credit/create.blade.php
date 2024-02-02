@extends('adminlte::page')

@section('title', 'SAD - Créditos')

@section('content_header')
    <h1>Añadir nuevo crédito</h1>
@stop

@section('content')
    
    @livewire('auth.credits-create')

@stop

@section('js')
    
    <script src="https://cdn.tailwindcss.com"></script>
@stop