<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Bet;
use App\Game;
use Session;
use Auth;
use DB;

class BetController extends Controller
{
    /**
     * Only Authenticated Users may access this Controller
     */
     
    public function __construct(){
        $this->middleware('auth');
    }
    public function betCreate($game)
    {
        Session::put('game', $game);
        
        return redirect()->route('bet.create');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $bets = DB::table('bets')->where('userId', $id)->get();
        $gameIDs = DB::table('bets')->where('userId', $id)->pluck('gameID');
        $games = [];
        foreach ($gameIDs as $id) {
            $game = Game::find($id);
            $games[$id]=$game;
        }
        return view('bet.index')->withBets($bets)->withGames($games);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $game = Game::find(Session::get('game'));

        return view('bet.create')->withGame($game);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ((DB::table('bets')->where([
                    ['userId', Auth::user()->id],
                    ['gameID', $request->gameID]
                ])->count()) != 0) {
            Session::flash('error','Du kannst nicht 2 mal aufs selbe spiel wetten');
            return redirect()->route('bet.index');
        }
        //Validate Data
        $this->validate($request,[
            'heim' => 'required|integer|min:0',
            'gast' => 'required|integer|min:0',
            'credits'=>'required|integer|min:|max:Auth::user()->Kontostand',
        ]);
        $bet = New Bet;

        $bet->userId = Auth::user()->id;
        $bet->gameID = $request->gameID;
        $bet->Betrag = $request->credits;
        $bet->HP = $request->heim;
        $bet->GP = $request->gast;

        $bet->save();

        Session::flash('success', 'Wette erfolgreich plaziert');

        return redirect()->route('bet.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
