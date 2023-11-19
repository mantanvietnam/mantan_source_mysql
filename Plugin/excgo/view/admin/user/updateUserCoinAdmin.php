<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light"><a href="/plugins/admin/excgo-view-admin-user-listUserAdmin.php">Người dùng</a> /</span>
        <?php if($_GET['type']=='plus') {
            echo 'Cộng coin';
        }else{
            echo 'Trừ coin';
        } ?>
    </h4>

    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-12">
                <!-- <div class="card-header d-flex justify-content-between align-items-center">
                  <h5 class="mb-0">
                  </h5>
                </div> -->
                <div class="card-body">
                    <p><?php echo @$mess;?></p>
                    <?= $this->Form->create(); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-phone"><?php if($_GET['type']=='plus') {
                                        echo 'Số coin Cộng cho tài khoản '.@$data->name.' - '.@$data->phone_number.' - '.number_format($data->total_coin).'đ';
                                    }else{
                                        echo 'Số coin Trừ cho tài khoản '.@$data->name.' - '.@$data->phone_number.' - '.number_format($data->total_coin).'đ';
                                    } ?>  (*)</label>
                                <input required type="number" class="form-control phone-mask" name="coin" id="coin" value="" />
                            </div>
                            <div class="mb-3">
                                <?php if($_GET['type']=='plus'){ ?>
                                    <label class="form-label" for="basic-default-fullname">Lý do cộng (*)</label>
                                    <input class="form-control" required type="text" id="note" name="note" value="">
                                <?php }else{ ?>
                                    <label class="form-label" for="basic-default-fullname">Lý do trừ (*)</label>
                                    <input class="form-control" required type="text" id="note" name="note" value="">
                                <?php   } ?>
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