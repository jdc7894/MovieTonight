@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">

                    @for ($i = 0; $i < count($movies); $i++)
                        <div class="panel-heading">{{$movies[$i]['attributes']['name']}}</div>

                        <div class="panel-body">
                            <object width="605" height="350" data={{"http://www.youtube.com/v/". $movies[$i]['attributes']['key']. "?version=3"}}> type="application/x-shockwave-flash"><param name="src" value={{"http://www.youtube.com/v/". $movies[$i]['attributes']['key']. "?version=3"}} /></object>
                        </div>
                    @endfor

                </div>
            </div>
        </div>
    </div>
@endsection
