@extends('main')

@section('title','| Registrieren')

@section('content')
   
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
        	<h1>Registrieren</h1>
        	<hr>
        	{!! Form::open() !!}
        		{{ Form::label('bName', "Benutzername") }}
        		{{ Form::text('bName', null, ['class'=>'form-control', 'placeholder'=>'Benutzername']) }}

        		{{ Form::label('Vorname', "Vorname") }}
        		{{ Form::text('Vorname', null, ['class'=>'form-control', 'placeholder'=>'Vorname']) }}

        		{{ Form::label('Nachname', "Nachname") }}
        		{{ Form::text('Nachname', null, ['class'=>'form-control', 'placeholder'=>'Nachname']) }}

        		{{ Form::label('email', "Email") }}
        		{{ Form::email('email', null, ['class'=>'form-control', 'placeholder'=>'Email']) }}

        		{{ Form::label('password', "Passwort") }}
        		{{ Form::password('password',['class'=>'form-control', 'placeholder'=>'Passwort']) }}

        		{{ Form::label('password_confirmation', "Passwort wiederholen") }}
        		{{ Form::password('password_confirmation',['class'=>'form-control', 'placeholder'=>'Passwort wiederholen']) }}
        		
        		<br>
        		{{ Form::checkbox('ageCheck', 'yes') }}
        		{{ Form::label('ageCheck', "Ich bestätige, dass ich das 18 Lebensjahr vollendet habe") }}
        		
        		<br><br>
        		
        		{{ Form::submit('Registrieren', ['class' => 'btn btn-primary btn-block']) }}

        	{!! Form::close() !!}
        </div><!-- col-md-6 -->
    </div><!-- row -->
@endsection