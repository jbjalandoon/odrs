<div class="container mt-4">
  <div class="card">
    <div class="card-body p-4">
      <nav style="--bs-breadcrumb-divider: '<'; font-weight: bold;" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/courses"><i class="fas fa-book"></i></a></li>
          <li class="breadcrumb-item active" aria-current="page">Back to Courses</li>
        </ol>
      </nav>
      <hr>
      <div class="row">
        <div class="col-12 mb-3">
          <span class="h2"><?=esc($edit) ? 'Editing': 'Adding'?> Courses</span>
        </div>
      </div>
      <form class="form-floating" action="<?=esc($edit) ? esc($value['id']) : 'add'?>" method="post" autocomplete="off">
        <div class="row justify-content-center">
          <div class="col-4">
            <div class="form-group mb-3">
              <label for="course" class="form-label">Course</label>
              <input value="<?=isset($value['course']) ? esc($value['course']): ''?>" type="text" name="course" class="form-control" id="course">
              <?php if (isset($error['course'])): ?>
                <div class="text-danger">
                  <?=esc($error['course'])?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-4">
            <div class="form-group mb-3">
              <label for="abbreviation" class="form-label">Abbreviation</label>
              <input value="<?=isset($value['abbreviation']) ? esc($value['abbreviation']): ''?>" type="text" name="abbreviation" class="form-control" id="abbreviation">
              <?php if (isset($error['abbreviation'])): ?>
                <div class="text-danger">
                  <?=esc($error['abbreviation'])?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-4">
            <div class="form-group mb-3">
              <label for="course_type" class="form-label">Course Type</label>
              <select name="course_type" id="course_type" class="form-select">
                <?php if (!empty($types)): ?>
                  <?php foreach($types as $type): ?>
                    <?php $selected = false; ?>
                    <?php if (isset($value['course_type'])): ?>
                      <?php if ($value['course_type'] == $type['id']): ?>
                        <?php $selected = true; ?>
                      <?php endif; ?>
                    <?php endif; ?>
                    <option value="<?=esc($type['id'])?>" <?=$selected ? 'selected':''?>><?=esc($type['type'])?></option>
                  <?php endforeach; ?>
                <?php endif;?>
              </select>
              <?php if (isset($error['course_type'])): ?>
                <div class="text-danger">
                  <?=esc($error['course_type'])?>
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
