@extends('layouts.app')

@section('title', '| Ingresar médicos')

@section('content')
@if (!Auth::user()->hasPermissionTo('Ingresar médico'))
    <meta http-equiv="refresh" content="0";url="/401">
    <script type="text/javascript">
        window.location.href = "/401"
    </script>
@endif
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

        <h1>Ingresar médico</h1>
        <hr>

    {{-- Using the Laravel HTML Form Collective to create our form --}}
        {{ Form::open(array('route' => 'medicos.store')) }}

        <div class="form-group">
            {{ Form::label('rut', 'R.U.T. (sin dígito verificador)') }}
            {{ Form::number('rut', null, array('class' => 'form-control')) }}
            <br>

            {{ Form::label('nombre', 'Nombre:') }}
            {{ Form::text('nombre', null, array('class' => 'form-control')) }}
            <br>

            {{ Form::label('fecha_contratacion', 'Fecha de contratación:') }}
            {{ Form::date('fecha_contratacion', null, array('class' => 'form-control')) }}
            <br>

            {{ Form::label('especialidad', 'Especialidad:') }}
            {{ Form::text('especialidad', null, array('class' => 'form-control')) }}
            <br>

            {{ Form::label('valor_consulta', 'Valor consulta:') }}
            {{ Form::number('valor_consulta', null, array('class' => 'form-control')) }}
            <br>

            {{ Form::submit('Ingresar médico', array('class' => 'btn btn-success btn-lg btn-block')) }}
            {{ Form::close() }}
        </div>
        </div>
    </div>

@endsection