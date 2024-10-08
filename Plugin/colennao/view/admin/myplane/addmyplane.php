<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/colennao-view-admin-myplane-listmyplane">myplane</a> /</span>
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
                        <li class="nav-item">
                          <button type="button" class="nav-link " role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-1" aria-controls="navs-top-1" aria-selected="true">
                            Nhập danh sách ngày
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
                              <div class="mb-3">
                                <label class="form-label">time start</label>
                                <input type="datetime-local" class="form-control" name="time" id="time" value="<?php echo isset($data->time) ? date('Y-m-d\TH:i', $data->time) : ''; ?>" />
                              </div>
                            </div>
                
                            <!-- <div class="col-md-6">
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
                            </div> -->
                            <!-- <div class="col-md-6">
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
                            </div> -->
                            <!-- <div class="col-md-6">
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
                            </div> -->
                            <!-- <div class="col-md-6">
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
                            </div> -->

                          </div>
                        </div>
                        <div class="tab-pane fade show " id="navs-top-1" role="tabpanel">
                          <div class="row">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Ngày</th>
                                        <th>Water</th>
                                        <th>Meal</th>
                                        <th>Workout</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php for ($i = 0; $i < 30; $i++): ?>
                                        <tr class="gradeX" id="trfeedback-">
                                            <td>
                                                <input type="text" class="form-control phone-mask mb-3" name="day[<?php echo $i; ?>]" value="<?php echo isset($alldata[$i]['day']) ? htmlspecialchars($alldata[$i]['day']) : ''; ?>" />
                                            </td>
                                            <td>
                                                <input type="text" class="form-control phone-mask" name="water[<?php echo $i; ?>]" value="<?php echo isset($alldata[$i]['water']) ? htmlspecialchars($alldata[$i]['water']) : ''; ?>" />
                                            </td>
                                            <td>
                                                <input type="text" class="form-control phone-mask" name="meal[<?php echo $i; ?>]" value="<?php echo isset($alldata[$i]['meal']) ? htmlspecialchars($alldata[$i]['meal']) : ''; ?>" />
                                            </td>
                                            <td>
                                                <input type="text" class="form-control phone-mask" name="workout[<?php echo $i; ?>]" value="<?php echo isset($alldata[$i]['workout']) ? htmlspecialchars($alldata[$i]['workout']) : ''; ?>" />
                                            </td>
                                            <td>
                                                <input type="hidden" class="form-control phone-mask" name="coutwater[<?php echo $i; ?>]" value="<?php echo isset($alldata[$i]['coutwater']) ? htmlspecialchars($alldata[$i]['coutwater']) : ''; ?>" />
                                            </td>
                                            <td>
                                                <input type="hidden" class="form-control phone-mask" name="coutmeal[<?php echo $i; ?>]" value="<?php echo isset($alldata[$i]['coutmeal']) ? htmlspecialchars($alldata[$i]['coutmeal']) : ''; ?>" />
                                            </td>
                                            <td>
                                                <input type="hidden" class="form-control phone-mask" name="coutworkout[<?php echo $i; ?>]" value="<?php echo isset($alldata[$i]['coutworkout']) ? htmlspecialchars($alldata[$i]['coutworkout']) : ''; ?>" />
                                            </td>
                                        </tr>
                                    <?php endfor; ?>
                                </tbody>
                            </table>
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


