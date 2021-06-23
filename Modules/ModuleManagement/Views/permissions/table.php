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
