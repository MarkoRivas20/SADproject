@extends('adminlte::page')

@section('title', 'SAD - Roles')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Roles</h1>
        @can('authenticate.role.create')
            
        <a class="btn btn-secondary btn-sm mr-4" href="{{route('authenticate.role.create')}}">Añadir rol</a>
        @endcan
        
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
                        <th>Rol</th>
                        <th></th>
                    </tr>
                </thead>
    
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{$role->id}}</td>
                            <td>{{$role->name}}</td>
                            <td width="25%">
                                @can('authenticate.role.edit')
                                    <a class="btn btn-warning btn-sm" href="{{route('authenticate.role.edit', $role)}}">Editar</a>
                                @endcan
                                @can('authenticate.role.disable')
                                    <a class="btn btn-danger btn-sm" href="{{route('authenticate.role.disable', $role)}}">Eliminar</a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@stop
