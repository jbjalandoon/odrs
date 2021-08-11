<!-- <main> -->
<nav class="navbar navbar-expand-lg sticky">
  <div class="container-fluid">
    <!-- <i class="fas fa-bars"></i> -->
    <span>Registrar's Online Document Request and Approval System</span>

    <div class="d-flex logout" id="navbarSupportedContent">
      <ul class="navbar-nav">
        <li class="nav-item dropdown me-3">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <span><?=ucwords(esc($_SESSION['name']))?></span>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="/logout">Log out<i class="fas fa-sign-out-alt"></i></a></li>
            </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>


      <!-- <div class="helper">
        RESIZE THE WINDOW
            <span>Breakpoints on 900px and 400px</span>
      </div> -->
    </main>
<!-- <nav class="navbar navbar-expand-lg fixed-top">
  <div class="container-fluid">
    <div class="navbar-brand">
    <img src="/img/pupt-logo.png" alt="PUPT">
      <a class="navbar-brand" href="#">
        Registrar's Document Request and Approval System
      </a>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div id="logout" class="collapse navbar-collapse d-flex" id="navbarSupportedContent">


      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

      </ul>
      //<a href="/logout"> <i class="fa fa-power-off"></i></a>
      <ul class="navbar-nav d-flex">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Super Admin
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#"><i class="fas fa-user"></i>My Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="/logout"><i class="fas fa-sign-out-alt"></i>Log out</a></li>
            </ul>
        </li>
    </ul>
    </div>
  </div>
</nav> -->
