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
        //Remove evaluated Bets
        $id = 0;
        foreach ($bets as $bet) {
            if ($bet->ausgewertet == true) {
                unset($bets[$id]);
            }
            $id++;          
        }
        //Evaluate bet
        $evaluated = 0;
        foreach ($bets as $bet) {
            $betHp = $bet->HP;
            $betGp = $bet->GP;
            $betWinner = "";

            if ($betHp > $betGp) {
                $betWinner = "Heim";
            } elseif ($betHp < $betGp) {
                $betWinner = "Gast";
            } elseif ($betHp == $betGp){
                $betWinner = "Tie";
            }

            $game = Game::find($bet->gameID);
            $gameHp = $game->hp;
            $gameGp = $game->gp;
            $gameWinner = "";

            if ($gameHp > $gameGp) {
                $gameWinner = "Heim";
            } elseif ($gameHp < $gameGp) {
                $gameWinner = "Gast";
            } elseif ($gameHp == $gameGp){
                $gameWinner = "Tie";
            }

            $user = User::find($bet->userId);
            $credits = $user->Kontostand;

            $stat = "";
            if (($betHp == $gameHp) && ($betGp = $gameGp)) {
                $credits = $credits + $bet->Betrag*5;
                $stat = "5Pkt";
            } elseif(($betHp - $betGp) == ($gameHp - $gameGp)) {
                $credits = $credits + $bet->Betrag*3;
                $stat = "3Pkt";
            } elseif($betWinner == $gameWinner){
                $credits = $credits + $bet->Betrag*2;
                $stat = "2Pkt";
            } else {
                $stat = "Loose";
            }

            $this->info(" Stat: ".$stat);

            $user = User::find($bet->userId);
            $user->Kontostand = $credits;
            // $user->save();

            $bet->ausgewertet = true;
            // $bet->save();
            $evaluated++;

            $this->info(" UserId: ".$bet->userId);

            $stats = DB::table('stats')->where('userId', $bet->userId)->get();

            if ($stat == "5Pkt") {
                $Pkt = $stats->Pkt5 + 1;
                $stats->Pkt5 = $Pkt;
            } elseif ($stat == "3Pkt") {
                $Pkt = $stats->Pkt3 + 1;
                $stats->Pkt3 = $Pkt;
            } elseif ($stat == "2Pkt") {
                $Pkt = $stats->Pkt2 + 1;
                $stats->Pkt2 = $Pkt;
            } else{
                $Pkt = $stats->Loose + 1;
                $stats->Loose = $Pkt;
            }
            
            $stats->save();
        }
        $this->info(" Evaluated: ".$evaluated);
    }
}

