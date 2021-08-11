<section class="content-header">
  <div class="container-fluid">
    <div class="row header-top">
      <div class="col-md-12">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
             <i class="fas fa-boxes"></i> Modules
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
                <div class="container-fluid">
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
                      <small class="text-muted">Module Management</small>
                      <h2>Modules</h2>
                    </div>
                    <div class="col-md-6">
                      <?php buttons($allPermissions, ['add-module'], 'modules') ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered mt-3 dataTable" style="width:100%">
                          <thead class="table-dark">
                            <tr>
                              <th>#</th>
                              <th>Module</th>
                              <th>Slug</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php if (!empty($modules)): ?>
                              <?php foreach ($modules as $module): ?>
                                <tr>
                                  <td>#</td>
                                  <td><?=ucwords(esc($module['module']))?></td>
                                  <td><?=esc($module['slug'])?></td>
                                  <td class="text-center">
                                    <?php buttons($allPermissions, ['edit-module','delete-module'], 'modules', esc($module['id'])) ?>
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
          <!-- Recycle Bin -->
          <div class="tab-pane fade" id="pills-recycle" role="tabpanel" aria-labelledby="pills-recycle-tab">
            <div class="card">
              <div class="card-body">
                <div class="container-fluid">
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
                    <div class="col-md-12">
                      <small class="text-muted">Module Management | Modules</small>
                      <h2>Recycle Bin</h2>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered mt-3 dataTable" style="width:100%">
                          <thead class="table-dark">
                            <tr>
                              <th>#</th>
                              <th>Module</th>
                              <th>Slug</th>
                              <th>Date Deleted</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php if (!empty($modules_deleted)): ?>
                              <?php foreach ($modules_deleted as $module): ?>
                                <tr>
                                  <td>#</td>
                                  <td><?=ucwords(esc($module['module']))?></td>
                                  <td><?=esc($module['slug'])?></td>
                                  <td>Date</td>
                                  <td class="text-center">
                                    <?php buttons($allPermissions, ['restore-all'], 'modules', esc($module['id'])) ?>
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
</section>
