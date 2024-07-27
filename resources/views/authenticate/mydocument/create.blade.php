@extends('adminlte::page')

@section('title', 'SAD - Créditos')

@section('content_header')
    <h1>Añadir nuevo documento</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">
        {!! Form::open(['route' => 'authenticate.mydocument.store','files' => true]) !!}

            <div class="form-group">
                {!! Form::label('name', 'Nombre') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del archivo']) !!}
                @error('name')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                {!! Form::label('document', 'Documento') !!}
                <br>
                {!! Form::file('document') !!}
                @error('document')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <hr>

            <h5>Compartir con:</h5>
                @foreach ($users as $user)
                    @if ($user->id != auth()->id())
                        <div>
                            <label>
                                {!! Form::checkbox('users[]',$user->id,null,['class'=>'mr-1']) !!}
                                {{$user->name}}
                            </label>
                        </div>
                    @endif
                    
                @endforeach

            @can('authenticate.mydocument.store')
                
            {!! Form::submit('Añadir documento', ['class' => 'btn btn-primary mt-4']) !!}
            @endcan

        {!! Form::close() !!}
    </div>
</div>
    
@stop
