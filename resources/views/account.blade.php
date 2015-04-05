@extends('app')

@section('content')
    <p>Make your changes here ...</p>
    <p>
        <img src="{{ $gravatar }}" title="User Avatar" />Current user ID: {{ $user_id }}
    </p>
    <p>
        <ul>
        @foreach($select as $user)
            <li><img src="{{ $user->avatar }}" title="{{ $user->name }}" /></li>
            <li>{{ $user->name }}</li>
            <li>{{ $user->email }}</li>
            <li>{{ $user->password }}</li>
        @endforeach
        </ul>
    </p>
@endsection
