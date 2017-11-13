@extends('main')

@section('title', 'Wette platzieren')
	
@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<center>
				<h1>Wette platzieren</h1>
				<hr>
				<p class="lead"><strong>{{ $game->heim}}</strong> gegen <strong>{{ $game->gast }}</strong></p>
			</center>
			{{ Form::open() }}
			<div class="form-group">
				{{ Form::label('heim', ($game->heim).':') }}
				{{ Form::text('heim', null , ['class'=>'form-control']) }}
			</div>

			<div class="form-group">
				{{ Form::label('gast', ($game->gast).':') }}
				{{ Form::text('gast', null , ['class'=>'form-control']) }}
			</div>
			<div class="form-group">
				{{ Form::label('credits', 'Credits: ') }}
				{{ Form::text('credits', null , ['class'=>'form-control']) }}
			</div>
			
			{{ Form::submit('Wette platzieren', ['class'=>'btn btn-primary btn-block formBtnSpacing']) }}
			
			{{ Form::close() }}
		</div>
	</div>
@endsection