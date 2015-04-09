@extends('layouts.default')

@section('page_title', 'Account manager')

@section('body_title', 'Manage your account')

@section('content')
    <p>Make your changes here ...</p>
    <table class="table table-condensed">
        @foreach($select as $user)
            <tbody>
            <tr>
                <td rowspan="3" class="text-center"><img class="img-thumbnail" src="{{ $user->avatar }}"
                                                         title="{{ $user->name }}"/></td>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <td>{{ $user->password }}</td>
            </tr>
            </tbody>
        @endforeach
    </table>
@stop
