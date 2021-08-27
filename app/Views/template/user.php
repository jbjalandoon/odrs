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
          <a class="nav-link sideLink" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Form-137 Request</a>

          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Generate Form-137 Request</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="" action="<?=base_url('form-137')?>" method="post" target="_blank">
                  <div class="modal-body">
                    <div class="form-group mb-3">
                      <label for="school" class="form-label">School: </label>
                      <input type="text" name="school" id="school" class="form-control" placeholder="School came from" required>
                    </div>
                    <div class="form-group">
                      <label class="form-label">Request:</label>
                      <br>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" name="request" type="radio" id="inlineCheckbox1" value="1st Request" checked>
                        <label class="form-check-label" for="inlineCheckbox1">1st</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" name="request" type="radio" id="inlineCheckbox2" value="2nd Request">
                        <label class="form-check-label" for="inlineCheckbox2">2nd</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" name="request" type="radio" id="inlineCheckbox3" value="3rd Request">
                        <label class="form-check-label" for="inlineCheckbox3">3rd</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" name="request" type="radio" id="inlineCheckbox4" value="4th Request">
                        <label class="form-check-label" for="inlineCheckbox4">4th</label>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Generate</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
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
