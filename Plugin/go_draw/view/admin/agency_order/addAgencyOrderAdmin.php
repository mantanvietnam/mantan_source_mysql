<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light"><a href="/plugins/admin/go_draw-view-admin-agency_order-listAgencyOrderAdmin.php">Đơn hàng</a> /</span>
        Thông tin đơn hàng
    </h4>

    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-12">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Thông tin sản phẩm</h5>
                </div>
                <div class="card-body">
                    <p><?php echo $mess;?></p>
                    <?= $this->Form->create(); ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="nav-align-top mb-4">

                                <div class="tab-content">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Tên đại lý (*)</label>
                                            <div class="d-flex">
                                                <select name="agency_id" class="form-select color-dropdown">
                                                    <?php
                                                    if (!empty($listAgency)):
                                                        foreach ($listAgency as $agency):
                                                            ?>
                                                          <option value="<?php echo $agency->id; ?>" <?php if (@$data->agency_id == $agency->id) echo 'selected'; ?>><?php echo $agency->name; ?></option>
                                                        <?php
                                                        endforeach;
                                                    endif;
                                                    ?>
                                                </select>
                                                <a class="btn btn-primary" href="<?php echo '/plugins/admin/go_draw-view-admin-agency-viewDetailAgencyAdmin.php/?id=' . @$agency->id; ?>">
                                                  <i class="bx bx-edit-alt me-1"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Tổng tiền</label>
                                            <input type="number" name="total_price" class="form-control" value="<?php echo @$data->total_price?>">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                          <label class="form-label">Trạng thái</label>
                                          <select name="status" class="form-select color-dropdown">
                                            <option value="0" <?php if(@$data->status == 0) echo 'selected';?> >Đơn hàng mới</option>
                                            <option value="1" <?php if(@$data->status == 1) echo 'selected';?> >Đã duyệt</option>
                                            <option value="2" <?php if(@$data->status == 2) echo 'selected';?> >Đã thanh toán</option>
                                          </select>
                                        </div>
                                    </div>

                                    <h5>Các combo trong đơn hàng</h5>
                                    <?php
                                      if (!empty($listItem)):
                                        foreach ($listItem as $key => $item):
                                    ?>
                                        <div class="row">
                                            <input type="hidden" name="<?php echo 'order_detail_id['.$key.']'; ?>" value="<?php echo $item->id; ?>">
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Tên combo</label>
                                                <select name="<?php echo 'order_detail_combo_id['.$key.']'; ?>" class="form-select color-dropdown">
                                                    <?php
                                                      if (!empty($listCombo)):
                                                        foreach ($listCombo as $combo):
                                                    ?>
                                                        <option value="<?php echo $combo->id; ?>" <?php if ($item->combo_id == $combo->id) echo 'selected'; ?>><?php echo $combo->name; ?></option>
                                                    <?php
                                                        endforeach;
                                                      endif;
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Số lượng</label>
                                                <input type="number" name="<?php echo 'order_detail_amount['.$key.']'; ?>" class="form-control" value="<?php echo @$item->amount?>">
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Đơn giá</label>
                                                <input type="number" name="<?php echo 'order_detail_unit_price['.$key.']'; ?>" class="form-control" value="<?php echo @$item->unit_price?>">
                                            </div>
                                        </div>
                                    <?php
                                        endforeach;
                                      else:
                                        echo '<p>Không có</p>';
                                      endif;
                                    ?>
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
    <script type="text/javascript" src="/ckfinder/ckfinder.js"></script>
    <script type="text/javascript">
      function BrowseServerImage(number = 0)
      {
        let finder = new CKFinder();
        finder.basePath = "../";
        finder.selectActionFunction = SetFileFieldImage;
        finder.popup();
      }

      function SetFileFieldImage(fileUrl)
      {
        $("#image").val(fileUrl);
        $("#show-image").attr('src', fileUrl);
      }
    </script>
</div>
