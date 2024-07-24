<div class="sidebar">
	<!-- Sidebar user panel (optional) -->
	<div class="user-panel mt-3 pb-3 mb-3 d-flex">
		<div class="image">
			<img src="{{ asset("assets/dist/img/user2-160x160.jpg") }}" class="img-circle elevation-2" alt="User Image">
		</div>
		<div class="info">
			<a href="#" class="d-block">{{ auth()->user()->name }}</a>
		</div>
	</div>

	<!-- SidebarSearch Form -->
	<div class="form-inline">
		<div class="input-group" data-widget="sidebar-search">
			<input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
			<div class="input-group-append">
				<button class="btn btn-sidebar">
					<i class="fas fa-search fa-fw"></i>
				</button>
			</div>
		</div>
	</div>

	<!-- Sidebar Menu -->
	<nav class="mt-2">
		<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
			<!-- Add icons to the links using the .nav-icon class						with font-awesome or any other icon font library -->
			<li class="nav-item menu-open">
				<ul class="nav nav-treeview">
					<li class="nav-item">
						<a href="{{ route("chat") }}" class="nav-link {{ Route::currentRouteName() == "chat" ? "active" : "" }}">
							<i class="	far fa-comment-dots nav-icon"></i>
							<p>Chat</p>
						</a>
					</li>
				</ul>
			</li>
			@if (auth()->user()->role_id == 1)
				<li class="nav-item menu-open">
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="{{ route("generate") }}" class="nav-link {{ Route::currentRouteName() == "generate" ? "active" : "" }}">
								<i class="fa fa-qrcode nav-icon"></i>
								<p>Generate Presensi</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item menu-open">
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="{{ route("manage") }}" class="nav-link {{ Route::currentRouteName() == "manage" ? "active" : "" }}">
								<i class="far fa-address-card nav-icon"></i>
								<p>Manage Presensi</p>
							</a>
						</li>
					</ul>
				</li>
			@else
			@endif

		</ul>
	</nav>
	<!-- /.sidebar-menu -->
</div>
