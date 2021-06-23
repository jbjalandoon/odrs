<?php if (!empty($permissions)): ?>
  <?php foreach ($modules as $module): ?>
    <b><?=esc($module['module'])?></b>
    <br>
    <?php foreach ($permission_types as $type): ?>
      <?=ucwords($type['type'] . ': ')?>
      <br>
      <?php foreach ($permissions as $permission): ?>
        <?php if ($permission['module_id'] == $module['id'] && $type['id'] == $permission['type_id']): ?>
          <span class="badge bg-success"><?=ucwords(esc($permission['permission']))?></span>
        <?php endif; ?>
      <?php endforeach; ?>
      <br>
    <?php endforeach; ?>
  <?php endforeach; ?>
<?php else: ?>
  <b>No Permissions</b>
<?php endif; ?>
