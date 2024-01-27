@extends('adminlte::page')

@section('title', 'SAD - Usuarios')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Usuarios</h1>
        <a class="btn btn-secondary btn-sm mr-4" href="{{route('authenticate.user.create')}}">Añadir usuario</a>
        
    </div>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th></th>
                    </tr>
                </thead>
    
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td width="25%">
                                <a class="btn btn-primary btn-sm" href="{{route('authenticate.user.setpass', $user)}}">Setear Contraseña</a>
                                <a class="btn btn-warning btn-sm" href="{{route('authenticate.user.edit', $user)}}">Editar</a>
                                <a class="btn btn-danger btn-sm" href="{{route('authenticate.user.disable', $user)}}">Eliminar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@stop
