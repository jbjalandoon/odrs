<div class="card mt-4">
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
          <span class="h2">Modules</span>
        </div>
        <div class="col-10">
          <a href="modules/add" class="float-end btn btn-success"> Add </a>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="table-responsive">
            <table class="table table-striped table-bordered mt-3 dataTable" style="width:100%">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Module</th>
                  <th>Slug</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($modules as $module): ?>
                  <tr>
                    <td>#</td>
                    <td><?=ucwords(esc($module['module']))?></td>
                    <td><?=esc($module['slug'])?></td>
                    <td class="text-center">
                      <a href="modules/edit/<?=esc($module['id'])?>" class="btn btn-edit btn-sm"><i class="fas fa-pencil-alt"></i> Edit </a>
                      <a href="modules/delete/<?=esc($module['id'])?>" class="btn btn-delete btn-sm"><i class="fas fa-trash-alt"></i> Delete </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
