@extends('layouts.app')

@section('title', '| Ingresar usuarios')

@section('content')
@if (!Auth::user()->hasPermissionTo('Ingresar usuario'))
    <meta http-equiv="refresh" content="0";url="/401">
    <script type="text/javascript">
        window.location.href = "/401"
    </script>
@endif
<div class='col-lg-4 col-lg-offset-4'>

    <h1><i class='fa fa-user-plus'></i> Ingresar usuario</h1>
    <hr>

    {{ Form::open(array('url' => 'users')) }}

    <div class="form-group">
        {{ Form::label('name', 'Nombre:') }}
        {{ Form::text('name', '', array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('email', 'Correo electrónico:') }}
        {{ Form::email('email', '', array('class' => 'form-control')) }}
    </div>

    <div class='form-group'>
        @foreach ($roles as $role)
            {{ Form::checkbox('roles[]',  $role->id ) }}
            {{ Form::label($role->name, ucfirst($role->name)) }}<br>
        @endforeach
    </div>

    <div class="form-group">
        {{ Form::label('password', 'Contraseña:') }}<br>
        {{ Form::password('password', array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('password', 'Confirmar contraseña:') }}<br>
        {{ Form::password('password_confirmation', array('class' => 'form-control')) }}

    </div>

    {{ Form::submit('Ingresar', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}
</div>
@endsection