<nav class="navbar navbar-expand-lg my-navbar sticky-top">
    <div class="container">
      <a class="navbar-brand" href="/"><span class="container-logo "><img class="logo-infest mb-1" src="{{asset("images/logo.png")}}" alt=""></span> INFEST</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link {{$page === "home" ? "active" : ""}}" href="/">HOME</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{$page === "shop" ? "active" : ""}}" href="/shop">SHOP</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{$page === "inventory" ? "active" : ""}}" href="/inventory">INVENTORY</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>