<div class="container mt-5">
  <div class="card">
    <div class="card-body p-5">
      <div class="row">
        <div class="col-12 mb-3">
          <span class="h2"><?=esc($edit) ? 'Editing': 'Adding'?> Academic Status</span>
        </div>
      </div>
      <form class="form-floating" action="<?=esc($edit) ? esc($value['id']) : 'add'?>" method="post" autocomplete="off">
        <div class="row justify-content-center">
          <div class="col-4">
            <div class="form-group mb-3">
              <label for="status" class="form-label">Academic Status</label>
              <input value="<?=isset($value['status']) ? esc($value['status']): ''?>" type="text" name="status" class="form-control" id="status">
              <?php if (isset($error['status'])): ?>
                <div class="text-danger">
                  <?=esc($error['status'])?>
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
