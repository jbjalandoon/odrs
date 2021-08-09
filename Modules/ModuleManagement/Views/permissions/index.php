<section>
  <div class="container-fluid">
    <div class="row header-top">
      <div class="col-md-12">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
              <i class="fas fa-user-shield"></i> Permissions
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
                      <div class="col-12">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                          <?=esc($_SESSION['success_message'])?>
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                      </div>
                    </div>
                  <?php endif; ?>
                  <div class="row mb-3">
                    <div class="col-5">
                      <small class="text-muted">Module Management</small>
                      <h2>Permissions</h2>
                    </div>
                    <div class="col-7">
                      <?php buttons($allPermissions, ['add-permissions'], 'permissions') ?>
                    </div>
                  </div>
                  <!-- <div class="row mt-3 mb-3">
                    <div class="col-4 offset-2">
                      <div class="input-group mb-3">
                        <label class="input-group-text" for="module">Modules</label>
                        <select class="form-select" id="module" onchange="filterPermission()">
                          <?php if (empty($modules)): ?>
                            <option value="" disabled selected>--No Modules Found--</option>
                          <?php else: ?>
                            <option value="0" selected>All</option>
                            <?php foreach($modules as $module): ?>
                              <option value="<?=esc($module['id'])?>"><?=esc(ucwords($module['module']))?></option>
                            <?php endforeach; ?>
                          <?php endif; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="input-group mb-3">
                        <label class="input-group-text" for="type">Permission Type</label>
                        <select class="form-select" id="type" onchange="filterPermission()">
                          <?php if (empty($permission_types)): ?>
                            <option value="" disabled selected>--No Type Found--</option>
                          <?php else: ?>
                            <option value="0" selected>All</option>
                            <?php foreach($permission_types as $permission_type): ?>
                              <option value="<?=esc($permission_type['id'])?>"><?=esc(ucwords($permission_type['type']))?></option>
                            <?php endforeach; ?>
                          <?php endif; ?>
                        </select>
                      </div>
                    </div>
                  </div> -->
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive" id="permission-table">
                        <table class="table table-striped table-bordered mt-3 dataTable" style="width:100%">
                          <thead class="table-dark">
                            <tr>
                              <th>#</th>
                              <th>Permission</th>
                              <th>Module</th>
                              <th>Icon</th>
                              <th>Path</th>
                              <th>Permission Type</th>
                              <th>Slug</th>
                              <th>Description</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php if (!empty($permissions)): ?>
                              <?php foreach ($permissions as $permission): ?>
                                <tr>
                                  <td>#</td>
                                  <td><?=ucwords(esc($permission['permission']))?></td>
                                  <td><?=esc($permission['module'])?></td>
                                  <td><?=$permission['icon'] == null ? 'N/A' : esc($permission['icon'])?></td>
                                  <td><?=esc($permission['path'])?></td>
                                  <td><?=ucwords(esc($permission['type']))?></td>
                                  <td><?=esc($permission['slug'])?></td>
                                  <td><?=esc($permission['description'])?></td>
                                  <td class="text-center">
                                    <?=esc(buttons($allPermissions, ['edit-permissions', 'delete-permissions'], 'permissions', $permission['id']))?>
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
          <!-- *********** Recycle Bin ****************** -->
          <div class="tab-pane fade" id="pills-recycle" role="tabpanel" aria-labelledby="pills-recycle-tab">
            <div class="card">
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
                    <div class="col-md-6">
                      <small class="text-muted">Module Management | Permissions</small>
                      <h2>Recycle Bin</h2>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive" id="permission-table">
                        <table class="table table-striped table-bordered mt-3 dataTable" style="width:100%">
                          <thead class="table-dark">
                            <tr>
                              <th>#</th>
                              <th>Permission</th>
                              <th>Module</th>
                              <th>Icon</th>
                              <th>Path</th>
                              <th>Permission Type</th>
                              <th>Slug</th>
                              <th>Description</th>
                              <th>Date Deleted</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php if (!empty($permissions_deleted)): ?>
                              <?php foreach ($permissions_deleted as $permission): ?>
                                <tr>
                                  <td>#</td>
                                  <td><?=ucwords(esc($permission['permission']))?></td>
                                  <td><?=esc($permission['module'])?></td>
                                  <td><?=$permission['icon'] == null ? 'N/A' : esc($permission['icon'])?></td>
                                  <td><?=esc($permission['path'])?></td>
                                  <td><?=ucwords(esc($permission['type']))?></td>
                                  <td><?=esc($permission['slug'])?></td>
                                  <td><?=esc($permission['description'])?></td>
                                  <td>Date</td>
                                  <td class="text-center">
                                    <?=esc(buttons($allPermissions, ['restore-all'], 'permissions', $permission['id']))?>
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
