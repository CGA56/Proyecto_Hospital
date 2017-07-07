@extends('layouts.app')

@section('title', '| Usuarios')

@section('content')
@if (!Auth::user()->hasPermissionTo('Consultar usuario'))
    <meta http-equiv="refresh" content="0";url="/401">
    <script type="text/javascript">
        window.location.href = "/401"
    </script>
@endif

<div class="col-lg-10 col-lg-offset-1">
    <h1><i class="fa fa-users"></i> Usuarios <a href="/usuarios/roles" class="btn btn-default pull-right">Roles</a>
    <a href="/usuarios/permisos" class="btn btn-default pull-right">Permisos</a></h1>
    <hr>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo electrónico</th>
                    <th>Fecha y hora de registro</th>
                    <th>Roles</th>
                    <th>Operaciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                <tr>

                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('d-m-Y H:i') }}</td>
                    <td>{{  $user->roles()->pluck('name')->implode(' ') }}</td>{{-- Retrieve array of roles associated to a user and convert to string --}}
                    <td>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Actualizar</a>

                    {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id] ]) !!}
                    {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}

                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    <a href="/usuarios/ingresar-usuario" class="btn btn-success">Ingresar usuario</a>

</div>

@endsection