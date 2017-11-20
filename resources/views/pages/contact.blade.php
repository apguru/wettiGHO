@extends('main')

@section('title' , 'Kontakt')

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <br>
        <div class="well panelHead">
            <h1 class="text-center">Kontakt</h1>
        </div>
        <div class="well panelBody">
            {{ Form::open(['route'=>'contact.send', 'method'=>'POST']) }}
            <div class="form-group">
                {{ Form::label('email', 'Email: ') }}
                {{ Form::email('email', null, ['class'=>'form-control','placeholder'=>'Deine Email']) }}
            </div>
            <div class="form-group">
                {{ Form::label('betreff', 'Betreff: ') }}
                {{ Form::text('betreff', null, ['class'=>'form-control','placeholder'=>'Betreff der Nachricht']) }}
            </div>
            <div class="form-group">
                {{ Form::label('nachricht', 'Nachricht: ') }}
                {{ Form::textarea('nachricht', null, ['class'=>'form-control', 'placeholder'=>'Deine Nachricht...']) }}
            </div>
            
            {{ Form::submit('Nachricht senden', ['class'=>'btn btn-block btn-primary']) }}
            
            {{ Form::close() }}
        </div>
    </div>
</div>


@endsection