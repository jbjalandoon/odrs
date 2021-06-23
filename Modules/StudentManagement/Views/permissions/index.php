<div class="card mt-5 me-3">
  <div class="card-body">
    <div class="container-fluid p-1">
      <?php if (isset($_SESSION['success_message'])): ?>
        <div class="row mb-3">
          <div class="col-12">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <?=esc($_SESSION['success_message'])?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          </div>
        </div>
      <?php endif; ?>
      <div class="row mb-3">
        <div class="col-10">
          <span class="h2">Role Permissions</span>
        </div>
        <div class="col-2">
          <!-- <?=esc(buttons($allPermissions, ['add-roles'], 'roles'))?> -->
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="table-responsive">
            <table class="table table-striped table-bordered mt-3 dataTable" style="width:100%">
              <thead>
                <tr>
                  <th width="5%">#</th>
                  <th width="10%">Role</th>
                  <th width="20%">Description</th>
                  <th width="60%">Permissions</th>
                  <th width="5%">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($roles)): ?>
                  <?php foreach ($roles as $role): ?>
                    <tr>
                      <td>#</td>
                      <td><?=ucwords(esc($role['role']))?></td>
                      <td><?=ucfirst(esc($role['description']))?></td>
                      <td class="permissions-data" id="<?=$role['id']?>">test</td>
                      <td class="text-center">
                        <?=esc(buttons($allPermissions, ['edit-role-permission'], 'role-permissions', $role['id']))?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
