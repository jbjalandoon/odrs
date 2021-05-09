<nav class="navbar navbar-expand-lg">
  <div class="container">
      <img src="img/pupt-logo.png" alt="">
      <!-- hindi ko alam bakit sa isang page hindi nagview ang logo hmpk -->
      <a class="navbar-brand" href="/student">
          PUP Taguig |Online Document Request
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                  <a class="nav-link sideLink active" href="<?=esc(base_url())?>/student"> My Requests</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link sideLink" href="<?=esc(base_url())?>/student/history">Request History</a>
              </li>
          </ul>
          <ul class="navbar-nav logout">
              <li class="nav-item dropdown d-flex">
                  <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="far fa-user-circle"></i> 2018-00293-TG-0
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <!-- <li><hr class="dropdown-divider"></li> -->
                      <li><a class="dropdown-item" href="/logout">Logout<i class="fas fa-sign-out-alt"></i></a></li>
                  </ul>
              </li>
          </ul>
      </div>
  </div>
</nav>

<!-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <div class="navbar-brand">
      <a class="navbar-brand" href="#">
        ODRS
      </a>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

      </ul>
      <a href="/logout"> <i class="fa fa-power-off"></i></a>
    </div>
  </div>
</nav> -->
