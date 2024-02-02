@extends('adminlte::page')

@section('title', 'SAD - Créditos')

@section('content_header')
    <h1>Editar CDP</h1>
@stop

@section('content')
    
    @livewire('auth.cdps-edit', ['cdp' => $cdp])

@stop

@section('js')
    
    <script src="https://cdn.tailwindcss.com"></script>
@stop