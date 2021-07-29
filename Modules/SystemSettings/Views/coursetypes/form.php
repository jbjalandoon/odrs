<div class="container mt-4">
  <div class="card">
    <div class="card-body p-4">
      <nav style="--bs-breadcrumb-divider: '<'; font-weight: bold;" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/course-types"><i class="fas fa-tasks"></i></a></li>
          <li class="breadcrumb-item active" aria-current="page">Back to Course Types</li>
        </ol>
      </nav>
      <hr>
      <div class="row">
        <div class="col-12 mb-3">
          <span class="h2"><?=esc($edit) ? 'Editing': 'Adding'?> Course Type</span>
        </div>
      </div>
      <form class="form-floating" action="<?=esc($edit) ? $id: 'add'?>" method="post" autocomplete="off">
        <div class="row justify-content-center">
          <div class="col-4">
            <div class="form-group mb-3">
              <label for="type" class="form-label">Course Type</label>
              <input value="<?=isset($value['type']) ? esc($value['type']): ''?>" type="text" name="type" class="form-control" id="type">
              <?php if (isset($error['type'])): ?>
                <div class="text-danger">
                  <?=esc($error['type'])?>
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
