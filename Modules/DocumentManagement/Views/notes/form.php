<div class="container mt-5">
  <div class="card">
    <div class="card-body p-5">
      <div class="row">
        <div class="col-12 mb-3">
          <span class="h2"><?=esc($edit) ? 'Editing': 'Adding'?> Roles</span>
        </div>
      </div>
      <form class="form-floating" action="<?=esc($edit) ? $value['id']: 'add'?>" method="post" autocomplete="off">
        <div class="row justify-content-center">
          <div class="col-4">
            <div class="form-group mb-3">
              <label for="note" class="form-label">Note</label>
              <input value="<?=isset($value['note']) ? esc($value['note']): ''?>" type="text" name="note" class="form-control" id="note">
              <?php if (isset($error['note'])): ?>
                <div class="text-danger">
                  <?=esc($error['note'])?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="float-end btn btn-primary">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
