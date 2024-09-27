<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/colennao-view-admin-condition-listcondition">Câu hỏi</a> /</span>
    Nội dung câu hỏi
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Nội dung câu hỏi</h5>
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
                            Câu hỏi
                          </button>
                        </li>
                        <!-- <li class="nav-item">
                          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-2" aria-controls="navs-top-2" aria-selected="false">
                            Đáp án  
                          </button>
                        </li> -->
                      </ul>
                      <div class="tab-content">
                        <div class="tab-pane fade active show" id="navs-top-question" role="tabpanel">
                          <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                  <?php echo $mess;?>
                                    <label class="form-label">id_groupfile</label>
                                    <select class="form-control" name="id_groupfile" id="id_groupfile" required>
                                        <option value="">Chọn Nhóm bài tập</option>
                                        <?php foreach ($dataWorkout as $item): ?>
                                            <option value="<?php echo $item['id']; ?>" 
                                                <?php echo isset($data->id) && $data->id == $item['id'] ? 'selected' : ''; ?>>
                                                <?php echo $item['title']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                          </div>
                          <?php if (!empty($dataquestion) && is_array($dataquestion)): ?>
                            <?php foreach ($dataquestion as $questionData): ?>
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <div class="mb-2">
                                            <label class="form-label">Câu hỏi: <?php echo $questionData['name']; ?></label>
                                            <input type="hidden" name="id_question[]" value="<?php echo $questionData['id']; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <?php 
                                            $hasAnswer = false; 
                                            for ($i = 1; $i <= 8; $i++): 
                                                $answerKey = 'answer' . $i; 
                                                if (isset($questionData[$answerKey]) && $questionData[$answerKey] !== null && $questionData[$answerKey] !== ''): // Kiểm tra đáp án không phải là null và không rỗng
                                                    $hasAnswer = true; 
                                                    // Gán giá trị tương ứng cho đáp án
                                                    $valueMap = ['a', 'b', 'c', 'd','e','f','g','h']; // Giá trị cho các đáp án
                                            ?>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="answer[<?php echo $questionData['id']; ?>][]" value="<?php echo $valueMap[$i - 1]; ?>" id="<?php echo $answerKey . '-' . $questionData['id']; ?>">
                                                    <label class="form-check-label" for="<?php echo $answerKey . '-' . $questionData['id']; ?>"><?php echo $questionData[$answerKey]; ?></label>
                                                </div>
                                            <?php 
                                                endif; 
                                            endfor; 
                                            if (!$hasAnswer): 
                                            ?>
                                                <p>Không có câu trả lời.</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Không có dữ liệu câu hỏi.</p>
                        <?php endif; ?>

                          <!-- <div class="row">
                            <div class="col-md-6">
                              <div class="mb-3">
                                <label class="form-label">id_question</label>
                                <input  type="text" class="form-control phone-mask" name="id_question" id="id_question" value="<?php echo @$data->id_group;?>" required/>
                              </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Lựa chọn:</label><br/>
                                    
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="question_options[]" value="Lựa chọn 1" id="option1">
                                        <label class="form-check-label" for="option1">đáp án a</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="question_options[]" value="Lựa chọn 2" id="option2">
                                        <label class="form-check-label" for="option2">đáp án b </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="question_options[]" value="Lựa chọn 3" id="option3">
                                        <label class="form-check-label" for="option3">đáp án c</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="question_options[]" value="Lựa chọn 4" id="option4">
                                        <label class="form-check-label" for="option4">đáp án d</label>
                                    </div>
                                </div>
                            </div>
                          </div> -->
                        </div>
                        <div class="tab-pane fade  show" id="navs-top-2" role="tabpanel">
                        
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
document.getElementById('addRowBtn').addEventListener('click', function() {
    // Lấy bảng và tạo hàng mới
    var table = document.getElementById('answerTable').getElementsByTagName('tbody')[0];
    var newRow = table.insertRow();

    // Tạo các ô và chèn vào hàng mới
    var cell1 = newRow.insertCell(0);
    var cell2 = newRow.insertCell(1);

    // Tạo nội dung cho từng ô
    cell1.innerHTML = '<input type="text" class="form-control" placeholder="" name="answername[]" />' +
                      '<input type="hidden" class="form-control" placeholder="" name="namequestion" />';
    cell2.innerHTML = '<button type="button" class="btn btn-danger" onclick="removeRow(this)">Xóa</button>';
});




</script>

