<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light"><a href="/plugins/admin/excgo-view-admin-province-listProvinceGroupAdmin?parent_id=<?php echo @$_GET['parent_id']; ?>">Khu vực</a> /</span>
        Thông tin nhóm khu vực <?php echo $province->name.'('.$province->bsx.')'; ?>
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
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="name">Tên khu vực</label>
                            <input required type="text" class="form-control" name="name" id="name" value="<?php echo @$data->name;?>" />
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="status">Trạng thái (*)</label>
                            <select name="status" class="form-select color-dropdown">
                              <option value="1" <?php if(@$data->status == 1) echo 'selected';?> >Kích hoạt</option>
                              <option value="0" <?php if(@$data->status === 0) echo 'selected';?> >Khóa</option>
                            </select>
                        </div>
                    </div>


                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <?= $this->Form->end() ?>

                   

                </div>
            </div>
        </div>
    </div>
</div><?php
