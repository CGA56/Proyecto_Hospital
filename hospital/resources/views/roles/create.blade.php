@extends('layouts.app')

@section('title', '| Ingresar roles')

@section('content')
@if (!Auth::user()->hasPermissionTo('Administrar roles y permisos'))
    <meta http-equiv="refresh" content="0";url="/401">
    <script type="text/javascript">
        window.location.href = "/401"
    </script>
@endif
<div class='col-lg-4 col-lg-offset-4'>

    <h1><i class='fa fa-key'></i>Ingresar rol</h1>
    <hr>

    {{ Form::open(array('url' => 'roles')) }}

    <div class="form-group">
        {{ Form::label('name', 'Nombre:') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>

    <h5><b>Asignar permisos</b></h5>

    <div class='form-group'>
        @foreach ($permissions as $permission)
            {{ Form::checkbox('permissions[]',  $permission->id ) }}
            {{ Form::label($permission->name, ucfirst($permission->name)) }}<br>

        @endforeach
    </div>

    {{ Form::submit('Ingresar', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

</div>

@endsection