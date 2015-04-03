@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Account Manager</div>

                    <div class="panel-body">
                        <p>Make your changes here ...</p>
                        <p>
                            Current user ID: {{ $user_id }}
                        </p>
                        <p>
                            <ul>
                            @foreach($results as $result)
                                <li>{{ $result->name }}</li>
                                <li>{{ $result->email }}</li>
                                <li>{{ $result->password }}</li>
                            @endforeach
                            </ul>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
