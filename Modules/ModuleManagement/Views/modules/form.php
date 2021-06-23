<div class="container mt-5">
  <div class="card">
    <div class="card-body p-4">
      <nav style="--bs-breadcrumb-divider: '<'; font-weight: bold;" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/modules"><i class="fas fa-boxes"></i></a></li>
          <li class="breadcrumb-item active" aria-current="page">Back to Modules</li>
        </ol>
      </nav>
      <hr>
      <div class="row">
        <div class="col-12 mb-3">
          <span class="h2"><?=esc($edit) ? 'Editing': 'Adding'?> Module</span>
        </div>
      </div>
      <form class="form-floating" action="<?=esc($edit) ? esc($value['id']) : 'add'?>" method="post" autocomplete="off">
        <div class="row justify-content-center">
          <div class="col-4">
            <div class="form-group mb-3">
              <label for="module" class="form-label">Module Name</label>
              <input value="<?=isset($value['module']) ? esc($value['module']): ''?>" type="text" name="module" class="form-control" id="module">
              <?php if (isset($error['module'])): ?>
                <div class="text-danger">
                  <?=esc($error['module'])?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-4">
            <div class="form-group mb-3">
              <label for="slug" class="form-label">Module Unique Identifier (Slug)</label>
              <input value="<?=isset($value['slug']) ? esc($value['slug']): ''?>" type="text" name="slug" class="form-control" id="slug">
              <?php if (isset($error['slug'])): ?>
                <div class="text-danger">
                  <?=esc($error['slug'])?>
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
