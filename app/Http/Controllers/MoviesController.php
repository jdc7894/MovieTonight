<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MovieDB;
use App\Models\Movie;
use App\Models\Visitor;
use \Auth;
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
//        return \Auth::user();

        return view('index');
    }

    public function result(Request $request)    // get request from index.blade
    {
        $year1 = $request->input('year1');
        $year2 = $request->input('year2');
        $genre = $request->input('genre');
        $rating = $request->input('rating');

        $movieData = MovieDB::search($year1,$year2,$genre,$rating);
        $url = MovieDB::getUrl()[0];
        $rating = MovieDB::getRatings()[0];
        $title = MovieDB::getTitle()[0];

        Session::put('urls', MovieDB::getUrl());
        Session::put('ratings', MovieDB::getRatings());
        Session::put('titles', MovieDB::getTitle());


        return view('result',[
            'movies' => $movieData,
            'key' => $url,
            'rating' => $rating,
            'title' => $title
        ]);

    }

    public function update()
    {
        $urls = Session::get('urls');
        $ratings = Session::get('ratings');
        $titles = Session::get('titles');

        unset($urls[0]);                            // remove operation
        $urls = array_values($urls);
        $temp_url = array_filter($urls);

        unset($ratings[0]);
        $ratings = array_values($ratings);          // remove operation

        unset($titles[0]);
        $titles = array_values($titles);          // remove operation

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
        Session::put('titles', $titles);

        $url = $urls[0];
        $rating = $ratings[0];
        $title = $titles[0];

        return view('result',[
            'key' => $url,
            'rating' => $rating,
            'title' => $title
        ]);
    }

    public function save()
    {
        $session = new \Symfony\Component\HttpFoundation\Session\Session();
        $session->start();

        if (Auth::check())
        {
            $user = new Visitor();
            $user->name = Auth::user()->name;
            $user->email = Auth::user()->email;
            $user->save();

            $movie = new Movie();
            $movie->visitor_id = Auth::user()->id;
            $movie->name = "what";
            $movie->key = "kk";
            $movie->rating = "2";
            $movie->save();
        }
        else
        {
            // pop up saying you need to login
        }

        /* TODO: replace as function */
        $urls = Session::get('urls');
        $ratings = Session::get('ratings');
        $titles = Session::get('titles');
        $session->getFlashBag()->add('save-success',$titles[0] . ' was successfully saved to your list!');

        unset($urls[0]);                            // remove operation
        $urls = array_values($urls);
        $temp_url = array_filter($urls);

        unset($ratings[0]);
        $ratings = array_values($ratings);          // remove operation

        unset($titles[0]);
        $titles = array_values($titles);          // remove operation

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
        Session::put('titles', $titles);

        $url = $urls[0];
        $rating = $ratings[0];
        $title = $titles[0];

        foreach ($session->getFlashBag()->get('save-success') as $message) {
            echo "<script type='text/javascript'>alert('$message');</script>";
        }

        return view('result',[
            'key' => $url,
            'rating' => $rating,
            'title' => $title
        ]);
    }
}
