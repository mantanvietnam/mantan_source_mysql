<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light"><a href="/plugins/admin/excgo-view-admin-user-listUserAdmin">Người dùng</a> / Block thành viên trong Khu vực</span>
    </h4>

    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-12">
                 <div class="card-header d-flex justify-content-between align-items-center">
                  <h5 class="mb-0">Thông tin thàng viên</h5>
                </div>
                <div class="card-body">
                    <p><?php echo @$mess;
                    // debug($listBlock);
                   /* debug($listProvince);
                    debug($user);
                    */
                ?></p>
                    <?= $this->Form->create(); ?>
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <img src="<?php echo @$user->avatar ?>" width="200px">
                        </div>
                        <div class="mb-3 col-md-8">
                            <label class="form-label">Họ và tên:</label>&emsp;<span><?php echo $user->name ?></span></br>
                            <label class="form-label">Số điện thoại:</label>&emsp;<span><?php echo $user->phone_number ?></span></br>
                            <label class="form-label">Email:</label>&emsp;<span><?php echo $user->email ?></span></br>
                            <label class="form-label">Địa chỉ:</label>&emsp;<span><?php echo $user->address ?></span></br>
                        </div>
                        <div class="mb-3 col-md-12">
                             <label class="form-label">Khu vực:</label>
                        </div>
                        <?php if(!empty($listProvince)){
                            foreach($listProvince as $key => $item){
                                $checks = '';
                                if(!empty($listBlock)){
                                          $checks = (in_array($item->id, $listBlock))? 'checked':'';
                                        }
                                echo '<div class="mb-3 col-md-3"> <label class="form-label"'.$item->name.' ('.$item->bsx.')</label></br>';
                                 

                                if(!empty($item->lower)){

                                    foreach($item->lower as $k => $value){
                                         $check = '';
                                        if(!empty($listBlock)){
                                          $check = (in_array($value->id, $listBlock))? 'checked':'';
                                        }

                                        echo '&emsp;<input type="checkbox" '.$check.' name="province_id[]" value="'.$value->id.'">&emsp;'.$value->name.'</br>';
                                    }
                                }

                            echo '</div>';
                            }
                        } ?>
                        

                        

                    </div>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>

    </div>
</div>