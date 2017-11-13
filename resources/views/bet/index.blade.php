@extends('main')

@section('title', 'Home')

@section('content')
  <div class="row">
      <div class="col-md-12">
          <h1>Meine Wetten</h1>
          <hr>
          {{ var_dump Session::get('game') }}
          <table class="table">
		        <thead>
		          <th>Heim</th>
		          <th>Gast</th>
		          <th>Heim Punkte</th>
		          <th>Gast Punkte</th>
		          <th>Credits</th>
		        </thead>
		        <tbody>

		          @foreach($bets as $bet)
	              <tr>
	                <th> {{ $bet->heim }} </th>
	                <th> {{ $bet->gast }}</th>
	                <th> {{ $bet->HP }} </th>
	                <th> {{ $bet->GP }} </th>
	                <th> {{ $bet->betrag }}</th>
	              </tr>
		          @endforeach
		        </tbody>
		      </table>
      </div>
  </div>
@endsection