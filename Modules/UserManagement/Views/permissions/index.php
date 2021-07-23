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
                <div class="col-md-6">
                  <small class="text-muted"> User Management</small>
                  <h2>Role Permissions</h2>
                </div>
                <div class="col-6">
                  <a href="#" class="btn float-end"> Edit Permissions </a>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered mt-3 dataTable" style="width:100%">
                      <thead class="table-dark">
                        <tr>
                          <th width="5%">#</th>
                          <th width="25%">Role</th>
                          <th width="20%">Description</th>
                          <th width="50%">Permissions</th>
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
      </div>
    </div>
  </div>
</section>