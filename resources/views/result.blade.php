@extends('layout')
@section('service')
    {!! HTML::style('css/bar.css')!!}

    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/twitter-bootstrap/3.0.3/css/bootstrap-combined.min.css">
    <link rel="stylesheet"  href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <body>
    <div class="container">
        <?php $url = "http://www.youtube.com/v/". $key. "?version=3" ?>
            <object width="605" height="350" data={{$url}}> type="application/x-shockwave-flash"><param name="src" value={{$url}} /></object>
            <form action="/update" method="get">
                <fieldset>
                    <div class="form-group" align="center">
                        <div class="">
                            <button id="singlebutton" name="singlebutton" class="btn btn-primary">Recommend other movies!</button>
                        </div>
                    </div>
                    </fieldset>
                </form>
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow=""
                     aria-valuemin="0" aria-valuemax="100" style="width:{{$rating}}">
                    {{$rating}} people recommended this movie!
                </div>
            </div>
    </div>
@stop