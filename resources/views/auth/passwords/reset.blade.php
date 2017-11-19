@extends('main')

@section('title', 'Passwort vergessen')

@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<br>
			<div class="panel panel-default">
			  <div class="panel-heading">
			    <h3 class="panel-title">Passwort zurücksetzen</h3>
			  </div>
			  <div class="panel-body">
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
	</div>
@endsection