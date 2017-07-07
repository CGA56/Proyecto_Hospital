@extends('layouts.app')
@section('content')
@if (!Auth::user()->hasPermissionTo('Consultar médico'))
    <meta http-equiv="refresh" content="0";url="/401">
    <script type="text/javascript">
        window.location.href = "/401"
    </script>
@endif
<div class="col-lg-10 col-lg-offset-1">
    <h1><i class="fa fa-users"></i> Médicos</h1>
    <hr>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>R.U.T.</th>
                    <th>Nombre</th>
                    <th>Fecha de contratación</th>
                    <th>Especialidad</th>
                    <th>Valor consulta</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($medicos as $medico)
                <tr>

                    <td>{{ $medico->rut }}</td>
                    <td>{{ $medico->nombre }}</td>
                    <td>{{ $medico->fecha_contratacion }}</td>
                    <td>{{ $medico->especialidad }}</td>
                    <td>${{ $medico->valor_consulta }}</td>
                    @if(Auth::user()->hasPermissionTo('Actualizar médico'))                    
                    <td>
                    <a href="{{ route('medicos.edit', $medico->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Actualizar</a>
                    @endif

                    @if(Auth::user()->hasPermissionTo('Eliminar médico'))
                    {!! Form::open(['method' => 'DELETE', 'route' => ['medicos.destroy', $medico->id] ]) !!}
                    {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                    @endif
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
    @if (Auth::user()->hasPermissionTo('Ingresar médico'))
    <a href="/medicos/ingresar-medico" class="btn btn-success">Ingresar médico</a>
    @endif
</div>
 
@endsection