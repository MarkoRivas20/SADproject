@extends('adminlte::page')

@section('title', 'SAD - Créditos')

@section('content_header')
    <h1>Editar CDP</h1>
@stop

@section('content')
    
    @livewire('auth.cdps-edit', ['cdp' => $cdp])

@stop

@section('js')
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.4/dist/flowbite.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
@stop