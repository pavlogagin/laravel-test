@extends('layouts.default')

@section('page_title', 'Account summary')

@section('body_title', 'Brief account summary')

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <p>Here will be brief summary of:</p>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Expense</th>
            <th>Amount, CAD</th>
        </tr>
        </thead>
        <tbody id="append_perm_exps">
        @foreach($perm_exps as $perm_exp)
            <tr>
                <td>{{ $perm_exp->title }}</td>
                <td>{{ number_format($perm_exp->amount, 2, ',', ' ') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <table class="table">
        <tr>
            <form class="form-horizontal" role="form" method="post" action="{{ url('/home') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <td class="nopadding-hor">
                    <div class="input-group">
                        <span class="input-group-addon glyphicon glyphicon-pencil"></span>
                        <input class="form-control" type="text" name="title" placeholder="Expense's title, eg. MSP"/>
                    </div>
                </td>
                <td class="nopadding-hor">
                    <div class="input-group">
                        <span class="input-group-addon glyphicon glyphicon-usd"></span>
                        <input class="form-control" type="text" name="amount" placeholder="Amount, eg. 65.25"/>
                        <span class="input-group-btn">
                            <button id="add_perm_exp" class="btn btn-default" type="button"><span class="glyphicon glyphicon-plus"></span></button>
                        </span>
                    </div>
                </td>
            </form>
        </tr>
    </table>
@stop