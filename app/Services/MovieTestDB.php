<?php
/**
 * Created by PhpStorm.
 * User: daecheol
 * Date: 4/28/15
 * Time: 5:16 PM
 */

namespace App\Services;


class MovieTestDB {
    protected $client;
    protected $cache;

    public function __construct($cache,$client)
    {
        $this->cache = $cache;
        $this->client = $client;
    }

    public function search($movie_title)
    {
        if($this->cache->has($movie_title))
        {
            return json_decode($this->cache->get($movie_title));
        }

        $json = $this->client->get('http://tmdb.com?q=' . urlencode($movie_title));
        return json_decode($json);   
    }
}