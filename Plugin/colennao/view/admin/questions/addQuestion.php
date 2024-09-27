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
                          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-2" aria-controls="navs-top-2" aria-selected="false">
                            Đáp án  
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
                        <div class="tab-pane fade  show" id="navs-top-2" role="tabpanel">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="mb-3">
                                <label class="form-label">đáp án 1</label>
                                <input  type="text" class="form-control phone-mask" name="answer1" id="answer1" value="<?php echo @$data->answer1;?>" />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="mb-3">
                                <label class="form-label">đáp án 2</label>
                                <input  type="text" class="form-control phone-mask" name="answer2" id="answer2" value="<?php echo @$data->answer2;?>" />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="mb-3">
                                <label class="form-label">đáp án 3</label>
                                <input  type="text" class="form-control phone-mask" name="answer3" id="answer3" value="<?php echo @$data->answer3;?>" />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="mb-3">
                                <label class="form-label">đáp án 4</label>
                                <input  type="text" class="form-control phone-mask" name="answer4" id="answer4" value="<?php echo @$data->answer4;?>" />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="mb-3">
                                <label class="form-label">đáp án 5</label>
                                <input  type="text" class="form-control phone-mask" name="answer5" id="answer5" value="<?php echo @$data->answer5;?>" />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="mb-3">
                                <label class="form-label">đáp án 6</label>
                                <input  type="text" class="form-control phone-mask" name="answer6" id="answer6" value="<?php echo @$data->answer6;?>" />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="mb-3">
                                <label class="form-label">đáp án 7</label>
                                <input  type="text" class="form-control phone-mask" name="answer7" id="answer7" value="<?php echo @$data->answer7;?>" />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="mb-3">
                                <label class="form-label">đáp án 8</label>
                                <input  type="text" class="form-control phone-mask" name="answer8" id="answer8" value="<?php echo @$data->answer8;?>" />
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

