<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MovieDB;
use Tmdb\Model\Movie;
use \Session;

class MoviesController extends Controller
{
    public $movie;

    public function __construct()
    {
        $this->movie = new MovieDB();
    }

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

        $movieData = MovieDB::search($year1,$year2,$genre,$rating,$keyword);
        $url = MovieDB::getUrl()[0];
        $rating = MovieDB::getRatings()[0];
        Session::put('urls', MovieDB::getUrl());
        Session::put('ratings', MovieDB::getRatings());

        return view('result',[
            'movies' => $movieData,
            'key' => $url,
            'rating' => $rating
        ]);

    }

    public function update()
    {
        $urls = Session::get('urls');
        $ratings = Session::get('ratings');

        unset($urls[0]);                            // remove operation
        $urls = array_values($urls);
        $temp_url = array_filter($urls);

        unset($ratings[0]);
        $ratings = array_values($ratings);          // remove operation

        if (empty($temp_url)) {             // list is empty.. show message about end of the list
            dd("empty shit!");
        }
        if (strpos($urls[0],'be/') !== false) {
            $old_url = $urls[0];
            $old_url = substr($old_url, strpos($old_url, "be/") + 3);       // old youtube url should be factored
            $urls[0] = $old_url;
        }

        Session::put('urls', $urls);
        Session::put('ratings', $ratings);

        $url = $urls[0];
        $rating = $ratings[0];
        return view('result',[
            'key' => $url,
            'rating' => $rating
        ]);
    }
}
