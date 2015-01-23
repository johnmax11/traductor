@extends('publico.template.master')
@section ('content')
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>
</head>
<body>
	<div class="welcome">
            hola cliente sin registrar
	</div>
    
        <div class="welcome">
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
</body>
</html>
@stop
