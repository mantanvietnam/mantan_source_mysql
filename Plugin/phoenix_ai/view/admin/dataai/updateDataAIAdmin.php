<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">AI Trợ Lý Ảo</h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">AI Trợ Lý Ảo</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">ID AI Dify (*)</label>
                    <input required type="text" class="form-control phone-mask" name="id_ai_dify" id="id_ai_dify" value="<?php echo @$data->id_ai_dify;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Link AI chat (*)</label>
                    <input type="text" required  class="form-control" placeholder="" name="link_ai" id="link_ai" value="<?php echo @$data->link_ai;?>" />
                  </div>
                  
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Mã nhúng code AI vào web (*)</label>
                    <textarea class="form-control" rows="5" placeholder="" name="embed_code_ai" id="embed_code_ai"><?php echo @$data->embed_code_ai;?></textarea>
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Lưu</button>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>