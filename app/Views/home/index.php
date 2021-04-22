<?= view('home/header') ?>

	<div class="container-fluid register">
  	<div class="row">
      <div class="col-3 register-left">
      </div>
			<div class="col-7 offset-2 register-right">
				<div class="row justify-content-center">
					<img src="/pup.png" alt="" />
				</div>
				<h3 class="text-center">Online Document Requests </h3>
        <h3 class="register-heading">Login</h3>
				<form class="" action="verify" method="post">
        	<div class="row register-form">
						<div class="col-md-8 offset-2">
							<div class="form-floating mb-3">
								<input type="text" class="form-control mb-3" name="username" class="floatingInput" placeholder="Student Number" required>
								<label for="floatingInput">Username</label>
								<?php if (isset($errors['username'])): ?>
									<div class="text-danger">
										<?=esc($errors['username'])?>
									</div>
								<?php endif; ?>
							</div>
							<div class="form-floating bm-3">
								<input type="password" class="form-control mb-3" name="password" class="floatingPassword" placeholder="password" required>
								<label for="floatingPassword">Password</label>
							</div>
							<?php if (isset($errors['password'])): ?>
								<div class="text-danger">
									<?=esc($errors['password'])?>
								</div>
							<?php endif; ?>
							<small>No account yet? Sign up <span><a href="signup">here</a></span></small>
							<button type="submit" class="float-end btn btn-primary" name="button" id="login-button">Sign In</button>
							<?php if (isset($_SESSION['error_login'])): ?>
								<div class="mt-4 alert alert-danger alert-dismissible fade show" role="alert">
									<?=esc($_SESSION['error_login'])?>
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
							<?php endif; ?>
						</div>
        	</div>
				</form>
			</div>
  	</div>
	</div>

<?= view('home/footer') ?>
