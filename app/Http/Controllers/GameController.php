<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Game;
use App\Http\Controllers\BetController;
use Session;

class GameController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function getIndex(){
    	$games = Game::orderBy('spielTag', 'asc')->get();

    	return view('games.index')->withGames($games);
    }

    public function create(){
    	return view('games.create');
    }

    public function store(Request $request)
    {
    	$game = New Game;
    	$game->heim = $request->heim;
    	$game->gast = $request->gast;
    	$game->spielTag = $request->spielTag;

    	$game->save();

    	Session::flash('success', 'Spiel erfolgreich erstellt');

    	return redirect()->route('spiele');

    }

    public function redirectToBet(Request $request)
    {
    	$game = Game::find($request->id);

        Session::put('game', $game);

    	return redirect()->route('bet.create');
    }
}
