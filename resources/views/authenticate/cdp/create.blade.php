@extends('adminlte::page')

@section('title', 'SAD - CDP')

@section('content_header')
    <h1>Añadir nuevo CDP</h1>
@stop

@section('content')
    
    @livewire('auth.cdps-create')

@stop

@section('js')
    
    <script src="https://cdn.tailwindcss.com"></script>
@stop