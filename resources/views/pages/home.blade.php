@extends('main')

@section('title', 'Home')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="jumbotron homeJumbotron">
        <center>
          <h3>Willkommen bei</h3>
          <h1>WettiGHO</h1>
        </center>
      </div><!-- jumbotron -->
    </div><!-- col-md-12 -->
    <div class="col-md-12">
      <div class="well panelHead">
        <h1>Was ist das hier?</h1>
      </div>
      <div class="well panelBody">
        <br>
        <p class="lead">Das Projekt 'WettiGHO' ist ein Programm, welches als Online-Wettbüro fungiert. Es basiert auf einem Punkte und Credit System, d.h. das man für unterschiedlich gut plazierte Wetten unterschiedlich viele Punkte erhält. Diese agieren als Multiplikator für die gesetzten Credits. Man setzt unentgeltliche Credits auf eine Tordifferenz, wobei für den richtigen Sieger 2, die richtige Differenz 3, und das richtige Ergebnis 5 Pkt vergeben werden. Da es sich hierbei um eine ertragsfreie Wettplattform handelt, werden lediglich Credits ausgezahlt, die in Bestenlisten miteinander verglichen werden.</p>
        <hr>
        <p class="lead">Um unser Programm nutzen zu können müssen sie sich eine koszenloses Konto erstellen, im anschluss erhalten sie kompletten Zugriff auf die Funktionen unsers Programmes</p>
        <p class="lead">Ein neuer Benutzer erhält zum Start 100 Creditpunkte die er nach belieben investieren kann.</p>
        
      </div><!-- well -->
    </div><!-- col-md-12 -->
  </div><!-- row -->
@endsection
