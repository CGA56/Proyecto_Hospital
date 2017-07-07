@extends('layouts.app')

@section('title', '| Consultar pacientes')

@section('content')
@if (!Auth::user()->hasPermissionTo('Consultar paciente'))
    <meta http-equiv="refresh" content="0";url="/401">
    <script type="text/javascript">
        window.location.href = "/401"
    </script>
@endif

<div class="container">

    <h1>{{ $paciente->title }}</h1>
    <hr>
    <p class="lead">{{ $paciente->nombre }} </p>
    <hr>
    {!! Form::open(['method' => 'DELETE', 'route' => ['pacientes.destroy', $paciente->id] ]) !!}
    <a href="{{ url()->previous() }}" class="btn btn-primary">Volver</a>
    @can('Actualizar paciente')
    <a href="{{ route('pacientes.edit', $paciente->id) }}" class="btn btn-info" role="button">Actualizar</a>
    @endcan
    @can('Eliminar paciente')
    {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
    @endcan
    {!! Form::close() !!}

</div>

@endsection