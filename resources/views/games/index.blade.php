@extends('main')

@section('title', 'Spiele')

@section('content')
  <div class="row">
      <div class="col-md-10 col-md-offset-1">
          <h1>Spiele</h1>
          <h4>1. Bundesliga 2017/2018</h4>
      <table class="table">
        <thead>
          <th>Heim</th>
          <th>Gast</th>
          <th>Datum</th>
          <th></th>
        </thead>
        <tbody>

          @foreach($games as $game)
            <tr>
              <th> {{ $game->heim }} </th>
              <th> {{ $game->gast }}</th>
              <th> {{ date('D, j. M Y G:i', strtotime($game->spielTag)) }} </th>
              <th><a href='{{ route('bet.betCreate', $game) }}' class="btn btn-success">Wetten</a></th>
            </tr>
          @endforeach
        </tbody>
      </table>
      <div class="text-center">
        {!! $games->links() !!}
      </div>
      </div>
  </div>
@endsection