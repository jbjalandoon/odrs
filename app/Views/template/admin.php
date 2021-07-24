<div id="header" class="container-fluid">
  <div class="row">
    <div class="col">
      <img src="<?=base_url()?>/img/pupt-logo.png" alt="">
      <span class="align-middle">PUPT - ODRS</span>
      <div class="dropdown float-end">
        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
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
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="main_nav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <?php foreach ($allPermissions as $permission): ?>
            <?php if ($permission['type_slug'] == 'view'): ?>
            <li class="nav-item">
                <a class="nav-link sideLink " href="<?=esc(base_url(esc($permission['path'])))?>"><?=esc(ucwords($permission['permission']))?></a>
            </li>
            <?php endif; ?>
        <?php endforeach; ?>
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