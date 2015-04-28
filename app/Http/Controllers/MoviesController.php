<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MovieDB;
use App\Models\Movie;
use App\Models\Visitor;
use App\Models\User;
use \Auth;
use \Session;
use DB;

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
            echo "<script type='text/javascript'>alert('That was end of my recommendations! Please make new search.');</script>";
            return redirect('/index');
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

    /* Save movie to the favorite movie list database */
    public function save()
    {
        $session = new \Symfony\Component\HttpFoundation\Session\Session();
        $session->start();
        $titles = Session::get('titles');
        $urls = Session::get('urls');
        $ratings = Session::get('ratings');

        /* Save to the movies database*/
        if (Auth::check())
        {
            $user = new Visitor();
            $user->name = Auth::user()->name;
            $user->email = Auth::user()->email;
            $user->save();

            $movieStorage = Movie::where('name', '=', $titles[0])->where('visitor_id', '=', Auth::user()->id)->get();
            if(count($movieStorage) != 0)
            {
                echo "<script type='text/javascript'>alert('You already saved this movie to your list');</script>";
                return redirect('/update');
            }
            $movie = new Movie();
            $movie->visitor_id = Auth::user()->id;
            $movie->name = $titles[0];
            $movie->key = $urls[0];
            $movie->rating = $ratings[0];
            $movie->save();
        }
        else
        {
            echo "<script type='text/javascript'>alert('You should log in to save the movies');</script>";
            return redirect('/auth/login');
        }

        $session->getFlashBag()->add('save-success',$titles[0] . ' was successfully saved to your list!');
        foreach ($session->getFlashBag()->get('save-success') as $message) {
            echo "<script type='text/javascript'>alert('$message');</script>";
        }

        return redirect('/update');
    }

    /* Get information from database.. */
    public function show()
    {
        /* Find current user id and query the movie database */
        if (Auth::check())
        {
            $id = Auth::user()->id;
            $movies = Movie::where('visitor_id', '=', $id)->get();      // find movies for this user
            //TODO: handle if movies are empty
        }

        return view('/auth/movielist', [
            'movies' => $movies
        ]);
    }

    /* Delete certain movie from database */
    public function delete($id)
    {
        $movie = Movie::find($id);
        $movie->delete();
        return redirect('/movielist');
    }

    public function delete_user($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/admin');
    }

    public function admin()
    {
        $users = (User::all());
        return view('/admin', [
            'users' => $users
        ]);
    }
}
