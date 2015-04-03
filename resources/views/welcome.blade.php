<html>
	<head>
		<title>HomeBudget | Pavlo Gagin</title>
		
		{{--<link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>--}}
        <link href="{{ asset('/css/app.css') }}" rel="stylesheet">

		<style>
			body {
				margin: 0;
				padding: 0;
				width: 100%;
				height: 100%;
				color: #B0BEC5;
				display: table;
                font-family: 'Indie Flower', cursive;
			}

			.container {
				text-align: center;
				display: table-cell;
				vertical-align: middle;
			}

			.content {
				text-align: center;
				display: inline-block;
			}

			.title {
				font-size: 96px;
				margin-bottom: 40px;
			}

			.quote {
				font-size: 24px;
			}

            .buttons {
                margin-top: 15px;
            }
		</style>
	</head>
	<body>
		<div class="container">
			<div class="content">
				<div class="title">HomeBudget</div>
				<div class="quote">{{ Inspiring::quote() }}</div>
                <div class="buttons">
                    <a href="/auth/register" class="btn btn-lg btn-success"><span class="glyphicon glyphicon-plus"></span> Create Account</a>
                    <a href="/auth/login" class="btn btn-lg btn-default">Sign In <span class="glyphicon glyphicon-user"></span></a>
                </div>
			</div>
		</div>
	</body>
</html>
