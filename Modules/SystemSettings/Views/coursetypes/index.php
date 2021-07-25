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
                  <small class="text-muted">System Settings</small>
                  <h2>Course Types</h2>
                </div>
                <div class="col-md-6">
                  <?=esc(buttons($allPermissions, ['add-course-types'], 'course-types'))?>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered mt-3 dataTable" style="width:100%">
                      <thead class="table-dark">
                        <tr>
                          <th width="5%">#</th>
                          <th width="10%">Course Type</th>
                          <th width="5%">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if (!empty($types)): ?>
                          <?php foreach ($types as $type): ?>
                            <tr>
                              <td>#</td>
                              <td><?=ucwords(esc($type['type']))?></td>
                              <td class="text-center">
                                <?=esc(buttons($allPermissions, ['edit-role-permission'], 'role-permissions', $type['id']))?>
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
</section>
