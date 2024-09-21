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
                          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-unit" aria-controls="navs-top-unit" aria-selected="false">
                            Danh sách các kết quả câu hỏi  
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
                        <div class="tab-pane fade" id="navs-top-unit" role="tabpanel">
                          <div class="row">
                            <div class="col-md-12"> 
                              <table class="table table-bordered table-striped table-hover mb-none text-center mb-3" id="answerTable">
                                <thead>
                                    <tr>
                               
                                        <th>Câu trả lời</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                 
                                <?php if (!empty($listanswerquestion)): ?>
                                    <?php foreach ($listanswerquestion as $value): ?>
                         
                                        <tr class="gradeX" id="trlink">
                                            <td>
                                                <input type="text" class="form-control" placeholder="" name="answername[]" id="answername" value="<?= $value->answerquestion['answername'] ?>" required/>
                                                <input type="hidden" class="form-control" placeholder="" name="namequestion" id="namequestion" value=""/>
                                                <input type="hidden" class="form-control" placeholder="" name="id_question" id="id_question" value=""/>
                                            </td>
                                            <td>
                                              <a href="/plugins/admin/colennao-view-admin-questions-deleteanswerquestion/?id=<?= $value->answerquestion['id'] ?>" class="btn btn-danger">Xóa</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr class="gradeX" id="trlink">
                                          <td>
                                              <input type="text" class="form-control" placeholder="" name="answername[]" id="answername" value="" required/>
                                              <input type="hidden" class="form-control" placeholder="" name="namequestion" id="namequestion" value=""/>
                                              <input type="hidden" class="form-control" placeholder="" name="id_question" id="id_question" value=""/>
                                          </td>
                                          <td>
                                            
                                            <a href="/plugins/admin/colennao-view-admin-questions-deleteanswerquestion/?id=<?= @$value->answerquestion['id'] ?>" class="btn btn-danger">Xóa</a>
                                          </td>
                                      </tr>
                                <?php endif; ?>
                                </tbody>
                              </table> 

                              <?php if(empty($_GET['id'])):?>
                                <div class="form-group mb-3 col-md-12">
                                  <button type="button" id="addRowBtn" class="btn btn-primary">Thêm hàng</button>
                                </div>
                              <?php else :?>
                                <div class="form-group mb-3 col-md-12 d-none" >
                                  <button type="button" id="addRowBtn" class="btn btn-primary">Thêm hàng</button>
                                </div>
                              <?php endif; ?>
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

