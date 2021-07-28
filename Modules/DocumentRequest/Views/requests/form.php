<div class="container p-1 mt-3" id="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/requests"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item active" aria-current="page">Request Document</li>
            </ol>
          </nav>
          <hr>
          <div class="row">
            <div class="col-12">
              <div class="alert alert-warning" role="alert">
                <i class="fas fa-exclamation-circle"></i> Make sure the information is correct before submitting the request
              </div>
            </div>
          </div>
          <form class="" action="new" method="post">
            <div class="row">
              <div class="col-md-4">
                <div class="row">
                  <div class="col-12">
                    <span class="h5">User Information</span>
                    <a href="<?=base_url('students/edit')?>" class="btn btn-seconary text-light btn-sm float-end">Edit</a>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    Name:
                  </div>
                  <div class="col-md-7">
                    <?=ucwords(esc($value['firstname']) . ' ' . esc($value['middlename']) . ' ' . esc($value['lastname']) . ' ' . esc($value['suffix']))?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    Gender:
                  </div>
                  <div class="col-md-7">
                    <?=$value['gender'] == 'm' ? 'Male': 'Female'?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    Status:
                  </div>
                  <div class="col-md-7">
                    <?=ucwords(esc($value['status']))?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    Course and <?=$value['status'] == 'enrolled' ? 'Level':'Year Graduated'?>:
                  </div>
                  <div class="col-md-7">
                    <?=strtoupper($value['abbreviation'] . ' ' . $value['level'])?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    Email:
                  </div>
                  <div class="col-md-7">
                    <?=ucwords(esc($value['email']))?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    Contact:
                  </div>
                  <div class="col-md-7">
                    <?=ucwords(esc($value['contact']))?>
                  </div>
                </div>
              </div>
              <div class="col-md-5">
                <div class="row">
                  <label for="Document" class="form-label"><h5>List of Documents</h5></label>
                </div>
                <?php foreach ($documents as $document): ?>
                  <div class="input-group mb-2">
                    <div class="input-group-text">
                      <div class="form-check">
                        <input class="form-check-input document-checkbox" name="document_id[]" type="checkbox" id="<?=trim(str_replace(' ', '', $document['document']))?>" value="<?=esc($document['id'])?>" onchange="showDetail(this)" >
                        <label class="for m-check-label" for="<?=trim(str_replace(' ', '', $document['document']))?>"><?=esc($document['document'])?></label>
                      </div>
                    </div>
                    <input type="number" name="quantity[]" value="1" class="form-control quantity-form" id="qty-form-<?=trim(str_replace(' ', '', $document['document']))?>" disabled required>
                  </div>
                <?php endforeach; ?>
                <?php if (isset($error['document_id'])): ?>
                  <div class="text-danger">
                    <?=esc($error['document_id'])?>
                  </div>
                <?php endif; ?>
                <?php if (isset($error['quantity.*']) && !isset($error['document_id'])): ?>
                  <div class="text-danger">
                    <?=esc($error['quantity.*'])?>
                  </div>
                <?php endif; ?>
              </div>
              <div class="col-md-3">
                <div class="row">
                  <label for="reasonInput" class="form-label" required><h5>Reason/s for Requesting</h5></label>
                </div>
                  <div class="form-check" id="reasonInput">
                    <input class="form-check-input reasons" type="radio" value="scholarship" name="reason" id="scholarship" required checked>
                    <label class="form-check-label" for="scholarship">
                      Scholarship Requirement
                    </label>
                  </div>
                  <div class="form-check" id="reasonInput">
                    <input class="form-check-input reasons" type="radio" value="employment" name="reason" id="employment" required>
                    <label class="form-check-label" for="employment">
                      Employment
                    </label>
                  </div>
                  <div class="form-check" id="reasonInput">
                    <input class="form-check-input reasons" type="radio" value="re-admission" name="reason" id="re-admission" required>
                    <label class="form-check-label" for="re-admission">
                      Re-admission
                    </label>
                  </div>
                  <div class="form-check" id="reasonInput">
                    <input class="form-check-input reasons" type="radio" value="transfer to other school" name="reason" id="transfer" required>
                    <label class="form-check-label" for="transfer">
                      Transfer to other school
                    </label>
                  </div>
                  <div class="form-check" id="reasonInput">
                    <input class="form-check-input reasons" type="radio" value="others" name="reason" id="others" required>
                    <label class="form-check-label" for="others">
                      Others
                    </label>
                  </div>
                  <input type="text" name="reason" value="" id="other_input" class="form-control form-control-sm" placeholder="Other Reason" disabled hidden>
                  <br>
                </div>
              <br>
              <div class="col-12">
                      <br><button type="submit" class="btn float-end" name="button">Submit <i class="fas fa-paper-plane"></i></button>
              </div>
            </div>
          </form>
        </div>
    </div>
  </div>
</div>
