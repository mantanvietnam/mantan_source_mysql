<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/colennao-view-admin-questions-listQuestion">Câu hỏi</a> /</span>
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
                        <li class="nav-item">
                          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-1" aria-controls="navs-top-2" aria-selected="false">
                            Đáp án 1
                          </button>
                        </li>
                        <li class="nav-item">
                          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-2" aria-controls="navs-top-2" aria-selected="false">
                            Đáp án 2
                          </button>
                        </li>
                        <li class="nav-item">
                          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-3" aria-controls="navs-top-2" aria-selected="false">
                            Đáp án 3
                          </button>
                        </li>
                        <li class="nav-item">
                          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-4" aria-controls="navs-top-2" aria-selected="false">
                            Đáp án 4
                          </button>
                        </li>
                        <li class="nav-item">
                          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-5" aria-controls="navs-top-2" aria-selected="false">
                            Đáp án 5
                          </button>
                        </li>
                        <li class="nav-item">
                          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-6" aria-controls="navs-top-2" aria-selected="false">
                            Đáp án 6
                          </button>
                        </li>
                        <li class="nav-item">
                          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-7" aria-controls="navs-top-2" aria-selected="false">
                            Đáp án 7
                          </button>
                        </li>
                        <li class="nav-item">
                          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-8" aria-controls="navs-top-2" aria-selected="false">
                            Đáp án 8
                          </button>
                        </li>
                      </ul>
                      <div class="tab-content">
                        <div class="tab-pane fade active show" id="navs-top-question" role="tabpanel">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="mb-3">
                                <label class="form-label">Câu hỏi (*)</label>
                                <input  type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" required/>
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Câu hỏi tiếng anh</label>
                                <input  type="text" class="form-control phone-mask" name="nameen" id="nameen" value="<?php echo @$data->nameen;?>" required/>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="mb-3">
                                <label class="form-label">Trạng thái</label>
                                <div class="input-group input-group-merge">
                                  <select class="form-select" name="status" id="status">
                                    <option value="active" <?php if(!empty($data->status) && $data->status=='active') echo 'selected'; ?> >Kích hoạt</option>
                                    <option value="lock" <?php if(!empty($data->status) && $data->status=='lock') echo 'selected'; ?> >Khóa</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane fade show" id="navs-top-1" role="tabpanel">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Đáp án 1 (Tiếng Việt)</label>
                                        <?php 
                                        $answer1_vi = '';
                                        $answer1_en = '';

                                        // Kiểm tra xem $data->answer1 có tồn tại và không rỗng
                                        if (!empty($data->answer1)) {
                                            $answer1 = json_decode($data->answer1, true);
                                            // Kiểm tra và lấy giá trị cho tiếng Việt
                                            $answer1_vi = isset($answer1['vi']) ? $answer1['vi'] : '';
                                            $answer1_en = isset($answer1['en']) ? $answer1['en'] : '';
                                        }

                                        showEditorInput('answer1_vi', 'answer1_vi', $answer1_vi); 
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Đáp án 1 (Tiếng Anh)</label>
                                        <?php showEditorInput('answer1_en', 'answer1_en', $answer1_en); ?>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="tab-pane fade show" id="navs-top-2" role="tabpanel">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Đáp án 2 (Tiếng Việt)</label>
                                        <?php 
                                            $answer2 = isset($data->answer2) ? json_decode($data->answer2, true) : [];
                                            $answer2_vi = $answer2['vi'] ?? '';
                                            showEditorInput('answer2_vi', 'answer2_vi', $answer2_vi); 
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Đáp án 2 (Tiếng Anh)</label>
                                        <?php 
                                            $answer2_en = $answer2['en'] ?? '';
                                            showEditorInput('answer2_en', 'answer2_en', $answer2_en); 
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade show" id="navs-top-3" role="tabpanel">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Đáp án 3 (Tiếng Việt)</label>
                                        <?php 
                                            $answer3 = isset($data->answer3) ? json_decode($data->answer3, true) : [];
                                            $answer3_vi = $answer3['vi'] ?? '';
                                            showEditorInput('answer3_vi', 'answer3_vi', $answer3_vi); 
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Đáp án 3 (Tiếng Anh)</label>
                                        <?php 
                                            $answer3_en = $answer3['en'] ?? '';
                                            showEditorInput('answer3_en', 'answer3_en', $answer3_en); 
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade show" id="navs-top-4" role="tabpanel">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Đáp án 4 (Tiếng Việt)</label>
                                        <?php 
                                            $answer4 = isset($data->answer4) ? json_decode($data->answer4, true) : [];
                                            $answer4_vi = $answer4['vi'] ?? '';
                                            showEditorInput('answer4_vi', 'answer4_vi', $answer4_vi); 
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Đáp án 4 (Tiếng Anh)</label>
                                        <?php 
                                            $answer4_en = $answer4['en'] ?? '';
                                            showEditorInput('answer4_en', 'answer4_en', $answer4_en); 
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade show" id="navs-top-5" role="tabpanel">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Đáp án 5 (Tiếng Việt)</label>
                                        <?php 
                                            $answer5 = isset($data->answer5) ? json_decode($data->answer5, true) : [];
                                            $answer5_vi = $answer5['vi'] ?? '';
                                            showEditorInput('answer5_vi', 'answer5_vi', $answer5_vi); 
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Đáp án 5 (Tiếng Anh)</label>
                                        <?php 
                                            $answer5_en = $answer5['en'] ?? '';
                                            showEditorInput('answer5_en', 'answer5_en', $answer5_en); 
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade show" id="navs-top-6" role="tabpanel">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Đáp án 6 (Tiếng Việt)</label>
                                        <?php 
                                            $answer6 = isset($data->answer6) ? json_decode($data->answer6, true) : [];
                                            $answer6_vi = $answer6['vi'] ?? '';
                                            showEditorInput('answer6_vi', 'answer6_vi', $answer6_vi); 
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Đáp án 6 (Tiếng Anh)</label>
                                        <?php 
                                            $answer6_en = $answer6['en'] ?? '';
                                            showEditorInput('answer6_en', 'answer6_en', $answer6_en); 
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade show" id="navs-top-7" role="tabpanel">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Đáp án 7 (Tiếng Việt)</label>
                                        <?php 
                                            $answer7 = isset($data->answer7) ? json_decode($data->answer7, true) : [];
                                            $answer7_vi = $answer7['vi'] ?? '';
                                            showEditorInput('answer7_vi', 'answer7_vi', $answer7_vi); 
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Đáp án 7 (Tiếng Anh)</label>
                                        <?php 
                                            $answer7_en = $answer7['en'] ?? '';
                                            showEditorInput('answer7_en', 'answer7_en', $answer7_en); 
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade show" id="navs-top-8" role="tabpanel">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Đáp án 8 (Tiếng Việt)</label>
                                        <?php 
                                            $answer8 = isset($data->answer8) ? json_decode($data->answer8, true) : [];
                                            $answer8_vi = $answer8['vi'] ?? '';
                                            showEditorInput('answer8_vi', 'answer8_vi', $answer8_vi); 
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Đáp án 8 (Tiếng Anh)</label>
                                        <?php 
                                            $answer8_en = $answer8['en'] ?? '';
                                            showEditorInput('answer8_en', 'answer8_en', $answer8_en); 
                                        ?>
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

