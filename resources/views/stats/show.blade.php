@extends('main')

@section('title', 'Statistiken')

@section('content')
  <br>
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="well panelHead">
          <h1 class="text-center">Meine Statistiken</h1>
      </div>
      <div class="well panelBody text-center">
              <dl class="dl-horizontal">
      					<dt>Platzierte Wetten:</dt>
      					<dd>{{ $bets }}</dd>
      				</dl>
              <dl class="dl-horizontal">
      					<dt>Rate:</dt>
      					<dd>{{  (($stats->Pkt5) + ($stats->Pkt3) + ($stats->Pkt2)) / ($stats->Loose)}}</dd>
      				</dl>
              <dl class="dl-horizontal">
      					<dt>Verlorene Wetten:</dt>
      					<dd>{{ $stats->Loose }}</dd>
      				</dl>
      				<dl class="dl-horizontal">
      					<dt>Gewonnen Wetten:</dt>
      					<dd>{{ ($stats->Pkt5) + ($stats->Pkt3) + ($stats->Pkt2)}}</dd>
      				</dl>
              <dl class="dl-horizontal">
      					<dt>5 Punkte Wetten:</dt>
      					<dd>{{ $stats->Pkt5}}</dd>
      				</dl>
              <dl class="dl-horizontal">
      					<dt>3 Punkte Wetten:</dt>
      					<dd>{{ $stats->Pkt3}}</dd>
      				</dl>
              <dl class="dl-horizontal">
      					<dt>2 Punkte Wetten:</dt>
      					<dd>{{ $stats->Pkt2}}</dd>
      				</dl>

      </div>
    </div>
  </div>
@endsection
