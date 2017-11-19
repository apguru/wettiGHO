@extends('main')

@section('title', 'Passwort vergessen')

@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<br>
		  	@if (session('status'))
		  		<div class="alert alert-success">
		  			{{ session('status') }}
		  		</div>
		  	@endif
		  	<div class="well panelHead">
		  		<h1 class="text-center">Passwort zurücksetzten</h1>
		  	</div>
		  	<div class="well panelBody">		  	
				{{ Form::open(['url' => 'password/email', 'method' => "POST"]) }}

				{{ Form::label('email', 'Email Adresse:') }}
				{{ Form::email('email', null, ['class'=>'form-control']) }}

				{{ Form::submit('Passwort zurücksetzen', ['class'=>'btn btn-primary btn-block formBtnSpacing']) }}

				{{ Form::close() }}
			</div>
		</div>
	</div>
@endsection