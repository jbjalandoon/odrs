<div class="card mt-4">
  <div class="card-body">
    <div class="container-fluid p-1">
      <div class="row mb-3">
        <div class="col-2">
          <span class="h2">Roles</span>
        </div>
        <div class="col-10">
          <a href="roles/add" class="float-end btn btn-success"> Add </a>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="table-responsive">
            <table class="table table-striped table-bordered mt-3 dataTable" style="width:100%">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Role</th>
                  <th>Permissions</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($roles as $role): ?>
                  <tr>
                    <td>#</td>
                    <td><?=ucwords(esc($role['role']))?></td>
                    <td>
                      <ul>
                        <?php $ctr = 0 ?>
                        <?php foreach ($permissions as $permission): ?>
                          <?php if (esc($permission['role_id']) == esc($role['id'])): ?>
                            <?php $ctr++ ?>
                            <li><?=ucwords(esc($permission['module']))?></li>
                          <?php endif; ?>
                        <?php endforeach; ?>
                      </ul>
                      <?=$ctr == 0 ? 'No Permissions': ''?>
                    </td>
                    <td class="text-center">
                      <a href="roles/edit/<?=esc($role['id'])?>" class="btn btn-edit btn-sm"><i class="fas fa-pencil-alt"></i> Edit </a>
                      <a href="#" class="btn btn-delete btn-sm"><i class="fas fa-trash-alt"></i> Delete </a>
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
