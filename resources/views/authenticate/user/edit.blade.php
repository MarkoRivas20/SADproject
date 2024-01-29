@extends('adminlte::page')

@section('title', 'SAD - Usuarios')

@section('content_header')
    <h1>Editar usuario</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::model($user, ['route' => ['authenticate.user.update', $user], 'method' => 'put']) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Nombre') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del usuario']) !!}
                    @error('name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('email', 'Correo electrónico') !!}
                    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el correo electrónico del usuario']) !!}
                    @error('email')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <h3>Listado de Roles</h3>
                @foreach ($roles as $role)
                <div>
                    <label>
                        {!! Form::checkbox('roles[]',$role->id,null,['class'=>'mr-1']) !!}
                        {{$role->name}}
                    </label>
                </div>
                    
                @endforeach

                @can('authenticate.user.update')
                    
                {!! Form::submit('Actualizar usuario', ['class' => 'btn btn-primary']) !!}
                @endcan
                

            {!! Form::close() !!}
        </div>
    </div>
@stop