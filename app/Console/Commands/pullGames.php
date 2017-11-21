<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Game;

class pullGames extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'games:pull';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pull all Games';

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
        $context  = stream_context_create(array('http' => array('header' => 'Accept: application/xml')));
        $url = "https://www.openligadb.de/api/getmatchdata/bl1/2017";

        $xml = file_get_contents($url, false, $context);
        $games = simplexml_load_string($xml);

        

        for ($i=0; $i < count($games) ; $i++) { 
            $game = New Game;

            $game->matchId = $games->Match[$i]->MatchID;
            $game->heim = $games->Match[$i]->Team1->TeamName;
            $game->gast = $games->Match[$i]->Team2->TeamName;
            $game->spielTag = $games->Match[$i]->MatchDateTime;

            $game->save();
        }
    }
}
