<div class="container mt-4">
  <div class="card">
    <div class="card-body p-4">
      <nav style="--bs-breadcrumb-divider: '<'; font-weight: bold;" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/offices"><i class="fas fa-university"></i></a></li>
          <li class="breadcrumb-item active" aria-current="page">Back to Offices</li>
        </ol>
      </nav>
      <hr>
      <div class="row">
        <div class="col-12 mb-3">
          <span class="h2"><?=esc($edit) ? 'Editing': 'Adding'?> Office</span>
        </div>
      </div>
      <form class="form-floating" action="<?=esc($edit) ? esc($value['id']) : 'add'?>" method="post" autocomplete="off">
        <div class="row justify-content-center">
          <div class="col-4">
            <div class="form-group mb-3">
              <label for="office" class="form-label">Office Name </label>
              <input value="<?=isset($value['office']) ? esc($value['office']): ''?>" type="text" name="office" class="form-control" id="office">
              <?php if (isset($error['office'])): ?>
                <div class="text-danger">
                  <?=esc($error['office'])?>
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
