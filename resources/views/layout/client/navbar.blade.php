<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="">Navbar</a>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="" class="nav-link">
                Dashboard
            </a>
        </li>
      </ul>
      <!-- Right-aligned items -->
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
          </form>
          <a href="#" role="button" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>