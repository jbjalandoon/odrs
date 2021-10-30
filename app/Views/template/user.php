<nav class="navbar navbar-expand-lg">
  <div class="container">
  <img src="<?=base_url()?>/img/pupt-logo.png" alt="">

    <a class="navbar-brand" href="/<?=$_SESSION['landing_page']?>">
      PUP Taguig | Online Document Request
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="menu"><i class="fas fa-bars"></i></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <?php foreach ($allPermissions as $permission): ?>
          <?php if ($permission['type_slug'] == 'view'): ?>
            <li class="nav-item">
              <a class="nav-link sideLink active" href="<?=esc(base_url(esc($permission['path'])))?>"><?=esc(ucwords($permission['permission']))?></a>
            </li>
          <?php endif; ?>
        <?php endforeach; ?>
        <li class="nav-item">
          <a class="nav-link sideLink active" href="<?=esc(base_url('form-137'))?>">Form 137 Form</a>
        </li>
      </ul>
      <ul class="navbar-nav logout">
          <li class="nav-item dropdown d-flex">
              <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="far fa-user-circle"></i> <?=esc($_SESSION['name'])?>
              </a>
              <ul class="dropdown-menu " aria-labelledby="navbarDropdown">
                  <!-- <li><hr class="daxropdown-divider"></li> -->
                  <li><a class="dropdown-item" style="color: black;"  href="#" id="passwordModal" data-bs-toggle="modal" data-bs-target="#passwordForm" ><i class="fas fa-lock"></i> Change Password</a></li>
                  <li><a class="dropdown-item" style="color: black;"  href="/logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
              </ul>
          </li>
      </ul>
    </div>
  </div>
</nav>

<div id="passwordContainer">
  <?= view('userTemplate/passwordForm') ?>
</div>
