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

    return view('stats.show')->withStats($stats)->withBets($bets);

  }

  public function getLeaderboard()
  {
    $data = DB::table('users')
                ->join('stats', 'users.id', "=", 'stats.userId' )
                ->select("stats.*", 'users.bName', 'users.Kontostand','users.activated')
                ->orderBy('users.Kontostand','desc')
                ->paginate(10);
    for ($i=0; $i < count($data); $i++) { 
      if ($data[$i]->activated == false) {
        unset($data[$i]);
      }
    }

    return view('stats.leaderboard')->withData($data);
  }
}
;