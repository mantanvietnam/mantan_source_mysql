<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/colennao-view-admin-myplane-listmyplane">myplane</a> /</span>
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
                      </ul>
                      <div class="tab-content">
                        <div class="tab-pane fade active show" id="navs-top-question" role="tabpanel">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="mb-3">
                                  <label class="form-label">id_userpeople</label>
                                  <select name="id_userpeople" id="id_userpeople" class="form-control" >
                                      <option value="">Chọn nhóm bài tập người dùng</option>
                                      <?php if (!empty($listDatauserpeople)): ?>
                                          <?php foreach ($listDatauserpeople as $key): ?>
                                            <option value="<?php echo $key->id; ?>" <?= (isset($data->id_userpeople) && $data->id_userpeople == $key->id) ? 'selected' : '' ?>>
                                                  <?php echo $key->name; ?>
                                              </option>
                                          <?php endforeach; ?>
                                      <?php endif; ?>
                                  </select>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="mb-3">
                                  <label class="form-label">id_breakfast</label>
                                  <select name="id_breakfast" id="id_breakfast" class="form-control" >
                                      <option value="">Chọn thức ăn cho bữa sáng</option>
                                      <?php if (!empty($listDatabreakfast)): ?>
                                          <?php foreach ($listDatabreakfast as $key => $value): ?>
                                            <option value="<?php echo $value->id; ?>" <?= (isset($data->id_breakfast) && $data->id_breakfast == $value->id) ? 'selected' : '' ?>>
                                                  <?php echo $value->name.'->'.$value->time ?>
                                              </option>
                                          <?php endforeach; ?>
                                      <?php endif; ?>
                                  </select>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="mb-3">
                                  <label class="form-label">id_lunch</label>
                                  <select name="id_lunch" id="id_lunch" class="form-control" >
                                      <option value="">Chọn thức ăn cho bữa trưa</option>
                                      <?php if (!empty($listDatalunch)): ?>
                                          <?php foreach ($listDatalunch as $key => $value): ?>
                                            <option value="<?php echo $value->id; ?>" <?= (isset($data->id_lunch) && $data->id_lunch == $value->id) ? 'selected' : '' ?>>
                                                <?php echo $value->name.'->'.$value->time ?>
                                              </option>
                                          <?php endforeach; ?>
                                      <?php endif; ?>
                                  </select>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="mb-3">
                                  <label class="form-label">id_dinner</label>
                                  <select name="id_dinner" id="id_dinner" class="form-control" >
                                      <option value="">Chọn thức ăn cho bữa tối</option>
                                      <?php if (!empty($listDatadinner)): ?>
                                          <?php foreach ($listDatadinner as $key => $value): ?>
                                            <option value="<?php echo $value->id; ?>" <?= (isset($data->id_dinner) && $data->id_dinner == $value->id) ? 'selected' : '' ?>>
                                                <?php echo $value->name.'->'. $value->time ?>
                                              </option>
                                          <?php endforeach; ?>
                                      <?php endif; ?>
                                  </select>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="mb-3">
                                  <label class="form-label">id_snacks</label>
                                  <select name="id_snack" id="id_snack" class="form-control" >
                                      <option value="">Chọn thức ăn cho bữa ăn nhẹ</option>
                                      <?php if (!empty($listDatasnacks)): ?>
                                          <?php foreach ($listDatasnacks as $key => $value): ?>
                                            <option value="<?php echo $value->id; ?>" <?= (isset($data->id_snack) && $data->id_snack == $value->id) ? 'selected' : '' ?>>
                                                <?php echo $value->name .'->'. $value->time ?>
                                              </option>
                                          <?php endforeach; ?>
                                      <?php endif; ?>
                                  </select>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="mb-3">
                                <label class="form-label">water</label>
                                <input  type="text" class="form-control phone-mask" name="water" id="water" value="<?php echo @$data->water;?>" />
                              </div>
                              <div class="mb-3">
                                <label class="form-label">meal</label>
                                <input  type="text" class="form-control phone-mask" name="meal" id="meal" value="<?php echo @$data->meal;?>" />
                              </div>
                              <div class="mb-3">
                                <label class="form-label">workout</label>
                                <input  type="text" class="form-control phone-mask" name="workout" id="workout" value="<?php echo @$data->workout;?>" />
                              </div>
                              <div class="mb-3">
                                <label class="form-label">day</label>
                                <input  type="number" class="form-control phone-mask" name="day" id="day" value="<?php echo @$data->day;?>" />
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


