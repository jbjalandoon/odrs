<?= view('home/header') ?>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto d-flex flex-column min-vh-100 justify-content-center align-items-center">
        <div class="card my-5">

            <img class="card-img-top" src="/img/login-img.jpg" alt="Card image cap">

          <div class="card-body">
            <div class="text-center">
              <p class="h4">Sign In</p>
            </div>
            <div class="text-center">
              <form action="verify" method="post">
                <div class="form-group">
                  <div class="input-group mb-3">
                    <label for="username" class="sr-only"></label>
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope"></i></span>
                    <input type="username" name="username" id="username" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" required>
                    <?php if (isset($errors['username'])): ?>
                      <div class="text-danger">
                        <?=esc($errors['username'])?>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group mb-3">
                    <label for="password" class="sr-only"></label>
                    <span class="input-group-text" id="basic-addon2"><i class="fas fa-lock"></i></span>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" aria-label="Username" aria-describedby="basic-addon2" required>
                    <?php if (isset($errors['password'])): ?>
                      <div class="text-danger">
                        <?=esc($errors['password'])?>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
                <!-- FORGOT PASSWORD -->
                <small>
                  Forgot your password? Click <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">here</a>.
                    <!-- Button trigger modal -->

                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label" for="email">Email</label>
                            <input type="email"  id="email" class="form-control" value="" placeholder="johndoe@email.com">
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary btn-sm" onClick="requestPassword()">Request</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </small>
                <div class="text-center">
                  <hr>
                  <button type="submit" name="button" id="login-button" class="btn login-btn mb-4">Sign In</button>
                  <?php if (isset($_SESSION['error_login'])): ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                      <?=esc($_SESSION['error_login'])?>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  <?php endif; ?>
                </div>
              </form>
            </div>
          </div>
          <div class="card-footer">
            <small class="fst-italic">
              By using this service, you understood and agree to the PUP Online Services
              <a href="https://www.pup.edu.ph/terms/">Terms of Use</a> and
              <a href="https://www.pup.edu.ph/privacy/">Privacy Statement</a>.
            </small>
          </div>
        </div>
      </div>
    </div>
  </div>
<?= view('home/footer') ?>
