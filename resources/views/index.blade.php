@extends('layout')
@section('content')
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/twitter-bootstrap/3.0.3/css/bootstrap-combined.min.css">
        <link rel="stylesheet"  href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <body>
    <div class="container auth">

        <div class="span6 pull-right">
            <div id="big-form" class="well auth-box">
                <form action="/dvds" method="get">
                    <fieldset>
                        <div class="form-group">
                            <div class="">
                                <label class=" control-label">Year </label>
                                <select name="year_id">

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class=" control-label">Genre </label>
                            <select name="genre_id">
                                <option value="0">All</option>

                            </select>
                        </div>

                        <div class="form-group">
                            <label class=" control-label">IMDb Score </label>
                            <select name="rating_id">
                                <option value="0">All</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class=" control-label">Movie Keyword </label>
                                <input type="text" class="form-group" name="keyword" id="keyword">
                        </div>

                        <div class="form-group" align="center">
                            <div class="">
                                <button id="singlebutton" name="singlebutton" class="btn btn-primary">Recommend Movies!</button>
                            </div>
                        </div>

                    </fieldset>
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
@stop