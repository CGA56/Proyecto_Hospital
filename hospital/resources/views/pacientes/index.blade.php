@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Pacientes</h3></div>
                    <div class="panel-heading">Página {{ $pacientes->currentPage() }} of {{ $pacientes->lastPage() }}</div>
                    @foreach ($pacientes as $paciente)
                        <div class="panel-body">
                            <li style="list-style-type:disc">
                                <a href="{{ route('pacientes.show', $paciente->id ) }}"><b>{{ $paciente->nombre }}</b><br>
                                    <p class="teaser">
                                       {{  str_limit($paciente->rut, 100) }} {{-- Limit to 100 characters --}}
                                    </p>
                                </a>
                            </li>
                        </div>
                    @endforeach
                    </div>
                    <div class="text-center">
                        {!! $pacientes->links() !!}
                    </div>
                </div>
            </div>
        </div>
@endsection