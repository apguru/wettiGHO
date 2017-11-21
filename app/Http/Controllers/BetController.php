<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Bet;
use App\Game;
use Session;
use Auth;
use App\User;
use DB;

class BetController extends Controller
{
    /**
     * Only Authenticated Users may access this Controller
     */
     
    public function __construct(){
        //only logged in users may access thes Controller
        $this->middleware('auth');
    }
    public function betCreate($game)
    {
        //put gameId into Session
        Session::put('game', $game);
        
        //redirect to bet.create
        return redirect()->route('bet.create');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get User data 
        $id = Auth::user()->id;
        
        //Get user's bets
        $bets = DB::table('bets')->where('userId', $id)->get();
        
        //Get corresponding game data
        $gameIDs = DB::table('bets')->where('userId', $id)->pluck('gameID');
        
        //Create array with game data, index of array = gameId
        $games = [];
        foreach ($gameIDs as $id) {
            $game = Game::find($id);
            $games[$id]=$game;
        }
        //return view with user Bets and Game Data
        return view('bet.index')->withBets($bets)->withGames($games);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //get game Data from Session
        $game = Game::find(Session::get('game'));
        
        //return view bet.create with Game Data
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
        //check if bet with game id Already exists, 
        //if true return to bet.index+
        //User cant bet 2 times on the same game
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
        //Create New Bet
        $game = Game::find($request->gameID);

        $bet = New Bet;
        
        //Retrieve Data From Form
        $bet->userId = Auth::user()->id;
        $bet->gameID = $request->gameID;
        $bet->Betrag = $request->credits;
        $bet->spielTag = $game->spielTag;
        $bet->HP = $request->heim;
        $bet->GP = $request->gast;
        
        //save Bet
        $bet->save();
        
        //Get user account credit balance
        $nKontostand = (Auth::user()->Kontostand) - $request->credits;
        
        //Get user Data
        $user = User::find(Auth::user()->id);
        
        //Remove betted credits
        $user->Kontostand = $nKontostand;
        
        //Save User with new Balance
        $user->save();
        
        //Flash Success and Info 
        Session::flash('success', 'Wette erfolgreich plaziert');
        Session::flash('info', 'Dir wurden '.$request->credits.' Credits abgezogen!');

        //redirect to bet.index
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
    
    public function wettenAuswerten(){
        
    }
}
