@extends('layouts.app')

@section('title', '| Ingresar permisos')

@section('content')
@if (!Auth::user()->hasPermissionTo('Administrar roles y permisos'))
    <meta http-equiv="refresh" content="0";url="/401">
    <script type="text/javascript">
        window.location.href = "/401"
    </script>
@endif

<div class='col-lg-4 col-lg-offset-4'>

    <h1><i class='fa fa-key'></i>Ingresar permiso</h1>
    <br>

    {{ Form::open(array('url' => 'permissions')) }}

    <div class="form-group">
        {{ Form::label('name', 'Nombre:') }}
        {{ Form::text('name', '', array('class' => 'form-control')) }}
    </div><br>
    @if(!$roles->isEmpty()) {{-- If no roles exist yet --}}
        <h4>Asignar permiso a roles</h4>

        @foreach ($roles as $role) 
            {{ Form::checkbox('roles[]',  $role->id ) }}
            {{ Form::label($role->name, ucfirst($role->name)) }}<br>

        @endforeach
    @endif
    <br>
    {{ Form::submit('Ingresar permiso', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

</div>

@endsection