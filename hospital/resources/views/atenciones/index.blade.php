@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Atenciones</h3></div>
                    <div class="panel-heading">Página {{ $atenciones->currentPage() }} of {{ $atenciones->lastPage() }}</div>
                    @foreach ($atenciones as $atencion)
                        <div class="panel-body">
                            <li style="list-style-type:disc">
                                <a href="{{ route('atenciones.show', $atencion->id ) }}"><b>{{ $atencion->id }}</b><br>
                                    <p class="teaser">
                                       {{  str_limit($atencion->fecha_hora, 100) }} {{-- Limit to 100 characters --}}
                                    </p>
                                </a>
                            </li>
                        </div>
                    @endforeach
                    </div>
                    <div class="text-center">
                        {!! $atenciones->links() !!}
                    </div>
                </div>
            </div>
        </div>
@endsection