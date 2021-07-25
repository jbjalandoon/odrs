
<?php if (!empty($modules)): ?>
  <?php foreach ($modules as $module): ?>
    <h6><?=esc($module['module'])?></h6>
    <?php foreach ($permission_types as $permission_type): ?>
        <?=esc($permission_type['type'])?>:
        <br>
      <?php foreach ($permissions as $permission): ?>
        <?php if ($permission['module_id'] == $module['id'] && $permission['permission_type'] == $permission_type['id']): ?>
          <span class="badge bg-success"><?=ucwords(esc($permission['permission']))?></span>
        <?php endif; ?>
      <?php endforeach; ?>
      <hr>
    <?php endforeach; ?>
  <?php endforeach; ?>

<?php else: ?>
  This roles has no permissions
<?php endif; ?>
