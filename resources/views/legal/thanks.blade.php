@extends('layouts.app')

@section('content')

    <div class="row">

        <div class="col-xs-12 thanks">
            <h1>Agradecimientos</h1>
        </div>

        <div class="col-xs-12 thanks">

            <h3>Sobre la imagen de marca</h3>
            <p>
                La imagen de marca de <b>Devoogle</b> ha sido diseñada y cedida de manera totalmente altruista por <b>Rober González</b>.
                Puedes encontrarlo en su <a href="https://rober.design/" title="Rober González" target="_blank">web personal</a> o en su cuenta de
                <a href="https://twitter.com/robergd" target="_blank" title="Twitter de Rober González">Twitter</a> y así conoces las cosas tan espectaculares que hace.

                <br><br>
                Muchísimas gracias por tu aportación, Rober.
            </p>
        </div>


        <div class="col-xs-12 thanks">

            <h3>Sobre el contenido</h3>
            <p>
            El contenido de Devoogle se nutre en su inmensa mayoría de contenido publicado por terceros. Entidades
            públicas, privadas,
            empresas y personas a título personal
            que dedican su tiempo, esfuerzo y experiencias para que otros podamos aprender.<br><br>
            Quisiera reflejar en esta página cada una de las fuentes utilizadas y aprovechar para agredecerles su
            aportación
            a la comunidad del desarrollo de software. <b>Muchas gracias a todos</b>.
            </p>

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
