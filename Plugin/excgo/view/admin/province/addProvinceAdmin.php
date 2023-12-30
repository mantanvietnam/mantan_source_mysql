<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light"><a href="/plugins/admin/excgo-view-admin-province-listProvinceAdmin">Khu vực</a> /</span>
        Thông tin khu vực
    </h4>
    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-12">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Thông tin khu vực</h5>
                </div>

                <div class="card-body">
                    <p><?php echo $mess ?? '';?></p>
                    <?= $this->Form->create(); ?>
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label class="form-label" for="name">Tên khu vực</label>
                            <input required type="text" class="form-control" name="name" id="name" value="<?php echo @$data->name;?>" />
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="status">Trạng thái (*)</label>
                            <select name="status" class="form-select color-dropdown">
                              <option value="1" <?php if(@$data->status == 1) echo 'selected';?> >Kích hoạt</option>
                              <option value="0" <?php if(@$data->status === 0) echo 'selected';?> >Khóa</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8 mb-3 ">
                            <label class="form-label" for="departure_province_id">Khu vực cha (*)</label>
                            <?php if (!empty($parent)): ?>
                                <select name="parent_id" id="parent_id" class="form-select color-dropdown" disabled>
                                  <option value="<?php echo $parent->id ?>" selected><?php echo $parent->name ?? ''; ?></option>
                                </select>
                            <?php else: ?>
                              <select name="parent_id" id="parent_id" class="form-select color-dropdown">
                                  <option value="" selected>Không có</option>
                                  <?php foreach ($listProvince ?? [] as $province): ?>
                                      <option value="<?php echo $province->id ?>"
                                          <?php if(@$data->parent_id == $province->id || @$_GET['parent_id'] == $province->id) echo 'selected';?>
                                      ><?php echo $province->name ?></option>
                                  <?php endforeach ?>
                              </select>
                            <?php endif; ?>
                        </div>
                        <p><a href="<?php echo '/plugins/admin/excgo-view-admin-province-addProvinceAdmin?parent_id=' . @$data->id ?>" class="btn btn-primary">
                          <i class='bx bx-plus'></i> Thêm khu vực con
                        </a></p>
                    </div>

                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>

    </div>
</div><?php
