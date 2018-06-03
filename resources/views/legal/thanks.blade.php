@extends('layouts.app')

@section('content')

    <div class="row">

        <div class="col-xs-12 thanks">
            <h2>Agradecimientos</h2>
        </div>

        <div class="col-xs-12 thanks">

            El contenido de Devoogle se nutre en su inmensa mayoría de contenido publicado por terceros. Entidades
            públicas, privadas,
            empresas y personas a título personal
            que dedican su tiempo, esfuerzo y experiencias para que otros podamos aprender.<br><br>
            Quisiera reflejar en esta página cada una de las fuentes utilizadas y aprovechar para agredecerles su
            aportación
            a la comunidad del desarrollo de software. <b>Muchas gracias a todos</b>.

        </div>

        <div class="col-xs-12 thanks">

            <p>Por orden alfabético; páginas webs, blogs...etc., que son fuentes de contenido:</p>

            <ul class="list-group">
                @foreach ($sources as $source)
                    <li class="list-group-item">
                        <a href="{{$source->url()}}" title="{{$source->name}}" target="_blank">
                            {{$source->name}}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>


        <div class="col-xs-12 thanks">

            <p>
                El caso particular de <b>Youtube</b>, consiste en haber utilizado como fuente de datos multitud de
                canales de usuarios que
                exponen de manera pública su contenido. Aunque todos son fantásticos y cada uno aporta su granito de
                arena,
                quería hacer mención especial al esfuerzo que ponen desde <a href="https://www.autentia.com/"
                                                                             target="_blank"
                                                                             title="Autentia">Autentia</a> por grabar y
                ofrecer contenidos en gran cantidad y
                de gran calidad.
            </p>

            <p><b>Canales de Youtube</b> por orden alfabético:</p>

            <ul class="list-group">
                @foreach ($channels as $channel)
                    <li class="list-group-item">
                        <a href="{{$channel->url()}}" title="Canal de Youtube de {{$channel->name}}" target="_blank">
                            {{$channel->name}}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="col-xs-12 thanks">
            <p>Insisto, <b>muchas gracias a todos</b></p>
        </div>

    </div>



@endsection
