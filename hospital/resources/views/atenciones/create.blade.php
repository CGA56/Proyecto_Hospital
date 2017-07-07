@extends('layouts.app')

@section('title', '| Ingresar Atenciones')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

        <h1>Ingresar Atenciones</h1>
        <hr>

    {{-- Using the Laravel HTML Form Collective to create our form --}}
        {{ Form::open(array('route' => 'atenciones.store')) }}

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
                 <option value='{{$medico->id}}'>pedro</option>    
                @endforeach
                </select>
            <br>
            {{ Form::submit('Ingresar atencion', array('class' => 'btn btn-success btn-lg btn-block')) }}
            {{ Form::close() }}
        </div>
        </div>
    </div>

@endsection