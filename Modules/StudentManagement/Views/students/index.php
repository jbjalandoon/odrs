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
          <span class="h2">Students</span>
        </div>
        <div class="col-2">
          <a href="students/add" class="float-end btn btn-success"> Add </a>
        </div>
      </div>
      <div class="card mb-5 mt-5">
        <div class="card-body">
          <h5 class="card-title">Upload via Excel</h5>
          <form action="students/insert-spreadsheet" method="post" enctype="multipart/form-data">
            <div class="row">
              <div class="col-4">
                <div class="form-group mb-3">
                  <label for="academic_status">Academic Status</label>
                  <select name="academic_status" id="academic_status" class="form-select">
                    <?php foreach($academic_status as $status):?>
                      <option value="<?=esc($status['id'])?>"><?=esc($status['status'])?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-8">
                <div class="form-group mb-3">
                  <label for="course_id">Course</label>
                  <select name="course_id" id="course_id" class="form-select">
                    <?php foreach($courses as $course):?>
                      <option value="<?=esc($course['id'])?>"><?=esc($course['course'])?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-5">
                <input type="file" name="students" class="form-control" required>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-primary float-end">Upload</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="table-responsive">
            <table class="table table-striped table-bordered mt-3 dataTable" style="width:100%">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Courses</th>
                  <th>Academic Status</th>
                  <th>Level</th>
                  <th>Year Graduated</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($permissions)): ?>
                  <?php foreach ($permissions as $permission): ?>
                    <tr>
                      <td>#</td>
                      <td><?=ucwords(esc($permission['permission']))?></td>
                      <td><?=esc($permission['module'])?></td>
                      <td><?=esc($permission['icon'])?></td>
                      <td><?=esc($permission['path'])?></td>
                      <td><?=ucwords(esc($permission['type']))?></td>
                      <td><?=esc($permission['slug'])?></td>
                      <td><?=esc($permission['description'])?></td>
                      <td class="text-center">
                        #
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
