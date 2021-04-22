<div class="container-fluid mt-5">
  <div class="row">
    <div class="col-12">
      <span class="h2">Request Document</span>
    </div>
  </div>
  <hr>
  <form class="" action="request" method="post">

    <div class="row">
      <div class="col-6 offset-3">
        <label for="Document" class="form-label">Document</label>
        <?php foreach ($documents as $document): ?>
                <div class="input-group mb-1">
                  <div class="input-group-text">
                    <div class="form-check">
                      <input class="form-check-input document-checkbox" name="document_id[]" type="checkbox" id="<?=trim(str_replace(' ', '', $document['document']))?>" value="<?=esc($document['id'])?>" onchange="showDetail(this)" >
                      <label class="form-check-label" for="<?=trim(str_replace(' ', '', $document['document']))?>"><?=esc($document['document'])?></label>
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
      </div>
    </div>
        <?php foreach ($documents as $document): ?>

        <?php endforeach; ?>
        <div class="row">
          <div class="col-6 offset-3">
            <label for="reasonInput" class="form-label">Reason</label>
            <div class="input-group mb-3">
              <textarea id="reasonInput" name="reason" rows="3" class="form-control" placeholder="e.g (Scholarship, Job)" required></textarea>
            </div>
            <div class="input-group mb-3">
              <button type="submit" class="btn btn-primary" name="button">Submit</button>
            </div>
          </div>
        </div>
  </form>
  <hr>
  <footer class="text-center">
    <div class="mb-2">
      <small>
        © 2020 made with <i class="fa fa-heart" style="color:red"></i> by - <a target="_blank" rel="noopener noreferrer" href="https://azouaoui.netlify.com">
          Mohamed Azouaoui
        </a>
      </small>
    </div>
    <div>
      <a href="https://github.com/azouaoui-med" target="_blank">
        <img alt="GitHub followers" src="https://img.shields.io/github/followers/azouaoui-med?label=github&style=social" />
      </a>
      <a href="https://twitter.com/azouaoui_med" target="_blank">
        <img alt="Twitter Follow" src="https://img.shields.io/twitter/follow/azouaoui_med?label=twitter&style=social" />
      </a>
    </div>
  </footer>
</div>
