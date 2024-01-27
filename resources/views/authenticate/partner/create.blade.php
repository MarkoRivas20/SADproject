@extends('adminlte::page')

@section('title', 'SAD - Socios')

@section('content_header')
    <h1>Añadir nuevo socio</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'authenticate.partner.store']) !!}

                <div class="form-group">
                    {!! Form::label('register', 'Registro') !!}
                    {!! Form::text('register', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el Nº de registro del socio']) !!}
                    @error('register')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('name', 'Nombre') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del socio']) !!}
                    @error('name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('document', 'DNI/RUC') !!}
                    {!! Form::text('document', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el DNI/RUC del socio']) !!}
                    @error('document')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                {!! Form::submit('Añadir socio', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop