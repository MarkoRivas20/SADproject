@extends('adminlte::page')

@section('title', 'SAD - Créditos')

@section('content_header')
    <h1>Editar documento</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">
        {!! Form::model($mydocument, ['route' => ['authenticate.mydocument.update', $mydocument], 'method' => 'put']) !!}

            <div class="form-group">

                <label>Nombre</label>
                <input class="form-control" type="text" value="{{$mydocument->name}}" disabled>

            </div>

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

            @can('authenticate.mydocument.update')
                
            {!! Form::submit('Actualizar documento', ['class' => 'btn btn-primary mt-4']) !!}
            @endcan

        {!! Form::close() !!}
    </div>
</div>
    
@stop