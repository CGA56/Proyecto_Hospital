@extends('layouts.app')

@section('title', '| Actualizar atenciones')

@section('content')
@if (!Auth::user()->hasPermissionTo('Actualizar atención'))
    <meta http-equiv="refresh" content="0";url="/401">
    <script type="text/javascript">
        window.location.href = "/401"
    </script>
@endif
<div class="row">

    <div class="col-md-8 col-md-offset-2">

        <h1>Actualizar atenciones</h1>
        <hr>
            {{ Form::model($atencion, array('route' => array('atenciones.update', $atencion->id), 'method' => 'PUT')) }}
            <div class="form-group">
            {{Form::label('fech','Fecha :')}}
            <input type="datetime-local" name="fecha_hora" id="fecha_hora">
            <br>
            {{ Form::label('nombrePte','Nombre paciente :') }}
               <select id="id_paciente" name="id_paciente">
               @foreach ($pacientes as $user)
                    <option value='{{$user->id}}' >{{$user->nombre}}</option>
                @endforeach
                </select>
            <br>
            {{ Form::label('nombreMedico', 'Nombre Medico:') }}
            <select id="id_medico" name="id_medico">
              
               @foreach ($medicos as $medico)
                 <option value='{{$medico->id}}'>{{$medico->nombre}}</option>    
                @endforeach
                </select>
            <br>
            
            {{ Form::submit('Actualizar', array('class' => 'btn btn-primary')) }}

            {{ Form::close() }}
    </div>
    </div>
</div>

@endsection