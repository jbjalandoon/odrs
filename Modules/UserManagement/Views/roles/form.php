<div class="container mt-4">
  <div class="card">
    <div class="card-body p-4">
      <nav style="--bs-breadcrumb-divider: '<'; font-weight: bold;" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/roles"><i class="fas fa-user-tag"></i></a></li>
          <li class="breadcrumb-item active" aria-current="page">Back to Roles</li>
        </ol>
      </nav>
      <hr>
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
              <label for="landing_page" class="form-label">Landing Page</label>
              <input value="<?=isset($value['landing_page']) ? esc($value['landing_page']): ''?>" type="text" name="landing_page" class="form-control" id="landing_page">
              <?php if (isset($error['landing_page'])): ?>
                <div class="text-danger">
                  <?=esc($error['landing_page'])?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-4">
            <div class="form-group mb-3">
              <label for="identifier" class="form-label">Identifier</label>
              <input value="<?=isset($value['identifier']) ? esc($value['identifier']): ''?>" type="text" name="identifier" class="form-control" id="identifier">
              <?php if (isset($error['identifier'])): ?>
                <div class="text-danger">
                  <?=esc($error['identifier'])?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-4">
            <div class="form-group mb-3">
              <label for="description" class="form-label">Description</label>
              <textarea name="description" class="form-control" id="description" rows="5"><?=isset($value['description']) ? esc($value['description']): ''?></textarea>
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
