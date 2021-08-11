<section>
  <div class="container-fluid">
    <div class="row header-top">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="container-fluid p-1">
              <?php if (isset($_SESSION['success_message'])): ?>
                <div class="row mb-3">
                  <div class="col-md-12">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                      <?=esc($_SESSION['success_message'])?>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  </div>
                </div>
              <?php endif; ?>
              <div class="row mb-3">
                <small class="text-muted"> User Management</small>
                <div class="col-6">
                  <h2>Role Permissions</h2>
                </div>
                <div class="col-6">
                  <button type="button" class="btn btn-primary float-end edit-button" onclick="showCheckbox()">Edit</button>
                  <button type="button" class="btn btn-warning float-end cancel-button d-none" onclick="cancelCheckbox()">Cancel</button>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <form class="" action="role-permissions/edit" method="post">
                  <?php foreach ($modules as $module): ?>
                    <h5><?=esc($module['module'])?></h5>
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered mt-3" style="width:100%">
                        <thead>
                          <tr>
                            <th width="50%">Permissions</th>
                            <th width="50%">Roles</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($permissions as $permission): ?>
                            <?php if ($permission['module_id'] == $module['id']): ?>
                              <tr>
                                <td><?=ucwords(esc($permission['permission']))?></td>
                                <td>
                                  <?php foreach ($roles as $role): ?>
                                    <?php $selected = false ?>
                                    <?php foreach ($permissions_roles as $permission_role): ?>
                                      <?php if ($permission_role['role_id'] == $role['id'] && $permission['id'] == $permission_role['permission_id']): ?>
                                        <?php $selected = true ?>
                                        <?php break; ?>
                                      <?php endif; ?>
                                    <?php endforeach; ?>
                                        <span class="badge rounded-pill bg-<?= $selected ? 'success': 'danger'?> assigned-role"><?=esc($role['role'])?></span>
                                        <div class="form-check form-check-inline d-none checkbox">
                                          <input class="form-check-input" type="checkbox" name="value[]" id="<?=esc($permission['permission'] . $role['role'])?>" value="<?=esc($permission['id'])?>,<?=$role['id']?>" <?= $selected ? 'checked': ''?>>
                                          <label class="form-check-label" for="<?=esc($permission['permission'] . $role['role'])?>"><?=esc($role['role'])?></label>
                                        </div>
                                  <?php endforeach; ?>
                                </td>
                              </tr>
                            <?php endif; ?>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  <?php endforeach; ?>
                  <button type="submit" class="btn btn-primary d-none" id="submit">Submit</button>
                </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
