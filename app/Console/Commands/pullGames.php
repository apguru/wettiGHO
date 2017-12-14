<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Game;
use DB;
use App\League;

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
    public function pull($url)
    {
        $context  = stream_context_create(array('http' => array('header' => 'Accept: application/xml')));
        $url = $url;

        $xml = file_get_contents($url, false, $context);
        $games = simplexml_load_string($xml);

        

        for ($i=0; $i < count($games) ; $i++) {

            if (League::where('leagueID',$games->Match[$i]->LeagueId)->count() == 0) {
                $league = New League;

                $league->leagueID = $games->Match[$i]->LeagueId;
                $league->name = $games->Match[$i]->LeagueName;

                $league->save();

            }
            $matchId = $games->Match[$i]->MatchID;
            if (Game::where('matchId', $matchId)->count() == 0) {
                $leagueName = $games->Match[$i]->LeagueName;
                $league = DB::table('leagues')->select('id')->where('name', '=', $leagueName )->get();

                $game = New Game;

                $game->matchId = $games->Match[$i]->MatchID;
                $game->leagueId = $league[0]->id;
                $game->heim = $games->Match[$i]->Team1->TeamName;
                $game->gast = $games->Match[$i]->Team2->TeamName;
                $game->spielTag = $games->Match[$i]->MatchDateTime;

                $game->save();  
            }
        }
    }

    public function handle()
    {
        $this->pull('https://www.openligadb.de/api/getmatchdata/bl1/2017');
        $this->pull('https://www.openligadb.de/api/getmatchdata/bl2/2017');
        $this->pull('https://www.openligadb.de/api/getmatchdata/dfb2017');
        return;
    }
}
