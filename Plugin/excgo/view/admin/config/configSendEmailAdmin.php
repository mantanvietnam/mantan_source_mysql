<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Cài đặt gửi email</h4>

    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-12">
                <div class="card-body">
                    <p><?php echo @$mess;?></p>
                    <?= $this->Form->create(); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="listUpgradeRequestToDriverAdmin">Yêu cầu nâng cấp tài khoản</label>
                                <input class="form-control" required type="text" id="listUpgradeRequestToDriverAdmin" name="listUpgradeRequestToDriverAdmin" value="<?php echo @$data_value['listUpgradeRequestToDriverAdmin']; ?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="listWithdrawRequestAdmin">Yêu cầu rút tiền</label>
                                <input class="form-control" required type="text" id="listWithdrawRequestAdmin" name="listWithdrawRequestAdmin" value="<?php echo @$data_value['listWithdrawRequestAdmin']; ?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="listComplaintAdmin">Khiếu nại</label>
                                <input class="form-control" required type="text" id="listComplaintAdmin" name="listComplaintAdmin" value="<?php echo @$data_value['listComplaintAdmin']; ?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="listSupportAdmin">Yêu cầu hỗ trợ</label>
                                <input class="form-control" required type="text" id="listSupportAdmin" name="listSupportAdmin" value="<?php echo @$data_value['listSupportAdmin']; ?>">
                            </div>
                        </div>
                    </div>
                    <p><b>Chú ý:</b> các email cách nhau bởi dấu phẩy</p>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>

    </div>
</div>
