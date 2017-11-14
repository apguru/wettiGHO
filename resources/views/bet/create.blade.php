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
		</div>
		<form method="POST", action="{{ route('bet.store') }}">
		{{ csrf_field() }}
		{{ Form::hidden('gameID', $game->id) }}
		<div class="col-md-6">
			<div class="row">
				<div class="form-group">
					<div class="col-md-5">
						<label for="heim">{{ $game->heim }}</label>
					</div>
					<div class="col-md-4">
						<div class="row">
							<div class="col-md-2">
								<label for="heim">Tore:</label>
							</div>
							<div class="col-md-9 col-md-offset-1">
								<input name="heim"type="text" class="form-control">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="row">
				<div class="form-group">
					<div class="col-md-5">
						<label for="heim">{{ $game->gast }}</label>
					</div>
					<div class="col-md-4">
						<input name="heim"type="text" class="form-control"">
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12">
		<hr>
		</div>
		<div class="col-md-6 col-md-offset-3">
				<label for="credits">Credits</label>
				<input name="credits"type="text" class="form-control" placeholder="Max: {{ Auth::user()->Kontostand }}">
		</div>
		<input type="submit" class="btn btn-primary btn-block formBtnSpacing" value="Wette plazieren">
		</form>
		</div>
	</div>
@endsection