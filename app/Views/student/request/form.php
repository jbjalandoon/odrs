<div class="container" id="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/student"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item active" aria-current="page">Request Document</li>
            </ol>
          </nav> 
          <hr>

          <h3>Request Document</h3>
          
          <form class="" action="request" method="post">
            <div class="row">
              <div class="col-md-3">
                <table class="table">
                  <thead>
                    <th>User Profile<i class="far fa-id-card"></i></th>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Student Number : 2018-00293-TG-0</td>
                    </tr>
                    <tr>
                      <td>Name : Jerome B. Jalandoon</td>
                    </tr>
                    <tr>
                      <td>Course : DICT</td>
                    </tr>
                    <tr>
                      <td>Email : email@email.com</td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="col-md-9">
                <label for="Document" class="form-label">Documents</label>
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

                <?php if (isset($error['quantity'])): ?>
                  <div class="text-danger">
                    <?=esc($error['quantity'])?>
                  </div>
                <?php endif; ?>

                <?php foreach ($documents as $document): ?>
                <?php endforeach; ?>
                  <label for="reasonInput" class="form-label">Reason</label>
                  <div class="input-group mb-3">
                    <textarea id="reasonInput" name="reason" rows="3" class="form-control" placeholder="e.g (Scholarship, Job)" required></textarea>
                  </div>
                  <div class="input-group mb-3">
                    <button type="submit" class="btn" name="button">Submit <i class="fas fa-paper-plane"></i></button>
                  </div>
              </div>
            </div>
          </form>
        </div>
    </div>
  </div>
</div>