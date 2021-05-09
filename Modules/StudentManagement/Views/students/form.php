<div class="container mt-5">
  <div class="card">
	<div class="card-body p-5">
	  <div class="row">
		<div class="col-12 mb-3">
		  <span class="h2"><?=esc($edit) ? 'Editing': 'Adding'?> Student</span>
		</div>
	  </div>
	  <form class="form-floating" action="<?=esc($edit) ? esc($value['id']) : 'add'?>" method="post" autocomplete="off">
		<div class="row justify-content-center">
			<div class="col-3">
				<div class="form-group mb-3">
					<label for="student_number">Student Number</label>
					<input type="text" class="form-control" value="<?=isset($value['student_number']) ? esc($value['student_number']) : '' ?>" name="student_number" id="student_number">
					<?php if(isset($error['student_number'])):?>
						<div class="text-danger">
							<?=esc($error['student_number'])?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="row justify-content-center">
		  <div class="col-3">
				<div class="form-group mb-3">
					<label for="firstname" class="form-label">First Name</label>
					<input value="<?=isset($value['firstname']) ? esc($value['firstname']): ''?>" type="text" name="firstname" class="form-control" id="firstname">
					<?php if (isset($error['firstname'])): ?>
					<div class="text-danger">
						<?=esc($error['firstname'])?>
					</div>
					<?php endif; ?>
				</div>
		  </div>
		  <div class="col-3">
				<div class="form-group mb-3">
					<label for="lastname" class="form-label">Last Name</label>
					<input value="<?=isset($value['lastname']) ? esc($value['lastname']): ''?>" type="text" name="lastname" class="form-control" id="lastname">
					<?php if (isset($error['lastname'])): ?>
					<div class="text-danger">
						<?=esc($error['lastname'])?>
					</div>
					<?php endif; ?>
				</div>
		  </div>
		  <div class="col-3">
				<div class="form-group mb-3">
					<label for="middlename" class="form-label">Middle Name</label>
					<input value="<?=isset($value['middlename']) ? esc($value['middlename']): ''?>" type="text" name="middlename" class="form-control" id="middlename">
					<?php if (isset($error['middlename'])): ?>
					<div class="text-danger">
						<?=esc($error['middlename'])?>
					</div>
					<?php endif; ?>
				</div>
		  </div>
		</div>
		<div class="row justify-content-center">
			<div class="col-3">
				<div class="form-group mb-3">
					
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
