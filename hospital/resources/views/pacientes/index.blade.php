@extends('layouts.app')
@section('content')
@if (!Auth::user()->hasPermissionTo('Consultar paciente'))
    <meta http-equiv="refresh" content="0";url="/401">
    <script type="text/javascript">
        window.location.href = "/401"
    </script>
@endif
<div class="col-lg-10 col-lg-offset-1">
    <h1><i class="fa fa-users"></i> Pacientes</h1>
    <hr>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>R.U.T.</th>
                    <th>Nombre</th>
                    <th>Fecha de nacimiento</th>
                    <th>Sexo</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($pacientes as $paciente)
                <tr>

                    <td>{{ $paciente->rut }}</td>
                    <td>{{ $paciente->nombre }}</td>
                    <td>{{ $paciente->fecha_nacimiento }}</td>
                    <td>{{ $paciente->sexo }}</td>
                    <td>{{ $paciente->direccion }}</td>
                    <td>{{ $paciente->telefono }}</td>
                    @if(Auth::user()->hasPermissionTo('Actualizar paciente'))                    
                    <td>
                    <a href="{{ route('pacientes.edit', $paciente->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Actualizar</a>
                    @endif

                    @if(Auth::user()->hasPermissionTo('Eliminar paciente'))
                    {!! Form::open(['method' => 'DELETE', 'route' => ['pacientes.destroy', $paciente->id] ]) !!}
                    {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                    @endif
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
    @if (Auth::user()->hasPermissionTo('Ingresar paciente'))
    <a href="/pacientes/ingresar-paciente" class="btn btn-success">Ingresar paciente</a>
    @endif
</div>
 
@endsection