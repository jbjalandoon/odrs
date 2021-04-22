<div class="container mt-5">
  <div class="row">
    <div class="col-12">
      <span class="h2">Adding User</span>
    </div>
  </div>
  <hr>
  <form class="form-floating" action="add" method="post" autocomplete="off">
    <div class="row">
      <div class="col-4">
        <div class="form-group mb-3">
          <label for="firstname" class="form-label">First Name </label>
          <input value="<?=isset($value['firstname']) ? esc($value['firstname']): ''?>" type="text" name="firstname" class="form-control" id="firstname">
          <?php if (isset($error['firstname'])): ?>
            <div class="text-danger">
              <?=esc($error['firstname'])?>
            </div>
          <?php endif; ?>
        </div>
      </div>
      <div class="col-4">
        <div class="form-group mb-3">
          <label for="lastname" class="form-label">Last Name</label>
          <input value="<?=isset($value['lastname']) ? esc($value['lastname']): ''?>" type="text" name="lastname" class="form-control" id="lastname">
          <?php if (isset($error['lastname'])): ?>
            <div class="text-danger">
              <?=esc($error['lastname'])?>
            </div>
          <?php endif; ?>
        </div>
      </div>
      <div class="col-4">
        <div class="form-group mb-3">
          <label for="middlename" class="form-label">Middle Name</label>
          <input value="<?=isset($value['middlename']) ? esc($value['middlename']): ''?>" type="text" name="middlename" class="form-control" id="middlename">
          <?php if (isset($error['middlename'])): ?>
            <div class="text-danger">
              <?=esc($error['middlename'])?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-4">
        <div class="form-group mb-3">
          <label for="email" class="form-label">Email</label>
          <input value="<?=isset($value['email']) ? esc($value['email']) : ''?>" type="text" name="email" class="form-control" id="email">
          <?php if (isset($error['email'])): ?>
            <div class="text-danger">
              <?=esc($error['email'])?>
            </div>
          <?php endif; ?>
        </div>
      </div>
      <div class="col-4">
        <div class="form-group mb-3">
          <label for="contact" class="form-label">Contact</label>
          <input value="<?=isset($value['contact']) ? esc($value['contact']): ''?>" type="text" name="contact" class="form-control" id="contact">
          <?php if (isset($error['contact'])): ?>
            <div class="text-danger">
              <?=esc($error['contact'])?>
            </div>
          <?php endif; ?>
        </div>
      </div>
      <div class="col-4">
        <label for="office" class="form-label">Office</label>
        <select name="office_id" id="office" class="form-select mb-3" aria-label="">
          <?php foreach ($offices as $office): ?>
            <option value="<?=esc($office['id'])?>"><?=ucwords(esc($office['office']))?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="col-4">
        <div class="form-group mb-3">
          <label for="password" class="form-label">Password</label>
          <input value="<?=isset($value['password']) ? esc($value['password']): ''?>" type="password" name="password" class="form-control" id="password">
          <?php if (isset($error['password'])): ?>
            <div class="text-danger">
              <?=esc($error['password'])?>
            </div>
          <?php endif; ?>
        </div>
      </div>
      <div class="col-4">
        <div class="form-group mb-3">
          <label for="confirm_password" class="form-label">Confirm Password</label>
          <input value="<?=isset($value['confirm_password']) ? esc($value['confirm_password']): ''?>" type="password" name="confirm_password" class="form-control" id="cofirm_password">
          <?php if (isset($error['confirm_password'])): ?>
            <div class="text-danger">
              <?=esc($error['confirm_password'])?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <button type="submit" class="float-end btn btn-primary" name="button">Submit</button>
      </div>
    </div>
  </form>
  <hr>
  <footer class="text-center">
    <div class="mb-2">
      <small>
        © 2020 made with <i class="fa fa-heart" style="color:red"></i> by - <a target="_blank" rel="noopener noreferrer" href="https://azouaoui.netlify.com">
        Mohamed Azouaoui
        </a>
      </small>
    </div>
    <div>
      <a href="https://github.com/azouaoui-med" target="_blank">
        <img alt="GitHub followers" src="https://img.shields.io/github/followers/azouaoui-med?label=github&style=social" />
      </a>
      <a href="https://twitter.com/azouaoui_med" target="_blank">
        <img alt="Twitter Follow" src="https://img.shields.io/twitter/follow/azouaoui_med?label=twitter&style=social" />
      </a>
    </div>
  </footer>
</div>
