@extends('main')

@section('title', 'Wette platzieren')
	
@section('content')
	<div class="row">
		<div class="col-md-12">
			<br>
			<div class="well panelHead">
				<h1 class="text-center ">Wette platzieren</h1>
			</div>
			<div class="well panelBody">
				<div class="row">
					<p class="lead text-center"><strong>{{ $game->heim}}</strong> gegen <strong>{{ $game->gast }}</strong></p>
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
												<input name="heim" type="text" class="form-control">
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
										<label for="gast">{{ $game->gast }}</label>
									</div>
									<div class="col-md-4">
										<div class="row">
											<div class="col-md-2">
												<label for="gast">Tore:</label>
											</div>
											<div class="col-md-9 col-md-offset-1">
												<input name="gast" type="text" class="form-control">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<hr>
						</div>
						<div class="col-md-6 col-md-offset-3">
							<label for="credits">Credits</label>
							<input name="credits"type="text" class="form-control" placeholder="Max: {{ Auth::user()->Kontostand }}">
						</div>
						<div class="col-md-4 col-md-offset-4">
							<center>
								<input type="submit" class="btn btn-success btn-block formBtnSpacing" value="Wette plazieren">
							</center>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection