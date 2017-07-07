@extends('layouts.app')

@section('title', '| Roles')

@section('content')
@if (!Auth::user()->hasPermissionTo('Administrar roles y permisos'))
    <meta http-equiv="refresh" content="0";url="/401">
    <script type="text/javascript">
        window.location.href = "/401"
    </script>
@endif
<div class="col-lg-10 col-lg-offset-1">
    <h1><i class="fa fa-key"></i> Roles

    <a href="/usuarios" class="btn btn-default pull-right">Usuarios</a>
    <a href="/usuarios/permisos" class="btn btn-default pull-right">Permisos</a></h1>
    <hr>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Rol</th>
                    <th>Permisos</th>
                    <th>Operación</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($roles as $role)
                <tr>

                    <td>{{ $role->name }}</td>

                    <td>{{ str_replace(array('[',']','"'),'', $role->permissions()->pluck('name')) }}</td>{{-- Retrieve array of permissions associated to a role and convert to string --}}
                    <td>
                    <a href="{{ URL::to('roles/'.$role->id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Actualizar</a>

                    {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id] ]) !!}
                    {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}

                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    <a href="{{ URL::to('roles/create') }}" class="btn btn-success">Ingresar rol</a>

</div>

@endsection