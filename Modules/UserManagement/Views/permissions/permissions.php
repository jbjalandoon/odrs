<?php if (!empty($permissions)): ?>
  <?php foreach ($modules as $module): ?>
    <b><?=esc($module['module'])?></b>
    <br>
    <?php foreach ($permission_types as $type): ?>
      <?=ucwords($type['type'] . ': ')?>
      <br>
      <?php foreach ($permissions as $permission): ?>
        <?php if (in_array($own_permissions, $permission)): ?>
          <?php if ($permission['module_id'] == $module['id'] && $type['id'] == $permission['permission_type']): ?>
              <span class="badge bg-success"><?=ucwords(esc($permission['permission']))?></span>
          <?php endif; ?>
        <?php endif; ?>
      <?php endforeach; ?>
      <br>
    <?php endforeach; ?>
  <?php endforeach; ?>
<?php else: ?>
  <b>No Permissions</b>
<?php endif; ?>
