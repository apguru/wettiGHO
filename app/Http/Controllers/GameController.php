<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Game;
use App\Bet;
use App\Http\Controllers\BetController;
use Carbon\Carbon;
use Session;
use DB;
use Auth;
use Parser;
use XmlParser;

class GameController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function getIndex(){
        //Get all Games orderd by `spieltag`
        $time = Carbon::now();
        $games = Game::orderBy('spielTag','asc')->where('spielTag', '>', $time)->paginate(10);
    	// $games = DB::table('games')->where('spielTag', '>', $time)->orderBy('spielTag','asc')->paginate(10);

        //return view game.index with all game & game data
    	return view('games.index')->withGames($games);
    }

    public function create(){
        //return view games.create
    	return view('games.create');
    }

    public function store(Request $request)
    {

        $this->validate($request,[
            'matchId' => "required|Integer",
            'heim' => 'required|String',
            'gast' => 'required|String',
            'spielTag' => 'required|date'
        ]);
        //Create new Game & assign Data from Form
    	$game = New Game;
        $game->matchId = $request->matchId;
    	$game->heim = $request->heim;
    	$game->gast = $request->gast;
    	$game->spielTag = $request->spielTag;
        
        //save new Game
    	$game->save();
        
        //Flash success message
    	Session::flash('success', 'Spiel erfolgreich erstellt');
        
        //redirect to route "spiele"
    	return redirect()->route('spiele');

    }
    //get Game id from game.index table
    public function redirectToBet(Request $request)
    {
        //Get gameid from Form
    	$game = Game::find($request->id);
        
        //gut gameId into Session under "game"
        Session::put('game', $game);

        //rediect to route: "bet.create"
    	return redirect()->route('bet.create');
    }

}
