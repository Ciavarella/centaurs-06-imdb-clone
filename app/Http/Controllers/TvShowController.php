<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\TvShow;

class TvShowController extends Controller
{
    public function TvShowApi($argument, $searchMethod)
    {
        $api_key = 'api_key=6975fbab174d0a26501b5ba81f0e0b3c';
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.themoviedb.org/3/". $searchMethod . $api_key . $argument,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "{}",
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            $result = json_decode($response, true);
            
            return $result; 
    }

    public function createTvShowFromApi()
    {
<<<<<<< HEAD
        $keyword = "Gam of thrones";
=======
        $keyword = "Family guy";
>>>>>>> methods for adding tv-show seasons from api
        $argument = str_replace(' ', '%20', $keyword);
        $searchMethod = 'search/tv?';
        $search = '&language=en-US&query=' . $argument . '&page=1';

        $result = $this->TvShowApi($search, $searchMethod);
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> methods for adding tv-show seasons from api
        
        $tvShowModel = new TvShow();
        $tvShowModel->createTvSHowFromApi($result['results'][0]);

        $seasons = $this->getTvShowSeasons($result['results'][0]);
        $tvShow = $tvShowModel->getTvShowByName($seasons['name']);
<<<<<<< HEAD
=======
        //print_r($result);
        $tvShow = new TvShow();
        $tvShow->createTvSHowFromApi($result['results'][0]);
>>>>>>> Made som changes in db tables for tvshows and episodes

        foreach ($seasons['seasons'] as $k => $season) {
            if($k <> 0) { 
                $tvShowModel->createSeasonsFromApi($season, $tvShow);
                
                for ($i=1; $i <= $season['episode_count']; $i++) { 
                    $episodeInfo = $this->getEpisodeInfoFromApi([$seasons][0]['id'], $season['season_number'], $i);
                    $episodeCredits = $this->getEpisodeActorsFromApi([$seasons][0]['id'], $season['season_number'], $i);
                    $tvShowModel->createEpisodeFromApi($episodeInfo, $tvShow->id, $seasons);
                    $tvShowModel->createEpisodeStaffFromApi($episodeCredits, $tvShow->id, $episodeInfo);
                } 
            }
        }
    }

    public function getEpisodeActorsFromApi($tvShowId, $seasonNr, $episodeNr)
    {
        $searchMethod = 'tv/' . $tvShowId . '/' . 'season/' . $seasonNr . '/' . 'episode/' . $episodeNr . '/credits?';
        $languageEndString = '&language=en-US';

        return $this->tvShowApi($languageEndString, $searchMethod);
    }

    public function getEpisodeInfoFromApi($tvShowId, $seasonNr, $episodeNr)
    {
        $searchMethod = 'tv/' . $tvShowId . '/' . 'season/' . $seasonNr . '/' . 'episode/' . $episodeNr . '?';
        $languageEndString = '&language=en-US';

        return $this->tvShowApi($languageEndString, $searchMethod);
    }
    public function getTvShowSeasons($tvShow)
    {
        $searchMethod = 'tv/' . $tvShow['id'] . '?';
        $languageEndString = '&language=en-US';

        return $this->TvShowApi($languageEndString, $searchMethod);
    }
<<<<<<< HEAD
}

=======
    public function getTvShowStaffFromApi($tvShow)
=======

        foreach ($seasons['seasons'] as $season) {

            $tvShowModel->createSeasonsFromApi($season, $tvShow);
            
            for ($i=1; $i <= $season['episode_count']; $i++) { 
                $episodeInfo = $this->getEpisodeInfoFromApi([$seasons][0]['id'], $season['season_number'], $i);
                $episodeCredits = $this->getEpisodeActorsFromApi([$seasons][0]['id'], $season['season_number'], $i);
                $tvShowModel->createEpisodeFromApi($episodeInfo, $episodeCredits, $tvShow->id, $seasons);
                //$tvShowModel->createTvShowEpisode();
            } 
        }
        die;
        //$this->getTvShowStaffFromApi($result['results'][0]);
    }
    //https://api.themoviedb.org/3/tv/1399/season/1/episode/1/credits?api_key=6975fbab174d0a26501b5ba81f0e0b3c
    public function getEpisodeActorsFromApi($tvShowId, $seasonNr, $episodeNr)
    {
        $searchMethod = 'tv/' . $tvShowId . '/' . 'season/' . $seasonNr . '/' . 'episode/' . $episodeNr . '/credits?';
        $languageEndString = '&language=en-US';

        return $this->tvShowApi($languageEndString, $searchMethod);
    }

    public function getEpisodeInfoFromApi($tvShowId, $seasonNr, $episodeNr)
>>>>>>> methods for adding tv-show seasons from api
    {
        $searchMethod = 'tv/' . $tvShowId . '/' . 'season/' . $seasonNr . '/' . 'episode/' . $episodeNr . '?';
        $languageEndString = '&language=en-US';

        return $this->tvShowApi($languageEndString, $searchMethod);
    }
    public function getTvShowSeasons($tvShow)
    {
        $searchMethod = 'tv/' . $tvShow['id'] . '?';
        $languageEndString = '&language=en-US';

        return $this->TvShowApi($languageEndString, $searchMethod);
    }
}
                               //"tv/1396/season/0/episode/1?"
//https://api.themoviedb.org/3/tv/1399/season/1/episode/1?api_key=6975fbab174d0a26501b5ba81f0e0b3c&language=en-US
//https://api.themoviedb.org/3/tv/1399?api_key=6975fbab174d0a26501b5ba81f0e0b3c&language=en-US
>>>>>>> Made som changes in db tables for tvshows and episodes
