<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/colennao-view-admin-mealtime-listmealtime">Thời gian nhịn ăn</a> /</span>
    Nội dung 
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Nội dung</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-12">
                  <div class="nav-align-top mb-4">
                      <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                          <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-question" aria-controls="navs-top-question" aria-selected="true">
                            thông tin
                          </button>
                        </li>
                      </ul>
                      <div class="tab-content">
                        <div class="tab-pane fade active show" id="navs-top-question" role="tabpanel">
                          <div class="row">
                            <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tên</label>
                                <select class="form-control" name="id_level" id="id_level">
                                    <?php foreach ($listDatacategorydiet as $categorydiet): ?>
                                        <option value="<?php echo $categorydiet['id']; ?>" <?php echo ($data->id == $categorydiet['id']) ? 'selected' : ''; ?>>
                                            <?php echo $categorydiet['name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                              <div class="mb-3">
                                  <label class="form-label">Nhịn ăn</label>
                                  <input type="text" class="form-control" name="fasting" id="fasting" value="<?php echo $data->fasting?>" />
                              </div>
                              <div class="mb-3">
                                  <label class="form-label">ăn uống</label>
                                  <input type="text" class="form-control" name="eating" id="eating" value="<?php echo $data->eating?>" />
                              </div>
                              <div class="mb-3">
                                  <label class="form-label">image</label>
                                  <?php showUploadFile('image','image',@$data->image,0);?>
                              </div>
                              <div class="mb-3">
                                  <label class="form-label">Mô tả 1</label>
                                  <textarea maxlength="160" rows="5" class="form-control" name="description1" id="description1"><?php echo @$data->description1;?></textarea>
                              </div>
                              <div class="mb-3">
                                  <label class="form-label">Mô tả 2</label>
                                  <textarea maxlength="160" rows="5" class="form-control" name="description2" id="description2"><?php echo @$data->description2;?></textarea>
                              </div>
                              <div class="mb-3">
                                  <label class="form-label">Mới</label>
                                  <input type="hidden" name="beginner" value="0" />
                                  <input type="checkbox" class="form-check-input" name="beginner" id="beginner" value="1" <?php echo ($data->beginner == 1) ? 'checked' : ''; ?> />
                                 
                              </div>
                              <div class="mb-3">
                                  <label class="form-label">Phổ biến</label>
                                  <input type="hidden" name="populer" value="0" />
                                  <input type="checkbox" class="form-check-input" name="populer" id="populer" value="1" <?php echo ($data->populer == 1) ? 'checked' : ''; ?> />
                                  
                              </div>



                          </div>
                        </div>
                      </div>              
                  </div>
                </div>
              </div>
                <div class="col-4">
                <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
              
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>


