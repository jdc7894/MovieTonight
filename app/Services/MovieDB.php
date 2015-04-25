<?php
namespace App\Services;
use Illuminate\Database\Eloquent\Model;
use Cache;

class MovieDB                       // class for Movie DB API
{
    protected $cache;
    protected $client;
//    public function __construct(\Illuminate\Cache\Repository $cache, $client)
//    {
//        $this->cache = $cache;
//        $this->client = $client;
//    }

    public function search($year1,$year2,$genre,$rating,$keyword)
    {
//        if($this->cache->has($dvd_title)) {
//            return json_decode($this->cache->get($dvd_title));
//        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://api.themoviedb.org/3/discover/movie/550?api_key=0c56401bde4dc0dea76f181c05b2171f");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Accept: application/json"
        ));

        $response = curl_exec($ch);
        curl_close($ch);
        return ($response);
//        $json = $this->client->get('http://api.themoviedb.org/3/discover/movie/550?api_key=0c56401bde4dc0dea76f181c05b2171f
//');
//        return json_decode($json);
    }
}