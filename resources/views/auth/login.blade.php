@extends('main')

@section('title','| Login')

@section('content')
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <br>
      <div class="well panelHead">
        <h1 class="text-center">Login</h1>
      </div>
      <div class="well panlBody">
      	{{ Form::open() }}
      	
      	{{ Form::label('email', 'Email:') }}
      	{{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'email']) }}
      	
      	{{ Form::label('password', 'Passwort:') }}
      	{{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Passwort']) }}

        <br>
        <label for="remember">
          {{ Form::checkbox('remember') }}
          Eingeloggt bleiben
      	</label>
      	{{ Form::submit('Login', ['class' => 'btn btn-success btn-block formBtnSpacing']) }}

        <h5><a href="{{ url('password/reset') }}">Passwort vergessen?</a></h5>
          
        {{ Form::close() }}
      </div>
    </div>
  </div>
@endsection