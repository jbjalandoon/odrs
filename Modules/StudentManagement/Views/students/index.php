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
        <div class="col-10">
          <span class="h2">Students</span>
        </div>
        <div class="col-2">
          <a href="students/add" class="float-end btn"> Add Student</a>
        </div>
      </div>
      <form action="students/insert-spreadsheet" method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="col-5">
            <input type="file" name="students" class="form-control" required>
          </div>
          <div class="col-2">
            <button type="submit" class="btn">Upload file</button>
          </div>
          <p style="font-style: italic;">*Upload an excel file that contains list of students</p>

        </div>
      </form>
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
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($students)): ?>
                  <?php foreach ($students as $student): ?>
                    <tr>
                      <td>#</td>
                      <td><?=ucwords(esc($student['firstname'] . ' ' . esc($student['lastname'])))?></td>
                      <td><?=ucwords(esc($student['course']))?></td>
                      <td><?=ucwords(esc($student['status']))?></td>
                      <td class="text-center">
                        <?=esc(buttons($allPermissions, ['edit-students', 'delete-students'], 'students', $student['id']))?>
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
