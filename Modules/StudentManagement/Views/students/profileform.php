<div class="container p-1 mt-3" id="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/requests"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item" aria-current="page"> <a href="../requests/new">Request Document</a> </li>
              <li class="breadcrumb-item active" aria-current="page">Editing Profile</li>
            </ol>
          </nav>
          <hr>
          <form class="" action="edit" method="post">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group mb-3">
                  <label for="firstname" class="form-label">First Name </label>
                  <input value="<?=isset($value['firstname']) ? esc($value['firstname']): ''?>" type="text" name="firstname" class="form-control" id="firstname">
                  <?php if (isset($error['firstname'])): ?>
                    <div class="text-danger">
                      <?=esc($error['firstname'])?>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group mb-3">
                  <label for="lastname" class="form-label">Last Name </label>
                  <input value="<?=isset($value['lastname']) ? esc($value['lastname']): ''?>" type="text" name="lastname" class="form-control" id="lastname">
                  <?php if (isset($error['lastname'])): ?>
                    <div class="text-danger">
                      <?=esc($error['lastname'])?>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group mb-3">
                  <label for="middlename" class="form-label">Middle Name </label>
                  <input value="<?=isset($value['middlename']) ? esc($value['middlename']): ''?>" type="text" name="middlename" class="form-control" id="middlename">
                  <?php if (isset($error['middlename'])): ?>
                    <div class="text-danger">
                      <?=esc($error['middlename'])?>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
              <div class="col-md-1">
                <div class="form-group mb-3">
                  <label for="suffix" class="form-label">Suffix </label>
                  <select class="form-select" name="sufix">
                    <option value="" selected> -- Select Suffix -- </option>
                    <option value="jr" <?=$value['suffix'] == 'jr' ?'selected':''?>> Jr. </option>
                    <option value="sr" <?=$value['suffix'] == 'sr' ?'selected':''?>> Sr. </option>
                    <option value="i" <?=$value['suffix'] == 'i' ?'selected':''?>> I </option>
                    <option value="ii" <?=$value['suffix'] == 'ii' ?'selected':''?>> II </option>
                    <option value="iii" <?=$value['suffix'] == 'iii' ?'selected':''?>> III </option>
                    <option value="iv" <?=$value['suffix'] == 'iv' ?'selected':''?>> IV </option>
                    <option value="v" <?=$value['suffix'] == 'v' ?'selected':''?>> V </option>
                  </select>
                  <?php if (isset($error['suffix'])): ?>
                    <div class="text-danger">
                      <?=esc($error['suffix'])?>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
              <div class="col-md-5">
                <div class="form-group mb-3">
                  <label for="course_id" class="form-label">Course </label>
                  <select name="course_id" id="course_id" class="form-select">
                    <?php if (!empty($courses)): ?>
                      <?php foreach($courses as $course): ?>
                        <?php $selected = false; ?>
                        <?php if (isset($value['course_id'])): ?>
                          <?php if ($value['course_id'] == $course['id']): ?>
                            <?php $selected = true; ?>
                          <?php endif; ?>
                        <?php endif; ?>
                        <option value="<?=esc($course['id'])?>" <?=$selected ? 'selected':''?>><?=esc($course['course'])?></option>
                      <?php endforeach; ?>
                    <?php endif;?>
                  </select>
                  <?php if (isset($error['course_id'])): ?>
                    <div class="text-danger">
                      <?=esc($error['course_id'])?>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
              <div class="col-md-4">
                <label for="" class="mb-3">Status</label>
                <div class="form-group mb-3">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input status" type="radio" name="status" id="inlineRadio1" value="alumni" checked='true'>
                    <label class="form-check-label" for="inlineRadio1">Alumni</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input status" type="radio" name="status" id="inlineRadio2" value="enrolled" <?=$value['status'] == 'enrolled' ? 'checked':''?>>
                    <label class="form-check-label" for="inlineRadio2">Currently Enrolled</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input status" type="radio" name="status" id="inlineRadio3" value="returning" <?=$value['status'] == 'returning' ?'checked':''?>>
                    <label class="form-check-label" for="inlineRadio3">Returning</label>
                  </div>
                  <?php if (isset($error['status'])): ?>
                    <div class="text-danger">
                      <?=esc($error['status'])?>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group mb-3">
                  <label for="level" class="form-label" id="yearLabel">Year Level</label>
                  <select name="level" id="level" class="form-select">
                    <option value="1">1st Year</option>
                    <option value="2">2nd Year</option>
                    <option value="3">3rd Year</option>
                    <option value="4">4th Year</option>
                    <option value="5">5th Year</option>
                  </select>
                  <?php if (isset($error['level'])): ?>
                    <div class="text-danger">
                      <?=esc($error['level'])?>
                    </div>
                  <?php endif; ?>
                  <label for="year_graduated" class="form-label" id="graduatedLabel">Year Graduated </label>
                  <input value="<?=isset($value['year_graduated']) ? esc($value['suffix']): ''?>" type="text" name="year_graduated" class="form-control" id="year_graduated">
                  <?php if (isset($error['year_graduated'])): ?>
                    <div class="text-danger">
                      <?=esc($error['year_graduated'])?>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <label for="email" class="form-label">Email </label>
                  <input value="<?=isset($value['0']) ? esc($value['0']): ''?>" type="text" name="email" class="form-control" id="email">
                  <?php if (isset($error['email'])): ?>
                    <div class="text-danger">
                      <?=esc($error['email'])?>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <label for="suffix" class="form-label">Contact Number </label>
                  <input value="<?=isset($value['contact']) ? esc($value['contact']): ''?>" type="text" name="contact" class="form-control" id="contact">
                  <?php if (isset($error['contact'])): ?>
                    <div class="text-danger">
                      <?=esc($error['contact'])?>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <label for="birthdate" class="form-label">Birthdate </label>
                  <input type="date" name="birthdate" id="birthdate" class="form-control" value="<?=isset($value['birthdate']) ? date('Y-m-d',strtotime(esc($value['birthdate']))): ''?>">
                  <?php if (isset($error['birthdate'])): ?>
                    <div class="text-danger">
                      <?=esc($error['birthdate'])?>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
              <div class="col-md-12">
                <label for="" class="mb-3">Gender</label>
                <div class="form-group mb-3">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input status" type="radio" name="gender" id="male" value="m" checked>
                    <label class="form-check-label" for="male">Male</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input status" type="radio" name="gender" id="female" value="f" <?=$value['gender'] == 'f' ? 'checked':''?>>
                    <label class="form-check-label" for="female">Female</label>
                  </div>
                  <?php if (isset($error['status'])): ?>
                    <div class="text-danger">
                      <?=esc($error['status'])?>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
              <div class="input-group mb-3 mt-3">
                <br><button type="submit" id="submitbtn" class="btn" name="button">Submit <i class="fas fa-paper-plane"></i></button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <br>
    </div>
  </div>
</div>
