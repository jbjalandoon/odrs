<div class="modal fade" id="passwordForm" tabindex="-1" aria-labelledby="passwordFormLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="passwordFormLabel"> <i class="fas fa-lock"></i> Change Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="row">
            <div class="col-12">
              <div class="form-group mb-3">
                <label for="old_password">Old Password *</label>
                <input type="password" class="form-control" name="old_password" id="old_password">
                <?php if(isset($error['old_password'])): ?>
                  <div class="text-danger">
                    <?=esc($error['old_password'])?>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="form-group mb-3">
                <label for="new_password">New Password *</label>
                <input type="password" class="form-control" name="new_password" id="new_password">
                <?php if(isset($error['new_password'])): ?>
                  <div class="text-danger">
                    <?=esc($error['new_password'])?>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="form-group mb-3">
                <label for="repeat_password">Repeat New Password *</label>
                <input type="password" class="form-control" name="repeat_password" id="repeat_password">
                <?php if(isset($error['repeat_password'])): ?>
                  <div class="text-danger">
                    <?=esc($error['repeat_password'])?>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="changePassword" onclick="changePassword()" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>