<div id="header" class="container-fluid">
  <div class="row">
    <div class="col">
      <img src="<?=base_url()?>/img/pupt-logo.png" alt="">
      <span class="align-middle">PUPT - ODRS</span>
      <div class="dropdown float-end">
        <a class="btn dashboard btn-light btn-sm" href="<?=base_url('dashboards')?>">
          <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>
        <a class="btn completerqt btn-light btn-sm report" href="<?=base_url('completed')?>">
          <i class="fas fa-chart-line"></i> Completed Requests
        </a>
        <button class="btn logout btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="fas fa-user-shield"></i> <?=esc($_SESSION['name'])?>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
          <li><a class="dropdown-item" href="#" id="passwordModal" data-bs-toggle="modal" data-bs-target="#passwordForm" ><i class="fas fa-lock"></i> Change Password</a></li>
          <li><a class="dropdown-item" href="/logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>

<nav id="menu" class="navbar navbar-expand-lg navbar-light">
  <div class="container">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav" aria-controls="main_nav" aria-expanded="false" aria-label="Toggle navigation">
      Menu
      <span class="navbar-toggler-icon btn-sm"></span>
    </button>
    <div class="collapse navbar-collapse" id="main_nav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <a class="nav-link sideLink" href="/document-requests">
            <i class="far fa-file-alt" style="color: maroon;"></i> Pending Requests
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link sideLink" href="/payment">
            <i class="fas fa-money-bill-wave" style="color: blue"></i> For Payment
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link sideLink" href="/paid">
            <i class="fas fa-receipt" style="color: green;"></i> Paid Requests
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link sideLink " href="/on-process-document">
              <i class="fas fa-redo-alt"style="color: goldenrod;"></i> On Process Documents
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link sideLink " href="/printed-requests">
              <i class="fas fa-print" style="color: blue;"></i> Printed Requests
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link sideLink " href="/claimed-requests">
            <i class="far fa-check-circle" style="color: green;"></i> Claimed Requests
            </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div id="passwordContainer">
  <?= view('userTemplate/passwordForm') ?>
</div>

<br>
<div class="container">
    <div class="content-wrapper">
