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
                <form action="/result" method="get">
                    <fieldset>
                        <div class="form-group">
                            <div class="">
                                <label class=" control-label">Year </label>
                                <input name="year1" id="year1" type="text" class="textbox" value="1900" size="4" maxlength="4" style="width:50px;"/><span style="width:9px; padding-top:5px; margin-right:0px;">-</span>
                                <input name="year2" id="year2" type="text" class="textbox" value="2015" size="4" maxlength="4" style="width:50px;"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class=" control-label">Genre </label>
                            <select class="combobox" name="genre" id="genre">
                                <option value="">Select genre</option>
                                <option value="action"  >action movies</option>
                                <option value="adventure"  >adventure movies</option>
                                <option value="animation"  >animation movies</option>
                                <option value="biography"  >biography movies</option>
                                <option value="comedy"  >comedy movies</option>
                                <option value="crime"  >crime movies</option>
                                <option value="documentary"  >documentary movies</option>
                                <option value="drama"  >drama movies</option>
                                <option value="family"  >family movies</option>
                                <option value="fantasy"  >fantasy movies</option>
                                <option value="film_noir"  >film-noir movies</option>
                                <option value="history"  >history movies</option>
                                <option value="horror"  >horror movies</option>
                                <option value="music"  >music movies</option>
                                <option value="musical"  >musical movies</option>
                                <option value="mystery"  >mystery movies</option>
                                <option value="romance"  >romance movies</option>
                                <option value="sci_fi"  >sci-fi movies</option>
                                <option value="short"  >short movies</option>
                                <option value="sport"  >sport movies</option>
                                <option value="thriller"  >thriller movies</option>
                                <option value="war"  >war movies</option>
                                <option value="western"  >western movies</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class=" control-label">IMDb Score </label>
                            <select name="rating">
                                <option value="any">Any</option>
                                <option value="three">Above 3</option>
                                <option value="four">Above 4</option>
                                <option value="five">Above 5</option>
                                <option value="six">Above 6</option>
                                <option value="seven">Above 7</option>
                                <option value="eight">Above 8</option>
                                <option value="nine">Above 9</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class=" control-label">Movie Keyword </label>
                                <input type="text" class="form-group" name="keyword" id="keyword">
                        </div>

                        <div class="form-group" align="center">
                            <div class="">
                                <button id="submit" name="submit" class="btn btn-primary">Recommend Movies!</button>
                            </div>
                        </div>

                    </fieldset>
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
@stop