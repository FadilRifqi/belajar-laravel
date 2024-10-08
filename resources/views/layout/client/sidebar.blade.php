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
						<a href="{{ route(strtolower(auth()->user()->role->name)) }}"
							class="nav-link {{ Route::currentRouteName() == strtolower(auth()->user()->role->name) ? "active" : "" }}">
							<i class="fa fa-home nav-icon"></i>
							<p> Dashboard</p>
						</a>
					</li>
				</ul>
			</li>
			<!-- Add icons to the links using the .nav-icon class						with font-awesome or any other icon font library -->
			<li class="nav-item menu-open">
				<ul class="nav nav-treeview">
					<li class="nav-item">
						<a href="{{ route("chat") }}" class="nav-link {{ Route::currentRouteName() == "chat" ? "active" : "" }}">
							<i class="far fa-comment-dots nav-icon"></i>
							<p>Chat</p>
						</a>
					</li>
				</ul>
			</li>

			@if (auth()->user()->role_id == 1)
				<li
					class="nav-item {{ in_array(Route::currentRouteName(), ["generate", "manage-presensi", "manage-presensi.search", "manage-pegawai", "data.edit", "manage-pegawai.search"]) ? "menu-open" : "" }}">
					<a href="#"
						class="nav-link {{ in_array(Route::currentRouteName(), ["generate", "manage-presensi", "manage-presensi.search", "manage-pegawai", "data.edit", "manage-pegawai.search"]) ? "active-warning" : "" }}">
						<i class="fa fa-suitcase nav-icon"></i>
						<p>Pegawai
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="{{ route("generate") }}" class="nav-link {{ Route::currentRouteName() == "generate" ? "active" : "" }}">
								<i class="fa fa-qrcode nav-icon"></i>
								<p>Generate Presensi</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route("manage-presensi") }}"
								class="nav-link {{ Route::currentRouteName() == "manage-presensi" || Route::currentRouteName() == "manage-presensi.search" ? "active" : "" }}">
								<i class="far fa-address-card nav-icon"></i>
								<p>Manage Presensi</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route("manage-pegawai") }}"
								class="nav-link {{ Route::currentRouteName() == "manage-pegawai" || Route::currentRouteName() == "data.edit" || Route::currentRouteName() == "manage-pegawai.search" ? "active" : "" }}">
								<i class="fa fa-users nav-icon"></i>
								<p>Manage Pegawai</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item menu-open">
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="{{ route("ticket.admin") }}"
								class="nav-link {{ Route::currentRouteName() == "ticket.admin" || Route::currentRouteName() == "data.edit" || Route::currentRouteName() == "manage-pegawai.search" ? "active" : "" }}">
								<i class="fa fa-exclamation-circle nav-icon"></i>
								<p>Opened Ticket</p>
							</a>
						</li>
					</ul>
				</li>
			@else
				<li class="nav-item menu-open">
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="{{ route("scan") }}" class="nav-link {{ Route::currentRouteName() == "scan" ? "active" : "" }}">
								<i class="fa fa-qrcode nav-icon"></i>
								<p>Scan Presensi</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item menu-open">
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="{{ route("ticket") }}" class="nav-link {{ Route::currentRouteName() == "ticket" ? "active" : "" }}">
								<i class="fa fa-exclamation-circle nav-icon"></i>
								<p>Open Ticket</p>
							</a>
						</li>
					</ul>
				</li>
			@endif

		</ul>
	</nav>
	<!-- /.sidebar-menu -->
</div>
