<div class="container mt-5">
  <div class="card">
    <div class="card-body p-5">
      <div class="row">
        <div class="col-12 mb-3">
          <span class="h2"><?=esc($edit) ? 'Editing': 'Adding'?> Module</span>
        </div>
      </div>
      <form class="form-floating" action="<?=esc($edit) ? esc($value['id']) : 'add'?>" method="post" autocomplete="off">
        <div class="row justify-content-center">
          <div class="col-4">
            <div class="form-group mb-3">
              <label for="permission" class="form-label">Permission Name</label>
              <input value="<?=isset($value['permission']) ? esc($value['permission']): ''?>" type="text" name="permission" class="form-control" id="permission">
              <?php if (isset($error['permission'])): ?>
                <div class="text-danger">
                  <?=esc($error['permission'])?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-4">
            <div class="form-group mb-3">
              <label for="slug" class="form-label">Permission Unique Identifier (Slug)</label>
              <input value="<?=isset($value['slug']) ? esc($value['slug']): ''?>" type="text" name="slug" class="form-control" id="slug">
              <?php if (isset($error['slug'])): ?>
                <div class="text-danger">
                  <?=esc($error['slug'])?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-4">
            <div class="form-group mb-3">
              <label for="icon">Icon (Font Awesome)</label>
              <input type="text" class="form-control" name="icon" id="icon" value="<?= isset($value['icon']) ? esc($value['icon']) : '' ?>">
              <?php if(isset($error['icon'])): ?>
                <div class="text-danger">
                  <?=esc($error['icon'])?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-4">
            <div class="form-group mb-3">
              <label for="path">Path</label>
              <input type="text" class="form-control" name="path" id="path" value="<?= isset($value['path']) ? esc($value['path']) : '' ?>">
              <?php if(isset($error['path'])): ?>
                <div class="text-danger">
                  <?=esc($error['path'])?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-4">
            <div class="form-group mb-3">
              <label for="description" class="form-label">Description</label>
              <textarea name="description" id="description" class="form-control" rows="8" cols="80"><?=isset($value['description']) ? esc($value['description']): ''?></textarea>
              <?php if (isset($error['description'])): ?>
                <div class="text-danger">
                  <?=esc($error['description'])?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-4">
            <div class="form-group mb-3">
              <label for="permission_type" class="form-label">Permission Type</label>
              <select class="form-select" name="permission_type" id="permission_type">
                <?php foreach ($permissionTypes as $permissionType): ?>
                  <option value="<?=esc($permissionType['id'])?>"><?=ucwords(esc($permissionType['type']))?></option>
                <?php endforeach; ?>
              </select>
              <?php if (isset($error['description'])): ?>
                <div class="text-danger">
                  <?=esc($error['description'])?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-4">
            <div class="form-group mb-3">
              <label for="module_id" class="form-label">Module</label>
              <select class="form-select" name="module_id" id="module_id">
                <?php foreach ($modules as $module): ?>
                  <option value="<?=esc($module['id'])?>"><?=ucwords(esc($module['module']))?></option>
                <?php endforeach; ?>
              </select>
              <?php if (isset($error['module_id'])): ?>
                <div class="text-danger">
                  <?=esc($error['module_id'])?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="float-end btn btn-primary" name="button">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
