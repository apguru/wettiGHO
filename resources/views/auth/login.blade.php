@extends('main')

@section('title','| Login')

@section('content')
  <div class="row">
      <div class="col-md-6 col-md-offset-3">
      	<h1>Login</h1>
      	<hr>
      	{{ Form::open() }}
      	
      	{{ Form::label('email', 'Email:') }}
      	{{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'email']) }}
      	
      	{{ Form::label('password', 'Passwort:') }}
      	{{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Passwort']) }}
      	
      	{{ Form::submit('Login', ['class' => 'btn btn-success btn-block formBtnSpacing']) }}

        <h5><a href="{{ url('password/reset') }}">Passwort vergessen</h5>
          
        {{ Form::close() }}
    </div>
  </div>
@endsection