<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light"><a href="/admins/listAdmin">Tài khoản quản trị</a> / Phân quyền dữ liệu</span>
    </h4>

    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-12">
                 <div class="card-header d-flex justify-content-between align-items-center">
                  <h5 class="mb-0">Phân quyền dữ liệu</h5>
                </div>
                <div class="card-body">
                    <p><?php echo @$mess;
                   // debug($admin);
                   /* debug($listProvince);
                    debug($user);
                    */
                ?></p>
                    <?= $this->Form->create(); ?>
                    <div class="row">
                       
                        <div class="mb-3 col-md-8">
                            <label class="form-label">Họ và tên:</label>&emsp;<span><?php echo $admin->fullName ?></span></br>
                            <label class="form-label">Tài khoàn:</label>&emsp;<span><?php echo $admin->user ?></span></br>
                            <label class="form-label">Email:</label>&emsp;<span><?php echo $admin->email ?></span></br>
                        </div>
                        <div class="mb-3 col-md-12">
                             <label class="form-label">Phân quyền:</label>
                        </div>
                        <?php if(!empty($permissiondata)){
                            foreach($permissiondata as $key => $item){
                                $check = '';
                                if(!empty($admin->permissiondata)){
                                  $check = (in_array($key, $admin->permissiondata))? 'checked':'';
                                }
								echo '<div class="mb-3 col-md-3"> <label class=""><input type="checkbox" '.$check.' name="permissiondata[]" value="'.$key.'">  '.$item.'</label></div>';
                            }
                                

                            }
                         ?>
                        

                        

                    </div>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>

    </div>
</div>