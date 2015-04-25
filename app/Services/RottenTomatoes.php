<?php

namespace App\Services;
use Illuminate\Database\Eloquent\Model;
use Cache;

class RottenTomatoes
{
    public static function search($dvd_title,$id)
    {
        if(Cache::has("rottenMovies-$id")) {
            $jsonString = Cache::get("rottenMovies-$id");	// get from cache
        } else {
            $url = "http://api.rottentomatoes.com/api/public/v1.0/movies.json?page=1&apikey=vaaadfqg3tzcz894c688txwx&q=$dvd_title";
            $jsonString = file_get_contents($url);		// get request
            Cache::put("rottenMovies-$id", $jsonString, 60);
        }
        return json_decode($jsonString);
    }
}