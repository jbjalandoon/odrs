<div class="container mt-5">
  <div class="card">
    <div class="card-body p-5">
      <div class="row">
        <div class="col-12 mb-3">
          <span class="h2"><?=esc($edit) ? 'Editing': 'Adding'?> Permissions</span>
        </div>
      </div>
      <form class="form-floating" action="<?=esc($edit) ? $value['id']: 'add'?>" method="post" autocomplete="off">
        <div class="row justify-content-center">
          <div class="col-4">
            <div class="form-group mb-3">
              <label for="role" class="form-label">Role</label>
              <input value="<?=isset($value['role']) ? esc($value['role']): ''?>" type="text" name="role" class="form-control" id="role" disabled>
              <?php if (isset($error['role'])): ?>
                <div class="text-danger">
                  <?=esc($error['role'])?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-4">
            <div class="form-group mb-3">
              <label for="permissions" class="form-label" >Permissions</label>
              <br>
              <select class="js-example-responsive form-control" name="permission_id[]" multiple="multiple" id="permissions">
                <?php foreach ($modules as $module): ?>
                  <optgroup label="<?=ucwords(esc($module['module']))?>">
                    <?php foreach ($permissions as $permission): ?>
                      <?php $selected = false; ?>
                      <?php if (!empty($role_permissions)): ?>
                        <?php foreach ($role_permissions as $role_permission): ?>
                          <?php if ($role_permission['permission_id'] == $permission['id']): ?>
                            <?php $selected = true; ?>
                          <?php endif; ?>
                        <?php endforeach; ?>
                      <?php endif; ?>
                      <?php if ($module['id'] == $permission['module_id']): ?>
                        <option value="<?=esc($permission['id'])?>" <?=$selected ? 'selected': ''?>><?=ucwords(esc($permission['permission']))?></option>
                      <?php endif; ?>
                    <?php endforeach; ?>
                  </optgroup>
                <?php endforeach; ?>
              </select>
              <?php if (isset($error['permissions'])): ?>
                <div class="text-danger">
                  <?=esc($error['permissions'])?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="float-end btn btn-submit">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
