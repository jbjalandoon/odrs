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
        <div class="col-2">
          <span class="h2">Permissions</span>
        </div>
        <div class="col-10">
          <a href="permissions/add" class="float-end btn btn-success"> Add </a>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="table-responsive">
            <table class="table table-striped table-bordered mt-3 dataTable" style="width:100%">
              <thead>
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
                      <td><?=esc($permission['icon'])?></td>
                      <td><?=esc($permission['path'])?></td>
                      <td><?=ucwords(esc($permission['type']))?></td>
                      <td><?=esc($permission['slug'])?></td>
                      <td><?=esc($permission['description'])?></td>
                      <td class="text-center">
                        #
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
