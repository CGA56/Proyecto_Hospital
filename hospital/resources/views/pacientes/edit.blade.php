@extends('layouts.app')

@section('title', '| Actualizar pacientes')

@section('content')
@if (!Auth::user()->hasPermissionTo('Actualizar paciente'))
    <meta http-equiv="refresh" content="0";url="/401">
    <script type="text/javascript">
        window.location.href = "/401"
    </script>
@endif
<div class="row">

    <div class="col-md-8 col-md-offset-2">

        <h1>Actualizar pacientes</h1>
        <hr>
            {{ Form::model($paciente, array('route' => array('pacientes.update', $paciente->id), 'method' => 'PUT')) }}
            <div class="form-group">
            {{ Form::label('rut', 'R.U.T. (sin dígito verificador)') }}
            {{ Form::number('rut', null, array('class' => 'form-control')) }}
            <br>

            {{ Form::label('nombre', 'Nombre:') }}
            {{ Form::text('nombre', null, array('class' => 'form-control')) }}
            <br>

            {{ Form::label('fecha_nacimiento', 'Fecha de nacimiento:') }}
            {{ Form::date('fecha_nacimiento', null, array('class' => 'form-control')) }}
            <br>

            {{ Form::label('sexo', 'Sexo:') }}
            <select id="sexo" class="form_control" name="sexo">
                <option value="Femenino">Femenino</option>
                <option value="Masculino">Masculino</option>
            </select>    
            <br>

            {{ Form::label('direccion', 'Dirección:') }}
            {{ Form::date('direccion', null, array('class' => 'form-control')) }}
            <br>

            {{ Form::label('telefono', 'Teléfono:') }}
            {{ Form::number('telefono', null, array('class' => 'form-control')) }}
            <br>
            
            {{ Form::submit('Actualizar', array('class' => 'btn btn-primary')) }}

            {{ Form::close() }}
    </div>
    </div>
</div>

@endsection