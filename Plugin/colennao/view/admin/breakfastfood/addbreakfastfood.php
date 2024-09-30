<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/colennao-view-admin-breakfastfood-listbreakfastfood">breakfast</a> /</span>
    Nội dung câu hỏi
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Nội dung bữa sáng</h5>
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
                        <li class="nav-item">
                          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-unit" aria-controls="navs-top-unit" aria-selected="false">
                            How to make:  
                          </button>
                        </li>
                        <li class="nav-item">
                          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-3" aria-controls="navs-top-3" aria-selected="false">
                            Ingredients  
                          </button>
                        </li>
                      </ul>
                      <div class="tab-content">
                        <div class="tab-pane fade active show" id="navs-top-question" role="tabpanel">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="mb-3">
                                <label class="form-label">Tên food (*)</label>
                                <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Tên food tiếng anh</label>
                                <input  type="text" class="form-control phone-mask" name="nameen" id="nameen" value="<?php echo @$data->nameen;?>" />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="mb-3">
                                <label class="form-label">Ảnh minh họa</label>
                                <?php showUploadFile('image','image',@$data->image,0);?>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="mb-3">
                                <label class="form-label">Ngày</label>
                                <input type="number" class="form-control" name="time" id="time" value="<?php echo $data->time ?>" />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="mb-3">
                                <label class="form-label">Thời gian nấu ăn</label>
                                <input type="number" class="form-control" name="timeeat" id="timeeat" value="<?=$data->timeeat?>" />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="mb-3">
                                <label class="form-label">lượng thức ăn</label>
                                <input  type="text" class="form-control phone-mask" name="eatformat" id="eatformat" value="<?php echo @$data->eatformat;?>" />
                              </div>
                              <div class="mb-3">
                                <label class="form-label">lượng thức ăn tiếng anh</label>
                                <input  type="text" class="form-control phone-mask" name="eatformaten" id="eatformaten" value="<?php echo @$data->eatformaten;?>" />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="mb-3">
                                  <label class="form-label">id_food</label>
                                  <select name="id_food" id="id_food" class="form-control" >
                                      <option value="">Chọn nhóm thức ăn</option>
                                      <?php if (!empty($listData)): ?>
                                          <?php foreach ($listData as $key => $value): ?>
                                              <option value="<?php echo $value->id; ?>" <?php echo ($data->id_food == $value->id) ? 'selected' : ''; ?>>
                                                  <?php echo $value->name; ?>
                                              </option>
                                          <?php endforeach; ?>
                                      <?php endif; ?>
                                  </select>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="navs-top-unit" role="tabpanel">
                          <div class="row">
                            <div class="col-md-6"> 
                              <div class="mb-3">
                                <label class="form-label">Nội dung làm thế nào</label>
                                <?php showEditorInput('content', 'content', @$data->content);?>
                              </div>
                            </div>
                            <div class="col-md-6"> 
                              <div class="mb-3">
                                <label class="form-label">Nội dung làm thế nào tiếng anh</label>
                                <?php showEditorInput('contenten', 'contenten', @$data->contenten);?>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="navs-top-3" role="tabpanel">
                          <div class="row">
                            <div class="col-md-6"> 
                              <div class="mb-3">
                                <label class="form-label">Thành phần</label>
                                <?php showEditorInput('Ingredients', 'Ingredients', @$data->Ingredients);?>
                              </div>
                            </div>
                            <div class="col-md-6"> 
                              <div class="mb-3">
                                <label class="form-label">Thành phần tiếng anh</label>
                                <?php showEditorInput('ingredientsen', 'ingredientsen', @$data->ingredientsen);?>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>              
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


