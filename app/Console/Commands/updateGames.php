<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Game;

class updateGames extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'games:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gets Game results and updates DB';

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
        //Get all Games
        $games = Game::all();

        //Remove not played Games
        $id = 0;
        foreach ($games as $game) {
            if (strtotime('now') < strtotime($game->spielTag)) {
                unset($games[$id]);
            }
            $id++;          
        }
        foreach ($games as $game) {
            $context  = stream_context_create(array('http' => array('header' => 'Accept: application/xml')));
            $url = "https://www.openligadb.de/api/getmatchdata/".$game->matchId;

            $xml = file_get_contents($url, false, $context);
            $gameData = simplexml_load_string($xml);

            $toreHeim = $gameData->MatchResults->MatchResult[1]->PointsTeam1;
            $toreGast = $gameData->MatchResults->MatchResult[1]->PointsTeam2;

            $gameDB = Game::find($game->id);

            $gameDB->hp = $toreHeim;
            $gameDB->gp = $toreGast;

            $gameDB->save();

        }
    }
}
