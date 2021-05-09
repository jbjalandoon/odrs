<div class="card mt-5 me-3">
  <div class="card-body">
    <div class="container-fluid p-1">
      <?php if (isset($_SESSION['success_message'])): ?>
        <div class="row mb-3">
          <div class="col-12">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <?=esc($_SESSION['success_message'])?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          </div>
        </div>
      <?php endif; ?>
      <div class="row mb-3">
        <div class="col-2">
          <span class="h2">Courses</span>
        </div>
        <div class="col-10">
          <?=esc(buttons($allPermissions, ['add-courses'], 'courses'))?>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="table-responsive">
            <table class="table table-striped table-bordered mt-3 dataTable" style="width:100%">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Course</th>
                  <th>Abbreviation</th>
                  <th>Course Type</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($courses)): ?>
                  <?php foreach ($courses as $course): ?>
                    <tr>
                      <td>#</td>
                      <td><?=ucwords(esc($course['course']))?></td>
                      <td><?=strtoupper(esc($course['abbreviation']))?></td>
                      <td><?=ucwords(esc($course['type']))?></td>
                      <td class="text-center">
                        <?=esc(buttons($allPermissions, ['edit-role', 'delete-role'], 'roles', $course['id']))?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
