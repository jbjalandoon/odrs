<div class="card mt-5 me-3">
  <div class="card-body">
    <div class="container-fluid p-1">
      <div class="row">
        <span class="h2">Undergraduates Student</span>
      </div>
      <div class="row">
        <div class="col-12">
          <table class="table table-striped table-bordered mt-3 dataTable" style="width:100%">
            <thead>
              <tr>
                <th>Student Number</th>
                <th>Name</th>
                <th>Course</th>
                <th>Contact</th>
                <th>Gender</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($students)): ?>
                <?php foreach ($students as $student): ?>
                  <tr>
                    <td><?=esc($student['student_number'])?></td>
                    <td><?=ucwords(esc($student['firstname']).' '.esc($student['middlename']).' '.esc($student['lastname']))?></td>
                    <td><?=esc($student['course'])?></td>
                    <td><?=esc($student['contact'])?></td>
                    <td><?=esc($student['gender']) == 'f' ? 'Female' : 'Male'?></td>
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
