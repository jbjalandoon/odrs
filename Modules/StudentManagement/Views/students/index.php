<section>
  <div class="container-fluid">
    <div class="row header-top">
      <div class="col-md-12">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
              <i class="fas fa-users"></i> Students
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-notsetup" data-bs-toggle="pill" data-bs-target="#pills-notset" type="button" role="tab" aria-controls="pills-notset" aria-selected="false">
             <i class="fas fa-user-slash"></i> Not yet setup
            </button>
          </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
          <!-- CONTENTS -->
          <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="card">
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
                    <div class="col-md-6">
                      <small class="text-muted">Student Management</small>
                      <h2>Students</h2>
                    </div>
                    <div class="col-md-6">
                      <a href="students/add" class="float-end btn btn-add"><i class="fas fa-plus-square"></i> Add Student</a>
                    </div>
                  </div>
                    <div class="row">
                      <div class="col-md-5">
                        <input type="file" id="file" name="students" class="form-control" required>
                      </div>
                      <div class="col-md-2">
                        <button onClick='insertSpreadsheet()' class="btn btn-upload">Upload file</button>
                      </div>
                      <p style="font-style: italic;">*Upload an excel file that contains list of students</p>
                    </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered mt-3 dataTable" style="width:100%">
                          <thead class="table-dark">
                            <tr>
                              <th>#</th>
                              <th>Student Number</th>
                              <th>Name</th>
                              <th>Courses</th>
                              <th>Academic Status</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php if (!empty($students)): ?>
                              <?php foreach ($students as $student): ?>
                                <tr>
                                  <td>#</td>
                                  <td><?=ucwords(esc($student['student_number']))?></td>
                                  <td><?=ucwords(esc($student['firstname'] . ' ' . esc($student['lastname'])))?></td>
                                  <td><?=ucwords(esc($student['course']))?></td>
                                  <td><?=ucwords(esc($student['status']))?></td>
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
          </div>
          <!-- *************** NOT YET SETUP ************** -->
          <div class="tab-pane fade show" id="pills-notset" role="tabpanel" aria-labelledby="pills-notsetup">
            <div class="card">
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
                    <div class="col-md-12">
                      <small class="text-muted">Student Management | Students</small>
                      <h2>Student Accounts that has not been set up</h2>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered mt-3 dataTable" style="width:100%">
                          <thead class="table-dark">
                            <tr>
                              <th>#</th>
                              <th>Student Number</th>
                              <th>Name</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php if (!empty($students_inc)): ?>
                              <?php foreach ($students_inc as $student): ?>
                                <tr>
                                  <td>#</td>
                                  <td><?=ucwords(esc($student['student_number']))?></td>
                                  <td><?=ucwords(esc($student['firstname'] . ' ' . esc($student['lastname'])))?></td>
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
          </div>
          <!-- **************** Recycle Bin *************** -->
      </div>
    </div>
  </div>
</section>
