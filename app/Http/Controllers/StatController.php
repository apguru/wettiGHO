<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Stat;
use App\Bet;
use Auth;
use DB;

class StatController extends Controller
{
  public function __construct(){
      //only logged in users may access thes Controller
      $this->middleware('auth');
  }

  public function getShow()
  {
    $stats = DB::table('stats')->where('userid', Auth::user()->id)->first();
    $bets = Bet::where('userId', Auth::user()->id)->count();
    echo Auth::user()->id;

    return view('stats.show')->withStats($stats)->withBets($bets);

  }
}
