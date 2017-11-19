@extends('main')

@section('title', 'Meine Daten')

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<br/>
			<div class="well panelHead">
			<h3 class="panelTitle">Benutzerdaten</h3>
			</div>
			<div class="well panelBody">
				<dl class="dl-horizontal">
					<dt>Benutzername</dt>
					<dd>{{ Auth::user()->bName }}</dd>
				</dl>
				<dl class="dl-horizontal">
					<dt>Vorname</dt>
					<dd>{{ Auth::user()->Vorname }}</dd>
				</dl>
				<dl class="dl-horizontal">
					<dt>Nachname</dt>
					<dd>{{ Auth::user()->Nachname }}</dd>
				</dl>
				<dl class="dl-horizontal">
					<dt>Email:</dt>
					<dd>{{ Auth::user()->email }}</dd>
				</dl>
				<dl class="dl-horizontal">
					<dt>Kontostand:</dt>
					<dd>{{ Auth::user()->Kontostand }} <i class="fa fa-money" aria-hidden="true"></i></dd>
				</dl>
			</div>
		</div>
	</div>
@endsection