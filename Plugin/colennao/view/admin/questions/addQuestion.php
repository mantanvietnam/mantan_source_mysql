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
                          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-answer1" aria-controls="navs-top-answer1" aria-selected="false">
                            Đáp án 1
                          </button>
                        </li>
                        <li class="nav-item">
                          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-answer2" aria-controls="navs-top-answer2" aria-selected="false">
                            Đáp án 2
                          </button>
                        </li>
                        <li class="nav-item">
                          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-answer3" aria-controls="navs-top-answer3" aria-selected="false">
                            Đáp án 3
                          </button>
                        </li>
                        <li class="nav-item">
                          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-answer4" aria-controls="navs-top-answer4" aria-selected="false">
                            Đáp án 4
                          </button>
                        </li>
                      </ul>
                      <div class="tab-content">
                        <div class="tab-pane fade active show" id="navs-top-question" role="tabpanel">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="mb-3">
                                <label class="form-label">Câu hỏi nhiều đáp án</label>
                                <input type="hidden" name="is_checked" value="0">
                                <input type="checkbox" name="is_checked" value="1" <?php echo (@$data->is_checked == 1) ? 'checked' : ''; ?>>
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Câu hỏi (*)</label>
                                <?php showEditorInput('question', 'question', @$data->question);?>
                              </div>
                            </div>
                          </div>
                        </div>
                       
                        <div class="tab-pane fade" id="navs-top-answer1" role="tabpanel">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="mb-3">
                                <label class="form-label">Phương án A</label>
                                <?php showEditorInput('option_a', 'option_a', @$data->option_a);?>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="navs-top-answer2" role="tabpanel">
                          <div class="row">
                            <div class="col-md-12">
                            <div class="mb-3">
                              <label class="form-label">Phương án B</label>
                              <?php showEditorInput('option_b', 'option_b', @$data->option_b);?>
                            </div>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="navs-top-answer3" role="tabpanel">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="mb-3">
                                <label class="form-label">Phương án C</label>
                                <?php showEditorInput('option_c', 'option_c', @$data->option_c);?>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="navs-top-answer4" role="tabpanel">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="mb-3">
                                <label class="form-label">Phương án D</label>
                                <?php showEditorInput('option_d', 'option_d', @$data->option_d);?>
                              </div>
                            </div>
                          </div>
                        </div>  
                      </div>              
                  </div>
                </div>

                <!-- <div class="col-md-4">
                  <div class="mb-3">
                    <label class="form-label">Phương án đúng (*)</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="option_true" id="option_true" required>
                        <option value="">Chọn phương án đúng</option>
                        <option value="a" <?php if(!empty($data->option_true) && $data->option_true=='a') echo 'selected'; ?> >Phương án A</option>
                        <option value="b" <?php if(!empty($data->option_true) && $data->option_true=='b') echo 'selected'; ?> >Phương án B</option>
                        <option value="c" <?php if(!empty($data->option_true) && $data->option_true=='c') echo 'selected'; ?> >Phương án C</option>
                        <option value="d" <?php if(!empty($data->option_true) && $data->option_true=='d') echo 'selected'; ?> >Phương án D</option>
                      </select>
                    </div>
                  </div>
                </div> -->

                <div class="col-md-4">
                  <div class="mb-3">
                    <label class="form-label">Bài khảo sát (*)</label>
                    <div class="input-group input-group-merge">
                      <select required class="form-select" name="id_test" id="id_test">
                        <option value="">Chọn bài khảo sát</option>
                        <?php 
                        if(!empty($listTest)){
                          foreach ($listTest as $key => $item) {
                            if(!empty($data->id_test) && $data->id_test==$item->id){
                              echo '<option selected value="'.$item->id.'">'.$item->title.'</option>';
                            }else{
                              echo '<option value="'.$item->id.'">'.$item->title.'</option>';
                            }
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-4 d-none">
                  <div class="mb-3">
                      <label class="form-label">Type</label>
                      <div class="input-group input-group-merge">
                          <input class="form-control" name="type" id="type" readonly>
                      </div>
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

              <button type="submit" class="btn btn-primary">Lưu</button>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const idTestSelect = document.getElementById('id_test');
        const typeInput = document.getElementById('type');

        // Cập nhật input 'type' khi chọn một 'id_test'
        idTestSelect.addEventListener('change', function () {
            const selectedId = idTestSelect.value;
            // Tìm tiêu đề tương ứng với ID được chọn
            for (let option of idTestSelect.options) {
                if (option.value === selectedId) {
                    typeInput.value = option.text;
                    break;
                }
            }
        });

        // Nếu cần khôi phục giá trị khi trang được tải lại
        const selectedId = idTestSelect.value;
        if (selectedId) {
            for (let option of idTestSelect.options) {
                if (option.value === selectedId) {
                    typeInput.value = option.text;
                    break;
                }
            }
        }
    });
</script>