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
			<form method="POST", action="{{ route('bet.store') }}">
				{{ csrf_field() }}
				{{ Form::hidden('gameID', $game->id) }}
				<div class="form-group">
					<label for="heim">{{ $game->heim }}</label>
					<input name="heim"type="text" class="form-control" placeholder="Tore {{ $game->heim }}">
				</div>
				<div class="form-group">
					<label for="gast">{{ $game->gast }}</label>
					<input name="gast"type="text" class="form-control" placeholder="Tore {{ $game->gast }}">
				</div>
				<div class="form-group">
					<label for="credits">Credits</label>
					<input name="credits"type="text" class="form-control" placeholder="Max: {{ Auth::user()->Kontostand }}">
				</div>

				<input type="submit" class="btn btn-primary btn-block formBtnSpacing" value="Wette plazieren">
			</form>
		</div>
	</div>
@endsection