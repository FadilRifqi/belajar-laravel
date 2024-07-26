<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>@yield("title") | @yield("page")</title>

		<!-- Google Font: Source Sans Pro -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="{{ asset("assets/plugins/fontawesome-free/css/all.min.css") }}">
		<!-- Ionicons -->
		<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
		<!-- Tempusdominus Bootstrap 4 -->
		<link rel="stylesheet"
			href="{{ asset("assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css") }}">
		<!-- iCheck -->
		<link rel="stylesheet" href="{{ asset("assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css") }}">
		<!-- JQVMap -->
		<link rel="stylesheet" href="{{ asset("assets/plugins/jqvmap/jqvmap.min.css") }}">
		<!-- Theme style -->
		<link rel="stylesheet" href="{{ asset("assets/dist/css/adminlte.min.css") }}">
		<!-- overlayScrollbars -->
		<link rel="stylesheet" href="{{ asset("assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css") }}">
		<!-- Daterange picker -->
		<link rel="stylesheet" href="{{ asset("assets/plugins/daterangepicker/daterangepicker.css") }}">
		<!-- summernote -->
		<link rel="stylesheet" href="{{ asset("assets/plugins/summernote/summernote-bs4.min.css") }}">
		@vite("resources/css/layout.css")
		@vite("resources/js/app.js")
		@livewireStyles
		@yield("head")
	</head>

	<body class="hold-transition sidebar-mini layout-fixed">
		<div class="wrapper">
			<!-- Preloader -->
			<div class="preloader flex-column justify-content-center align-items-center">
				<img class="animation__shake" src="{{ asset("assets/dist/img/AdminLTELogo.png") }}" alt="AdminLTELogo"
					height="60" width="60">
			</div>

			<!-- Navbar -->
			@include("layout.client.navbar")
			<!-- /.navbar -->

			<!-- Main Sidebar Container -->
			<aside class="main-sidebar sidebar-dark-primary elevation-4">
				<!-- Brand Logo -->
				<a href="index3.html" class="brand-link">
					<img src="{{ asset("assets/dist/img/AdminLTELogo.png") }}" alt="AdminLTE Logo"
						class="brand-image img-circle elevation-3" style="opacity: .8">
					<span class="brand-text font-weight-light">{{ auth()->user()->divisi->nama }}</span>
				</a>

				<!-- Sidebar -->
				@include("layout.client.sidebar")
				<!-- /.sidebar -->
			</aside>

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<div class="content-header">
					<div class="container-fluid">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1 class="m-0">@yield("page")</h1>
							</div><!-- /.col -->
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-right">
									<li class="breadcrumb-item"><a class="text-red" href="{{ route("logout") }}">Logout</a></li>
									<li class="breadcrumb-item active">@yield("page")</li>
								</ol>
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.container-fluid -->
				</div>
				<!-- /.content-header -->

				<!-- Main content -->
				<section class="content pb-3">
					<div class="container-fluid">
						@yield("content")
					</div>
				</section>
				<!-- /.content -->
			</div>
			<!-- /.content-wrapper -->
			<footer class="main-footer">
				<strong>Copyright &copy; 2014-2021 <a href="https://github.com/FadilRifqi" target="_blank">Khebab</a>.</strong>
				All rights reserved.
			</footer>

			<!-- Control Sidebar -->
			<aside class="control-sidebar control-sidebar-dark">
				<!-- Control sidebar content goes here -->
			</aside>
			<!-- /.control-sidebar -->
		</div>
		<!-- ./wrapper -->

		<!-- jQuery -->
		<script src="{{ asset("assets/plugins/jquery/jquery.min.js") }}"></script>
		<!-- jQuery UI 1.11.4 -->
		<script src="{{ asset("assets/plugins/jquery-ui/jquery-ui.min.js") }}"></script>
		<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
		<script>
			$.widget.bridge('uibutton', $.ui.button)
		</script>
		<!-- Bootstrap 4 -->
		<script src="{{ asset("assets/plugins/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
		<!-- ChartJS -->
		<script src="{{ asset("assets/plugins/chart.js/Chart.min.js") }}"></script>
		<!-- Sparkline -->
		<script src="{{ asset("assets/plugins/sparklines/sparkline.js") }}"></script>
		<!-- JQVMap -->
		<script src="{{ asset("assets/plugins/jqvmap/jquery.vmap.min.js") }}"></script>
		<script src="{{ asset("assets/plugins/jqvmap/maps/jquery.vmap.usa.js") }}"></script>
		<!-- jQuery Knob Chart -->
		<script src="{{ asset("assets/plugins/jquery-knob/jquery.knob.min.js") }}"></script>
		<!-- daterangepicker -->
		<script src="{{ asset("assets/plugins/moment/moment.min.js") }}"></script>
		<script src="{{ asset("assets/plugins/daterangepicker/daterangepicker.js") }}"></script>
		<!-- SweetAlert2 -->
		<script src="{{ asset("assets/plugins/sweetalert2/sweetalert2.min.js") }}"></script>
		<!-- Summernote -->
		<script src="{{ asset("assets/plugins/summernote/summernote-bs4.min.js") }}"></script>
		<!-- overlayScrollbars -->
		<script src="{{ asset("assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js") }}"></script>
		<!-- AdminLTE App -->
		<script src="{{ asset("assets/dist/js/adminlte.js") }}"></script>
		<!-- Livewire Scripts -->
		@livewireScripts
		@yield("script")
	</body>

</html>
