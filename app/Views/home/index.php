<?= view('home/header') ?>
<main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
      <div class="card login-card">
        <div class="row no-gutters">
          <div class="col-md-5">
            <img src="/img/bldg-a.jpg" alt="login" class="login-card-img">
          </div>
          <div class="col-md-7">
            <div class="card-body">
              <div class="brand-wrapper">
                <img src="/img/odrs-logo.png" alt="logo" class="logo">
              </div>
              <p class="login-card-description">Sign In</p>
              <form action="verify" method="post">
                  <div class="form-group">
                    <label for="username" class="sr-only"><i class="fas fa-user"></i>Username</label>
                    <input type="username" name="username" id="username" class="form-control" placeholder="Username" required>
					<?php if (isset($errors['username'])): ?>
						<div class="text-danger">
							<?=esc($errors['username'])?>
						</div>	
					<?php endif; ?>
                  </div>
                  <div class="form-group mb-4">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="***********" required>
					<?php if (isset($errors['password'])): ?>
						<div class="text-danger">
							<?=esc($errors['password'])?>
						</div>
					<?php endif; ?>
                  </div>
                  <button type="submit" name="button" id="login-button" class="btn btn-block login-btn mb-4">Login</button>
				  	<?php if (isset($_SESSION['error_login'])): ?>
						<div class="mt-4 alert alert-danger alert-dismissible fade show" role="alert">
						<?=esc($_SESSION['error_login'])?>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
					<?php endif; ?>
                </form>
                <a href="#!" class="forgot-password-link">Forgot password?</a>
                <p class="login-card-footer-text">Don't have an account? <a href="register" class="text-reset">Register here</a></p>
                <nav class="login-card-footer-nav">
                  <a href="#!">Terms of use.</a>
                  <a href="#!">Privacy policy</a>
                </nav>
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="card login-card">
        <img src="assets/images/login.jpg" alt="login" class="login-card-img">
        <div class="card-body">
          <h2 class="login-card-title">Login</h2>
          <p class="login-card-description">Sign in to your account to continue.</p>
          <form action="#!">
            <div class="form-group">
              <label for="email" class="sr-only">Email</label>
              <input type="email" name="email" id="email" class="form-control" placeholder="Email">
            </div>
            <div class="form-group">
              <label for="password" class="sr-only">Password</label>
              <input type="password" name="password" id="password" class="form-control" placeholder="Password">
            </div>
            <div class="form-prompt-wrapper">
              <div class="custom-control custom-checkbox login-card-check-box">
                <input type="checkbox" class="custom-control-input" id="customCheck1">
                <label class="custom-control-label" for="customCheck1">Remember me</label>
              </div>              
              <a href="#!" class="text-reset">Forgot password?</a>
            </div>
            <input name="login" id="login" class="btn btn-block login-btn mb-4" type="button" value="Login">
          </form>
          <p class="login-card-footer-text">Don't have an account? <a href="#!" class="text-reset">Register here</a></p>
        </div>
      </div> -->
    </div>
  </main>

	

<?= view('home/footer') ?>
