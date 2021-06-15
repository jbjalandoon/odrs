<?= view('home/header') ?>

	<div class="fluid register">
  	<div class="row">
      <div class="col-md-3 register-left">

      </div>
      <div class="col-md-9 register-right">
				<div class="row">
					<img src="/pup.png" alt=""/>
          <h3 class="text-center">Online Document Requests </h3>
				</div>
        <h3 class="register-heading">Student Registration</h3>
				<form class="" action="register" method="post">
        	<div class="row register-form">
						<div class="col-md-6">
								<div class="form-group mb-3">
									<label for="username" class="form-label">Student Number* </label>
									<input type="text" name="username" id="username" class="form-control" placeholder="Student Number" value="" />
									<?php if (isset($errors['username'])): ?>
										<div class="text-danger">
											<?=esc($errors['username'])?>
										</div>
									<?php endif; ?>
								</div>
								<div class="form-group mb-3">
									<label for="email" class="form-label">Email *</label>
									<input type="text" name="email" id="email" class="form-control" placeholder="Email" value="" />
									<?php if (isset($errors['email'])): ?>
										<div class="text-danger">
											<?=esc($errors['email'])?>
										</div>
									<?php endif; ?>
								</div>
								<div class="form-group mb-3">
									<label for="password" class="form-label">Password *</label>
									<input type="password" id="password" name="password" class="form-control" placeholder="Password" />
									<?php if (isset($errors['password'])): ?>
										<div class="text-danger">
											<?=esc($errors['password'])?>
										</div>
									<?php endif; ?>
								</div>
								<div class="form-group mb-3">
									<label for="repeat_password" class="form-label">Confirm Password *</label>
									<input type="password" name="repeat_password" id="repeat_password" class="form-control"  placeholder="Confirm Password" value="" />
									<?php if (isset($errors['repeat_password'])): ?>
										<div class="text-danger">
											<?=esc($errors['repeat_password'])?>
										</div>
									<?php endif; ?>
								</div>
								<div class="form-group mb-3">
									<label for="contact" class="form-label">Contact *</label>
									<input type="text" name="contact" class="form-control" value="">
									<?php if (isset($errors['contact'])): ?>
										<div class="text-danger">
											<?=esc($errors['contact'])?>
										</div>
									<?php endif; ?>
								</div>
								<div class="form-group mb-3">
									<div class="maxl">
										<label class="radio inline">
												<input type="radio" name="gender" value="m" checked>
												<span> Male </span>
										</label>
										<label class="radio inline">
												<input type="radio" name="gender" value="f">
												<span>Female </span>
										</label>
									</div>
								</div>
						</div>
						<div class="col-md-6">
								<div class="form-group mb-3">
									<label for="firstname" class="form-label">First Name *</label>
									<input type="text" name="firstname" class="form-control" value="">
									<?php if (isset($errors['firstname'])): ?>
										<div class="text-danger">
											<?=esc($errors['firstname'])?>
										</div>
									<?php endif; ?>
								</div>
								<div class="form-group mb-3">
									<label for="lastname" class="form-label">Last Name *</label>
									<input type="text" class="form-control" name="lastname" value="">
									<?php if (isset($errors['lastname'])): ?>
										<div class="text-danger">
											<?=esc($errors['lastname'])?>
										</div>
									<?php endif; ?>
								</div>
								<div class="form-group mb-3">
									<label for="middlename" class="form-label">Middle Name</label>
									<input type="text" class="form-control" name="middlename" value="">
									<?php if (isset($errors['middlename'])): ?>
										<div class="text-danger">
											<?=esc($errors['middlename'])?>
										</div>
									<?php endif; ?>
								</div>
								<div class="form-group mb-3">
									<label for="course_id" class="form-label">Course *</label>
										<select class="form-select" name="course_id">
											<?php if (isset($courses)): ?>
												<?php foreach ($courses as $course): ?>
													<option value="<?=esc($course['id'])?>"><?=esc($course['course'])?></option>
												<?php endforeach; ?>
											<?php else: ?>
													<option value="" disabled selected>-- No Available Course --</option>
											<?php endif; ?>
										</select>
										<?php if (isset($errors['course_id'])): ?>
											<div class="text-danger">
												<?=esc($errors['course_id'])?>
											</div>
										<?php endif; ?>
								</div>
								<div class="form-group mb-3">
									<label for="birthdate" class="form-label">Birthdate</label>
									<input type="date" name="birthdate" class="form-control" value="">
									<?php if (isset($errors['birthdate'])): ?>
										<div class="text-danger">
											<?=esc($errors['birthdate'])?>
										</div>
									<?php endif; ?>
								</div>
								<input type="submit" class="btnRegister"  value="Register"/>
						</div>
        	</div>
				</form>
    	</div>
  	</div>
	</div>

<?= view('home/footer') ?>
