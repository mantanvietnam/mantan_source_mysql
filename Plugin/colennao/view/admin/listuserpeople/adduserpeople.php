<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/colennao-view-admin-listuserpeople-listuserpeople">userpeople</a> /</span>
    Nội dung câu hỏi
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">add userpeople</h5>
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
                            Bài tập 
                          </button>
                        </li>
                      </ul>
                      <div class="tab-content">
                        <div class="tab-pane fade active show" id="navs-top-question" role="tabpanel">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="mb-3">
                                <label class="form-label">Tên bài tập</label>
                                <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="mb-3">
                                <label class="form-label">Ảnh minh họa</label>
                                <?php showUploadFile('image','image',@$data->image,0);?>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="navs-top-unit" role="tabpanel">
                          <div class="container">
                          <?php if (!empty($dataWorkouts) && !empty($dataExerciseWorkouts)): ?>
                              <?php foreach ($dataWorkouts as $packageWorkout): ?>
                                  <div class="row mb-4">
                                      <div class="col-md-12">
                                          <h4><?= htmlspecialchars($packageWorkout->title) ?></h4>
                                      </div>
                                      <div class="col-md-12">
                                          <?php 
                                          $lessonsExist = false; 
                                          foreach ($dataExerciseWorkouts as $workout): ?>
                                              <?php if ($workout->id_workout == $packageWorkout->id): 
                                                  $lessonsExist = true; 
                                              ?>
                                                  <div class="form-check">
                                                      <input type="checkbox" class="form-check-input" name="id_lesson[]" 
                                                            value='{"idWorkout": <?= $workout->id_workout ?>, "id": <?= $workout->id ?>}' 
                                                            data-workout-id="<?= $workout->id_workout ?>" 
                                                            <?= in_array([$workout->id_workout, $workout->id], (array)json_decode($data->id_lesson, true)) ? 'checked' : '' ?>>
                                                      <label class="form-check-label" for="id_lesson_<?= $workout->id ?>"><?= htmlspecialchars($workout->title) ?></label>
                                                  </div>
                                              <?php endif; ?>
                                          <?php endforeach; ?>
                                          <?php if (!$lessonsExist): ?>
                                              <p>Không có bài học nào cho gói bài tập này.</p>
                                          <?php endif; ?>
                                      </div>
                                  </div>
                              <?php endforeach; ?>
                          <?php else: ?>
                              <p>Không có dữ liệu gói bài tập hoặc bài học.</p>
                          <?php endif; ?>



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

