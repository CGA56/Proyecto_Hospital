@extends('layouts.app')

@section('title', '| Consultar médicos')

@section('content')
@if (!Auth::user()->hasPermissionTo('Consultar médico'))
    <meta http-equiv="refresh" content="0";url="/401">
    <script type="text/javascript">
        window.location.href = "/401"
    </script>
@endif

<div class="container">

    <h1>{{ $medico->title }}</h1>
    <hr>
    <p class="lead">{{ $medico->nombre }} </p>
    <hr>
    {!! Form::open(['method' => 'DELETE', 'route' => ['medicos.destroy', $medico->id] ]) !!}
    <a href="{{ url()->previous() }}" class="btn btn-primary">Volver</a>
    @can('Actualizar médico')
    <a href="{{ route('medicos.edit', $medico->id) }}" class="btn btn-info" role="button">Actualizar</a>
    @endcan
    @can('Eliminar médico')
    {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
    @endcan
    {!! Form::close() !!}

</div>

@endsection