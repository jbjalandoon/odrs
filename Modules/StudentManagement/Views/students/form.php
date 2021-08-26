<div class="container mt-4">
  <div class="card">
    <div class="card-body p-4">
		<nav style="--bs-breadcrumb-divider: '<'; font-weight: bold;" aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="/students"><i class="fas fa-user-friends"></i></a></li>
				<li class="breadcrumb-item active" aria-current="page">Back to Students</li>
			</ol>
		</nav>
		<hr>

		<h3>Add Student</h3>
    <?php if (isset($errors['names'])): ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?=$errors['names']?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>
		<form class="" action="add" method="post">
			<div class="row register-form">
				<div class="col-md-6">
					<div class="form-group mb-3">
						<label for="student_number" class="form-label">Student Number* </label>
						<input type="text" name="student_number" id="student_number" class="form-control" placeholder="Student Number" value="" />
						<?php if (isset($errors['student_number'])): ?>
							<div class="text-danger">
								<?=esc($errors['student_number'])?>
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
            <label for="birthdate" class="form-label">Birthdate *</label>
            <input type="date" name="birthdate" id="birthdate" class="form-control" placeholder="Birthdate" value="" />
            <?php if (isset($errors['birthdate'])): ?>
              <div class="text-danger">
                <?=esc($errors['birthdate'])?>
              </div>
            <?php endif; ?>
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
						<label for="middlename" class="form-label">Middle Name</label>
						<input type="text" class="form-control" name="middlename" value="">
						<?php if (isset($errors['middlename'])): ?>
							<div class="text-danger">
								<?=esc($errors['middlename'])?>
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

					<div class="row">
						<div class="col-12">
						<button type="submit" class="btnRegister float-end btn btn-primary">Submit</button>
						</div>
					</div>
				</div>
			</div>
		</form>
    </div>
  </div>
</div>
