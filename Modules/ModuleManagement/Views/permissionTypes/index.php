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
        <div class="col-9">
          <span class="h2">Permission Types</span>
        </div>
        <div class="col-3">
          <a href="permission-types/add" class="float-end btn"> Add Permission Type </a>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="table-responsive">
            <table class="table table-striped table-bordered mt-3 dataTable" style="width:100%">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Permission Type</th>
                  <th>Identifier</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($permissionsTypes)): ?>
                  <?php foreach ($permissionsTypes as $permissionsType): ?>
                    <tr>
                      <td>#</td>
                      <td><?=ucwords(esc($permissionsType['type']))?></td>
                      <td><?=esc($permissionsType['slug'])?></td>
                      <td class="text-center">
                        <?=esc(buttons($allPermissions, ['edit-permission-type', 'delete-permission-type'], 'permission-types', $permissionsType['id']))?>
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
