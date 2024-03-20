<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Kiểm tra các cuốc xe đã hoàn thành</h4>

    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-12">
                <div class="card-body">
                  <p><?php echo @$mess;?></p>
                  <?= $this->Form->create(); ?>
                  <div class="row">
                    <input class="form-control" hidden="" type="text" id="input" name="input" value="">

                    <div class="col-md-2">
                      <button type="submit" class="btn btn-primary">
                          Kiểm tra
                      </button>
                    </div>
                  </div>
                  <?= $this->Form->end() ?>
                </div>
            </div>
        </div>

    </div>
</div>
