<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/ngayhoixanh-view-admin-tree-listTreeAdmin/?id_location=<?php echo @$_GET['id_location'];?>">Loại cây</a> /</span>
    Thông tin loại cây
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin loại cây</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Tên chương trình (*)</label>
                    <input required type="text" class="form-control phone-mask" name="name_program" id="name_program" value="<?php echo @$data->name_program;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Địa điểm (*)</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="id_location" id="id_location" required>
                        <option value="">Chọn địa điểm</option>
                        <?php 
                        if(!empty($listLocation)){
                          foreach ($listLocation as $key => $item) {
                            if(empty($data->id_location) || $data->id_location!=$item->id){
                              echo '<option value="'.$item->id.'">'.$item->name.'</option>';
                            }else{
                              echo '<option selected value="'.$item->id.'">'.$item->name.'</option>';
                            }
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Tên loại cây (*)</label>
                    <input required type="text" class="form-control phone-mask" name="name_tree" id="name_tree" value="<?php echo @$data->name_tree;?>" />
                  </div>
                  
                  <div class="mb-3">
                    <label class="form-label">Số lượng cây trồng được (*)</label>
                    <input required type="text" class="form-control phone-mask" name="number_tree" id="number_tree" value="<?php echo @$data->number_tree;?>" />
                  </div>

                  
                </div>

                <div class="col-md-12">
                  <div class="mb-3">
                    <label class="form-label">Lý do chọn 1</label>
                    <?php showEditorInput('choose_1', 'choose_1', @$data->choose_1);?>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Lý do chọn 2</label>
                    <?php showEditorInput('choose_2', 'choose_2', @$data->choose_2);?>
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