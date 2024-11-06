<?php 
    getHeader();
    global $settingThemes;

?>
 <div class="body">
        <div class="auth-container">
            <div class="form-container">
                <!-- Tab content -->
                <div class="tab-content" id="authTabContent">
                    <h4 class="text-center text-danger">Sửa thông tin người tham gia</h4>
                    <?=$mess?>
                    <div class="container">
                        <form method="POST" action="">
                            <input type="hidden" value="<?php echo $csrfToken; ?>" name="_csrfToken">
                            <input type="hidden" value="<?php echo @$data->id_events; ?>" name="id_events">
                            <input type="hidden" value="<?php echo @$data->id_member; ?>" name="id_member">
                                <div class="mb-3">
                                
                                    <input type="hidden" name="name" class="form-control" id="name" placeholder="Tên" value="<?php echo @$data->name;?>" readonly>
                                </div>

                                <div class="mb-3">
                                
                                    <input type="hidden" name="email" class="form-control" id="email" placeholder="email" value="<?php echo @$data->email;?>" readonly>
                                </div>
                                <div class="mb-3">
                            
                                    <input type="hidden" name="sex" class="form-control" id="sex" placeholder="Giới tính" value="<?php echo @$data->sex;?>" readonly>
                                </div>

                                <div class="mb-3">
                                
                                <input type="date-local" name="date" class="form-control" id="date" placeholder="date" value="<?php echo date('H:i d/m/Y', $data->date);?>" readonly>
                                </div>
                                <div class="mb-3">
                            
                                    <input type="hidden" name="city" class="form-control" id="city" placeholder="city" value="<?php echo @$data->city;?>" readonly>
                                </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Trạng thái</label>
                                <select name="status" class="form-control" id="status" required>
                                    <option value="">Chọn trạng thái</option>
                                    <option value="Pending" <?php echo (isset($data['status']) && $data['status'] === 'Pending') ? 'selected' : ''; ?>>Pending</option>
                                    <option value="Absent" <?php echo (isset($data['status']) && $data['status'] === 'Absent') ? 'selected' : ''; ?>>Absent</option>
                                    <option value="Arrived" <?php echo (isset($data['status']) && $data['status'] === 'Arrived') ? 'selected' : ''; ?>>Arrived</option>
                                </select>
                            </div>
                            
                            <!-- <button type="submit" class="btn btn-danger w-100">Sửa thông tin người tham gia</button> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php getFooter();?>