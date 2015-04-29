@extends('layout')
@section('content')
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/twitter-bootstrap/3.0.3/css/bootstrap-combined.min.css">
    <link rel="stylesheet"  href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <body>
    <div class="intro-text">
        <div class="span6">
            <div class="intro-lead-in">Welcome To Movie Tonight!</div>
            <div class="intro-heading">Fill in your preferences!</div>
            <div id="big-form" class="">
                <form action="/result" method="get">
                    <fieldset>
                        <div class="form-group">
                            <div class="">
                                <label class=" control-label">Year </label>
                                <input name="year1" id="year1" type="text" class="textbox" value="1900" size="4" maxlength="4" style="width:50px; color:black"/><span style="width:9px; padding-top:5px; margin-right:0px;">-</span>
                                <input name="year2" id="year2" type="text" class="textbox" value="2015" size="4" maxlength="4" style="width:50px; color:black"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class=" control-label">Genre </label>
                            <select class="combobox" name="genre" id="genre">
                                <option value="">Select genre</option>
                                <option value="action"  >action movies</option>
                                <option value="adventure"  >adventure movies</option>
                                <option value="animation"  >animation movies</option>
                                <option value="comedy"  >comedy movies</option>
                                <option value="crime"  >crime movies</option>
                                <option value="documentary"  >documentary movies</option>
                                <option value="drama"  >drama movies</option>
                                <option value="family"  >family movies</option>
                                <option value="fantasy"  >fantasy movies</option>
                                <option value="foreign"  >film-noir movies</option>
                                <option value="history"  >history movies</option>
                                <option value="horror"  >horror movies</option>
                                <option value="music"  >music movies</option>
                                <option value="mystery"  >mystery movies</option>
                                <option value="romance"  >romance movies</option>
                                <option value="sci_fi"  >sci-fi movies</option>
                                <option value="thriller"  >thriller movies</option>
                                <option value="war"  >war movies</option>
                                <option value="western"  >western movies</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class=" control-label">TMDb Score </label>
                            <select name="rating">
                                <option value="0">Any</option>
                                <option value="3">Above 3</option>
                                <option value="4">Above 4</option>
                                <option value="5">Above 5</option>
                                <option value="6">Above 6</option>
                                <option value="7">Above 7</option>
                                <option value="8">Above 8</option>
                                <option value="9">Above 9</option>
                            </select>
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
