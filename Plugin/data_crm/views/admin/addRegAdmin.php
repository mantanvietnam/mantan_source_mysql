<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">
            <a href="/plugins/admin/data_crm-views-admin-listRegAdmin">Đăng ký Data CRM</a> /
        </span>
        Thông tin đăng ký Data CRM
    </h4>
    
    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-12">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Thông tin đăng ký Data CRM</h5>
                </div>

                <div class="card-body">
                    <p><?php echo $mess ?? ''; ?></p>
                    <?= $this->Form->create(); ?>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="name">Tên hệ thống (*)</label>
                            <input required type="text" class="form-control" name="system_name" id="system_name" value="<?php echo @$data->system_name; ?>" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="name">Tên Boss (*)</label>
                            <input required type="text" class="form-control" name="boss_name" id="boss_name" value="<?php echo @$data->boss_name; ?>" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="name">điện thoại Boss (*)</label>
                            <input required type="text" class="form-control" name="boss_phone" id="boss_phone" value="<?php echo @$data->boss_phone; ?>" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="name">Email Boss (*)</label>
                            <input required type="text" class="form-control" name="boss_email" id="boss_email" value="<?php echo @$data->boss_email; ?>" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="name">Domain</label>
                            <input required type="text" class="form-control" name="domain" id="domain" value="<?php echo @$data->domain; ?>" />
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <?= $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
