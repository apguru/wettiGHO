<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Game;
use App\Bet;
use App\User;
use DB;
use App\Stat;

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
    protected $description = 'Evaluates all bet ';

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
            $ausgewertet = $bet->ausgewertet;
            if ($ausgewertet != 0) {
                unset($bets[$id]);
            }
            //Remove Bets where Games aren't played
            $time = strtotime($bet->spielTag) + 70000;
            if (strtotime('now') < $time) {
                unset($bets[$id]);
            }
            //remove bets where Games arent updated
            $gameDone = Game::find($bet->gameID);
            if ($gameDone->done != true) {
                unset($bets[$id]);
            }
            $id++;          
        }
        //Evaluate bet
        foreach ($bets as $bet) {

            if ($bet->HP > $bet->GP) {
                $betWinner = "Heim";
            } elseif ($bet->HP < $bet->G) {
                $betWinner = "Gast";
            } elseif ($bet->HP == $bet->G){
                $betWinner = "Tie";
            }

            $game = Game::find($bet->gameID);

            if ($game->hp > $game->gp) {
                $gameWinner = "Heim";
            } elseif ($game->hp < $game->gp) {
                $gameWinner = "Gast";
            } elseif ($game->hp == $game->gp){
                $gameWinner = "Tie";
            }


            $user = User::find($bet->userId)->first();

            if (($bet->HP == $game->hp) && ($bet->GP = $game->gp)) {
                $credits = $user->Kontostand + $bet->Betrag*5;
                $stat = "5Pkt";
            } elseif(($bet->HP - $bet->GP) == ($game->hp - $game->gp)) {
                $credits = $user->Kontostand + $bet->Betrag*3;
                $stat = "3Pkt";
            } elseif($betWinner == $gameWinner){
                $credits = $user->Kontostand + $bet->Betrag*2;
                $stat = "2Pkt";
            } else {
                $stat = "Loose";
            }

            $user = User::find($bet->userId)->first();
            $user->Kontostand = $credits;
            $user->save();

            $bet->ausgewertet = true;
            $bet->save();

            $stats = Stat::where('userId',$bet->userId)->first();

            if ($stat == "5Pkt") {
                $Pkt = $stats->Pkt5 + 1;
                $stats->Pkt5 = $Pkt;
            } elseif ($stat == "3Pkt") {
                $Pkt = $stats->Pkt3 + 1;
                $stats->Pkt3 = $Pkt;
            } elseif ($stat == "2Pkt") {
                $Pkt = $stats->Pkt2 + 1;
                $stats->Pkt2 = $Pkt;
            } else {
                $Pkt = $stats->Loose + 1;
                $stats->Loose = $Pkt;
            }
            $stats->save();

        }
    }
}

