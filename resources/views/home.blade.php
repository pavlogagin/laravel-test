@extends('layouts.default')

@section('page_title', 'Account summary')

@section('body_title', 'Brief account summary')

@section('content')
    <p>Here will be brief summary of:</p>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Expense</th>
            <th>Amount, CAD</th>
        </tr>
        </thead>
        <tbody>
        @foreach($perm_exps as $perm_exp)
            <tr>
                <td>{{ $perm_exp->title }}</td>
                <td>{{ $perm_exp->amount }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop
