@extends('adminlte::page')

@section('title', 'SAD - Créditos')

@section('content_header')
    <h1>Editar crédito</h1>
@stop

@section('content')
    
    @livewire('auth.credits-edit', ['credit' => $credit])

@stop

@section('js')
    
    <script src="https://cdn.tailwindcss.com"></script>
@stop