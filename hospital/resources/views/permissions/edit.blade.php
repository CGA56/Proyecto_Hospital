@extends('layouts.app')

@section('title', '| Actualizar permisos')

@section('content')
@if (!Auth::user()->hasPermissionTo('Administrar roles y permisos'))
    <meta http-equiv="refresh" content="0";url="/401">
    <script type="text/javascript">
        window.location.href = "/401"
    </script>
@endif

<div class='col-lg-4 col-lg-offset-4'>

    <h1><i class='fa fa-key'></i> Actualizar {{$permission->name}}</h1>
    <br>
    {{ Form::model($permission, array('route' => array('permissions.update', $permission->id), 'method' => 'PUT')) }}{{-- Form model binding to automatically populate our fields with permission data --}}

    <div class="form-group">
        {{ Form::label('name', 'Nombre de permiso:') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>
    <br>
    {{ Form::submit('Actualizar', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

</div>

@endsection