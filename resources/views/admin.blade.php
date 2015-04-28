@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    @for ($i = 0; $i < count($users); $i++)
                        @if($users[$i]['attributes']['name'] != "David")
                        <div class="panel-heading">{{$users[$i]['attributes']['name']}}</div>

                        <form action="/delete_user/{{$users[$i]['attributes']['id']}}" method="get">
                            <fieldset>
                                <div class="form-group" align="center">
                                    <div class="">
                                        <button id="singlebutton" name="singlebutton" class="btn btn-primary">Delete this user.</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                        @endif
                    @endfor
                </div>
            </div>
        </div>
    </div>
@endsection
