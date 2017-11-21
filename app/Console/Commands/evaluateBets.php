<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Game;
use App\Bet;
use App\User;

class evaluateBets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bets:evaluate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Evaluates the bets of all Users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //Get all bets and Games
        $bets = Bet::all();
        //Remove unwanted bets
        $id = 0;
        foreach ($bets as $bet) {
            if (strtotime('now') < strtotime($bet->spielTag)) {
                unset($bets[$id]);
            }
            $id++;          
        }
        $id = 0;
        foreach ($bets as $bet) {
            if ($bet->ausgewertet == true) {
                unset($bets[$id]);
            }
            $id++;          
        }
        //Evaluate bet
        foreach ($bets as $bet) {
            $betHp = $bet->HP;
            $betGp = $bet->GP;
            if ($betHp > $betGp) {
                $betWinner = "Heim";
            } elseif ($betHp > $betGp) {
                $betWinner = "Gast";
            } elseif ($betHp == $betGp){
                $betWinner = "Tie";
            }

            $game = Game::find($bet->gameID);
            $gameHp = $game->hp;
            $gameGp = $game->gp;
            if ($gameHp > $gameGp) {
                $betWinner = "Heim";
            } elseif ($gameHp > $gameGp) {
                $betWinner = "Gast";
            } elseif ($gameHp == $gameGp){
                $betWinner = "Tie";
            }

            $credits = 0;
            if (($betHp == $gameHp) && ($betGp = $gameGp)) {
                $credits = $bet->betrag*5;

                $user = User::find($bet->userId);
                $user->credits = $user->credits + $credits;

                $user->save();

                $bet->ausgewertet = true;

                $bet->save();

                return;
            } elseif(($betHp - $betGp) == ($gameHp - $gameGp)) {
                $credits = $bet->betrag*3;

                $user = User::find($bet->userId);
                $user->credits = $user->credits + $credits;

                $user->save();

                $bet->ausgewertet = true;

                $bet->save();
            }
        }
    }
}
