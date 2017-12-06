<nav class="navbar navbar-inverse">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      {{ Html::image('logo48.png', '', ['id'=>'navLogo']) }}
    </div> <!-- /.container -->

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a class="navbar-brand" href="/">WettiGHO</a></li>
        <li></li>
        <li class='{{ Request::is("/") ? "active" : "" }}'><a href="{{ route('pages.welcome')}}"><i class="fa fa-home fa-fw" aria-hidden="true"></i> Home <span class="sr-only">(current)</span></a></li>
        @if (Auth::check())
          <li class="dropdown {{ Request::is("bet/*") ? "active" : "" }} {{ Request::is("bet") ? "active" : "" }} {{ Request::is("spiele") ? "active" : "" }}">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Wetten<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li class="{{ Request::is("bet") ? "active" : "" }}" ><a href="{{ route('bet.index') }}">Meine Wetten</a></li>
              <li class="{{ Request::is("spiele") ? "active" : "" }}"><a href="{{ route('spiele') }}">Wette platzieren</a></li>
            </ul>
          </li>
          <li class="dropdown {{ Request::is("stats/*") ? "active" : "" }}">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Statistiken<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li class='{{ Request::is("stats/show") ? "active" : "" }}'><a href="{{ route('stats.show') }}">Meine Statistiken</a></li>
              <li class='{{ Request::is("stats/leaderboard") ? "active" : "" }}'><a href="{{ route('stats.leaderboard') }}">Bestenliste</a></li>
            </ul>
          </li>
        @endif
        <li class='{{ Request::is("contact") ? "active" : "" }}'><a href="{{ route('pages.contact') }}"><i class="fa fa-address-card-o fa-fw" aria-hidden="true"></i> Contact</a></li>
      </ul>
      @if (Auth::check())
      <ul class="nav navbar-nav navbar-right">
        <li><p class="navbar-text">Kontostand: {{ Auth::user()->Kontostand }} <i class="fa fa-money" aria-hidden="true"></i></p></li>
        <li class="dropdown {{ Request::is("user/data") ? "active" : "" }}">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Hello {{ Auth::check()? Auth::user()->Vorname : User }} <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li class='{{ Request::is("user/data") ? "active" : "" }}'><a href="{{ route('user.data') }}"> <i class="fa fa-id-card fa-fw" aria-hidden="true"></i> Benutzerdaten</a></li>
            <li role="seperator" class="divider"></li>
            <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
      @else
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown {{ Request::is("auth/*") ? "active" : "" }}">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user fa-fw"></i>User<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li class='{{ Request::is("auth/login") ? "active" : "" }}'><a href="{{ route('login') }}"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a></li>
            <li class='{{ Request::is("auth/register") ? "active" : "" }}'><a href="{{ route('register') }}"><i class="fa fa-user-plus" aria-hidden="true"></i> Register</a></li>
          </ul>
        </li>
      </ul>
      @endif
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav><!-- /.nav -->