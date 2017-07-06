@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Médicos</h3></div>
                    <div class="panel-heading">Página {{ $medicos->currentPage() }} of {{ $medicos->lastPage() }}</div>
                    @foreach ($medicos as $medico)
                        <div class="panel-body">
                            <li style="list-style-type:disc">
                                <a href="{{ route('medicos.show', $medico->id ) }}"><b>{{ $medico->nombre }}</b><br>
                                    <p class="teaser">
                                       {{  str_limit($medico->especialidad, 100) }} {{-- Limit to 100 characters --}}
                                    </p>
                                </a>
                            </li>
                        </div>
                    @endforeach
                    </div>
                    <div class="text-center">
                        {!! $medicos->links() !!}
                    </div>
                </div>
            </div>
        </div>
@endsection