<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Câu hỏi trắc nghiệm</h4>

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
                  <div class="mb-3">
                    <label class="form-label">Câu hỏi (*)</label>
                    <?php showEditorInput('question', 'question', @$data->question);?>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Phương án A</label>
                    <?php showEditorInput('option_a', 'option_a', @$data->option_a);?>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Phương án B</label>
                    <?php showEditorInput('option_b', 'option_b', @$data->option_b);?>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Phương án C</label>
                    <?php showEditorInput('option_c', 'option_c', @$data->option_c);?>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Phương án D</label>
                    <?php showEditorInput('option_d', 'option_d', @$data->option_d);?>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="mb-3">
                    <label class="form-label">Phương án đúng (*)</label>
                    <div class="input-group input-group-merge">
                      <select class="form-control" name="option_true" id="option_true" required>
                        <option value="">Chọn phương án đúng</option>
                        <option value="a" <?php if(!empty($data->option_true) && $data->option_true=='a') echo 'selected'; ?> >Phương án A</option>
                        <option value="b" <?php if(!empty($data->option_true) && $data->option_true=='b') echo 'selected'; ?> >Phương án B</option>
                        <option value="c" <?php if(!empty($data->option_true) && $data->option_true=='c') echo 'selected'; ?> >Phương án C</option>
                        <option value="d" <?php if(!empty($data->option_true) && $data->option_true=='d') echo 'selected'; ?> >Phương án D</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="mb-3">
                    <label class="form-label">Bài thi (*)</label>
                    <div class="input-group input-group-merge">
                      <select required class="form-control" name="id_test" id="id_test">
                        <option value="">Chọn bài thi</option>
                        <?php 
                        if(!empty($listTest)){
                          foreach ($listTest as $key => $item) {
                            if(empty($data->id_test) || $data->id_test!=$item->id){
                              echo '<option value="'.$item->id.'">'.$item->title.'</option>';
                            }elseif(empty($_SESSION['id_test_choose']) && $_SESSION['id_test_choose']!=$item->id){
                              echo '<option value="'.$item->id.'">'.$item->title.'</option>';
                            }
                            else{
                              echo '<option selected value="'.$item->id.'">'.$item->title.'</option>';
                            }
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="mb-3">
                    <label class="form-label">Trạng thái</label>
                    <div class="input-group input-group-merge">
                      <select class="form-control" name="status" id="status">
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