<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/colennao-view-admin-listuserpeople-listuserpeople">Danh sách bài tập luyện </a> /</span>
    Nội dung câu hỏi
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thêm bài luyện tập</h5>
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
                                  <label class="form-label">Kế hoạch</label>
                                  <select class="form-control" name="id_consume" id="id_consume" required>
                                      <option value="">Chọn Nhóm </option>
                                   
                                      <?php foreach ($datamyplane as $item): ?>
                                          <option value="<?php echo $item['id']; ?>" 
                                              <?php echo isset($data->id_consume) && $data->id_consume == $item['id'] ? 'selected' : ''; ?>>
                                              <?php echo $item['name']; ?>
                                          </option>
                                      <?php endforeach; ?>
                                  </select>
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
                                    <label class="form-label">Dạng bài tập</label>
                                    <select class="form-select" name="type" id="type">
                                        <option value="karate" <?php echo (isset($data->type) && $data->type === 'karate') ? 'selected' : ''; ?>>Karate</option>
                                        <option value="yoga" <?php echo (isset($data->type) && $data->type === 'yoga') ? 'selected' : ''; ?>>Yoga</option>
                                    </select>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="navs-top-unit" role="tabpanel">
                          <div class="container">
                              <h4 class="mb-4">Thêm bài tập</h4>
                              <table class="table table-bordered" id="exerciseTable">
                                  <thead>
                                      <tr>
                                          <th>Tên nhóm bài học</th>
                                          <th>Tên bài học</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  <?php if (!empty($data)): ?>
                              <?php 
                                  // Giải mã chuỗi JSON từ 'id_lesson' của đối tượng $data
                                  $idLessons = json_decode($data->id_lesson, true);

                                  // Kiểm tra nếu $idLessons không phải là mảng hợp lệ và không rỗng
                                  if (!is_array($idLessons)) {
                                      // Nếu $idLessons không phải là mảng hợp lệ, gán nó thành một mảng rỗng
                                      $idLessons = [];
                                  }
                              ?>

                              <?php if (!empty($idLessons)): ?>
                                  <?php foreach ($idLessons as $lesson): ?>
                                      <tr>
                                          <!-- Tên nhóm bài học - select lấy từ $dataWorkouts -->
                                          <td>
                                              <select class="form-control" name="workout_group[]">
                                                  <?php foreach ($dataWorkouts as $option): ?>
                                                      <option value="<?= $option->id ?>"
                                                          <?= $lesson[0] == $option->id ? 'selected' : '' ?>>
                                                          <?= htmlspecialchars($option->title) ?>
                                                      </option>
                                                  <?php endforeach; ?>
                                              </select>
                                          </td>

                                          <!-- Tên bài học - select lấy từ $dataExerciseWorkouts -->
                                          <td>
                                              <select class="form-control" name="workout_title[]">
                                                  <option value="">Chọn bài học</option>
                                                  <?php foreach ($dataExerciseWorkouts as $exercise): ?>
                                                      <!-- Kiểm tra xem bài học có thuộc nhóm workout không -->
                                                      <?php if ($lesson[0] == $exercise->id_workout): ?>
                                                          <option value="<?= $exercise->id ?>"
                                                              <?= $lesson[1] == $exercise->id ? 'selected' : '' ?>>
                                                              <?= htmlspecialchars($exercise->title) ?>
                                                          </option>
                                                      <?php endif; ?>
                                                  <?php endforeach; ?>
                                              </select>
                                          </td>
                                      </tr>
                                  <?php endforeach; ?>
                              <?php else: ?>
                                  <!-- Nếu $idLessons là rỗng hoặc không hợp lệ, hiển thị thông báo -->
                                  <tr>
                                      <td colspan="2"></td>
                                  </tr>
                              <?php endif; ?>
                          <?php else: ?>
                              <!-- Nếu không có dữ liệu, hiển thị một hàng trống để người dùng nhập -->
                              <tr>
                                  <td>
                                      <select class="form-control" name="workout_group[]">
                                          <option value="">Chọn nhóm bài học</option>
                                          <?php foreach ($dataWorkouts as $workout): ?>
                                              <option value="<?= $workout->id ?>"><?= htmlspecialchars($workout->title) ?></option>
                                          <?php endforeach; ?>
                                      </select>
                                  </td>

                                  <td>
                                      <select class="form-control" name="workout_title[]">
                                          <option value="">Chọn bài học</option>
                                          <?php foreach ($dataExerciseWorkouts as $exercise): ?>
                                              <option value="<?= $exercise->id ?>"><?= htmlspecialchars($exercise->title) ?></option>
                                          <?php endforeach; ?>
                                      </select>
                                  </td>
                              </tr>
                          <?php endif; ?>





                                  </tbody>
                              </table>

                              <div class="form-group">
                                  <button type="button" class="btn btn-primary" id="addRowButton">Thêm Hàng</button>
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

<script>
    document.getElementById('addRowButton').addEventListener('click', function() {
    var table = document.getElementById('exerciseTable').getElementsByTagName('tbody')[0];
    var newRow = table.insertRow(table.rows.length);

    // Tạo cột cho nhóm bài học
    var cell1 = newRow.insertCell(0);
    cell1.innerHTML = `
        <select class="form-control" name="workout_group[]">
            <option value="">Chọn nhóm bài học</option>
            <?php foreach ($dataWorkouts as $workout): ?>
                <option value="<?= $workout->id ?>"><?= htmlspecialchars($workout->title) ?></option>
            <?php endforeach; ?>
        </select>
    `;

    // Tạo cột cho bài học
    var cell2 = newRow.insertCell(1);
    cell2.innerHTML = `
        <select class="form-control" name="workout_title[]">
            <option value="">Chọn bài học</option>
            <?php foreach ($dataExerciseWorkouts as $exercise): ?>
                <option value="<?= $exercise->id ?>"><?= htmlspecialchars($exercise->title) ?></option>
            <?php endforeach; ?>
        </select>
    `;
});

</script>