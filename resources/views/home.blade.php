@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Brief Summary</div>

				<div class="panel-body">
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
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
