<?php
namespace App\Services;
use Illuminate\Database\Eloquent\Model;
use Cache;


class MovieDB extends Model                     // class for Movie DB API
{
    public static $storage;
    public static $url;
    public static $rating;
    public static $title;

    public function __construct()
    {
        self::$storage = array();
        self::$url = array();
        self::$rating = array();
        self::$title = array();
    }

    public static function getUrl()
    {
        return self::$url;
    }

    public static function getRatings()
    {
        return self::$rating;
    }

    public static function getTitle()
    {
        return self::$title;
    }

    public static function search($year1,$year2,$genre,$rating)
    {
        $query = $year1 . $year2 . $genre . $rating;
        {
            $genre_id = self::getGenreId($genre);
            $token  = new \Tmdb\ApiToken('0c56401bde4dc0dea76f181c05b2171f');       // api key
            $client = new \Tmdb\Client($token);

            if($genre_id == 0)      // genre not selected
            {
                $response = $client->getDiscoverApi()->discoverMovies([
                    'page' => 1,
                    'language' => 'en',
                    'primary_release_date.gte' => $year1 . '-01-01',
                    'primary_release_date.lte' => $year2 . '-01-01',
                    'vote_average.gte' => $rating
                ]);
            }
            else
            {
                $response = $client->getDiscoverApi()->discoverMovies([
                    'page' => 1,
                    'language' => 'en',
                    'primary_release_date.gte' => $year1 . '-01-01',
                    'primary_release_date.lte' => $year2 . '-01-01',
                    'with_genres' => $genre_id,
                    'vote_average.gte' => $rating
                ]);
            }

            for($i = 0; $i <= 19; $i++) // store the movie keys
            {
                self::$storage[] = $response["results"][$i]["id"];
                self::$rating[] =  $response["results"][$i]["vote_average"];
            }

            $repository  = new \Tmdb\Repository\MovieRepository($client);
            for($i = 0; $i <= 19; $i++)
            {
                $movie = $repository->load(self::$storage[$i]);
                foreach ($movie->getVideos() as $trailer) {
                    self::$url[] = $trailer->getKey();
                    self::$title[] =$movie->getTitle();
                    break;
                }
            }

            Cache::put($query,$response,60);
            return ($response);
        }

    }

    public static function getGenreId($genre)
    {
        if($genre == "action")
        {
            return 28;
        }
        else if($genre == "adventure")
        {
            return 12;
        }

        else if($genre == "animation")
        {
            return 16;
        }
        else if($genre == "comedy")
        {
            return 35;
        }
        else if($genre == "crime")
        {
            return 80;
        }
        else if($genre == "documentary")
        {
            return 99;
        }
        else if($genre == "drama")
        {
            return 18;
        }
        else if($genre == "family")
        {
            return 10751;
        }
        else if($genre == "fantasy")
        {
            return 14;
        }
        else if($genre == "foreign")
        {
            return 10769;
        }
        else if($genre == "history")
        {
            return 36;
        }
        else if($genre == "horror")
        {
            return 27;
        }
        else if($genre == "music")
        {
            return 10402;
        }
        else if($genre == "mystery")
        {
            return 9648;
        }
        else if($genre == "romance")
        {
            return 10749;
        }
        else if($genre == "sci_fi")
        {
            return 878;
        }
        else if($genre == "thriller")
        {
            return 53;
        }
        else if($genre == "war")
        {
            return 10752;
        }
        else if($genre == "western")
        {
            return 37;
        }
        else
        {
            return 0;
        }
    }
}