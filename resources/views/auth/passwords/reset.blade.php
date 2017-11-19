@extends('main')

@section('title', 'Passwort vergessen')

@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<br>
			<div class="well panelHead">
			    <h1>Passwort zurücksetzen</h1>
			</div>
			<div class="well panelBody">
			    {!! Form::open(['url' => 'password/reset', 'method' => "POST"]) !!}

			    {{ Form::hidden('token', $token) }}

				{{ Form::label('email', 'Email Adresse:') }}
				{{ Form::email('email', $email, ['class'=>'form-control' , 'placeholder'=>'deine Email']) }}

				{{ Form::label('password', 'Neues Passwort:') }}
				{{ Form::password('password', ['class'=>'form-control']) }}

				{{ Form::label('password_confirmation', 'Neues Passwort wiederholen: ') }}
				{{ Form::password('password_confirmation', ['class'=>'form-control']) }}

				{{ Form::submit('Passwort zurücksetzen', ['class'=>'btn btn-primary formBtnSpacing']) }}

				{!! Form::close() !!}
			</div>
		</div>
	</div>
@endsection