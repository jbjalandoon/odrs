<div class="container mt-4">
  <div class="card">
    <div class="card-body p-4">
      <nav style="--bs-breadcrumb-divider: '<'; font-weight: bold;" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/users"><i class="fas fa-users"></i></a></li>
          <li class="breadcrumb-item active" aria-current="page">Back to Users</li>
        </ol>
      </nav>
      <hr>
      <div class="row">
        <div class="col-12 mb-3">
          <span class="h2"><?=esc($edit) ? 'Editing': 'Adding'?> User</span>
        </div>
      </div>
      <form class="form-floating" action="<?=esc($edit) ? esc($value['user_id']) : 'add'?>" method="post" autocomplete="off">
        <div class="row justify-content-center">
          <div class="col-3">
            <div class="form-group mb-3">
              <label for="firstname" class="form-label">First Name</label>
              <input value="<?=isset($value['firstname']) ? esc($value['firstname']): ''?>" type="text" name="firstname" class="form-control" id="firstname">
              <?php if (isset($error['firstname'])): ?>
                <div class="text-danger">
                  <?=esc($error['firstname'])?>
                </div>
              <?php endif; ?>
            </div>
          </div>
          <div class="col-3">
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
          <div class="col-3">
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
        <div class="row justify-content-center">
          <div class="col-3">
        		<div class="form-group mb-3">
							<label for="username">Username</label>
							<input value="<?=isset($value['username']) ? $value['username']: ''?>" type="text" name="username" id="username" class="form-control">
							<?php if(isset($error['username'])): ?>
								<div class="text-danger">
									<?=esc($error['username'])?>
                </div>
							<?php endif; ?>
            </div>
          </div>
          <div class="col-3">
            <div class="form-group mb-3">
              <label for="password">Password</label>
              <input value="" type="password" class="form-control" name="password" id="password">
              <?php if(isset($error['password'])): ?>
                <div class="text-danger">
                  <?=esc($error['password'])?>
                </div>
              <?php endif; ?>
            </div>
          </div>
          <div class="col-3">
            <div class="form-group mb-3">
              <label for="confirm_password">Confirm Password</label>
              <input value="" type="password" name="confirm_password" id="confirm_password" class="form-control">
              <?php if(isset($error['confirm_password'])): ?>
                <div class="text-danger">
                  <?=esc($error['confirm_password'])?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-3">
            <div class="form-group mb-3">
              <label for="email">Email</label>
              <input type="text" class="form-control" value="<?=isset($value['email']) ? $value['email'] : ''?>" name="email" id="email">
              <?php if(isset($error['email'])): ?>
                <div class="text-danger">
                  <?=esc($error['email'])?>
                </div>
              <?php endif;?>
            </div>
          </div>
          <div class="col-3">
            <div class="form-group mb-3">
              <label for="contact">Contact</label>
              <input type="text" name="contact" value="<?=isset($value['contact']) ? $value['contact']: ''?>" id="contact" class="form-control">
              <?php if(isset($error['contact'])): ?>
                <div class="text-danger">
                  <?=esc($value['contact'])?>
                </div>
              <?php endif; ?>
            </div>
          </div>
          <div class="col-3">
            <div class="form-group mb-3">
              <label for="role_id">Roles</label>
              <select class="form-select" name="role_id" id="role_id" onchange="showOfficerForm()">
                <?php foreach($roles as $role): ?>
                  <?php $selected = false; ?>
                  <?php if(isset($value['role_id'])):?>
                    <?php $value['role_id'] == $role['id'] ? $selected = true: $selected = false;?>
                  <?php endif; ?>
                  <?php if ($role['identifier'] != 'students'): ?>
                    <option value="<?=esc($role['id'])?>" <?= $selected ? 'selected': ''?>><?=esc(ucwords($role['role']))?></option>
                  <?php endif; ?>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-3">
            <div class="form-group mb-3" id="officeForm" style="display:none">
              <label for="office_id">Office</label>
              <select class="form-select" name="office_id" id="office_id">
                <?php foreach($offices as $office): ?>
                  <?php $selected = false; ?>
                  <?php if(isset($value['office_id'])):?>
                    <?php $value['role_id'] == $office['id'] ? $selected = true: $selected = false;?>
                  <?php endif; ?>
                  <option value="<?=esc($office['id'])?>" <?= $selected ? 'selected': ''?>><?=esc(ucwords($office['office']))?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="float-end btn btn-primary" name="button">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
