<div class="container mt-5">
  <div class="card">
    <div class="card-body p-5">
      <div class="row">
        <div class="col-12 mb-3">
          <span class="h2"><?=esc($edit) ? 'Editing': 'Adding'?> Role</span>
        </div>
      </div>
      <form class="form-floating" action="<?=esc($edit) ? esc($value['id']) : 'add'?>" method="post" autocomplete="off">
        <div class="row justify-content-center">
          <div class="col-4">
            <div class="form-group mb-3">
              <label for="role" class="form-label">Role Name</label>
              <input value="<?=isset($value['role']) ? esc($value['role']): ''?>" type="text" name="role" class="form-control" id="role">
              <?php if (isset($error['role'])): ?>
                <div class="text-danger">
                  <?=esc($error['role'])?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-4">
            <div class="form-group mb-3">
              <label for="description" class="form-label">Description</label>
              <textarea name="description" class="form-control" id="description" rows="5"><?=isset($value['slug']) ? esc($value['slug']): ''?></textarea>
              <?php if (isset($error['description'])): ?>
                <div class="text-danger">
                  <?=esc($error['description'])?>
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
