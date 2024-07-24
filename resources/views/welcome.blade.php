<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Login Page</title>
		<!-- Bootstrap CSS -->
		<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	</head>

	<body>
		<div class="container">
			<div class="row justify-content-center mt-5">
				<div class="col-md-6">
					<!-- Display Error Message -->
					@if (session("error"))
						<div class="alert alert-danger" role="alert">
							{{ session("error") }}
						</div>
					@endif
					<div class="card">
						<div class="card-header text-center">
							<h4>Login</h4>
						</div>
						<div class="card-body">
							<form action="{{ route("login") }}" method="POST">
								@csrf
								<div class="form-group">
									<label for="email">Username</label>
									<input name="name" type="text" class="form-control" id="name" placeholder="username">
								</div>
								<div class="form-group">
									<label for="password">Password</label>
									<input name="password" type="password" class="form-control" id="password" placeholder="password">
								</div>
								<button type="submit" class="btn btn-primary btn-block">Login</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Bootstrap JS, Popper.js, and jQuery -->
		<script src="{{ asset("assets/plugins/bootstrap/js/bootstrap.min.js") }}"></script>
		<script src="{{ asset("assets/plugins/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
		<script src="{{ asset("assets/plugins/jquery/jquery.min.js") }}"></script>
		<script>
			window.addEventListener('pageshow', function(event) {
				if (event.persisted || (typeof window.performance != 'undefined' && window.performance.navigation.type ===
						2)) {
					window.location.reload();
				}
			});
		</script>
	</body>

</html>
