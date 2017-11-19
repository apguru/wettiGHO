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
			  @if (session('status'))
			  	<div class="alert alert-success">
			  		{{ session('status') }}
			  	</div>
			  @endif
			    {{ Form::open(['url' => 'password/email', 'method' => "POST"]) }}

				{{ Form::label('email', 'Email Adresse:') }}
				{{ Form::email('email', null, ['class'=>'form-control']) }}

				{{ Form::submit('Passwort zurücksetzen', ['class'=>'btn btn-primary formBtnSpacing']) }}

				{{ Form::close() }}
			  </div>
			</div>
		</div>
	</div>
@endsection