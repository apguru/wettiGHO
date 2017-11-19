@extends('main')

@section('title', 'Home')

@section('content')
  <div class="row">
      <div class="col-md-12">
          <h1>Meine Wetten</h1>
          <hr>
          <table class="table">
		        <thead>
		          <th>Heim</th>
		          <th>Gast</th>
		          <th>Heim Punkte</th>
		          <th>Gast Punkte</th>
		          <th>Spieltag</th>
		          <th>Credits</th>
		        </thead>
		        <tbody>
				
		          @foreach($bets as $bet)
	              <tr>
	                <th>{{ $games[$bet->gameID]->heim }}</th>
	                <th>{{ $games[$bet->gameID]->gast }}</th>
	                <th>{{ $bet->HP }} </th>
	                <th>{{ $bet->GP }} </th>
	                <th>{{ date('D, j. M Y G:i', strtotime($games[$bet->gameID]->spielTag)) }}</th>
	                <th>{{ $bet->Betrag }}</th>
	              </tr>
		          @endforeach
		        </tbody>
		      </table>
      </div>
  </div>
@endsection