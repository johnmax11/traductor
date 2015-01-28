@extends('publico.template.master')
@section ('content')
{{HTML::script("js/jquery-1.11.2.min.js")}}
{{HTML::style("js/jquery-steps/jquery.steps.css")}}
{{HTML::style("js/jquery-steps/main.css")}}
{{HTML::style("js/jquery-steps/normalize.css")}}
{{HTML::script("js/jquery-steps/jquery.steps.js")}}
{{HTML::script("js/jquery-steps/jquery.steps.min.js")}}
{{HTML::script("js/publico/cotizador.js")}}
{{HTML::style("css/publico/cotizador.css")}}
{{HTML::script('js/upload/client/fileuploader.js');}}
{{HTML::script('js/jquery-ui/js/jquery-ui-1.9.2.custom.js');}}
{{HTML::script('js/jquery-ui/js/jquery-ui-1.9.2.custom.min.js');}}
{{HTML::style('js/upload/client/fileuploader.css');}}
{{HTML::style('js/jquery-ui/css/ui-lightness/jquery-ui-1.9.2.custom.min.css');}}
{{HTML::style('js/jquery-ui/css/ui-lightness/jquery-ui-1.9.2.custom.css');}}
<section>
    <div class="welcome">
        hola cliente sin registrar
    </div>

    <div class="welcome">

        <div>
            Hello!, get your translation project started
            <!-- APERTURA div STEPS para crear los pasos para el proceso de cotizacion -->
            <div id="parentDivSteps">
                <div id="divSteps">
                    <h3>Upload your files</h3>
                    <section>
                        <div id="file-uploader-demo1">		
                            <noscript>			
                            <p>Please enable JavaScript to use file uploader.</p>
                            <!-- or put a simple form for upload here -->
                            </noscript>         
                        </div>
                    </section>
                </div>
            </div>
            <div id="resumen" class="ui-state-highlight" style="width: auto; margin-left: 80%; margin-bottom: 80%; margin-top: -25%">
                <span class="ui-icon ui-icon-info"></span>
                <ul id="displayInfo">
                    <li>Words: <span id="idWords"></span></li>
                </ul>
            </div>
            <!-- CIERRE div STEPS -->
        </div>

        <div class="container" style='margin-top:200px;'>
            <div class="panel panel-default" style='width:50%;float: none;margin-left: auto;margin-right: auto;background-color:#f7f7f7;'>
                <div class="panel-body" style='width:50%; margin-left: auto;margin-right: auto;'>
                    {{-- Preguntamos si hay algún mensaje de error y si hay lo mostramos  --}}
                    @if(Session::has('mensaje_error'))
                    <div class="alert alert-danger">{{ Session::get('mensaje_error') }}</div>
                    @endif
                    {{ Form::open(array('url' => '/login')) }}
                    <legend>Iniciar sesión</legend>
                    <div class="form-group">
                        {{ Form::text('email', Input::old('email'), array('class' => 'form-control','placeholder'=>'Email')); }}
                    </div>
                    <div class="form-group">
                        {{ Form::password('password', array('class' => 'form-control','placeholder'=>'Contrase&ntilde;a')); }}
                    </div>
                    <label style='display:none;'>
                        Recordar contraseña
                        {{ Form::checkbox('rememberme', true) }}
                    </label>
                    {{ Form::submit('Ingresar', array('class' => 'btn btn-primary btn btn-lg btn-primary btn-block')) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</section>
@stop
