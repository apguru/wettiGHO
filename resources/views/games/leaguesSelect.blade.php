@extends('main')

@section('title', 'Ligen')

@section('content')
  <div class="row">
    <h1>Ligen</h1>
    <div class="col-md-10 col-md-offset-1"> 

        <ul class="list-group">
            @foreach($leagues as $league)
              <li class="list-group-item"><a href="{{ route('spiele.league', $league->id) }}" class="btn btn-block btn-link">{{ $league->name }}</a></li>
            @endforeach
        </ul>
    </div>    
  </div>
@endsection