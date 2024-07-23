<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Management Login - @yield("title")</title>
		<!-- Styles -->
		<link href="{{ asset("assets/plugins/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet">
		@yield("head")
	</head>

	<body>
		<header>
			<!-- Header content here -->
			@include("layout.client.navbar")
		</header>

		<main>
			<section class="jumbotron text-center">
				<div class="container">
					<h1 class="jumbotron-heading">Welcome to Your Dashboard</h1>
					<p class="lead text-muted">Manage everything from one place.</p>
					<p>
						<a href="#" class="btn btn-primary my-2">Main call to action</a>
						<a href="#" class="btn btn-secondary my-2">Secondary action</a>
					</p>
				</div>
			</section>
			<div class="container">
				@yield("content")
			</div>
		</main>

		<footer>
			<div class="container">
				<p class="float-right">
					<a href="#">Back to top</a>
				</p>
				<p>Dashboard © 2023 Company, Inc</p>
			</div>
		</footer>

		<script>
			window.onpageshow = function(event) {
				if (event.persisted) {
					window.location.reload();
				}
			};
		</script>
	</body>

</html>
