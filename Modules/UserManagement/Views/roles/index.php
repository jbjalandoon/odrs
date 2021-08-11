<section>
  <div class="container-fluid">
    <div class="row header-top">
      <div class="col-md-12">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
              <i class="fas fa-user-tag"></i> Roles
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-recycle-tab" data-bs-toggle="pill" data-bs-target="#pills-recycle" type="button" role="tab" aria-controls="pills-recycle" aria-selected="false">
              <i class="fas fa-archive"></i> Recycle Bin
            </button>
          </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
          <!-- CONTENTS -->
          <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
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
                      <small class="text-muted">User Management</small>
                      <h2>Roles</h2>
                    </div>
                    <div class="col-md-6">
                      <?=esc(buttons($allPermissions, ['add-roles'], 'roles'))?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                          <table class="table table-striped table-bordered mt-3 dataTable" style="width:100%">
                            <thead class="table-dark">
                              <tr>
                                <th>#</th>
                                <th>Role</th>
                                <th>Description</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php if (!empty($roles)): ?>
                                <?php foreach ($roles as $role): ?>
                                  <tr>
                                    <td>#</td>
                                    <td><?=ucwords(esc($role['role']))?></td>
                                    <td><?=ucfirst(esc($role['description']))?></td>
                                    <td class="text-center">
                                      <?=esc(buttons($allPermissions, ['edit-role', 'delete-role'], 'roles', $role['id']))?>
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
          </div>
          <!-- **************** Recycle Bin *************** -->
          <div class="tab-pane fade" id="pills-recycle" role="tabpanel" aria-labelledby="pills-recycle-tab">
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
                      <small class="text-muted">User Management | Roles</small>
                      <h2>Recycle Bin</h2>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered mt-3 dataTable" style="width:100%">
                          <thead class="table-dark">
                            <tr>
                              <th>#</th>
                              <th>Role</th>
                              <th>Description</th>
                              <th>Date Deleted</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php if (!empty($roles_deleted)): ?>
                              <?php foreach ($roles_deleted as $role): ?>
                                <tr>
                                  <td>#</td>
                                  <td><?=ucwords(esc($role['role']))?></td>
                                  <td><?=ucfirst(esc($role['description']))?></td>
                                  <td>Date</td>
                                  <td class="text-center">
                                    <?=esc(buttons($allPermissions, ['restore-all'], 'roles', $role['id']))?>
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
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
