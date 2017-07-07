@extends('layouts.app')
@section('content')
@if (!Auth::user()->hasPermissionTo('Consultar atención'))
    <meta http-equiv="refresh" content="0";url="/401">
    <script type="text/javascript">
        window.location.href = "/401"
    </script>
@endif
<div class="col-lg-10 col-lg-offset-1">
    <h1><i class="fa fa-users"></i> Atenciones</h1>
    <hr>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>Fecha y hora</th>
                    <th>Paciente</th>
                    <th>Médico</th>
                    <th>Estado</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($atenciones as $atencion)
                <tr>

                    <td>{{ $atencion->fecha_hora }}</td>
                    <td>{{ $atencion->id_paciente }}</td>
                    <td>{{ $atencion->id_medico }}</td>
                    <td>{{ $atencion->estado }}</td>
                    @if(Auth::user()->hasPermissionTo('Actualizar atención'))                    
                    <td>
                    <a href="{{ route('atenciones.edit', $atencion->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Actualizar</a>
                    @endif

                    @if(Auth::user()->hasPermissionTo('Eliminar atención'))
                    {!! Form::open(['method' => 'DELETE', 'route' => ['atenciones.destroy', $atencion->id] ]) !!}
                    {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                    @endif
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
    @if (Auth::user()->hasPermissionTo('Ingresar atención'))
    <a href="/atenciones/ingresar-atencion" class="btn btn-success">Ingresar atención</a>
    @endif
</div>
 
@endsection