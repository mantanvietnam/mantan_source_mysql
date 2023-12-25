<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/2top_crm_donate-view-admin-charity-listCharityCRM">Chương trình từ thiện</a> /</span>
    Thông tin chương trình
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin chương trình</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Tên chương trình (*)</label>
                    <input required type="text" class="form-control phone-mask" name="title" id="title" value="<?php echo @$data->title;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Tổng số tiền quyên góp</label>
                    <input type="text" class="form-control" placeholder="" name="money_donate" id="money_donate" value="<?php echo @$data->money_donate;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Tổng số người quyên góp</label>
                    <input type="text" class="form-control" placeholder="" name="person_donate" id="person_donate" value="<?php echo @$data->person_donate;?>" />
                  </div>

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

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Nơi tổ chức chương trình</label>
                    <input type="text" class="form-control" placeholder="" name="address" id="address" value="<?php echo @$data->address;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Thành phố</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="id_city" id="id_city">
                        <?php 
                          $listCity = getListCity();
                          foreach ($listCity as $key => $city) {
                            if(empty($data->id_city) || $data->id_city!=$city['id']){
                              echo '<option value="'.$city['id'].'">'.$city['name'].'</option>';
                            }else{
                              echo '<option selected value="'.$city['id'].'">'.$city['name'].'</option>';
                            }
                          }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Thời gian bắt đầu sự kiện</label>
                    <input type="text" class="form-control datepicker" placeholder="" name="time_event_start" id="time_event_start" value="<?php if(!empty($data->time_event_start)) echo date('d/m/Y', $data->time_event_start);?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Thời gian kết thúc sự kiện</label>
                    <input type="text" class="form-control datepicker" placeholder="" name="time_event_end" id="time_event_end" value="<?php if(!empty($data->time_event_end)) echo date('d/m/Y', $data->time_event_end);?>" />
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="mb-3">
                    <label class="form-label">Mô tả</label>
                    <?php showEditorInput('description', 'description', @$data->description);?>
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