<?php

class MovieDBTest extends TestCase {

    public function tearDown()
    {
        Mockery::close();
    }

    public function testSearchPullsFromCache()
    {
        $json = '{"total": 0, "movies: []}';
        $client = Mockery::mock('Apps\Services\Client');

        $cache = Mockery::mock('Illuminate\Cache\Repository');
        $cache->shouldReceive('has')->with('query')->andReturn(true);
        $cache->shouldReceive('get')->with('query')->andReturn($json);

        $rt = new App\Services\MovieTestDB($cache,$client);
        $results = $rt->search('query');
        $this->assertEquals($results, json_decode($json));
    }

    public function testSearchPullsFromApiAndStoresInCache()
    {
        $client = Mockery::mock('Apps\Services\Client');
        $client->shouldReceive('get')
            ->with('http://tmdb.com?q=query')
            ->andReturn('{"total": 0, "movies: []}');

        $cache = Mockery::mock('Illuminate\Cache\Repository');
        $cache->shouldReceive('has')->with('query')->andReturn(false);

        $rt = new App\Services\MovieTestDB($cache,$client);
        $results = $rt->search('query');
        $this->assertEquals($results,json_decode('{"total": 0, "movies: []}'));

    }

}