<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MovieDB;



class MoviesController extends Controller
{

    public function search()
    {
        return view('index');
    }

    public function result(Request $request)    // get request from index.blade
    {
        $year1 = $request->input('year1');
        $year2 = $request->input('year2');
        $genre = $request->input('genre');
        $rating = $request->input('rating');
        $keyword = $request->input('keyword');

        $token  = new \Tmdb\ApiToken('0c56401bde4dc0dea76f181c05b2171f');
        $client = new \Tmdb\Client($token);
        $response = $client->getDiscoverApi()->discoverMovies([
            'page' => 1,
            'language' => 'en',
            'primary_release_date.gte' => '2010-12-12',
            'primary_release_date.lte' => '2011-02-12'
        ]);
        dd($response);
//        return view('result',[
//            'movies' => $movieData
//        ]);
    }

}
