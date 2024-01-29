@extends('adminlte::page')

@section('title', 'SAD - Roles')

@section('content_header')
    <h1>Añadir nuevo rol</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'authenticate.role.store']) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Nombre') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del rol']) !!}
                    @error('name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <h3>Listado de Permisos</h3>
                @foreach ($permissions as $permission)
                <div>
                    <label>
                        {!! Form::checkbox('permissions[]',$permission->id,null,['class'=>'mr-1']) !!}
                        {{$permission->description}}
                    </label>
                </div>

                @can('authenticate.role.store')
                    
                {!! Form::submit('Añadir rol', ['class' => 'btn btn-primary']) !!}
                @endcan


            {!! Form::close() !!}
        </div>
    </div>
@stop