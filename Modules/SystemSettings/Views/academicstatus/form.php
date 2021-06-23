<div class="container mt-4">
  <div class="card">
    <div class="card-body p-4">
      <nav style="--bs-breadcrumb-divider: '<'; font-weight: bold;" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/academic-status"><i class="fas fa-spinner"></i></a></li>
          <li class="breadcrumb-item active" aria-current="page">Back to Academic Status</li>
        </ol>
      </nav>
      <hr>
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
            <button type="submit" class="float-end btn" name="button">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
